<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Help Hero Header -->
        <div class="bg-[#ffde00] py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <!-- Background Decorative Shapes (Mockup) -->
            <div class="absolute top-0 right-0 p-8 opacity-20">
                <svg width="200" height="200" viewBox="0 0 200 200">
                    <circle cx="150" cy="50" r="40" fill="white" />
                    <rect x="20" y="100" width="80" height="80" fill="white" rx="10" />
                </svg>
            </div>

            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h1 class="text-3xl md:text-4xl font-black text-slate-800 mb-8 tracking-tight">
                    {{ $type === 'patient' ? 'Patients, how can we help?' : 'Providers, how can we help?' }}
                </h1>

                <!-- Search Form -->
                <form action="{{ route('help.index') }}" method="GET" class="max-w-2xl mx-auto">
                    <input type="hidden" name="type" value="{{ $type }}">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-transform group-focus-within:scale-110">
                            <svg class="h-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="q" 
                            placeholder="Search for articles..." 
                            class="block w-full pl-12 pr-4 py-4 rounded-xl border-none shadow-xl focus:ring-4 focus:ring-white/50 text-lg font-bold text-slate-700 placeholder-slate-400 transition-all"
                        >
                    </div>
                </form>
            </div>
        </div>

        <!-- Categories Grid -->
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20 pb-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('help.category', $category) }}" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center text-center transition-all hover:shadow-xl hover:-translate-y-1 group">
                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-6 group-hover:bg-[#ffde00]/20 transition-colors">
                            <svg class="w-8 h-8 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-black text-slate-800 mb-2 tracking-tight">{{ $category->name }}</h3>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">{{ $category->articles_count ?? $category->articles()->count() }} articles</p>
                    </a>
                @endforeach
            </div>

            <!-- Provider/Patient Toggle Section -->
            <div class="mt-20 text-center border-t border-slate-100 pt-16">
                <h2 class="text-2xl font-black text-slate-800 mb-8 tracking-tight">
                    {{ $type === 'patient' ? 'Are you a provider?' : 'Are you a patient?' }}
                </h2>
                <a 
                    href="{{ route('help.index', ['type' => $type === 'patient' ? 'provider' : 'patient']) }}" 
                    class="inline-block px-10 py-3 bg-[#ffde00] hover:bg-[#ffe633] text-slate-800 font-black text-sm uppercase tracking-widest rounded-xl transition-all shadow-md hover:shadow-lg"
                >
                    {{ $type === 'patient' ? 'Provider Help' : 'Patient Help' }}
                </a>
            </div>
        </div>

        <!-- Help Footer -->
        <div class="bg-white border-t border-slate-100 py-12 text-center">
            <div class="max-w-4xl mx-auto px-4">
                <div class="flex items-center justify-center gap-2 mb-4">
                    <span class="text-sm font-bold text-slate-400">Help Center</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                    <span>Powered by MedVroom</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
