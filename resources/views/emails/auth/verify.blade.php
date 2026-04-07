<x-emails.layout>
    <x-slot name="title">
        Verify your email address
    </x-slot>

    <p>Welcome to MedVroom! We're excited to have you join our clinical network. Before we get started, we just need to verify your email address.</p>

    <div style="margin: 32px 0;">
        <a href="{{ $url }}" class="button">
            Verify Email Address
        </a>
    </div>

    <p style="font-size: 14px; color: #64748b;">
        If you didn't create an account with us, you can safely ignore this email.
    </p>

    <x-slot name="footer_text">
        If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:
        <br>
        <span style="word-break: break-all; font-size: 11px;">{{ $url }}</span>
    </x-slot>
</x-emails.layout>
