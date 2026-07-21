<x-emails.layout title="Update on Your Application">
    <p>Hi <strong>{{ $doctor->user?->name }}</strong>,</p>

    <p>Thank you for applying to join MedVroom as a healthcare provider.</p>

    <p>After reviewing your application, we are unable to approve your profile at this time.</p>

    @if($note)
    <div style="margin:24px 0; padding:16px 20px; background:#fef2f2; border-left:4px solid #f87171; border-radius:6px; text-align:left;">
        <p style="margin:0; font-size:14px; color:#991b1b; font-weight:600;">Reason from our team:</p>
        <p style="margin:8px 0 0; font-size:14px; color:#7f1d1d;">{{ $note }}</p>
    </div>
    @endif

    <p>If you believe this is an error or would like to reapply, please contact our support team.</p>

    <a href="{{ url('/contact') }}" class="button" style="background-color:#64748b;">
        Contact Support
    </a>

    <x-slot name="footer_text">
        You're receiving this because you applied as a provider on MedVroom.
    </x-slot>
</x-emails.layout>
