<header class="bg-white border-b border-slate-100 py-4 px-6 md:px-12 flex items-center justify-between sticky top-0 z-50">
    <div class="flex items-center space-x-8">
        <a href="/" class="flex items-center space-x-2 group">
            <x-application-logo class="w-8 h-8 group-hover:rotate-12 transition-transform duration-300" />
            <span class="text-xl font-bold text-[#00234B] tracking-tight">Zocdoc</span>
            @if(isset($forProviders) && $forProviders)
                <span class="text-sm font-medium text-slate-400 ml-2 pt-1">for Providers</span>
            @endif
        </a>
    </div>

    <nav class="hidden md:flex items-center space-x-6">
        <a href="#" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Find care</a>
        <div class="w-px h-4 bg-slate-200"></div>
        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-800 hover:text-indigo-600 transition-colors">Sign in</a>
        <a href="#" class="px-4 py-2 border border-slate-300 rounded-md text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all">Need help?</a>
    </nav>
</header>
