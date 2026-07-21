<x-app-layout>
    <div x-data="{}" class="h-[calc(100vh-64px)] flex flex-col bg-white overflow-hidden">
        <!-- Top Filter Bar -->
        <form method="GET" action="{{ route('search') }}" class="flex-none bg-white border-b border-slate-100 px-6 py-4 shadow-sm z-30">
            <input type="hidden" name="q" value="{{ request('q') }}">
            <input type="hidden" name="location" value="{{ request('location') }}">
            <div class="max-w-full mx-auto flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2 mr-4">
                    <span class="w-3 h-3 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Active Results</span>
                </div>

                {{-- Date & Time --}}
                <select name="availability" onchange="this.form.submit()"
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm cursor-pointer">
                    <option value="">Date & Time</option>
                    <option value="today" {{ request('availability') == 'today' ? 'selected' : '' }}>Available Today</option>
                    <option value="tomorrow" {{ request('availability') == 'tomorrow' ? 'selected' : '' }}>Available Tomorrow</option>
                    <option value="this_week" {{ request('availability') == 'this_week' ? 'selected' : '' }}>Available This Week</option>
                </select>

                {{-- Specialty --}}
                <select name="specialty" onchange="this.form.submit()"
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm cursor-pointer">
                    <option value="">Specialty</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty->name }}" {{ request('specialty') == $specialty->name ? 'selected' : '' }}>
                            {{ $specialty->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Gender --}}
                <select name="gender" onchange="this.form.submit()"
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm cursor-pointer">
                    <option value="">Gender</option>
                    <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ request('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>

                {{-- Visit type --}}
                <select name="visit_type" onchange="this.form.submit()"
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm cursor-pointer">
                    <option value="">In-person/Video</option>
                    <option value="virtual" {{ request('visit_type') == 'virtual' ? 'selected' : '' }}>Video Visit</option>
                    <option value="in_person" {{ request('visit_type') == 'in_person' ? 'selected' : '' }}>In-Person</option>
                </select>

                {{-- Insurance --}}
                <select name="insurance" onchange="this.form.submit()"
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm cursor-pointer">
                    <option value="">Insurance</option>
                    @foreach(['Aetna','Blue Cross Blue Shield','UnitedHealthcare','Cigna','Humana','Medicare','Medicaid','Anthem','Molina Healthcare','Kaiser Permanente','WellCare','Centene'] as $ins)
                        <option value="{{ $ins }}" {{ request('insurance') == $ins ? 'selected' : '' }}>{{ $ins }}</option>
                    @endforeach
                </select>

                {{-- Experience --}}
                <select name="min_experience" onchange="this.form.submit()"
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm cursor-pointer">
                    <option value="">Experience</option>
                    <option value="1" {{ request('min_experience') == '1' ? 'selected' : '' }}>1+ Years</option>
                    <option value="5" {{ request('min_experience') == '5' ? 'selected' : '' }}>5+ Years</option>
                    <option value="10" {{ request('min_experience') == '10' ? 'selected' : '' }}>10+ Years</option>
                    <option value="15" {{ request('min_experience') == '15' ? 'selected' : '' }}>15+ Years</option>
                </select>

                {{-- Rating --}}
                <select name="min_rating" onchange="this.form.submit()"
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm cursor-pointer">
                    <option value="">Rating</option>
                    <option value="4.5" {{ request('min_rating') == '4.5' ? 'selected' : '' }}>4.5+ Stars</option>
                    <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>4+ Stars</option>
                    <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>3+ Stars</option>
                </select>

                @if(request('specialty') || request('gender') || request('visit_type') || request('insurance') || request('availability') || request('min_experience') || request('min_rating'))
                    <a href="{{ route('search', array_filter(request()->only(['q','location']))) }}"
                       class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-all">
                        Clear filters
                    </a>
                @endif

                <button type="submit"
                    class="ml-auto bg-slate-900 text-white px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-slate-900/20 hover:scale-105 active:scale-95">
                    Apply filters
                </button>
            </div>
        </form>

        <div class="flex-1 flex overflow-hidden">
            <!-- Results (now full width — map removed) -->
            <div class="flex-1 overflow-y-auto bg-slate-50/40 px-4 sm:px-8 lg:px-12 py-12 scrollbar-premium">
                <div class="max-w-5xl mx-auto">
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-6">
                        <div class="relative group">
                            <div
                                class="absolute -left-6 top-1/2 -translate-y-1/2 w-1.5 h-12 bg-primary rounded-full transform scale-y-0 group-hover:scale-y-100 transition-transform duration-500">
                            </div>
                            <h1 class="text-5xl font-black text-slate-900 tracking-tighter leading-none mb-3">
                                {{ $doctors->total() }} <span class="text-primary italic">Providers</span>
                            </h1>
                            <div class="flex items-center gap-3">
                                <span class="flex h-2 w-2 relative">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-[0.2em]">
                                    Available in <span
                                        class="text-slate-900">{{ request('location', 'Brooklyn, NY') }}</span> •
                                    {{ $userTimezone }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Sort
                                by:</span>
                            <button
                                class="text-[10px] font-black text-slate-900 uppercase tracking-tighter px-4 py-2 bg-slate-50 rounded-xl transition-all">Best
                                Match</button>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @forelse($doctors as $doctor)
                            <x-doctor-card :doctor="$doctor" :startDate="$startDate" :endDate="$endDate" />
                        @empty
                            <div class="bg-white rounded-[2.5rem] p-16 text-center shadow-sm border border-slate-100">
                                <div
                                    class="w-24 h-24 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-black text-slate-900 mb-2 tracking-tight">No match found</h3>
                                <p class="text-slate-500 font-medium">Try adjusting your filters or search location</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-20 pb-20">
                        {{ $doctors->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-booking-modal />

    @push('styles')
        <style>
            .scrollbar-premium::-webkit-scrollbar {
                width: 10px;
            }

            .scrollbar-premium::-webkit-scrollbar-track {
                background: transparent;
            }

            .scrollbar-premium::-webkit-scrollbar-thumb {
                background: #e2e8f0;
                border-radius: 20px;
                border: 3px solid #f8fafc;
            }

            .scrollbar-premium::-webkit-scrollbar-thumb:hover {
                background: #cbd5e1;
            }
        </style>
    @endpush
</x-app-layout>