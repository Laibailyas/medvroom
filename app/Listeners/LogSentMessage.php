<?php

namespace App\Listeners;

use App\Models\MailLog;
use Illuminate\Mail\Events\MessageSent;

class LogSentMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSent $event): void
    {
        $message = $event->message;

        MailLog::create([
            'recipient' => implode(', ', array_map(fn ($address) => $address->getAddress(), $message->getTo())),
            'subject' => $message->getSubject(),
            'body' => $message->getHtmlBody() ?? $message->getTextBody(),
            'type' => $event->data['type'] ?? 'general',
            'status' => 'sent',
            'sent_at' => now(),
        ]);
    }
}
