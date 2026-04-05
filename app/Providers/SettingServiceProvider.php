<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (! $this->app->runningInConsole() || $this->app->runningUnitTests()) {
            $this->loadSettings();
        }
    }

    protected function loadSettings(): void
    {
        try {
            if (! Schema::hasTable('system_settings')) {
                return;
            }

            $settings = SystemSetting::all();

            // Mail Configuration
            if ($mail = $settings->where('key', 'mail_settings')->first()) {
                config([
                    'mail.mailers.smtp.host' => $mail->value['host'] ?? config('mail.mailers.smtp.host'),
                    'mail.mailers.smtp.port' => $mail->value['port'] ?? config('mail.mailers.smtp.port'),
                    'mail.mailers.smtp.encryption' => $mail->value['encryption'] ?? config('mail.mailers.smtp.encryption'),
                    'mail.mailers.smtp.username' => $mail->value['username'] ?? config('mail.mailers.smtp.username'),
                    'mail.mailers.smtp.password' => $mail->value['password'] ?? config('mail.mailers.smtp.password'),
                    'mail.from.address' => $mail->value['from_address'] ?? config('mail.from.address'),
                    'mail.from.name' => $mail->value['from_name'] ?? config('mail.from.name'),
                ]);
            }

            // SMS Configuration (Vonage)
            if ($sms = $settings->where('key', 'sms_settings')->first()) {
                config([
                    'services.vonage.key' => $sms->value['api_key'] ?? config('services.vonage.key'),
                    'services.vonage.secret' => $sms->value['api_secret'] ?? config('services.vonage.secret'),
                    'services.vonage.sms_from' => $sms->value['sms_from'] ?? config('services.vonage.sms_from'),
                ]);
            }

            // Google Socialite Configuration
            if ($google = $settings->where('key', 'google_settings')->first()) {
                config([
                    'services.google.client_id' => $google->value['client_id'] ?? config('services.google.client_id'),
                    'services.google.client_secret' => $google->value['client_secret'] ?? config('services.google.client_secret'),
                    'services.google.redirect' => $google->value['redirect'] ?? config('services.google.redirect'),
                ]);
            }


            // Load stripe settings from database
            $stripeSettings = SystemSetting::where('key', 'stripe_settings')->first();
            if ($stripeSettings) {
                config([
                    'cashier.key' => $stripeSettings->value['stripe_key'] ?? config('cashier.key'),
                    'cashier.secret' => $stripeSettings->value['stripe_secret'] ?? config('cashier.secret'),
                    'cashier.webhook.secret' => $stripeSettings->value['webhook_secret'] ?? config('cashier.webhook.secret'),
                ]);
            }
        } catch (\Exception $e) {
            // Silently fail if DB is not ready
        }
    }
}
