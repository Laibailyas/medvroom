<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the patient registration view.
     */
    public function create(): View
    {
        return view('auth.register-patient');
    }

    /**
     * Display the doctor registration view.
     */
    public function createDoctor(): View
    {
        return view('auth.register-doctor');
    }

    /**
     * Handle an incoming patient registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'mobile' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'date_of_birth' => ['required', 'string'],
            'sex' => ['required', 'in:male,female,other'],
            'extended_gender' => ['nullable', 'array'],
        ]);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'mobile_verification_code' => $code,
            'mobile_verification_expires_at' => now()->addMinutes(10),
            'password' => Hash::make($request->password),
            'role' => User::ROLE_PATIENT,
        ]);

        SmsService::send($request->mobile, "Your MedVroom verification code is: {$code}. This code expires in 10 minutes.");

        $user->patientProfile()->create([
            'date_of_birth' => $request->date_of_birth,
            'sex' => $request->sex,
            'extended_gender' => $request->extended_gender,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.mobile.notice');
    }

    /**
     * Handle an incoming doctor registration request.
     *
     * @throws ValidationException
     */
    public function storeDoctor(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'practice_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'mobile' => ['required', 'string', 'max:20', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'practice_specialty' => ['nullable', 'string'],
            'practice_size' => ['nullable', 'string'],
            'practice_zip_code' => ['required', 'string'],
            'referral_source' => ['nullable', 'string'],
            'terms' => ['accepted'],
        ]);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'mobile_verification_code' => $code,
            'mobile_verification_expires_at' => now()->addMinutes(10),
            'password' => Hash::make($request->password),
            'role' => User::ROLE_DOCTOR,
        ]);

        SmsService::send($request->mobile, "Your MedVroom verification code is: {$code}. This code expires in 10 minutes.");

        $user->doctorProfile()->create([
            'is_verified' => false,
            'clinic_name' => $request->practice_name,
            'practice_name' => $request->practice_name,
            'practice_specialty' => $request->practice_specialty,
            'practice_size' => $request->practice_size,
            'practice_zip_code' => $request->practice_zip_code,
            'referral_source' => $request->referral_source,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.mobile.notice');
    }
}
