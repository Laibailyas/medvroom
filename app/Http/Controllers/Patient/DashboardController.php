<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\DoctorProfile;
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
        $upcomingAppointments = $patientProfile->appointments()
            ->with(['doctorProfile.user', 'latestStatusHistory'])
            ->where('appointment_datetime', '>=', now())
            ->orderBy('appointment_datetime')
            ->get();

        $pastAppointments = $patientProfile->appointments()
            ->with(['doctorProfile.user', 'latestStatusHistory', 'review'])
            ->where('appointment_datetime', '<', now())
            ->orderByDesc('appointment_datetime')
            ->take(5)
            ->get();

        // Care Team (Doctors the patient has visited)
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
     * Toggle the completion status of a well guide item.
     */
    public function toggleWellGuide(Request $request, string $itemId)
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
