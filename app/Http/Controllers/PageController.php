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
}
