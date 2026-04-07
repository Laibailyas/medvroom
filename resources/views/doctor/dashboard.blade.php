<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter italic">Workspace Dashboard</h1>
                <p class="text-slate-500 font-bold mt-1">Welcome back, Dr. {{ Auth::user()->last_name }}. Here's what's happening today.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="#" class="px-6 py-3 bg-white border border-slate-200 text-slate-900 rounded-2xl font-black text-sm hover:bg-slate-50 transition-all shadow-sm">View Schedule</a>
                <a href="#" class="px-6 py-3 bg-primary text-slate-900 rounded-2xl font-black text-sm hover:scale-105 transition-all shadow-lg shadow-primary/20">Add Availability</a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Today's Revenue (Placeholder for now, link to Earnings) -->
            <div class="bg-white p-6 md:p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:ring-2 hover:ring-primary transition-all duration-500">
                <div class="flex items-start justify-between">
                    <div class="w-12 md:w-14 h-12 md:h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 group-hover:rotate-6 transition-transform">
                        <svg class="w-6 md:w-7 h-6 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3 1.343 3 3-1.343 3-3 3m0-12c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3m-3 9v4m0-13v4"/></svg>
                    </div>
                </div>
                <div class="mt-6">
                    <p class="text-[10px] md:text-xs uppercase font-black tracking-widest text-slate-400 italic">Day Forecast</p>
                    <h3 class="text-2xl md:text-3xl font-black italic tracking-tighter mt-1">$0.00</h3>
                    <p class="text-xs font-bold text-slate-400 mt-2">0 completed today</p>
                </div>
            </div>

            <!-- Appointments -->
            <div class="bg-white p-6 md:p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:ring-2 hover:ring-primary transition-all duration-500">
                <div class="flex items-start justify-between">
                    <div class="w-12 md:w-14 h-12 md:h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:rotate-6 transition-transform">
                        <svg class="w-6 md:w-7 h-6 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <div class="mt-6">
                    <p class="text-[10px] md:text-xs uppercase font-black tracking-widest text-slate-400 italic">Today's Visits</p>
                    <h3 class="text-2xl md:text-3xl font-black italic tracking-tighter mt-1">{{ count($todaysAppointments) }}</h3>
                    <p class="text-xs font-bold text-slate-400 mt-2">{{ count($upcomingAppointments) }} upcoming confirmed</p>
                </div>
            </div>

            <!-- Pending -->
            <div class="bg-white p-6 md:p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:ring-2 hover:ring-primary transition-all duration-500">
                <div class="flex items-start justify-between">
                    <div class="w-12 md:w-14 h-12 md:h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 group-hover:rotate-6 transition-transform">
                        <svg class="w-6 md:w-7 h-6 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <div class="mt-6">
                    <p class="text-[10px] md:text-xs uppercase font-black tracking-widest text-slate-400 italic">Pending Requests</p>
                    <h3 class="text-2xl md:text-3xl font-black italic tracking-tighter mt-1">{{ $pendingRequests }}</h3>
                    <p class="text-xs font-bold text-orange-600 mt-2">Needs attention</p>
                </div>
            </div>

            <!-- Total Patients -->
            <div class="bg-white p-6 md:p-8 rounded-[2rem] border border-slate-100 shadow-sm group hover:ring-2 hover:ring-primary transition-all duration-500">
                <div class="flex items-start justify-between">
                    <div class="w-12 md:w-14 h-12 md:h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600 group-hover:rotate-6 transition-transform">
                        <svg class="w-6 md:w-7 h-6 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                </div>
                <div class="mt-6">
                    <p class="text-[10px] md:text-xs uppercase font-black tracking-widest text-slate-400 italic">Active Patients</p>
                    <h3 class="text-2xl md:text-3xl font-black italic tracking-tighter mt-1">{{ $totalPatients }}</h3>
                    <p class="text-xs font-bold text-slate-400 mt-2">Total unique profiles</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Today's Schedule -->
            <div class="lg:col-span-2 bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                <div class="p-8 border-b border-slate-50 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-black tracking-tighter italic">Today's Schedule</h2>
                        <p class="text-xs font-bold text-slate-400 mt-0.5">{{ now()->format('l, F j, Y') }}</p>
                    </div>
                    <a href="#" class="text-xs font-black text-primary uppercase tracking-widest hover:underline italic">Full Calendar</a>
                </div>
                
                <div class="flex-1">
                    @forelse($todaysAppointments as $appointment)
                        <div class="p-8 flex items-center gap-6 group hover:bg-slate-50 transition-colors border-b border-slate-50 last:border-0">
                            <div class="text-center w-20 shrink-0">
                                <p class="text-sm font-black italic tracking-tighter text-slate-400 group-hover:text-primary transition-colors">{{ $appointment->appointment_datetime->format('g:i A') }}</p>
                            </div>
                            <div class="w-12 h-12 bg-slate-100 rounded-2xl shrink-0 overflow-hidden border-2 border-white">
                                <img src="{{ $appointment->patientProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-black text-slate-900 truncate">{{ $appointment->patientProfile->user->name }}</h4>
                                <p class="text-xs font-bold text-slate-400 truncate">{{ $appointment->notes ?: 'No specific notes provided.' }}</p>
                            </div>
                            <div class="shrink-0 flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="px-4 py-2 bg-slate-900 text-white rounded-xl text-xs font-black italic transition-all shadow-lg shadow-slate-900/10">View Info</button>
                            </div>
                        </div>
                    @empty
                        <div class="p-20 text-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-300 mx-auto mb-6">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="text-slate-400 font-bold italic tracking-tight">No appointments scheduled for today yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Column: Recent Requests & Activity -->
            <div class="space-y-8">
                <!-- Upcoming Confirmed -->
                <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-xl shadow-slate-900/10">
                    <h2 class="text-xl font-black tracking-tighter italic mb-6">Upcoming Next</h2>
                    
                    <div class="space-y-6">
                        @forelse($upcomingAppointments as $appointment)
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl overflow-hidden bg-slate-800 border border-slate-700 shrink-0">
                                    <img src="{{ $appointment->patientProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-black truncate italic leading-tight">{{ $appointment->patientProfile->user->name }}</p>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mt-0.5">{{ $appointment->appointment_datetime->format('M d, g:i A') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-600 text-sm font-bold italic tracking-tight">No upcoming confirmed visits.</p>
                        @endforelse
                    </div>

                    <a href="#" class="block w-full text-center py-4 bg-white/5 hover:bg-white/10 rounded-2xl mt-8 text-xs font-black uppercase tracking-widest italic transition-all">Details List</a>
                </div>

                <!-- Messaging Quick Links -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-black tracking-tighter italic leading-none">Patient Chat</h2>
                        <div class="w-2 h-2 rounded-full bg-primary animate-pulse"></div>
                    </div>
                    <p class="text-slate-500 text-sm font-bold mb-6">Stay connected with your patients in real-time.</p>
                    <a href="#" class="flex items-center justify-center gap-2 w-full py-4 bg-slate-50 hover:bg-slate-100 rounded-2xl text-xs font-black uppercase tracking-widest italic transition-all group">
                        <span>Open Messages</span>
                        <svg class="w-4 h-4 text-slate-400 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-doctor-layout>
