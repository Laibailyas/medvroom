<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Monthly appointment counts for the last 12 months
        $monthlyData = Appointment::select(
                DB::raw('MONTH(created_at) as month'),
DB::raw('YEAR(created_at) as year'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(fn ($r) => $r->year . '-' . $r->month);

        // Build 12-month labels + data arrays
        $chartLabels = [];
        $chartData   = [];
        for ($i = 11; $i >= 0; $i--) {
            $dt  = now()->subMonths($i);
            $key = $dt->format('Y') . '-' . $dt->format('m');
            $chartLabels[] = $dt->format('M');
            $chartData[]   = $monthlyData->get($key)?->total ?? 0;
        }

        $stats = [
            'total_patients'     => User::where('role', User::ROLE_PATIENT)->count(),
            'total_doctors'      => DoctorProfile::count(),
            'pending_providers'  => DoctorProfile::where('is_verified', false)->count(),
            'total_appointments' => Appointment::count(),
            'total_revenue'      => Payment::where('status', 'paid')->sum('amount') ?? 0,
            'recent_appointments' => Appointment::with([
                    'doctorProfile.user',
                    'patientProfile.user',
                ])
                ->latest()
                ->take(5)
                ->get(),
            'chart_labels' => $chartLabels,
            'chart_data'   => $chartData,
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
