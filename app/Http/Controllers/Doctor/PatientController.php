<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\PatientProfile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientController extends Controller
{
    /**
     * Display the specified patient profile to the doctor.
     */
    public function show(Request $request, PatientProfile $patient): View
    {
        $doctorProfile = $request->user()->doctorProfile;

        if (!$doctorProfile) {
            abort(403, 'Doctor profile not found.');
        }

        // Verify that the logged-in doctor has an appointment history with this patient
        $appointments = $patient->appointments()
            ->with(['latestStatusHistory', 'review'])
            ->where('doctor_profile_id', $doctorProfile->id)
            ->orderByDesc('appointment_datetime')
            ->get();

        if ($appointments->isEmpty()) {
            abort(403, 'You do not have permission to view this patient\'s profile as they have no appointment history with you.');
        }

        $patient->load(['user', 'insurancePlans.provider']);

        return view('doctor.patients.show', compact('patient', 'appointments'));
    }
}
