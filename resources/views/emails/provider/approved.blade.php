<x-emails.layout title="You're Approved! 🎉">
    <p>Hi <strong>{{ $doctor->user?->name }}</strong>,</p>

    <p>Great news — your MedVroom provider application has been <strong style="color:#059669;">approved and verified</strong>.</p>

    <p>Your profile is now live and patients can start booking appointments with you.</p>

    <a href="{{ url('/doctor/dashboard') }}" class="button" style="background-color:#4f46e5;">
        Go to Your Dashboard →
    </a>

    <p style="margin-top:24px; font-size:14px; color:#94a3b8;">
        If you have any questions, reply to this email or visit our Help Center.
    </p>

    <x-slot name="footer_text">
        You're receiving this because you applied as a provider on MedVroom.
    </x-slot>
</x-emails.layout>
