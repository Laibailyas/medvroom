<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class ContentSettingController extends Controller
{
    /**
     * Display the content settings form.
     */
    public function index()
    {
        $privacySetting = SystemSetting::firstOrCreate(
            ['key' => 'privacy_policy'],
            [
                'group' => 'Content',
                'description' => 'Privacy Policy page content.',
                'value' => ['title' => 'Privacy Policy', 'content' => '']
            ]
        );

        $termsSetting = SystemSetting::firstOrCreate(
            ['key' => 'terms_conditions'],
            [
                'group' => 'Content',
                'description' => 'Terms & Conditions page content.',
                'value' => ['title' => 'Terms & Conditions', 'content' => '']
            ]
        );

        $reviewPolicySetting = SystemSetting::firstOrCreate(
            ['key' => 'review_policy'],
            [
                'group' => 'Content',
                'description' => 'Review & Content Policy page content.',
                'value' => ['title' => 'Review & Content Policy', 'content' => '']
            ]
        );

        $telehealthConsentSetting = SystemSetting::firstOrCreate(
            ['key' => 'telehealth_consent'],
            [
                'group' => 'Content',
                'description' => 'Telehealth Informed Consent page content.',
                'value' => ['title' => 'Telehealth Informed Consent', 'content' => '']
            ]
        );

        $providerAgreementSetting = SystemSetting::firstOrCreate(
            ['key' => 'provider_agreement'],
            [
                'group' => 'Content',
                'description' => 'Provider Agreement page content.',
                'value' => ['title' => 'Provider Agreement', 'content' => '']
            ]
        );

        $acceptableUsePolicySetting = SystemSetting::firstOrCreate(
            ['key' => 'acceptable_use_policy'],
            [
                'group' => 'Content',
                'description' => 'Acceptable Use Policy page content.',
                'value' => ['title' => 'Acceptable Use Policy', 'content' => '']
            ]
        );

        $cookiePolicySetting = SystemSetting::firstOrCreate(
            ['key' => 'cookie_policy'],
            [
                'group' => 'Content',
                'description' => 'Cookie Policy page content.',
                'value' => ['title' => 'Cookie Policy', 'content' => '']
            ]
        );

        return view('admin.settings.content', [
            'privacy' => $privacySetting->value,
            'terms' => $termsSetting->value,
            'review_policy' => $reviewPolicySetting->value,
            'telehealth_consent' => $telehealthConsentSetting->value,
            'provider_agreement' => $providerAgreementSetting->value,
            'acceptable_use_policy' => $acceptableUsePolicySetting->value,
            'cookie_policy' => $cookiePolicySetting->value,
        ]);
    }

    /**
     * Update the content settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'privacy_title' => ['required', 'string', 'max:255'],
            'privacy_content' => ['nullable', 'string'],
            'terms_title' => ['required', 'string', 'max:255'],
            'terms_content' => ['nullable', 'string'],
            'review_policy_title' => ['required', 'string', 'max:255'],
            'review_policy_content' => ['nullable', 'string'],
            'telehealth_consent_title' => ['required', 'string', 'max:255'],
            'telehealth_consent_content' => ['nullable', 'string'],
            'provider_agreement_title' => ['required', 'string', 'max:255'],
            'provider_agreement_content' => ['nullable', 'string'],
            'acceptable_use_policy_title' => ['required', 'string', 'max:255'],
            'acceptable_use_policy_content' => ['nullable', 'string'],
            'cookie_policy_title' => ['required', 'string', 'max:255'],
            'cookie_policy_content' => ['nullable', 'string'],
        ]);

        $privacySetting = SystemSetting::where('key', 'privacy_policy')->first();
        if ($privacySetting) {
            $privacySetting->update([
                'value' => [
                    'title' => $request->input('privacy_title'),
                    'content' => $request->input('privacy_content'),
                ]
            ]);
        }

        $termsSetting = SystemSetting::where('key', 'terms_conditions')->first();
        if ($termsSetting) {
            $termsSetting->update([
                'value' => [
                    'title' => $request->input('terms_title'),
                    'content' => $request->input('terms_content'),
                ]
            ]);
        }

        $reviewPolicySetting = SystemSetting::where('key', 'review_policy')->first();
        if ($reviewPolicySetting) {
            $reviewPolicySetting->update([
                'value' => [
                    'title' => $request->input('review_policy_title'),
                    'content' => $request->input('review_policy_content'),
                ]
            ]);
        }

        $telehealthConsentSetting = SystemSetting::where('key', 'telehealth_consent')->first();
        if ($telehealthConsentSetting) {
            $telehealthConsentSetting->update([
                'value' => [
                    'title' => $request->input('telehealth_consent_title'),
                    'content' => $request->input('telehealth_consent_content'),
                ]
            ]);
        }

        $providerAgreementSetting = SystemSetting::where('key', 'provider_agreement')->first();
        if ($providerAgreementSetting) {
            $providerAgreementSetting->update([
                'value' => [
                    'title' => $request->input('provider_agreement_title'),
                    'content' => $request->input('provider_agreement_content'),
                ]
            ]);
        }

        $acceptableUsePolicySetting = SystemSetting::where('key', 'acceptable_use_policy')->first();
        if ($acceptableUsePolicySetting) {
            $acceptableUsePolicySetting->update([
                'value' => [
                    'title' => $request->input('acceptable_use_policy_title'),
                    'content' => $request->input('acceptable_use_policy_content'),
                ]
            ]);
        }

        $cookiePolicySetting = SystemSetting::where('key', 'cookie_policy')->first();
        if ($cookiePolicySetting) {
            $cookiePolicySetting->update([
                'value' => [
                    'title' => $request->input('cookie_policy_title'),
                    'content' => $request->input('cookie_policy_content'),
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Content settings updated successfully.');
    }
}
