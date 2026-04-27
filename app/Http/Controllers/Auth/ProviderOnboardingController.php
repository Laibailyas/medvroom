<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\InsuranceProvider;
use App\Models\Specialty;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProviderOnboardingController extends Controller
{
    // ── Middleware guard ──────────────────────────────────────────────────────

    /**
     * Redirect guest-only steps (1-2) away from logged-in users,
     * and gate authenticated steps (3+) behind auth.
     */
    private function requireAuth(): ?RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('provider.register.account');
        }

        return null;
    }

    // ── Screen 0 — Entry ─────────────────────────────────────────────────────

    public function entry(): View
    {
        return view('auth.provider-onboarding.entry');
    }

    // ── Screen 1 — Account Creation ──────────────────────────────────────────

    public function account(): View
    {
        return view('auth.provider-onboarding.account');
    }

    public function storeAccount(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'phone' => ['required', 'string', 'max:20', 'unique:users,mobile'],
        ]);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->email,
            'email' => $request->email,
            'mobile' => $request->phone,
            'mobile_verification_code' => $code,
            'mobile_verification_expires_at' => now()->addMinutes(10),
            'password' => Hash::make($request->password),
            'role' => User::ROLE_DOCTOR,
        ]);

        $user->doctorProfile()->create([
            'is_verified' => false,
            'onboarding_step' => 1,
        ]);

        // SMS code will be sent later in the flow, or send it now but verify later.
        // Let's send it now so it's ready when they reach the end.
        SmsService::send($request->phone, "Your MedVroom verification code is: {$code}. Use this at the final step of your registration.");

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('provider.register.identity');
    }

    // ── Screen 2 — Basic Provider Info (Moved up) ───────────────────────────

    public function identity(): View
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        return view('auth.provider-onboarding.identity');
    }

    public function storeIdentity(Request $request): RedirectResponse
    {
        $request->validate([
            'legal_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'provider_type' => 'required|string|max:50',
            'entity_type' => 'required|in:individual,organization',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->update(['name' => $request->legal_name]);
        $user->doctorProfile->update([
            'date_of_birth' => $request->date_of_birth,
            'provider_type' => $request->provider_type,
            'entity_type' => $request->entity_type,
            'onboarding_step' => 2,
        ]);

        return redirect()->route('provider.register.npi');
    }

    // ── Screen 3 — NPI Lookup ────────────────────────────────────────────────

    public function npi()
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        return view('auth.provider-onboarding.npi');
    }

    /**
     * Live NPI lookup — proxies to the CMS NPI Registry API.
     */
    public function npiLookup(Request $request): JsonResponse
    {
        $request->validate(['npi' => 'required|digits:10']);

        try {
            $response = Http::timeout(5)->get('https://npiregistry.cms.hhs.gov/api/', [
                'number' => $request->npi,
                'enumeration_type' => '',
                'version' => '2.1',
            ]);

            $results = $response->json('results', []);

            if (empty($results)) {
                return response()->json(['found' => false]);
            }

            $r = $results[0];
            $addr = collect($r['addresses'] ?? [])->firstWhere('address_purpose', 'LOCATION') ?? ($r['addresses'][0] ?? []);

            return response()->json([
                'found' => true,
                'name' => trim(($r['basic']['first_name'] ?? '').' '.($r['basic']['last_name'] ?? $r['basic']['organization_name'] ?? '')),
                'specialty' => $r['taxonomies'][0]['desc'] ?? null,
                'address' => implode(', ', array_filter([
                    $addr['address_1'] ?? null,
                    $addr['city'] ?? null,
                    $addr['state'] ?? null,
                    $addr['postal_code'] ?? null,
                ])),
                'taxonomy' => $r['taxonomies'][0]['code'] ?? null,
                'raw' => $r,
            ]);
        } catch (\Throwable) {
            return response()->json(['found' => false, 'error' => 'Lookup unavailable.']);
        }
    }

    public function storeNpi(Request $request): RedirectResponse
    {
        $request->validate([
            'npi_number' => 'required|digits:10',
            'npi_confirmed' => 'required|in:1',
            'clinic_name' => 'nullable|string|max:255',
            'clinic_address' => 'nullable|string|max:500',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->doctorProfile->update([
            'npi_number' => $request->npi_number,
            'npi_data' => $request->input('npi_raw') ? json_decode($request->npi_raw, true) : null,
            'clinic_name' => $request->clinic_name,
            'clinic_address' => $request->clinic_address,
            'onboarding_step' => 3,
        ]);

        return redirect()->route('provider.register.license');
    }

    // ── Screen 4 — License & Practice Details ────────────────────────────────

    public function license(): View
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        return view('auth.provider-onboarding.license');
    }

    public function storeLicense(Request $request): RedirectResponse
    {
        $request->validate([
            'licenses' => 'required|array|min:1',
            'licenses.*.state' => 'required|string|size:2',
            'licenses.*.number' => 'required|string|max:50',
            'licenses.*.expiry' => 'required|date|after:today',
            'telehealth_available' => 'nullable|boolean',
            'practice_zip_code' => 'required|string|max:10',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->doctorProfile->update([
            'license_states' => $request->licenses,
            'telehealth_available' => (bool) $request->telehealth_available,
            'practice_zip_code' => $request->practice_zip_code,
            'onboarding_step' => 4,
        ]);

        return redirect()->route('provider.register.services');
    }

    // ── Screen 5 — Insurance & Services ──────────────────────────────────────

    public function services(): View
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        $specialties = Specialty::orderBy('name')->get();
        $insurances = InsuranceProvider::orderBy('name')->get();

        return view('auth.provider-onboarding.services', compact('specialties', 'insurances'));
    }

    public function storeServices(Request $request): RedirectResponse
    {
        $request->validate([
            'specialties' => 'nullable|array',
            'specialties.*' => 'exists:specialties,id',
            'insurances' => 'nullable|array',
            'visit_types' => 'required|array|min:1',
            'visit_types.*' => 'in:in-person,telehealth',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $profile = $user->doctorProfile;
        $profile->update([
            'visit_types' => $request->visit_types,
            'onboarding_step' => 5,
        ]);

        if ($request->has('specialties')) {
            $profile->specialties()->sync($request->specialties);
        }

        return redirect()->route('provider.register.schedule');
    }

    // ── Screen 6 — Availability Setup ────────────────────────────────────────

    public function schedule(): View
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        return view('auth.provider-onboarding.schedule');
    }

    public function storeSchedule(Request $request): RedirectResponse
    {
        $request->validate([
            'schedule' => 'nullable|array',
            'schedule.*.day' => 'required|integer|between:0,6',
            'schedule.*.start' => 'required|date_format:H:i',
            'schedule.*.end' => 'required|date_format:H:i|after:schedule.*.start',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;

        $profile->schedules()->delete();
        foreach (($request->schedule ?? []) as $slot) {
            $profile->schedules()->create([
                'day_of_week' => $slot['day'],
                'start_time' => $slot['start'],
                'end_time' => $slot['end'],
                'slot_duration_minutes' => 30,
            ]);
        }

        $profile->update(['onboarding_step' => 6]);

        return redirect()->route('provider.register.documents');
    }

    // ── Screen 7 — Documents Upload ───────────────────────────────────────────

    public function documents(): View
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        return view('auth.provider-onboarding.documents');
    }

    public function storeDocuments(Request $request): RedirectResponse
    {
        $request->validate([
            'document_license' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'document_id' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'document_malpractice' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;

        $updates = ['onboarding_step' => 7];

        if ($request->hasFile('document_license')) {
            $updates['document_license_path'] = $request->file('document_license')->store('provider-docs/licenses', 'local');
        }
        if ($request->hasFile('document_id')) {
            $updates['document_id_path'] = $request->file('document_id')->store('provider-docs/ids', 'local');
        }
        if ($request->hasFile('document_malpractice')) {
            $updates['document_malpractice_path'] = $request->file('document_malpractice')->store('provider-docs/malpractice', 'local');
        }

        $profile->update($updates);

        return redirect()->route('provider.register.agreements');
    }

    // ── Screen 8 — Agreements ────────────────────────────────────────────────

    public function agreements(): View
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        return view('auth.provider-onboarding.agreements');
    }

    public function storeAgreements(Request $request): RedirectResponse
    {
        $request->validate([
            'agreed_provider_agreement' => 'accepted',
            'agreed_baa' => 'accepted',
            'agreed_license_validity' => 'accepted',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->doctorProfile->update([
            'agreed_provider_agreement' => true,
            'agreed_baa' => true,
            'agreed_license_validity' => true,
            'onboarding_step' => 8,
        ]);

        return redirect()->route('provider.register.verify');
    }

    // ── Screen 9 — Verify OTP (Moved to the end) ─────────────────────────────

    public function verify(): View
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        return view('auth.provider-onboarding.verify');
    }

    public function storeVerify(Request $request): RedirectResponse
    {
        $request->validate(['code' => 'required|digits:6']);

        /** @var User $user */
        $user = Auth::user();

        if (
            $user->mobile_verification_code !== $request->code ||
            now()->isAfter($user->mobile_verification_expires_at)
        ) {
            return back()->withErrors(['code' => 'Invalid or expired code. Please try again.']);
        }

        $user->update([
            'mobile_verified_at' => now(),
            'mobile_verification_code' => null,
        ]);

        $user->doctorProfile->update(['onboarding_step' => 9]);

        return redirect()->route('provider.register.review');
    }

    // ── Screen 10 — Review & Submit ───────────────────────────────────────────

    public function review(): View
    {
        if ($redirect = $this->requireAuth()) {
            return $redirect;
        }

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile->load('specialties');

        return view('auth.provider-onboarding.review', compact('user', 'profile'));
    }

    public function submit(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;

        $profile->update([
            'application_submitted_at' => now(),
            'onboarding_step' => 10,
        ]);

        if (! $user->hasVerifiedEmail()) {
            session(['url.intended' => route('provider.register.success')]);
            return redirect()->route('verification.notice');
        }

        return redirect()->route('provider.register.success');
    }

    // ── Screen 11 — Success ───────────────────────────────────────────────────

    public function success(): View
    {
        return view('auth.provider-onboarding.success');
    }
}
