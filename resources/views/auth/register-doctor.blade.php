<x-auth-layout :forProviders="true">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-5 gap-16 items-start px-6 md:px-12 py-16">
        <!-- Left Side: Branding & Rocket Info -->
        <div class="lg:col-span-2 pt-12 space-y-12">
            <div class="text-center md:text-left">
                <!-- High-Fidelity Rocket Illustration Placeholder -->
                <div class="w-32 h-32 mb-10 mx-auto md:mx-0">
                    <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                        <path d="M50 10L65 40H35L50 10Z" class="fill-primary" />
                        <rect x="40" y="40" width="20" height="40" class="fill-slate-200" />
                        <path d="M40 80L30 90H70L60 80H40Z" class="fill-secondary" />
                        <!-- Exhaust Lines -->
                        <path d="M45 92V98" stroke="#FBBF24" stroke-width="2" stroke-linecap="round" />
                        <path d="M55 92V98" stroke="#FBBF24" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <h2 class="text-4xl font-black text-neutral-dark tracking-tight leading-tight mb-6">Let's get started</h2>
                <p class="text-lg text-slate-600 font-medium leading-relaxed max-w-sm">
                    Zocdoc is the best way to reach the right patients for your practice. It's easy to join and there are no upfront fees or subscription costs.
                </p>
            </div>
        </div>

        <!-- Right Side: Enrollment Card -->
        <div class="lg:col-span-3 bg-white p-10 shadow-[0_8px_40px_rgba(0,0,0,0.08)] rounded-md border border-slate-50">
            <form method="POST" action="{{ route('register.doctor') }}" class="space-y-6" novalidate>
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <x-input-label for="first_name" value="First name" class="mb-2" />
                        <x-text-input id="first_name" type="text" name="first_name" :value="old('first_name')" required />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    </div>
                    <!-- Last Name -->
                    <div>
                        <x-input-label for="last_name" value="Last name" class="mb-2" />
                        <x-text-input id="last_name" type="text" name="last_name" :value="old('last_name')" required />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                    </div>
                </div>

                <!-- Practice Name -->
                <div>
                    <x-input-label for="practice_name" value="Practice name" class="mb-2" />
                    <x-text-input id="practice_name" type="text" name="practice_name" :value="old('practice_name')" required />
                    <x-input-error :messages="$errors->get('practice_name')" class="mt-2" />
                </div>

                <!-- Specialty -->
                <div>
                    <label for="practice_specialty" class="block text-sm font-bold text-slate-800 mb-2">Practice or provider's specialty</label>
                    <div class="relative">
                        <select name="practice_specialty" id="practice_specialty" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-md focus:ring-1 focus:ring-primary focus:border-primary text-sm font-medium transition-all outline-none appearance-none">
                            <option value="">Select</option>
                            <option value="cardiology" {{ old('practice_specialty') == 'cardiology' ? 'selected' : '' }}>Cardiology</option>
                            <option value="dermatology" {{ old('practice_specialty') == 'dermatology' ? 'selected' : '' }}>Dermatology</option>
                            <option value="pediatrics" {{ old('practice_specialty') == 'pediatrics' ? 'selected' : '' }}>Pediatrics</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('practice_specialty')" class="mt-2" />
                    <p class="text-[10px] text-slate-400 mt-2 font-medium">Select up to 3</p>
                </div>

                <!-- Practice Size -->
                <div>
                    <label for="practice_size" class="block text-sm font-bold text-slate-800 mb-2">Practice size</label>
                    <div class="relative">
                        <select name="practice_size" id="practice_size" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-md focus:ring-1 focus:ring-primary focus:border-primary text-sm font-medium transition-all outline-none appearance-none">
                            <option value="7" {{ old('practice_size') == '7' ? 'selected' : '' }}>7</option>
                            <option value="1" {{ old('practice_size') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2-5" {{ old('practice_size') == '2-5' ? 'selected' : '' }}>2-5</option>
                            <option value="6-10" {{ old('practice_size') == '6-10' ? 'selected' : '' }}>6-10</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('practice_size')" class="mt-2" />
                    <p class="text-[10px] text-slate-400 mt-2 font-medium leading-tight">Include all providers at your practice (MDs, NPs, PAs, etc.)</p>
                </div>

                <!-- Mobile Number -->
                <div>
                    <x-input-label for="mobile" value="Mobile number" class="mb-2" />
                    <x-text-input id="mobile" type="tel" name="mobile" :value="old('mobile')" placeholder="( ) -" required />
                    <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email address" class="mb-2" />
                    <p class="text-[11px] text-slate-400 mb-2 font-medium">This email will be used to log in</p>
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div>
                        <x-input-label for="password" value="Password" class="mb-2" />
                        <x-text-input id="password" type="password" name="password" required autocomplete="new-password" :value="old('password')" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Password Confirmation -->
                    <div>
                        <x-input-label for="password_confirmation" value="Confirm password" class="mb-2" />
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" :value="old('password_confirmation')" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <!-- ZIP Code -->
                <div>
                    <x-input-label for="practice_zip_code" value="ZIP code" class="mb-2" />
                    <x-text-input id="practice_zip_code" type="text" name="practice_zip_code" required :value="old('practice_zip_code')" />
                    <x-input-error :messages="$errors->get('practice_zip_code')" class="mt-2" />
                </div>

                <!-- Referral Source -->
                <div>
                    <label for="referral_source" class="block text-sm font-bold text-slate-800 mb-2">How did you hear about us?</label>
                    <div class="relative">
                        <select name="referral_source" id="referral_source" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-md focus:ring-1 focus:ring-primary focus:border-primary text-sm font-medium transition-all outline-none appearance-none">
                            <option value="">Select</option>
                            <option value="referral" {{ old('referral_source') == 'referral' ? 'selected' : '' }}>Professional Referral</option>
                            <option value="social" {{ old('referral_source') == 'social' ? 'selected' : '' }}>Social Media</option>
                            <option value="search" {{ old('referral_source') == 'search' ? 'selected' : '' }}>Search Engine</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('referral_source')" class="mt-2" />
                </div>

                <!-- Form Actions -->
                <div class="mt-12 space-y-4">
                    <x-button size="full">
                        Sign up
                    </x-button>
                    <button type="button" class="w-full py-4 border-2 border-slate-200 bg-white text-neutral-dark rounded-md text-sm font-black transition-all hover:bg-slate-50">
                        Request a demo
                    </button>
                </div>

                <div class="mt-8 text-center pt-2">
                    <p class="text-sm font-bold text-slate-700">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Log in</a>
                    </p>
                </div>

                <div class="mt-10 flex items-start space-x-3">
                    <input type="checkbox" name="terms" id="terms" class="mt-1 w-4 h-4 text-slate-300 border-slate-300 rounded focus:ring-1 focus:ring-primary" required {{ old('terms') ? 'checked' : '' }}>
                    <label for="terms" class="text-[11px] text-slate-500 leading-relaxed font-medium">
                        By checking this box I agree to receive text messages from Zocdoc about offers*
                    </label>
                    <x-input-error :messages="$errors->get('terms')" class="mt-2" />
                </div>
            </form>
        </div>
    </div>
</x-auth-layout>
