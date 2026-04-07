<?php

namespace App\Services;

use App\Models\SmsLog;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send an SMS message.
     */
    public static function send(string $recipient, string $message): SmsLog
    {
        // In a real application, you would integrate Twilio, Vonage, etc. here.
        // For now, we'll log it to the local system log and the database.

        Log::info("SMS sent to {$recipient}: {$message}");

        return SmsLog::create([
            'recipient' => $recipient,
            'body' => $message,
            'status' => 'sent', // Initially marked as sent
            'sent_at' => now(),
        ]);
    }
}
