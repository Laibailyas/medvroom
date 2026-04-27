<x-provider-onboarding-layout title="Verify your identity" description="Step 9 of 10 • Security Check" currentStep="9">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.verify.store') }}" class="p-8 lg:p-12 space-y-10 text-center">
            @csrf

            <div class="flex justify-center">
                <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-3xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/></svg>
                </div>
            </div>

            <div class="max-w-xs mx-auto">
                <p class="text-slate-600 font-medium leading-relaxed">
                    We've sent a 6-digit code to your mobile phone. Enter it below to secure your account.
                </p>
            </div>

            <div class="space-y-6" x-data="{ code: '' }">
                <div class="flex justify-center gap-2">
                    <input 
                        type="text" 
                        name="code" 
                        maxlength="6"
                        required
                        class="w-full max-w-[240px] tracking-[1em] text-center px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-3xl font-black transition-all placeholder:text-slate-300 placeholder:font-black"
                        placeholder="000000"
                        x-model="code"
                    >
                </div>
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                
                <button type="button" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                    Didn't receive a code? Resend
                </button>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Verify & Continue
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>
