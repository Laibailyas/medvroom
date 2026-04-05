<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SystemSettingController extends Controller
{
    /**
     * Display a listing of the system settings.
     */
    public function index(): View
    {
        $this->ensureDefaultSettings();

        $settings = SystemSetting::orderBy('group')->get()->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the specified system setting.
     */
    public function update(Request $request, SystemSetting $setting): RedirectResponse
    {
        // Dynamically validate based on the key if needed, or just accept the array
        $request->validate([
            'value' => ['required', 'array'],
        ]);

        $setting->update(['value' => $request->value]);

        return back()->with('status', 'settings-updated');
    }

    /**
     * Bootstraps default settings if the table is empty.
     */
    protected function ensureDefaultSettings(): void
    {
        $defaults = [
            [
                'key' => 'mail_settings',
                'group' => 'Email',
                'description' => 'SMTP configuration for system-generated emails.',
                'value' => [
                    'host' => config('mail.mailers.smtp.host'),
                    'port' => config('mail.mailers.smtp.port'),
                    'encryption' => config('mail.mailers.smtp.encryption'),
                    'username' => config('mail.mailers.smtp.username'),
                    'password' => config('mail.mailers.smtp.password'),
                    'from_address' => config('mail.from.address'),
                    'from_name' => config('mail.from.name'),
                ],
            ],
            [
                'key' => 'sms_settings',
                'group' => 'SMS',
                'description' => 'Vonage (Nexmo) API credentials for text message verification.',
                'value' => [
                    'api_key' => config('services.vonage.key'),
                    'api_secret' => config('services.vonage.secret'),
                    'sms_from' => config('services.vonage.sms_from'),
                ],
            ],
            [
                'key' => 'google_settings',
                'group' => 'Social Auth',
                'description' => 'Google Socialite credentials for unified login.',
                'value' => [
                    'client_id' => config('services.google.client_id'),
                    'client_secret' => config('services.google.client_secret'),
                    'redirect' => config('services.google.redirect') ?? 'http://localhost:8000/auth/google/callback',
                ],
            ],
            [
                'key' => 'maintenance_settings',
                'group' => 'Maintenance',
                'description' => 'Automated system cleanup tasks and retention policies.',
                'value' => [
                    'log_retention_days' => '30',
                ],
            ],
            [
                'key' => 'stripe_settings',
                'group' => 'Payments',
                'description' => 'Stripe API keys for Cashier and Elements integration.',
                'value' => [
                    'stripe_key' => env('STRIPE_KEY'),
                    'stripe_secret' => env('STRIPE_SECRET'),
                    'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
                ],
            ],
        ];

        foreach ($defaults as $default) {
            SystemSetting::firstOrCreate(
                ['key' => $default['key']],
                [
                    'group' => $default['group'],
                    'value' => $default['value'],
                    'description' => $default['description'],
                ]
            );
        }
    }
}
