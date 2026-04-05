<x-auth-layout title="Log In" description="Securely log in to your MedVroom account to manage appointments and medical records.">
    <div class="max-w-md mx-auto py-24 px-6">
        <div class="bg-white p-10 shadow-[0_4px_24px_rgba(0,0,0,0.06)] rounded-md border border-slate-50">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-black text-neutral-dark tracking-tight leading-tight">Welcome back</h2>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6" novalidate>
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" value="Email" class="mb-2" />
                    <x-text-input 
                        id="email" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <x-input-label for="password" value="Password" />
                        @if (Route::has('password.request'))
                            <a tabindex="-1" class="text-xs font-bold text-primary hover:underline underline-offset-2" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <x-password-input 
                        id="password" 
                        name="password" 
                        required 
                        :value="old('password')"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <label for="remember_me" class="flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" class="w-4 h-4 text-primary border-slate-300 rounded focus:ring-1 focus:ring-primary" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="ms-3 text-xs font-bold text-slate-500 group-hover:text-slate-800 transition-colors">Keep me logged in</span>
                    </label>
                </div>

                <div class="pt-4">
                    <x-button size="full">
                        Log in
                    </x-button>
            <!-- Social Divider -->
            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-xs text-slate-400 font-medium bg-[#F7F8F9] px-4">or</div>
            </div>

            <div class="space-y-4">
                <a href="{{ route('social.redirect', 'google') }}" class="w-full py-3 px-6 border border-slate-400 rounded-md text-sm font-bold text-slate-800 hover:bg-slate-50 transition-all flex items-center justify-center space-x-3">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <span>Continue with Google</span>
                </a>
            </div>

            <div class="mt-10 pt-8 border-t border-slate-100 text-center space-y-4">
                    <p class="text-sm font-bold text-slate-600">
                        New to Zocdoc? 
                        <a href="{{ route('register') }}" class="text-primary hover:underline underline-offset-4 font-bold">Create an account</a>
                    </p>
                    
                    <p class="text-xs font-bold text-slate-400">
                        Are you a doctor? 
                        <a href="{{ route('register.doctor') }}" class="ml-1 text-slate-700 hover:text-primary transition-colors font-bold">
                            Join as a Provider &rarr;
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-auth-layout>
