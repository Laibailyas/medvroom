<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MobileVerificationController extends Controller
{
    /**
     * Display the mobile verification prompt.
     */
    public function show(Request $request): View|RedirectResponse
    {
        return $request->user()->mobile_verified_at
            ? redirect()->intended(route('dashboard', absolute: false))
            : view('auth.verify-mobile');
    }

    /**
     * Verify the user's mobile number.
     */
    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $user = $request->user();

        if ($user->mobile_verification_code !== $request->code || $user->mobile_verification_expires_at->isPast()) {
            return back()->withErrors(['code' => 'The verification code is invalid or has expired.']);
        }

        $user->forceFill([
            'mobile_verified_at' => now(),
            'mobile_verification_code' => null,
            'mobile_verification_expires_at' => null,
        ])->save();

        return redirect()->intended(route('dashboard', absolute: false))
            ->with('status', 'mobile-verified');
    }

    /**
     * Resend the verification code.
     */
    public function resend(Request $request): RedirectResponse
    {
        $user = $request->user();

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->forceFill([
            'mobile_verification_code' => $code,
            'mobile_verification_expires_at' => now()->addMinutes(10),
        ])->save();

        SmsService::send($user->mobile, "Your MedVroom verification code is: {$code}. This code expires in 10 minutes.");

        return back()->with('status', 'verification-link-sent');
    }
}
