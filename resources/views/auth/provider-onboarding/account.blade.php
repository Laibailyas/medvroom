<x-provider-onboarding-layout title="Create Your Account" description="Join free in under 2 minutes" currentStep="1">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.account.store') }}" class="p-8 lg:p-12 space-y-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                        placeholder="dr.smith@example.com"
                    >
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all"
                        placeholder="••••••••"
                    >
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="phone" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Phone Number</label>
                    <input
                        type="tel"
                        name="phone"
                        id="phone"
                        value="{{ old('phone') }}"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                        placeholder="(555) 000-0000"
                    >
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Continue
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>

            <p class="text-center text-sm font-medium text-slate-400">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">Log in here</a>
            </p>
        </form>
    </div>
</x-provider-onboarding-layout>
