<x-provider-onboarding-layout title="Get more patients on {{ config('app.name') }}" currentStep="0">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <div class="p-8 lg:p-12">
            <div class="flex flex-col md:flex-row items-center gap-8 mb-12">
                <div class="w-full md:w-1/2">
                    <h3 class="text-4xl font-black text-slate-900 tracking-tight leading-tight mb-6">
                        Set up your profile in <span class="text-indigo-600">minutes</span>.
                    </h3>
                    <p class="text-lg text-slate-600 font-medium leading-relaxed mb-8">
                        Get approved in 1–2 days and start reaching more patients immediately. No upfront costs.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-700">Reach thousands of new patients</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-700">Seamless NPI verification</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-700">Automated insurance check</span>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="relative">
                        <div class="absolute inset-0 bg-indigo-600/5 blur-3xl rounded-full"></div>
                        <div class="relative bg-white border border-slate-100 rounded-2xl p-6 shadow-2xl shadow-slate-200">
                            <!-- Card Representation -->
                            <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-slate-50">
                                <div class="w-16 h-16 bg-slate-100 rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                                <div>
                                    <div class="w-32 h-4 bg-slate-100 rounded mb-2"></div>
                                    <div class="w-24 h-3 bg-slate-50 rounded"></div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="w-full h-10 bg-slate-50 rounded-lg"></div>
                                <div class="w-full h-10 bg-slate-50 rounded-lg"></div>
                                <div class="w-2/3 h-10 bg-indigo-600/10 rounded-lg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-button :href="route('provider.register.account')" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Get Started
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
            
            <p class="text-center mt-6 text-sm font-bold text-slate-400">
                Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log in here</a>
            </p>
        </div>
    </div>
</x-provider-onboarding-layout>
