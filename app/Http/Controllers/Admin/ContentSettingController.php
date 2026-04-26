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

        return view('admin.settings.content', [
            'privacy' => $privacySetting->value,
            'terms' => $termsSetting->value,
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

        return redirect()->back()->with('success', 'Content settings updated successfully.');
    }
}
