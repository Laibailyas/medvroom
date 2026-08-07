<x-app-layout>
    <div class="bg-slate-50 min-h-screen py-16">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="w-20 h-20 bg-primary/20 rounded-3xl flex items-center justify-center mx-auto mb-8">
                <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-3xl font-black text-slate-900 tracking-tighter mb-4">Booking Request Submitted</h1>

            <p class="text-sm font-bold text-slate-600 leading-relaxed mb-8">
                @if ($appointment && $appointment->doctorProfile?->user)
                    Your booking request has been submitted to Dr. {{ $appointment->doctorProfile->user->name }}.
                @else
                    Your booking request has been submitted.
                @endif
                <br><br>
                Your appointment is not yet confirmed. The provider may:
            </p>

            <ul class="text-left text-xs font-bold text-slate-500 space-y-2 mb-8 bg-white rounded-2xl border border-slate-100 p-6">
                <li>• Accept and confirm your requested appointment</li>
                <li>• Request a different date or time</li>
                <li>• Decline the request if the provider is unavailable or unable to accommodate the request</li>
            </ul>

            <p class="text-xs font-bold text-slate-400 leading-relaxed mb-10">
                You will receive updates through your MedVroom account and by email. If you have separately opted in
                to appointment-related SMS messages, you may also receive text message updates.
            </p>

            <a href="{{ route('patient.dashboard') }}"
                class="inline-block bg-slate-900 text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-xs hover:scale-105 transition-all">
                Go to Dashboard
            </a>
        </div>
    </div>
</x-app-layout>