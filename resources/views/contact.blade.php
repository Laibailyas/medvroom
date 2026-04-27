@php
    $siteSettings = \App\Models\SystemSetting::where('key', 'site_settings')->first()?->value ?? [];
    $supportEmail = !empty($siteSettings['support_email']) ? $siteSettings['support_email'] : \App\Constants\Contacts::EMAIL;
    $supportPhone = !empty($siteSettings['support_phone']) ? $siteSettings['support_phone'] : \App\Constants\Contacts::PHONE;
    $siteName = $siteSettings['site_name'] ?? 'MedVroom';
@endphp
<x-app-layout>
    <div class="bg-[#f9f8f1] min-h-screen pb-20">
        <!-- Header Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <h1 class="text-5xl font-black text-slate-800 mb-6 tracking-tight">We’re here to help</h1>
                    <p class="text-sm font-bold text-slate-600 leading-relaxed max-w-md">
                        Our service team is available {{ \App\Constants\Contacts::WORKING_HOURS_WEEKDAYS }}, and on {{ \App\Constants\Contacts::WORKING_HOURS_WEEKENDS }}
                    </p>
                </div>
                <div class="flex justify-center lg:justify-end">
                    <img src="/contact_support_illustration_1775062742614.png" alt="Support Illustration" class="w-full max-w-md drop-shadow-sm">
                </div>
            </div>
        </section>

        <!-- Support Cards -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Chat -->
                <div class="bg-white p-10 rounded-xl shadow-sm border border-slate-100 flex flex-col items-start">
                    <div class="mb-6">
                        <svg class="w-8 h-8 text-[#ffe600]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z"/>
                            <circle cx="7" cy="9" r="1.25"/><circle cx="12" cy="9" r="1.25"/><circle cx="17" cy="9" r="1.25"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-black text-slate-800 mb-2 uppercase tracking-tight">Start a chat</h2>
                    <p class="text-[13px] font-bold text-slate-500 mb-6">Quick, one-on-one help.</p>
                    <a href="#" class="text-sm font-black text-primary hover:underline uppercase tracking-widest">Start chat</a>
                </div>

                <!-- Call -->
                <div class="bg-white p-10 rounded-xl shadow-sm border border-slate-100 flex flex-col items-start">
                    <div class="mb-6">
                        <svg class="w-8 h-8 text-[#ffe600]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-black text-slate-800 mb-2 uppercase tracking-tight">Give us a call</h2>
                    <p class="text-[13px] font-bold text-slate-500 mb-6 leading-relaxed">
                        Talk to a support specialist right away.
                    </p>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Patient:</span>
                            <a href="tel:{{ $supportPhone }}" class="text-sm font-black text-primary hover:underline">{{ $supportPhone }}</a>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Provider:</span>
                            <a href="tel:{{ $supportPhone }}" class="text-sm font-black text-primary hover:underline">{{ $supportPhone }}</a>
                        </div>
                    </div>
                </div>

                <!-- Help Center -->
                <div class="bg-white p-10 rounded-xl shadow-sm border border-slate-100 flex flex-col items-start">
                    <div class="mb-6">
                        <svg class="w-8 h-8 text-[#ffe600]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-black text-slate-800 mb-2 uppercase tracking-tight">Visit our Help Center</h2>
                    <p class="text-[13px] font-bold text-slate-500 mb-6 leading-relaxed">
                        Find answers and step-by-step guides.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ route('help.index', ['type' => 'patient']) }}" class="text-sm font-black text-primary hover:underline uppercase tracking-widest">Patient</a>
                        <a href="{{ route('help.index', ['type' => 'provider']) }}" class="text-sm font-black text-primary hover:underline uppercase tracking-widest">Provider</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Locations Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-12">
                <div class="flex flex-col md:flex-row gap-16 md:gap-32">
                    <div class="flex items-center gap-6">
                        <svg class="w-8 h-8 text-[#ffe600]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                        </svg>
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Our locations</h3>
                    </div>
                    <div class="grid md:grid-cols-2 gap-12 flex-1">
                        <div>
                            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">{{ \App\Constants\Contacts::ADDRESS_NY['name'] }}</h4>
                            <div class="text-[13px] font-bold text-slate-600 space-y-1">
                                <p>{{ \App\Constants\Contacts::ADDRESS_NY['street'] }}</p>
                                <p>{{ \App\Constants\Contacts::ADDRESS_NY['floor'] }}</p>
                                <p>{{ \App\Constants\Contacts::ADDRESS_NY['city_state_zip'] }}</p>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-2">{{ \App\Constants\Contacts::ADDRESS_SV['name'] }}</h4>
                            <div class="text-[13px] font-bold text-slate-600 space-y-1">
                                <p>{{ \App\Constants\Contacts::ADDRESS_SV['street'] }}</p>
                                <p>{{ \App\Constants\Contacts::ADDRESS_SV['suite'] }}</p>
                                <p>{{ \App\Constants\Contacts::ADDRESS_SV['city_state_zip'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Practice CTA Banner -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">
            <div class="bg-[#ebeae2] rounded-xl p-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <h3 class="text-xl font-black text-slate-800 tracking-tight italic">Are you a practice interested in joining {{ $siteName }}?</h3>
                <a href="{{ route('register.doctor') }}" class="px-8 py-3 bg-transparent border-2 border-slate-400 font-black text-slate-600 text-xs uppercase tracking-widest rounded transition-colors hover:bg-slate-400 hover:text-white">
                    Get started
                </a>
            </div>
        </section>

        <!-- Email Footer -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-[13px] font-bold text-slate-500 mb-2">For non-urgent questions, email us. We respond within one business day.</p>
            <a href="mailto:{{ $supportEmail }}" class="text-[13px] font-black text-primary hover:underline">{{ $supportEmail }}</a>
        </div>
    </div>
</x-app-layout>
