<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-black text-slate-800 mb-8 uppercase tracking-tighter italic">Search Results</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($doctors as $doctor)
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center overflow-hidden">
                            @if($doctor->user->getProfilePhotoUrl())
                                <img src="{{ $doctor->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xl font-bold text-primary">{{ substr($doctor->user->first_name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">Dr. {{ $doctor->user->name }}</h3>
                            <p class="text-xs text-slate-500 uppercase font-black tracking-widest">{{ $doctor->specialties->first()?->name ?? 'Specialist' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center text-sm text-slate-600 gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $doctor->practice_zip_code ?? 'Location not specified' }}
                        </div>
                        <a href="{{ route('doctors.show', $doctor) }}" class="block w-full bg-[#fff04b] hover:bg-[#ffe600] text-slate-900 text-center py-3 rounded-xl font-black uppercase tracking-widest text-xs transition shadow-lg shadow-yellow-900/5">View Profile</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $doctors->links() }}
        </div>
    </div>
</x-app-layout>
