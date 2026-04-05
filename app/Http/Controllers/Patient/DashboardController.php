<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the patient dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $patientProfile = $user->patientProfile;

        // Appointments
        $allUpcoming = $patientProfile->appointments()
            ->with(['doctorProfile.user', 'latestStatusHistory'])
            ->where('appointment_datetime', '>=', now())
            ->orderBy('appointment_datetime')
            ->get();

        $actionRequiredAppointments = $allUpcoming->filter(function ($appt) {
            return $appt->status === 'reschedule_requested';
        });

        $upcomingAppointments = $allUpcoming->filter(function ($appt) {
            return $appt->status !== 'reschedule_requested';
        })->take(5);

        $pastAppointments = $patientProfile->appointments()
            ->with(['doctorProfile.user', 'latestStatusHistory', 'review'])
            ->where('appointment_datetime', '<', now())
            ->orderByDesc('appointment_datetime')
            ->take(5)
            ->get();

        // Care Team
        $careTeamIds = $patientProfile->appointments()->pluck('doctor_profile_id')->unique();
        $careTeam = DoctorProfile::whereIn('id', $careTeamIds)
            ->with(['user', 'specialties'])
            ->take(4)
            ->get();

        // Insurance Plans
        $insurancePlans = $patientProfile->insurancePlans()->with('provider')->get();

        // Well Guide Items
        $wellGuideItems = $this->getWellGuideItems($patientProfile->well_guide_data ?? []);
        $completedCount = collect($wellGuideItems)->where('completed', true)->count();
        $totalCount = count($wellGuideItems);
        $progress = $totalCount > 0 ? ($completedCount / $totalCount) * 100 : 0;

        return view('patient.dashboard', compact(
            'actionRequiredAppointments',
            'upcomingAppointments',
            'pastAppointments',
            'careTeam',
            'insurancePlans',
            'wellGuideItems',
            'progress',
            'completedCount',
            'totalCount'
        ));
    }

    /**
     * Display all patient appointments.
     */
    public function appointments(Request $request): View
    {
        $user = $request->user();
        $patientProfile = $user->patientProfile;

        $appointments = $patientProfile->appointments()
            ->with(['doctorProfile.user', 'doctorProfile.specialties', 'latestStatusHistory', 'review'])
            ->orderByDesc('appointment_datetime')
            ->paginate(15);

        // Sidebar data
        $careTeamIds = $patientProfile->appointments()->pluck('doctor_profile_id')->unique();
        $careTeam = DoctorProfile::whereIn('id', $careTeamIds)
            ->with(['user', 'specialties'])
            ->take(4)
            ->get();
        $insurancePlans = $patientProfile->insurancePlans()->with('provider')->get();

        return view('patient.appointments.index', compact('appointments', 'careTeam', 'insurancePlans'));
    }

    /**
     * Display appointment details.
     */
    public function show(Appointment $appointment): View
    {
        $this->authorizeOwner($appointment);

        $appointment->load(['patientProfile.user', 'doctorProfile.user', 'doctorProfile.specialties', 'payment', 'statusHistories', 'insurancePlan.provider']);

        $conversation = \App\Models\Conversation::firstOrCreate([
            'patient_id' => $appointment->patientProfile->user_id,
            'doctor_id' => $appointment->doctorProfile->user_id,
        ]);

        return view('patient.appointments.show', compact('appointment', 'conversation'));
    }

    /**
     * Show the rescheduling form.
     */
    public function reschedule(Appointment $appointment): View|RedirectResponse
    {
        $this->authorizeOwner($appointment);

        // Check 24 hour cutoff: must be more than 24 hours in the future
        if (! $appointment->appointment_datetime->isAfter(now()->addHours(24))) {
            return redirect()->route('patient.appointments.show', $appointment)
                ->with('error', 'Appointments can only be rescheduled up to 24 hours before the scheduled time.');
        }

        $doctor = $appointment->doctorProfile->load('user', 'specialties');
        
        // Load availability for the next 7 days
        $startDate = now()->startOfDay();
        $endDate = now()->addDays(7)->endOfDay();
        $userTimezone = config('app.timezone'); 
        $availability = $doctor->getAvailabilityForRange($startDate, $endDate, $userTimezone);

        return view('patient.appointments.reschedule', compact('appointment', 'doctor', 'availability'));
    }

    /**
     * Update the appointment time.
     */
    public function updateReschedule(Request $request, Appointment $appointment): RedirectResponse
    {
        $this->authorizeOwner($appointment);

        if (! $appointment->appointment_datetime->isAfter(now()->addHours(24))) {
            return redirect()->route('patient.appointments.show', $appointment)
                ->with('error', 'This appointment can no longer be rescheduled.');
        }

        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
        ]);

        $newDateTime = \Carbon\Carbon::parse("{$request->date} {$request->time}");

        // Simple validation: ensure it's in the future
        if ($newDateTime->isPast()) {
            return back()->with('error', 'Please select a future time slot.');
        }

        $oldDateTime = $appointment->appointment_datetime;
        $appointment->update(['appointment_datetime' => $newDateTime]);

        $appointment->transitionStatus('confirmed', "Rescheduled by patient. Was originally: " . $oldDateTime->format('M d, Y h:i A'));

        return redirect()->route('patient.appointments.show', $appointment)
            ->with('success', 'Appointment successfully rescheduled!');
    }

    /**
     * Reply to a doctor's reschedule request.
     */
    public function replyReschedule(Request $request, Appointment $appointment): RedirectResponse
    {
        $this->authorizeOwner($appointment);

        if ($appointment->status !== 'reschedule_requested') {
            return back()->with('error', 'This appointment does not have a pending reschedule request.');
        }

        $request->validate([
            'action' => 'required|in:accept,reject',
        ]);

        if ($request->action === 'accept') {
            $appointment->transitionStatus('confirmed', 'Patient accepted the proposed reschedule time.', $request->user()->id);
            return back()->with('success', 'You have accepted the new appointment time.');
        } else {
            $appointment->transitionStatus('cancelled', 'Patient rejected the proposed reschedule time.', $request->user()->id);
            return back()->with('success', 'You have rejected the reschedule. The appointment is cancelled.');
        }
    }

    /**
     * Authorize that the authenticated user owns the appointment.
     */
    private function authorizeOwner(Appointment $appointment): void
    {
        if ($appointment->patient_profile_id !== auth()->user()->patientProfile->id) {
            abort(403, 'Unauthorized access to appointment details.');
        }
    }

    /**
     * Toggle the completion status of a well guide item.
     */
    public function toggleWellGuide(Request $request, string $itemId): RedirectResponse
    {
        $patientProfile = $request->user()->patientProfile;
        $data = $patientProfile->well_guide_data ?? [];

        $data[$itemId] = ! ($data[$itemId] ?? false);

        $patientProfile->update(['well_guide_data' => $data]);

        return back()->with('status', 'well-guide-updated');
    }

    /**
     * Get the predefined well guide items with their status.
     */
    private function getWellGuideItems(array $state): array
    {
        $items = [
            [
                'id' => 'annual_checkup',
                'title' => 'Annual checkup',
                'description' => 'The CDC recommends regular checkups once per year to catch any health problems early.',
                'icon' => 'calendar',
            ],
            [
                'id' => 'skin_check',
                'title' => 'Skin check',
                'description' => 'According to the American Cancer Society, prevention and early detection are the first steps in the fight against cancer.',
                'icon' => 'shield',
            ],
            [
                'id' => 'teeth_cleaning',
                'title' => 'Teeth cleaning',
                'description' => 'The American Dental Association recommends regular cleanings to prevent gum disease.',
                'icon' => 'tooth',
            ],
            [
                'id' => 'eye_exam',
                'title' => 'Eye exam',
                'description' => 'The American Academy of Ophthalmology recommends vision screenings periodically.',
                'icon' => 'eye',
            ],
        ];

        return array_map(function ($item) use ($state) {
            $item['completed'] = $state[$item['id']] ?? false;

            return $item;
        }, $items);
    }
}
