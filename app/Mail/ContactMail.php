<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Form Submission: ' . ($this->data['subject'] ?? 'No Subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: "
                <h3>New Contact Message</h3>
                <p><strong>Name:</strong> " . e($this->data['first_name'] ?? '') . " " . e($this->data['last_name'] ?? '') . "</p>
                <p><strong>Email:</strong> " . e($this->data['email'] ?? '') . "</p>
                <p><strong>Message:</strong></p>
                <p>" . nl2br(e($this->data['message'] ?? '')) . "</p>
            "
        );
    }

    public function attachments(): array
    {
        return [];
    }
}