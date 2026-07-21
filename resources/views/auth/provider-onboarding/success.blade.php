<x-provider-onboarding-layout title="Application Submitted" currentStep="7">
    @if($profile->needs_info ?? false)
        {{-- ─── Action Required: admin requested more info ─────────────── --}}
        <div class="bg-white rounded-3xl border-2 border-amber-300 shadow-xl shadow-amber-100 overflow-hidden p-8 lg:p-12 space-y-8">
            <div class="flex items-center justify-center space-x-2 px-5 py-3 bg-amber-50 border border-amber-200 rounded-2xl w-fit mx-auto">
                <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
                <p class="text-sm font-black text-amber-700 uppercase tracking-widest">Action Required</p>
            </div>

            <div class="space-y-3 max-w-lg mx-auto text-center">
                <h3 class="text-3xl font-black text-slate-900 tracking-tight">
                    We need a bit more info
                </h3>
                <p class="text-lg text-slate-500 font-medium leading-relaxed">
                    Our team reviewed your application and needs an update before approving your profile.
                </p>
            </div>

            @if($profile->admin_note)
                <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl max-w-lg mx-auto text-left">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">Note from our team</p>
                    <p class="text-sm font-semibold text-slate-700">{{ $profile->admin_note }}</p>
                </div>
            @endif

            {{-- Jump back into any step to fix it --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-w-lg mx-auto text-left">
                <a href="{{ route('provider.register.practice') }}" class="flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-xl hover:border-indigo-300 hover:bg-indigo-50/50 transition-all group">
                    <span class="text-sm font-bold text-slate-700 group-hover:text-indigo-700">Basic Practice Info</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-hover:text-indigo-600"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="{{ route('provider.register.license') }}" class="flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-xl hover:border-indigo-300 hover:bg-indigo-50/50 transition-all group">
                    <span class="text-sm font-bold text-slate-700 group-hover:text-indigo-700">License, NPI &amp; Documents</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-hover:text-indigo-600"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="{{ route('provider.register.details') }}" class="flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-xl hover:border-indigo-300 hover:bg-indigo-50/50 transition-all group">
                    <span class="text-sm font-bold text-slate-700 group-hover:text-indigo-700">Practice Details</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-hover:text-indigo-600"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="{{ route('provider.register.profile-builder') }}" class="flex items-center justify-between p-4 bg-slate-50 border border-slate-100 rounded-xl hover:border-indigo-300 hover:bg-indigo-50/50 transition-all group">
                    <span class="text-sm font-bold text-slate-700 group-hover:text-indigo-700">Bio, Photo &amp; Pricing</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400 group-hover:text-indigo-600"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>

            <p class="text-center text-xs font-medium text-slate-400 max-w-lg mx-auto">
                Not sure which section? Start with License &amp; Documents, then Practice Details — those cover most requests.
            </p>

            <div class="pt-2 max-w-lg mx-auto">
                <a href="{{ route('dashboard') }}" class="block text-center text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                    Go to dashboard instead
                </a>
            </div>
        </div>
    @else
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden text-center p-8 lg:p-12 space-y-10">

        {{-- Success Icon --}}
        <div class="flex justify-center">
            <div class="w-28 h-28 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shadow-xl shadow-emerald-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
        </div>

        {{-- Message --}}
        <div class="space-y-3 max-w-md mx-auto">
            <h3 class="text-3xl font-black text-slate-900 tracking-tight">
                🎉 Thanks! Your profile is being reviewed.
            </h3>
            <p class="text-lg text-slate-500 font-medium leading-relaxed">
                Our team is verifying your credentials. You'll get an email once you're approved.
            </p>
        </div>

        {{-- Approval Time Badge --}}
        <div class="inline-flex items-center space-x-2 px-6 py-3 bg-amber-50 border border-amber-200 rounded-2xl mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <p class="text-sm font-black text-amber-700">Approval time: usually under 24 hours</p>
        </div>

        {{-- What Happens Next --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-left">
            <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl space-y-2">
                <div class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <p class="text-xs font-black uppercase tracking-widest text-slate-900">NPI Validation</p>
                <p class="text-xs font-medium text-slate-500">Automatic cross-check with the public NPI registry.</p>
            </div>
            <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl space-y-2">
                <div class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <p class="text-xs font-black uppercase tracking-widest text-slate-900">License Verification</p>
                <p class="text-xs font-medium text-slate-500">Manual check against your state database.</p>
            </div>
            <div class="p-5 bg-slate-50 border border-slate-100 rounded-2xl space-y-2">
                <div class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                </div>
                <p class="text-xs font-black uppercase tracking-widest text-slate-900">Final Approval</p>
                <p class="text-xs font-medium text-slate-500">Admin review and account activation.</p>
            </div>
        </div>

        {{-- CTA: Don't block them --}}
        <div class="pt-4 space-y-3">
            <p class="text-sm font-bold text-slate-500">You can finish setting up your profile while you wait.</p>
            <a
                href="{{ route('provider.register.profile-builder') }}"
                class="inline-flex items-center justify-center w-full px-8 py-5 bg-indigo-600 text-white text-lg font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-indigo-500/30 hover:bg-indigo-700 transition-colors group"
            >
                Complete Profile
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <a href="{{ route('dashboard') }}" class="block text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                Go to dashboard instead
            </a>
        </div>

    </div>
    @endif
</x-provider-onboarding-layout>
