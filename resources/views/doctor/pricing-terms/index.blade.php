<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter text-slate-900">Pricing &amp; Fee Terms</h1>
                <p class="text-slate-500 font-bold mt-1 uppercase tracking-widest text-[10px]">Current fee schedule and payment terms for your practice.</p>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-400 shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h3 class="text-lg font-black tracking-tighter text-slate-900">Pricing &amp; Fee Terms</h3>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">
                        Version {{ $pricingTerms->version }}
                        @if($pricingTerms->accepted_at)
                            &middot; Accepted {{ $pricingTerms->accepted_at->format('M d, Y g:i A') }}
                        @else
                            &middot; <span class="text-orange-500">Not yet accepted</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3 shrink-0">
                <a href="{{ route('doctor.pricing-terms.show') }}"
                   class="px-6 py-3 bg-slate-50 hover:bg-slate-100 text-slate-900 rounded-2xl font-black text-xs uppercase tracking-widest transition-all">
                    View
                </a>
                <a href="{{ route('doctor.pricing-terms.download') }}"
                   class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white rounded-2xl font-black text-xs uppercase tracking-widest transition-all">
                    Download PDF
                </a>
            </div>
        </div>
    </div>
</x-doctor-layout>
