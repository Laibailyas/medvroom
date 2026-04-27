<x-provider-onboarding-layout title="Application Submitted" currentStep="0">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden text-center p-8 lg:p-12">
        <div class="mb-10 flex justify-center">
            <div class="w-32 h-32 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center animate-bounce shadow-xl shadow-emerald-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
        </div>

        <h3 class="text-4xl font-black text-slate-900 tracking-tight leading-tight mb-6">
            You're under <span class="text-indigo-600">review</span>.
        </h3>
        
        <p class="text-xl text-slate-600 font-medium leading-relaxed max-w-lg mx-auto mb-10">
            We've received your application. Our team will verify your medical credentials within <span class="text-slate-900 font-black">24–48 hours</span>.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="p-6 bg-slate-50 border border-slate-100 rounded-3xl">
                <div class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <h5 class="text-xs font-black uppercase tracking-widest text-slate-900">Credentialing</h5>
                <p class="text-[10px] font-bold text-slate-500 mt-2 uppercase tracking-tighter">Verifying Licenses</p>
            </div>
            <div class="p-6 bg-slate-50 border border-slate-100 rounded-3xl">
                <div class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h5 class="text-xs font-black uppercase tracking-widest text-slate-900">Security Check</h5>
                <p class="text-[10px] font-bold text-slate-500 mt-2 uppercase tracking-tighter">HIPAA Compliance</p>
            </div>
            <div class="p-6 bg-slate-50 border border-slate-100 rounded-3xl">
                <div class="w-10 h-10 bg-white border border-slate-200 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                </div>
                <h5 class="text-xs font-black uppercase tracking-widest text-slate-900">Admin Review</h5>
                <p class="text-[10px] font-bold text-slate-500 mt-2 uppercase tracking-tighter">Final Approval</p>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="inline-flex items-center space-x-2 text-indigo-600 font-black uppercase tracking-widest hover:underline transition-all">
            <span>Go to Provider Portal</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
        </a>
    </div>
</x-provider-onboarding-layout>
