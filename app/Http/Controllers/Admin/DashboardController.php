<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_patients' => User::where('role', User::ROLE_PATIENT)->count(),
            'total_doctors' => DoctorProfile::count(),
            'total_appointments' => Appointment::count(),
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'recent_appointments' => Appointment::with(['doctorProfile.user', 'patientProfile.user'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
