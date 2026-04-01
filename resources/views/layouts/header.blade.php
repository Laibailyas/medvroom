<header class="bg-white border-b border-slate-100 py-4 px-6 md:px-12 flex items-center justify-between sticky top-0 z-50" x-data>
    <!-- Logo -->
    <div class="flex items-center">
        <a href="{{ url('/') }}" class="flex items-center space-x-2 group">
            <x-application-logo class="w-8 h-8 group-hover:scale-110 transition-transform duration-200" />
            <span class="text-xl font-black text-neutral-dark tracking-tight">MedVroom</span>
            @isset($forProviders)
                @if($forProviders)
                    <span class="text-sm font-medium text-slate-400 ml-1 pt-0.5">for Providers</span>
                @endif
            @endisset
        </a>
    </div>

    <!-- Right Nav -->
    <nav class="hidden md:flex items-center space-x-2">
        <a href="#" class="text-sm font-medium text-slate-600 hover:text-neutral-dark px-3 py-2 transition-colors">Find care</a>

        <!-- Sign In Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button
                @click="open = !open"
                class="flex items-center space-x-1 text-sm font-bold text-slate-800 hover:text-neutral-dark px-3 py-2 transition-colors"
            >
                <span>Sign in</span>
                <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
            </button>

            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
                class="absolute right-0 top-full mt-2 w-52 bg-white rounded-lg shadow-xl border border-slate-100 py-2 z-50"
                style="display: none;"
            >
                <p class="px-4 py-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Sign in as</p>
                <a href="{{ route('login') }}" class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-50 transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800 group-hover:text-neutral-dark">Patient</p>
                        <p class="text-[11px] text-slate-400">Manage appointments</p>
                    </div>
                </a>
                <a href="{{ route('login') }}?role=doctor" class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-50 transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800 group-hover:text-neutral-dark">Doctor / Provider</p>
                        <p class="text-[11px] text-slate-400">Access your practice</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Sign Up Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button
                @click="open = !open"
                class="flex items-center space-x-1 bg-primary hover:bg-primary-hover text-white text-sm font-bold px-4 py-2 rounded-md transition-all active:scale-[0.98]"
            >
                <span>Sign up</span>
                <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
            </button>

            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
                class="absolute right-0 top-full mt-2 w-52 bg-white rounded-lg shadow-xl border border-slate-100 py-2 z-50"
                style="display: none;"
            >
                <p class="px-4 py-2 text-[10px] font-black uppercase tracking-widest text-slate-400">Create account as</p>
                <a href="{{ route('register') }}" class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-50 transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800 group-hover:text-neutral-dark">Patient</p>
                        <p class="text-[11px] text-slate-400">Find & book care</p>
                    </div>
                </a>
                <a href="{{ route('register.doctor') }}" class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-50 transition-colors group">
                    <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800 group-hover:text-neutral-dark">Doctor / Provider</p>
                        <p class="text-[11px] text-slate-400">List your practice</p>
                    </div>
                </a>
            </div>
        </div>

        <a href="#" class="px-4 py-2 border border-slate-300 rounded-md text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all ml-2">Need help?</a>
    </nav>

    <!-- Mobile: Hamburger -->
    <div class="md:hidden" x-data="{ open: false }">
        <button @click="open = !open" class="p-2 rounded-md text-slate-600 hover:bg-slate-100 transition">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <div x-show="open" class="absolute top-full left-0 right-0 bg-white border-b border-slate-100 shadow-lg px-6 py-6 space-y-4" style="display:none;">
            <a href="{{ route('login') }}" class="block text-sm font-bold text-slate-700 py-2">Patient Sign in</a>
            <a href="{{ route('login') }}" class="block text-sm font-bold text-slate-700 py-2">Doctor Sign in</a>
            <a href="{{ route('register') }}" class="block text-sm font-bold text-slate-700 py-2">Patient Sign up</a>
            <a href="{{ route('register.doctor') }}" class="block w-full py-3 bg-primary text-white rounded-md text-sm font-bold text-center">Doctor Sign up</a>
        </div>
    </div>
</header>
