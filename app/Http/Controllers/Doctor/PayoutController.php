<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    /**
     * Display the doctor's payout history and Stripe Connect status.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $doctorProfile = $user->doctorProfile;

        if (! $doctorProfile) {
            return redirect()->route('dashboard')->with('error', 'Doctor profile not found.');
        }

        $payouts = $doctorProfile->payouts()
            ->orderByDesc('created_at')
            ->paginate(10);

        // Calculate available and pending balances (simulated for now)
        $availableBalance = $doctorProfile->payouts()->where('status', 'paid')->sum('amount');
        $pendingBalance = $doctorProfile->payouts()->where('status', 'pending')->sum('amount');

        return view('doctor.payouts.index', compact(
            'doctorProfile',
            'payouts',
            'availableBalance',
            'pendingBalance'
        ));
    }

    /**
     * Redirect to Stripe for account onboarding.
     */
    public function connect(Request $request)
    {
        $user = $request->user();
        $doctorProfile = $user->doctorProfile;

        // In a real implementation, we would use Stripe SDK to create a link.
        // For now, we simulate the redirect to a "Stripe" page.

        return back()->with('success', 'Stripe Connect onboarding flow would start here.');
    }
}
