<x-provider-onboarding-layout title="Payment Setup" description="Step 5 of 8 • Powered by Stripe" currentStep="5">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <div class="p-8 lg:p-12 space-y-8">

            <div class="flex items-center justify-between pb-6 border-b border-slate-100">
                <div>
                    <h3 class="text-2xl font-black text-slate-900">Get paid for appointments</h3>
                    <p class="text-slate-500 font-medium mt-1">Connect your bank account securely via Stripe to receive payouts.</p>
                </div>
                <div class="shrink-0 ml-4">
                    <svg class="h-8 w-auto text-slate-400" viewBox="0 0 60 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.44 10.08c0-.64.52-1.12 1.44-1.12.96 0 1.92.32 2.88.88V7.2C8.8 6.72 7.84 6.56 6.88 6.56c-2.4 0-4 1.28-4 3.36 0 3.28 4.48 2.72 4.48 4.16 0 .72-.64 1.2-1.6 1.2-1.04 0-2.16-.4-3.12-1.04v2.56c1.04.48 2.08.72 3.12.72 2.48 0 4.16-1.2 4.16-3.36-.02-3.52-4.48-2.88-4.48-4.08zm9.84-2.88L13.52 7.6l-1.28.3V6.72l-2.4.56V17.2l2.4-.56V10.4c.56-.72 1.52-1.04 2.24-.8V7.2h-.2zm3.2.32c0-.8-.64-1.44-1.44-1.44s-1.44.64-1.44 1.44.64 1.44 1.44 1.44 1.44-.64 1.44-1.44zm-.16 9.68V8.8h-2.4v8.4h2.4zm5.12-8.56c-.96 0-1.6.48-1.92 1.04l-.16-.88h-2.08v11.52l2.4-.56v-2.88c.32.24.88.4 1.52.4 1.84 0 3.52-1.6 3.52-4.4 0-2.56-1.68-4.24-3.28-4.24zm-.56 6.48c-.48 0-.88-.16-1.12-.4v-3.44c.24-.32.64-.48 1.12-.48 1.04 0 1.6.88 1.6 2.16 0 1.28-.56 2.16-1.6 2.16zm8.64-6.48c-2.32 0-3.92 1.84-3.92 4.4 0 2.88 1.76 4.4 4.16 4.4 1.12 0 2.08-.32 2.88-.88V14c-.8.56-1.68.8-2.64.8-.96 0-1.84-.4-2.08-1.44h5.12c0-.24.08-.56.08-.88 0-2.4-1.28-4.32-3.6-4.32zm-1.6 3.44c.16-.96.72-1.6 1.6-1.6.8 0 1.36.64 1.44 1.6h-3.04zM44 8.64c-.72 0-1.12.32-1.44.56l-.08-.4H40.4V20l2.4-.56v-3.04c.32.24.8.4 1.44.4 1.84 0 3.52-1.6 3.52-4.4 0-2.56-1.68-4.24-3.36-4.24-.16 0-.32.08-.4.08zm.4 6.48c-.48 0-.88-.16-1.12-.4v-3.44c.24-.32.64-.48 1.12-.48 1.04 0 1.6.88 1.6 2.16 0 1.28-.56 2.16-1.6 2.16z" fill="currentColor"/>
                    </svg>
                </div>
            </div>

            {{-- What Stripe will collect --}}
            <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl space-y-3">
                <p class="text-xs font-black uppercase tracking-widest text-slate-500">What Stripe will ask for</p>
                <ul class="space-y-2">
                    @foreach([
                        ['🏦', 'Bank account & routing number', 'For direct deposit payouts'],
                        ['🪪', 'Legal name & SSN (last 4)', 'For identity verification (required by US law)'],
                        ['📍', 'Business or home address', 'To confirm your identity'],
                        ['📅', 'Date of birth', 'Standard KYC requirement'],
                    ] as [$icon, $title, $sub])
                    <li class="flex items-start space-x-3">
                        <span class="text-base leading-tight mt-0.5">{{ $icon }}</span>
                        <div>
                            <p class="text-sm font-bold text-slate-800">{{ $title }}</p>
                            <p class="text-xs font-medium text-slate-400">{{ $sub }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <p class="text-[11px] font-medium text-slate-400 pt-1 border-t border-slate-200">
                    MedVroom never stores your banking credentials — all data goes directly to Stripe via their encrypted onboarding flow.
                </p>
            </div>

            {{-- Connect CTA --}}
            <a
                href="{{ route('provider.register.payment.stripe-connect') }}"
                class="group flex items-center p-6 bg-indigo-50 border-2 border-indigo-200 hover:border-indigo-600 rounded-3xl transition-all cursor-pointer"
            >
                <div class="w-14 h-14 rounded-2xl bg-indigo-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                </div>
                <div class="ml-5 flex-1">
                    <p class="text-lg font-black text-slate-900">Connect Bank Account via Stripe</p>
                    <p class="text-sm font-medium text-slate-500 mt-0.5">You'll be redirected to Stripe's secure onboarding — takes about 2 minutes</p>
                </div>
                <div class="ml-4 shrink-0 px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-black uppercase tracking-widest rounded-full">Recommended</div>
            </a>

            {{-- Benefits --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                <div class="p-4 bg-slate-50 rounded-2xl">
                    <p class="text-2xl mb-1">⚡</p>
                    <p class="text-xs font-black uppercase tracking-widest text-slate-700">Fast Payouts</p>
                    <p class="text-xs font-medium text-slate-500 mt-1">Deposits in 2 business days</p>
                </div>
                <div class="p-4 bg-slate-50 rounded-2xl">
                    <p class="text-2xl mb-1">🔒</p>
                    <p class="text-xs font-black uppercase tracking-widest text-slate-700">Secure</p>
                    <p class="text-xs font-medium text-slate-500 mt-1">Bank-level encryption</p>
                </div>
                <div class="p-4 bg-slate-50 rounded-2xl">
                    <p class="text-2xl mb-1">📊</p>
                    <p class="text-xs font-black uppercase tracking-widest text-slate-700">Dashboard</p>
                    <p class="text-xs font-medium text-slate-500 mt-1">Track earnings in real time</p>
                </div>
            </div>

            {{-- Skip --}}
            <div class="flex flex-col items-center space-y-3 pt-2 border-t border-slate-100">
                <form method="POST" action="{{ route('provider.register.payment.skip') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full py-4 text-sm font-black uppercase tracking-widest text-slate-500 hover:text-slate-700 transition-colors rounded-2xl border-2 border-slate-200 hover:border-slate-300">
                        Skip for now — set up later
                    </button>
                </form>
                <p class="text-xs font-medium text-amber-600 text-center">
                    ⚠ Without payment setup, you won't be able to accept bookings until this is completed from your dashboard.
                </p>
            </div>

        </div>
    </div>
</x-provider-onboarding-layout>