<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function index(): View
    {
        $setting = SystemSetting::firstOrCreate(
            ['key' => 'site_settings'],
            [
                'group' => 'Site',
                'description' => 'Global website branding, SEO, and basic information.',
                'value' => [
                    'site_name' => config('app.name'),
                    'logo_url' => '',
                    'favicon_url' => '',
                    'og_image_url' => '',
                    'meta_title' => '',
                    'meta_description' => '',
                    'support_email' => '',
                    'support_phone' => '',
                    'facebook_url' => '',
                    'twitter_url' => '',
                    'instagram_url' => '',
                ],
            ]
        );

        return view('admin.settings.site', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $setting = SystemSetting::where('key', 'site_settings')->firstOrFail();

        $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'support_email' => ['nullable', 'email', 'max:255'],
            'support_phone' => ['nullable', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'favicon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,ico,webp', 'max:1024'],
            'og_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
        ]);

        $value = $setting->value ?? [];

        // Handle file uploads
        if ($request->hasFile('logo')) {
            if (! empty($value['logo_url']) && Storage::disk('public')->exists($value['logo_url'])) {
                Storage::disk('public')->delete($value['logo_url']);
            }
            $value['logo_url'] = $request->file('logo')->store('site', 'public');
        }

        if ($request->hasFile('favicon')) {
            if (! empty($value['favicon_url']) && Storage::disk('public')->exists($value['favicon_url'])) {
                Storage::disk('public')->delete($value['favicon_url']);
            }
            $value['favicon_url'] = $request->file('favicon')->store('site', 'public');
        }

        if ($request->hasFile('og_image')) {
            if (!empty($value['og_image_url']) && Storage::disk('public')->exists($value['og_image_url'])) {
                Storage::disk('public')->delete($value['og_image_url']);
            }
            $value['og_image_url'] = $request->file('og_image')->store('site', 'public');
        }

        // Update other fields
        $fields = [
            'site_name', 'meta_title', 'meta_description',
            'support_email', 'support_phone',
            'facebook_url', 'twitter_url', 'instagram_url',
        ];

        foreach ($fields as $field) {
            $value[$field] = $request->input($field);
        }

        $setting->update(['value' => $value]);

        return back()->with('status', 'site-settings-updated');
    }
}
