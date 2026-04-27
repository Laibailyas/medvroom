<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the About Us page.
     */
    public function about(): View
    {
        return view('about');
    }

    /**
     * Display the Contact Us page.
     */
    public function contact(): View
    {
        return view('contact');
    }

    /**
     * Display the Privacy Policy page.
     */
    public function privacy(): View
    {
        $setting = SystemSetting::where('key', 'privacy_policy')->first()?->value ?? [
            'title' => 'Privacy Policy',
            'content' => '<p>Please check back later.</p>'
        ];

        return view('privacy', compact('setting'));
    }

    /**
     * Display the Terms & Conditions page.
     */
    public function terms(): View
    {
        $setting = SystemSetting::where('key', 'terms_conditions')->first()?->value ?? [
            'title' => 'Terms & Conditions',
            'content' => '<p>Please check back later.</p>'
        ];

        return view('terms', compact('setting'));
    }

    /**
     * Display the Review & Content Policy page.
     */
    public function reviewPolicy(): View
    {
        $setting = SystemSetting::where('key', 'review_policy')->first()?->value ?? [
            'title' => 'Review & Content Policy',
            'content' => '<p>Please check back later.</p>'
        ];

        return view('review-policy', compact('setting'));
    }

    /**
     * Display the Telehealth Informed Consent page.
     */
    public function telehealthConsent(): View
    {
        $setting = SystemSetting::where('key', 'telehealth_consent')->first()?->value ?? [
            'title' => 'Telehealth Informed Consent',
            'content' => '<p>Please check back later.</p>'
        ];

        return view('telehealth-consent', compact('setting'));
    }

    /**
     * Display the Provider Agreement page.
     */
    public function providerAgreement(): View
    {
        $setting = SystemSetting::where('key', 'provider_agreement')->first()?->value ?? [
            'title' => 'Provider Agreement',
            'content' => '<p>Please check back later.</p>'
        ];

        return view('provider-agreement', compact('setting'));
    }

    /**
     * Display the Acceptable Use Policy page.
     */
    public function acceptableUsePolicy(): View
    {
        $setting = SystemSetting::where('key', 'acceptable_use_policy')->first()?->value ?? [
            'title' => 'Acceptable Use Policy',
            'content' => '<p>Please check back later.</p>'
        ];

        return view('acceptable-use-policy', compact('setting'));
    }

    /**
     * Display the Cookie Policy page.
     */
    public function cookiePolicy(): View
    {
        $setting = SystemSetting::where('key', 'cookie_policy')->first()?->value ?? [
            'title' => 'Cookie Policy',
            'content' => '<p>Please check back later.</p>'
        ];

        return view('cookie-policy', compact('setting'));
    }
}
