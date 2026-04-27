<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Conversation;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display the doctor's appointments.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $doctorProfile = $user->doctorProfile;

        if (! $doctorProfile) {
            return redirect()->route('dashboard')->with('error', 'Doctor profile not found.');
        }

        $tab = $request->get('tab', 'requests');

        $query = Appointment::where('doctor_profile_id', $doctorProfile->id)
            ->with(['patientProfile.user', 'statusHistories']);

        if ($tab === 'requests') {
            $query->whereHas('latestStatusHistory', function ($q) {
                $q->whereIn('status', ['pending', 'reschedule_requested']);
            })->orderBy('created_at', 'asc');
        } elseif ($tab === 'upcoming') {
            $query->whereHas('latestStatusHistory', function ($q) {
                $q->where('status', 'confirmed');
            })->where('appointment_datetime', '>', now())
                ->orderBy('appointment_datetime', 'asc');
        } elseif ($tab === 'past') {
            $query->where(function ($q) {
                $q->whereHas('latestStatusHistory', function ($q2) {
                    $q2->whereIn('status', ['completed', 'cancelled', 'rejected']);
                })->orWhere(function ($q3) {
                    $q3->whereHas('latestStatusHistory', function ($q4) {
                        $q4->where('status', 'confirmed');
                    })->where('appointment_datetime', '<', now());
                });
            })->orderBy('appointment_datetime', 'desc');
        }

        $appointments = $query->paginate(10)->withQueryString();

        return view('doctor.appointments.index', compact('appointments', 'tab'));
    }

    /**
     * Update the status of an appointment (e.g. Accept, Reject)
     */
    public function show(Appointment $appointment)
    {
        $doctorProfile = auth()->user()->doctorProfile;

        if ($appointment->doctor_profile_id !== $doctorProfile->id) {
            abort(403);
        }

        $appointment->load(['patientProfile.user', 'latestStatusHistory', 'statusHistories', 'review']);

        $conversation = Conversation::firstOrCreate([
            'patient_id' => $appointment->patientProfile->user_id,
            'doctor_id' => $doctorProfile->user_id,
        ]);

        return view('doctor.appointments.show', compact('appointment', 'conversation'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $user = $request->user();
        $doctorProfile = $user->doctorProfile;

        // Ensure this appointment belongs to the logged-in doctor
        if (! $doctorProfile || $appointment->doctor_profile_id !== $doctorProfile->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'status' => 'required|in:confirmed,cancelled,completed',
            'comment' => 'nullable|string|max:500',
        ]);

        $appointment->transitionStatus(
            $validated['status'],
            $validated['comment'] ?? 'Doctor updated status',
            $user->id
        );

        return back()->with('success', 'Appointment status updated to '.$validated['status']);
    }

    /**
     * Propose a reschedule to a new datetime.
     */
    public function reschedule(Request $request, Appointment $appointment)
    {
        $user = $request->user();
        $doctorProfile = $user->doctorProfile;

        // Ensure this appointment belongs to the logged-in doctor
        if (! $doctorProfile || $appointment->doctor_profile_id !== $doctorProfile->id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'new_datetime' => 'required|date|after:today',
            'comment' => 'nullable|string|max:500',
        ]);

        // Keep the old datetime for reference if needed, or update immediately.
        // The requirement is that the patient has to confirm manually.
        // We will update the appointment_datetime and change the status to 'reschedule_requested'.

        $appointment->update([
            'appointment_datetime' => $validated['new_datetime'],
        ]);

        $appointment->transitionStatus(
            'reschedule_requested',
            $validated['comment'] ?? 'Doctor requested to reschedule.',
            $user->id
        );

        return back()->with('success', 'Reschedule request sent to the patient.');
    }
}
