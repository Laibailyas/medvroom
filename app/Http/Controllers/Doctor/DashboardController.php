<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $doctorProfile = $user->doctorProfile;

        if (!$doctorProfile) {
            // Handle edge case where a user has doctor role but no profile yet
            return redirect()->route('dashboard')->with('error', 'Doctor profile not found.');
        }

        $now = now();

        $todaysAppointments = $doctorProfile->appointments()
            ->with(['patientProfile.user'])
            ->whereDate('appointment_datetime', $now->toDateString())
            ->orderBy('appointment_datetime')
            ->get();

        $upcomingAppointments = $doctorProfile->appointments()
            ->with(['patientProfile.user'])
            ->where('appointment_datetime', '>', $now)
            ->whereHas('latestStatusHistory', function ($query) {
                $query->where('status', 'confirmed');
            })
            ->orderBy('appointment_datetime')
            ->take(5)
            ->get();
            
        $pendingAppointments = $doctorProfile->appointments()
            ->with(['patientProfile.user'])
            ->whereHas('latestStatusHistory', function ($query) {
                $query->where('status', 'pending')->orWhere('status', 'reschedule_requested');
            })
            ->orderBy('created_at', 'asc')
            ->get();
            
        $pendingRequests = $pendingAppointments->count();

        $totalPatients = $doctorProfile->appointments()
            ->distinct('patient_profile_id')
            ->count('patient_profile_id');

        return view('doctor.dashboard', compact(
            'todaysAppointments',
            'upcomingAppointments',
            'pendingAppointments',
            'pendingRequests',
            'totalPatients'
        ));
    }
}
