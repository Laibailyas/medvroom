<x-emails.layout title="Additional Information Required">
    <p>Hi <strong>{{ $doctor->user?->name }}</strong>,</p>

    <p>We're reviewing your MedVroom provider application and need a little more information before we can proceed.</p>

    @if($note)
    <div style="margin:24px 0; padding:16px 20px; background:#fffbeb; border-left:4px solid #fbbf24; border-radius:6px; text-align:left;">
        <p style="margin:0; font-size:14px; color:#92400e; font-weight:600;">Our team says:</p>
        <p style="margin:8px 0 0; font-size:14px; color:#78350f;">{{ $note }}</p>
    </div>
    @else
    <p>Please log in to your account and ensure all required fields are complete and accurate.</p>
    @endif

    <p>Once you've updated your information, our team will continue reviewing your application.</p>

    <a href="{{ route('provider.register.status') }}" class="button" style="background-color:#d97706;">
        Update My Profile →
    </a>

    <p style="margin-top:24px; font-size:14px; color:#94a3b8;">
        Questions? Just reply to this email and we'll help you out.
    </p>

    <x-slot name="footer_text">
        You're receiving this because you applied as a provider on MedVroom.
    </x-slot>
</x-emails.layout>
