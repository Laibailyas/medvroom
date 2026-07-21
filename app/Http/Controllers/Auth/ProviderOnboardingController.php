<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\InsuranceProvider;
use App\Models\InsurancePlan;
use App\Models\LegalAcceptance;
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
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProviderOnboardingController extends Controller
{
    /**
     * The Step 2 specialty <select> stores slug values (e.g. "primary_care")
     * in practice_specialty for display purposes, but the public search page
     * matches against the real `specialties` lookup table's `name` column
     * (e.g. "Primary Care"). This maps slug → display name so we can keep
     * that relation in sync whenever a provider sets/changes their specialty.
     */
    private const SPECIALTY_LABELS = [
        'primary_care'      => 'Primary Care',
        'internal_medicine' => 'Internal Medicine',
        'family_medicine'   => 'Family Medicine',
        'pediatrics'        => 'Pediatrics',
        'psychiatry'        => 'Psychiatry',
        'cardiology'        => 'Cardiology',
        'dermatology'       => 'Dermatology',
        'orthopedics'       => 'Orthopedics',
        'neurology'         => 'Neurology',
        'ob_gyn'            => 'OB/GYN',
        'urology'           => 'Urology',
        'oncology'          => 'Oncology',
        'endocrinology'     => 'Endocrinology',
        'gastroenterology'  => 'Gastroenterology',
        'pulmonology'       => 'Pulmonology',
        'rheumatology'      => 'Rheumatology',
        'other'             => 'Other',
    ];

    /**
     * Maps each legal checkbox accepted on Step 6 to the document slug +
     * current version used for the audit-trail record in legal_acceptances.
     * Bump the version string here whenever the underlying policy text
     * changes, so historical acceptances stay tied to the version that was
     * actually agreed to.
     */
    private const LEGAL_DOCUMENT_VERSIONS = [
        'provider-agreement'     => '1.0',
        'baa'                    => '1.0',
        'insurance-accuracy'     => '1.0',
        'payment-authorization'  => '1.0',
    ];

    // ── Middleware guard ──────────────────────────────────────────────────────

    private function requireAuth(): ?RedirectResponse
    {
        if (! Auth::check()) {
            return redirect()->route('provider.register.account');
        }

        return null;
    }

    /**
     * Once a provider has already submitted their application, editing an
     * earlier step shouldn't drag them forward through the rest of the
     * wizard again — send them back to the status page (which shows the
     * "action required" banner + links to every step when the admin has
     * requested more info). Before first submission, keep the normal
     * forward-moving wizard flow.
     */
    private function redirectAfterStep($profile, string $nextStepRoute): RedirectResponse
    {
        if ($profile->application_submitted_at) {
            return redirect()
                ->route('provider.register.status')
                ->with('success', 'Your info has been updated. Our team will review the changes.');
        }

        return redirect()->route($nextStepRoute);
    }

    // ── Screen 0 — Entry ─────────────────────────────────────────────────────

    public function entry(): View
    {
        return view('auth.provider-onboarding.entry');
    }

    // ── Step 1 — Create Account ───────────────────────────────────────────────

    public function account(): View
    {
        return view('auth.provider-onboarding.account');
    }

    public function storeAccount(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Password::defaults()],
            'phone'    => ['required', 'string', 'max:20', 'unique:users,mobile'],
        ]);

        $user = User::create([
            'name'     => $request->email,
            'email'    => $request->email,
            'mobile'   => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => User::ROLE_DOCTOR,
        ]);

        $user->doctorProfile()->create([
            'is_verified'     => false,
            'onboarding_step' => 1,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('provider.register.practice');
    }

    // ── Step 2 — Basic Practice Info ──────────────────────────────────────────

    public function practice(): View
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        $profile = Auth::user()->doctorProfile;

        return view('auth.provider-onboarding.practice', compact('profile'));
    }

    public function storePractice(Request $request): RedirectResponse
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        $request->validate([
            'full_name'     => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'practice_name' => 'nullable|string|max:255',
            'specialty'     => 'required|string|max:100',
            'city'          => 'required|string|max:100',
            'state'         => 'required|string|size:2',
        ]);

        /** @var User $user */
        $user = Auth::user();

        $user->update(['name' => $request->full_name]);

        $practiceName = $request->practice_name ?: 'Solo provider';

        $profile = $user->doctorProfile;

        $profile->update([
            'date_of_birth'       => $request->date_of_birth,
            // clinic_name and practice_name are both populated from the same
            // submission — clinic_name feeds the admin-editable "Clinical
            // Metadata" form, practice_name feeds the read-only "Submitted
            // Application" display, so they should never silently diverge.
            'clinic_name'         => $practiceName,
            'practice_name'       => $practiceName,
            'practice_specialty'  => $request->specialty,
            'practice_city'       => $request->city,
            'practice_state'      => $request->state,
            'onboarding_step'     => max($profile->onboarding_step ?? 0, 2),
        ]);

        // FIX: the public search page filters providers via the real
        // `specialties` relation (doctor_specialty pivot), not the
        // practice_specialty text column above. Keep it in sync here,
        // converting the slug ("primary_care") to its display name
        // ("Primary Care"). firstOrCreate means this self-heals even if
        // the specialties lookup table doesn't have the row yet.
        $specialtyLabel = self::SPECIALTY_LABELS[$request->specialty] ?? null;
        if ($specialtyLabel) {
            $specialty = Specialty::firstOrCreate(
                ['name' => $specialtyLabel],
                ['slug' => Str::slug($specialtyLabel)]
            );
            $profile->specialties()->sync([$specialty->id]);
        }

        return $this->redirectAfterStep($profile, 'provider.register.license');
    }

    // ── Step 3 — License + Identifiers ────────────────────────────────────────

    public function license(): View
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        $profile = Auth::user()->doctorProfile;

        return view('auth.provider-onboarding.license', compact('profile'));
    }

    /**
     * License search proxy — name + state lookup (future enhancement).
     * Returns empty results for now; replace with real registry API call.
     */
    public function licenseSearch(Request $request): JsonResponse
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'state' => 'required|string|max:50',
        ]);

        // TODO: Integrate with state medical board API
        return response()->json(['results' => []]);
    }

    public function storeLicense(Request $request): RedirectResponse
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;

        // Documents are only required the first time. On a resubmission
        // (e.g. after admin requests more info) the provider should be able
        // to fix a single field — like the NPI number — without being
        // forced to re-upload documents that are already on file.
        $documentIdRule = $profile->document_id_path
            ? 'nullable|file|mimes:pdf,png,jpg,jpeg|max:10240'
            : 'required|file|mimes:pdf,png,jpg,jpeg|max:10240';

        $documentMalpracticeRule = $profile->document_malpractice_path
            ? 'nullable|file|mimes:pdf,png,jpg,jpeg|max:10240'
            : 'required|file|mimes:pdf,png,jpg,jpeg|max:10240';

        $request->validate([
            'license_type'             => 'required|string|max:50',
            'license_number'           => 'required|string|max:100',
            'license_expiration_date'  => 'required|date|after:today',
            'state_of_licensure'       => 'required|string|size:2',
            'npi_number'               => 'required|digits:10',
            'npi_raw'                  => 'nullable|string',
            'dea_number'               => 'nullable|string|max:20',
            'document_id'              => $documentIdRule,
            'document_malpractice'     => $documentMalpracticeRule,
        ]);

        $npiData = null;
        if ($request->filled('npi_raw')) {
            $decoded = json_decode($request->npi_raw, true);
            $npiData = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
        }

        $updates = [
            'provider_type'            => $request->license_type,
            'license_number'           => $request->license_number,
            'license_expiration_date'  => $request->license_expiration_date,
            'license_states'           => [$request->state_of_licensure],
            'npi_number'               => $request->npi_number,
            'npi_data'                 => $npiData,
            'dea_number'               => $request->dea_number,
            'onboarding_step'          => max($profile->onboarding_step ?? 0, 3),
        ];

        // Only overwrite a stored document if a new one was actually uploaded.
        if ($request->hasFile('document_id')) {
            $updates['document_id_path'] = $request->file('document_id')->store('provider-documents', 'public');
        }

        if ($request->hasFile('document_malpractice')) {
            $updates['document_malpractice_path'] = $request->file('document_malpractice')->store('provider-documents', 'public');
        }

        $profile->update($updates);

        return $this->redirectAfterStep($profile, 'provider.register.details');
    }

    // ── Step 4 — Practice Details ─────────────────────────────────────────────

    public function details(): View
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        $profile = Auth::user()->doctorProfile;

        return view('auth.provider-onboarding.details', compact('profile'));
    }

    public function storeDetails(Request $request): RedirectResponse
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        $request->validate([
            'virtual_only'  => 'nullable|boolean',
            'address_line1' => 'required_unless:virtual_only,1|nullable|string|max:255',
            'address_city'  => 'required_unless:virtual_only,1|nullable|string|max:100',
            'address_state' => 'required_unless:virtual_only,1|nullable|string|size:2',
            'address_zip'   => 'required_unless:virtual_only,1|nullable|string|max:10',
            'services'      => 'nullable|array',
            'services.*'    => 'string|max:100',
            'insurances'    => 'nullable|array',
            'insurances.*'  => 'string|max:100',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;

        $isVirtual = (bool) $request->virtual_only;

        $profile->update([
            'virtual_only'        => $isVirtual,
            'clinic_address'      => $isVirtual ? null : implode(', ', array_filter([
                $request->address_line1,
                $request->address_city,
                $request->address_state,
                $request->address_zip,
            ])),
            'practice_zip_code'   => $isVirtual ? null : $request->address_zip,
            'services_offered'    => $request->services ?? [],
            'insurances_accepted' => $request->insurances ?? [],
            'onboarding_step'     => max($profile->onboarding_step ?? 0, 4),
        ]);

        // FIX: "insurances_accepted" above is only self-reported free text
        // saved on the doctor_profiles row itself. The public search page
        // (SearchController) filters providers using the real
        // `insurancePlans` relation (the doctor_insurance_plans pivot
        // table) — that was never being written to, so a newly submitted
        // provider would never show up in a filtered search even though
        // their profile "looked" complete in the admin panel. We now sync
        // that relation here, matching the submitted checkbox values
        // ("Aetna", "Cigna", ...) against the real lookup tables.
        //
        // Note: "services[]" here (Annual Physical, Urgent Care, etc.) is
        // NOT the doctor's specialty — that's set on Step 2 and synced to
        // the `specialties` relation there instead. Do not sync it here.

        if ($request->filled('insurances')) {
            $planIds = [];
            foreach ($request->insurances as $insuranceName) {
                $provider = InsuranceProvider::firstOrCreate(['name' => $insuranceName]);
                $plan = InsurancePlan::firstOrCreate([
                    'provider_id' => $provider->id,
                    'name'        => $insuranceName,
                ]);
                $planIds[] = $plan->id;
            }
            $profile->insurancePlans()->sync($planIds);
        } else {
            $profile->insurancePlans()->sync([]);
        }

        return $this->redirectAfterStep($profile, 'provider.register.payment');
    }

    // ── Step 5 — Payment Setup ────────────────────────────────────────────────

    public function payment(): View
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        return view('auth.provider-onboarding.payment');
    }

    /**
     * Redirect to Stripe Connect onboarding.
     */
    public function stripeConnect(Request $request): RedirectResponse
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        // TODO: Generate Stripe Connect OAuth link and redirect
        // $url = StripeService::connectUrl(Auth::user());
        // return redirect($url);

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;
        $profile->update(['onboarding_step' => max($profile->onboarding_step ?? 0, 5)]);

        return $this->redirectAfterStep($profile, 'provider.register.legal');
    }

    /**
     * Skip payment setup — with limited-functionality warning shown in view.
     */
    public function skipPayment(Request $request): RedirectResponse
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;
        $profile->update(['onboarding_step' => max($profile->onboarding_step ?? 0, 5)]);

        return $this->redirectAfterStep($profile, 'provider.register.legal');
    }

    // ── Step 6 — Legal Acceptance ─────────────────────────────────────────────

    public function legal(): View
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        $profile = Auth::user()->doctorProfile;

        return view('auth.provider-onboarding.agreements', compact('profile'));
    }

    public function storeLegal(Request $request): RedirectResponse
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        $request->validate([
            'agree_terms_of_service'      => 'accepted',
            'agree_provider_agreement'    => 'accepted',
            'agree_insurance_accuracy'    => 'accepted',
            'agree_baa'                   => 'accepted',
            'agree_payment_authorization' => 'accepted',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;

        // Don't stamp a fresh submission timestamp / re-flag as "just
        // submitted" on every re-visit — only set it the first time.
        $updates = [
            'agreed_provider_agreement'    => true,
            'agreed_baa'                   => true,
            'agreed_license_validity'      => true, // maps to insurance accuracy clause
            'agreed_payment_authorization' => true,
            'baa_accepted_at'               => now(),
            'baa_accepted_ip'               => $request->ip(),
            'onboarding_step'                => max($profile->onboarding_step ?? 0, 6),
        ];

        if (! $profile->application_submitted_at) {
            $updates['application_submitted_at'] = now();
        }

        $profile->update($updates);

        // Full audit trail: one legal_acceptances row per document, per
        // provider, capturing the version accepted, accepted date/time,
        // provider (via doctor_profile_id), IP address, and an audit
        // timestamp — independently of the boolean flags above, so the
        // Legal & Agreements screen can show real acceptance records
        // instead of just true/false.
        foreach (self::LEGAL_DOCUMENT_VERSIONS as $slug => $version) {
            LegalAcceptance::record($profile, $slug, $version, $request->ip());
        }

        return redirect()->route('provider.register.status');
    }

    // ── Step 7 — Status Screen ────────────────────────────────────────────────

    public function status(): View
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        $profile = Auth::user()->doctorProfile;

        return view('auth.provider-onboarding.success', compact('profile'));
    }

    // ── Step 8 — Pre-Live Profile Builder ─────────────────────────────────────

    public function profileBuilder(): View
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;

        return view('auth.provider-onboarding.profile_builder', compact('profile'));
    }

    public function storeProfileBuilder(Request $request): RedirectResponse
    {
        if ($redirect = $this->requireAuth()) return $redirect;

        $request->validate([
            'bio'           => 'nullable|string|max:2000',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'schedule'      => 'nullable|array',
            'schedule.*.day'   => 'required|integer|between:0,6',
            'schedule.*.start' => 'required|date_format:H:i',
            'schedule.*.end'   => 'required|date_format:H:i|after:schedule.*.start',
            'price_initial'    => 'nullable|numeric|min:0',
            'price_followup'   => 'nullable|numeric|min:0',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $profile = $user->doctorProfile;

        $updates = [
            'bio'            => $request->bio,
            'price_initial'  => $request->price_initial,
            'price_followup' => $request->price_followup,
            'onboarding_step'=> max($profile->onboarding_step ?? 0, 8),
        ];

        if ($request->hasFile('profile_photo')) {
            $updates['profile_photo_path'] = $request->file('profile_photo')
                ->store('provider-photos', 'public');
        }

        $profile->update($updates);

        // Save schedule
        if ($request->has('schedule')) {
            $profile->schedules()->delete();
            foreach ($request->schedule as $slot) {
                $profile->schedules()->create([
                    'day_of_week'           => $slot['day'],
                    'start_time'            => $slot['start'],
                    'end_time'              => $slot['end'],
                    'slot_duration_minutes' => 30,
                ]);
            }
        }

        // Provider has completed everything the platform requires of them —
        // send them straight to the dashboard rather than back to this form.
        return redirect()->route('dashboard')
            ->with('success', 'Profile saved! It will go live once you are approved.');
    }

    // ── Legacy / unused screens kept for backwards-compat (safe to remove later) ──

    /** @deprecated Replaced by practice() in new flow */
    public function identity(): View
    {
        return redirect()->route('provider.register.practice');
    }

    /** @deprecated NPI now collected directly in the license step */
    public function npi(): RedirectResponse
    {
        return redirect()->route('provider.register.license');
    }

    /** @deprecated Merged into details step */
    public function services(): RedirectResponse
    {
        return redirect()->route('provider.register.details');
    }

    /** @deprecated Merged into profile builder */
    public function schedule(): RedirectResponse
    {
        return redirect()->route('provider.register.profile-builder');
    }

    /** @deprecated Government ID + Malpractice Insurance uploads now live in the license step */
    public function documents(): RedirectResponse
    {
        return redirect()->route('provider.register.legal');
    }

    /** @deprecated Removed from new flow */
    public function verify(): RedirectResponse
    {
        return redirect()->route('provider.register.status');
    }

    /** @deprecated Removed from new flow */
    public function review(): RedirectResponse
    {
        return redirect()->route('provider.register.status');
    }

    /** @deprecated Use status() */
    public function success(): View
    {
        return $this->status();
    }

    // ── NPI Lookup (used by the license step's NPI Lookup block) ──────────────

    public function npiLookup(Request $request): JsonResponse
    {
        $request->validate(['npi' => 'required|digits:10']);

        try {
            $response = Http::timeout(5)->get('https://npiregistry.cms.hhs.gov/api/', [
                'number'           => $request->npi,
                'enumeration_type' => '',
                'version'          => '2.1',
            ]);

            $results = $response->json('results', []);

            if (empty($results)) {
                return response()->json(['found' => false]);
            }

            $r    = $results[0];
            $addr = collect($r['addresses'] ?? [])->firstWhere('address_purpose', 'LOCATION') ?? ($r['addresses'][0] ?? []);

            return response()->json([
                'found'     => true,
                'name'      => trim(($r['basic']['first_name'] ?? '') . ' ' . ($r['basic']['last_name'] ?? $r['basic']['organization_name'] ?? '')),
                'specialty' => $r['taxonomies'][0]['desc'] ?? null,
                'address'   => implode(', ', array_filter([
                    $addr['address_1'] ?? null,
                    $addr['city']      ?? null,
                    $addr['state']     ?? null,
                    $addr['postal_code'] ?? null,
                ])),
                'raw' => $r,
            ]);
        } catch (\Throwable) {
            return response()->json(['found' => false, 'error' => 'Lookup unavailable.']);
        }
    }
}
