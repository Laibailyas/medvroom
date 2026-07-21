@props(['doctor', 'startDate', 'endDate'])

@php
    // FIX: these used to be rand(47,50)/10 and rand(85,342) — a fresh random
    // number on every single page load, regardless of the doctor's real
    // reviews. Now pulled from real data (precomputed in SearchController,
    // with a safe fallback if that's ever missing).
    $avgRating = $doctor->avg_rating ?? round($doctor->reviews->avg('rating') ?: 0, 1);
    $reviewsCount = $doctor->reviews_count ?? $doctor->reviews->count();
@endphp

<div class="doctor-card bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 hover:shadow-2xl hover:shadow-yellow-900/5 transition-all duration-500 group mb-8 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-50/50 rounded-full -mr-16 -mt-16 blur-3xl group-hover:bg-yellow-100/50 transition-colors"></div>
    
    <div class="flex flex-col xl:flex-row gap-10 relative z-10">
        <!-- left side: info -->
        <div class="flex-1">
            <div class="flex items-start gap-6 mb-8">
                <!-- Avatar -->
                <div class="relative shrink-0">
                    <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center overflow-hidden border-2 border-slate-50 shadow-xl group-hover:scale-105 transition-transform duration-500">
                        @if($doctor->user->getProfilePhotoUrl())
                            <img src="{{ $doctor->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-yellow-50 to-yellow-100 flex items-center justify-center">
                                <span class="text-3xl font-black text-yellow-600">{{ substr($doctor->user->first_name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="absolute -bottom-2 -right-2 bg-green-500 w-6 h-6 rounded-full border-4 border-white flex items-center justify-center shadow-lg">
                        <div class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></div>
                    </div>
                </div>
                
                <div class="flex-1 min-w-0">
                    <div class="flex flex-wrap items-center gap-2 mb-2">
                        <span class="bg-yellow-400/10 text-yellow-700 text-[10px] font-black uppercase px-2.5 py-1 rounded-full border border-yellow-200/50">Top-Rated MD</span>
                        <span class="bg-slate-50 text-slate-400 text-[10px] font-black uppercase px-2.5 py-1 rounded-full border border-slate-200/30">Verified</span>
                    </div>
                    <h3 class="font-black text-2xl text-slate-900 truncate tracking-tight group-hover:text-primary transition-colors">
                        Dr. {{ $doctor->user->name }}
                    </h3>
                    <p class="text-[11px] text-slate-500 uppercase font-black tracking-widest mt-1.5 flex items-center gap-2">
                        <span class="inline-block w-1 h-1 bg-slate-300 rounded-full"></span>
                        {{ $doctor->specialties->first()?->name ?? 'Specialist' }}
                    </p>

                    <!-- FIX: real rating + review count instead of rand() -->
                    <div class="flex items-center gap-2 mt-4">
                        <div class="flex text-yellow-400 gap-0.5">
                            @for($i=1; $i<=5; $i++)
                                <svg class="w-4 h-4 {{ $i <= round($avgRating) ? 'fill-current' : 'text-slate-200 fill-current' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                        </div>
                        @if($reviewsCount > 0)
                            <span class="text-sm font-black text-slate-800 ml-1">{{ number_format($avgRating, 1) }}</span>
                            <span class="text-xs text-slate-400 font-bold ml-1">({{ $reviewsCount }} {{ Str::plural('review', $reviewsCount) }})</span>
                        @else
                            <span class="text-xs text-slate-400 font-bold italic ml-1">New provider</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 mb-6">
                <div class="flex items-center gap-3 text-slate-700 text-[11px] font-bold bg-slate-50/80 px-4 py-3 rounded-2xl border border-slate-100 hover:bg-white hover:shadow-md transition-all cursor-default">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Video Visits
                </div>
                <!-- FIX: was `{{ $doctor->practice_zip_code ?? 'New York, NY' }}` —
                     every doctor with no zip code fell back to a hardcoded NYC
                     string. Now shows the doctor's real city/state, falling
                     back to zip, falling back to an honest "not listed". -->
                <div class="flex items-center gap-3 text-slate-700 text-[11px] font-bold bg-slate-50/80 px-4 py-3 rounded-2xl border border-slate-100 hover:bg-white hover:shadow-md transition-all cursor-default">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    @if($doctor->practice_city && $doctor->practice_state)
                        {{ $doctor->practice_city }}, {{ $doctor->practice_state }}
                    @elseif($doctor->practice_zip_code)
                        {{ $doctor->practice_zip_code }}
                    @else
                        Location not listed
                    @endif
                </div>
            </div>
            
            <div class="text-[11px] text-slate-500 font-bold leading-relaxed px-1 mt-2">
                <span class="text-green-500">✔</span> New patient apps <span class="text-slate-300 mx-2">|</span> <span class="text-primary italic">Highly recommended</span> <span class="text-slate-300 mx-2">|</span> Excellent wait time
            </div>
        </div>

        <!-- right side: grid -->
        <div class="w-full xl:w-[500px] flex flex-col justify-between">
            <div class="bg-slate-50/50 rounded-[2rem] p-6 border border-slate-100 shadow-inner">
                <x-availability-grid :doctor="$doctor" :availability="$doctor->availability" :startDate="$startDate" :endDate="$endDate" />
            </div>
            
            @php 
                $upcomingAppointment = $doctor->appointments->first();
                // FIX: carry the searched insurance (if any) through to the
                // doctor profile page so the in-network badge there reflects
                // what the patient actually searched for.
                $profileUrl = route('doctors.show', array_merge(['doctor' => $doctor], request()->only('insurance')));
            @endphp

            <div class="mt-6 flex gap-4">
                <a href="{{ $profileUrl }}" class="flex-1 bg-white hover:bg-slate-900 hover:text-white text-slate-900 p-4 rounded-2xl font-black uppercase tracking-widest text-[11px] transition-all duration-300 border border-slate-200 shadow-sm text-center">View Profile</a>
                
                @if($upcomingAppointment)
                    @php 
                        $canReschedule = $upcomingAppointment->appointment_datetime->isAfter(now()->addHours(24));
                    @endphp
                    <div class="flex-[2] flex gap-3">
                        <a href="{{ route('patient.appointments.show', $upcomingAppointment) }}" class="flex-1 bg-primary hover:bg-[#ffe600] text-slate-900 p-4 rounded-2xl font-black transition-all duration-300 shadow-xl shadow-yellow-900/10 text-center flex flex-col items-center justify-center gap-0.5 group">
                            <span class="text-[9px] uppercase tracking-widest leading-none opacity-60">Booked: {{ $upcomingAppointment->appointment_datetime->format('M d') }}</span>
                            <div class="flex items-center gap-1">
                                <span class="text-[10px] uppercase tracking-[0.1em]">Open</span>
                                <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </a>
                        
                        @if($canReschedule)
                            <a href="{{ route('patient.appointments.reschedule', $upcomingAppointment) }}" class="flex-1 bg-slate-900 hover:bg-slate-800 text-white p-4 rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all duration-300 shadow-xl shadow-slate-900/10 text-center flex items-center justify-center gap-2 group">
                                <span>Reschedule</span>
                            </a>
                        @else
                            <button disabled title="Locked: Within 24 hours" class="flex-1 bg-slate-100 text-slate-400 p-4 rounded-2xl font-black uppercase tracking-widest text-[10px] cursor-not-allowed border border-slate-200 text-center">
                                Locked
                            </button>
                        @endif
                    </div>
                @else
                    <a href="{{ $profileUrl }}" class="flex-[1.5] bg-primary hover:bg-[#ffe600] text-slate-900 p-4 rounded-2xl font-black uppercase tracking-widest text-[11px] transition-all duration-300 shadow-xl shadow-yellow-900/10 text-center">Book Instantly</a>
                @endif
            </div>
        </div>
    </div>
</div>