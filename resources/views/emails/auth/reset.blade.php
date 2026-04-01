<x-emails.layout>
    <x-slot name="title">
        Reset your password
    </x-slot>

    <p>You're receiving this email because we received a password reset request for your account. No changes have been made yet.</p>

    <div style="margin: 32px 0;">
        <a href="{{ $url }}" class="button">
            Reset Password
        </a>
    </div>

    <p style="font-size: 14px; color: #64748b;">
        This password reset link will expire in {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutes.
    </p>

    <p style="font-size: 14px; color: #64748b; margin-top: 16px;">
        If you did not request a password reset, no further action is required.
    </p>

    <x-slot name="footer_text">
        If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
        <br>
        <span style="word-break: break-all; font-size: 11px;">{{ $url }}</span>
    </x-slot>
</x-emails.layout>
