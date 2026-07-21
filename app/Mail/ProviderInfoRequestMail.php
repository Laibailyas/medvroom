<?php

namespace App\Mail;

use App\Models\DoctorProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProviderInfoRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public DoctorProfile $doctor,
        public ?string $note = null
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Action Required: Additional Information Needed for Your MedVroom Application');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.provider.info-request');
    }
}
