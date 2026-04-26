@php
    $role = $role ?? 'patient';
    $displayRole = match($role) {
        'doctor' => 'Provider',
        'admin' => 'Admin',
        default => 'Patient',
    };
    $loginTitle = match($role) {
        'doctor' => 'Provider Portal',
        'admin' => 'Admin Dashboard',
        default => 'Welcome Back',
    };
    $loginDesc = match($role) {
        'doctor' => 'Manage your practice and connect with patients.',
        'admin' => 'System administration and platform management.',
        default => 'Find and book local providers who take your insurance.',
    };
    $accentColor = match($role) {
        'doctor' => 'emerald',
        'admin' => 'slate',
        default => 'primary',
    };

    $siteSettings = \App\Models\SystemSetting::where('key', 'site_settings')->first()?->value ?? [];
    $siteName = $siteSettings['site_name'] ?? config('app.name', 'MedVroom');
@endphp

<x-auth-layout :title="$loginTitle . ' Log In'" :description="$loginDesc">
    <div class="max-w-md mx-auto py-20 px-6">
        <!-- Role Badge -->
        <div class="flex justify-center mb-6">
            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] 
                @if($role === 'doctor') bg-emerald-50 text-emerald-600 border border-emerald-100 
                @elseif($role === 'admin') bg-slate-100 text-slate-600 border border-slate-200 
                @else bg-primary/10 text-primary border border-primary/20 @endif">
                {{ $displayRole }} Login
            </span>
        </div>

        <div class="bg-white p-10 shadow-[0_20px_50px_rgba(0,0,0,0.05)] rounded-[2rem] border border-slate-100">
            <div class="mb-10 text-center">
                <h2 class="text-4xl font-black text-slate-900 tracking-tighter leading-none mb-3">{{ $loginTitle }}</h2>
                <p class="text-sm font-bold text-slate-400">{{ $loginDesc }}</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6" novalidate>
                @csrf
                
                <!-- Intended Role for Validation -->
                <input type="hidden" name="intended_role" value="{{ $role }}">

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" value="Email address" class="mb-2" />
                    <x-text-input 
                        id="email" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        placeholder="name@example.com"
                        required 
                        autofocus 
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 transition-all"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <x-input-label for="password" value="Password" />
                        @if (Route::has('password.request'))
                            <a tabindex="-1" class="text-xs font-black text-primary hover:underline underline-offset-4" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <x-password-input 
                        id="password" 
                        name="password" 
                        required 
                        :value="old('password')"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-primary/20 transition-all"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <label for="remember_me" class="flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" class="w-5 h-5 text-primary border-slate-200 rounded-lg focus:ring-primary transition-all" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="ms-3 text-xs font-bold text-slate-500 group-hover:text-slate-900 transition-colors">Keep me logged in</span>
                    </label>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-sm shadow-2xl transition-all active:scale-[0.98]
                        @if($role === 'doctor') bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-900/20 
                        @elseif($role === 'admin') bg-slate-900 hover:bg-slate-800 text-white shadow-slate-900/20 
                        @else bg-primary hover:bg-[#ffe600] text-slate-900 shadow-yellow-900/20 @endif">
                        Sign in
                    </button>
                </div>

                @if($role === 'patient')
                    <!-- Social Divider -->
                    <div class="relative py-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-100"></div>
                        </div>
                        <div class="relative flex justify-center text-[10px] font-black uppercase tracking-widest text-slate-300 bg-white px-4">or</div>
                    </div>

                    <div class="space-y-4">
                        <a href="{{ route('social.redirect', 'google') }}" class="w-full py-4 px-6 border-2 border-slate-50 rounded-2xl text-sm font-bold text-slate-700 hover:bg-slate-50 transition-all flex items-center justify-center space-x-3">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            <span class="tracking-tight uppercase text-[11px] font-black">Continue with Google</span>
                        </a>
                    </div>

                    <div class="mt-10 pt-8 border-t border-slate-50 text-center space-y-4">
                        <p class="text-sm font-bold text-slate-500">
                            New to {{ $siteName }}? 
                            <a href="{{ route('register') }}" class="text-primary hover:underline underline-offset-4 font-black">Create an account</a>
                        </p>
                        
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest">
                            Are you a provider? 
                            <a href="{{ route('provider.login') }}" class="ml-1 text-slate-900 hover:text-primary transition-colors">
                                Go to Provider Portal &rarr;
                            </a>
                        </p>
                    </div>
                @elseif($role === 'doctor')
                    <div class="mt-10 pt-8 border-t border-slate-50 text-center space-y-4">
                        <p class="text-sm font-bold text-slate-500">
                            Don't have a practice account? 
                            <a href="{{ route('register.doctor') }}" class="text-emerald-600 hover:underline underline-offset-4 font-black">Join as a Provider</a>
                        </p>
                        <a href="{{ route('login') }}" class="block text-[11px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-900 transition-colors">
                            &larr; Return to Patient Login
                        </a>
                    </div>
                @else
                    <div class="mt-10 pt-8 border-t border-slate-50 text-center">
                        <a href="{{ route('login') }}" class="text-[11px] font-black text-slate-400 uppercase tracking-widest hover:text-slate-900 transition-colors">
                            &larr; Return to Patient Login
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</x-auth-layout>
