<?php

namespace App\Mail;

use App\Models\DoctorProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProviderRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public DoctorProfile $doctor,
        public ?string $note = null
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Update on Your MedVroom Provider Application');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.provider.rejected');
    }
}
