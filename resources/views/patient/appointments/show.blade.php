<x-app-layout>
    <div class="bg-slate-50 min-h-screen pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            
            <!-- Breadcrumbs & Header -->
            <div class="flex items-center justify-between mb-10">
                <div class="flex items-center gap-4">
                    <a href="{{ route('patient.appointments.index') }}"
                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-100 text-slate-400 hover:text-slate-900 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Appointment Details</h1>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em] mt-1 italic">Reference #{{ str_pad($appointment->id, 8, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="px-4 py-1.5 {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} text-[10px] font-black uppercase tracking-widest rounded-full border border-current opacity-80">
                        {{ $appointment->status }}
                    </span>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-8 bg-green-50 border border-green-100 text-green-600 p-4 rounded-2xl text-sm font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-8 bg-red-50 border border-red-100 text-red-600 p-4 rounded-2xl text-sm font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Main Info -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Doctor Info Card -->
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 flex items-start gap-6 relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-full -mr-16 -mt-16 blur-3xl group-hover:bg-primary/10 transition-colors"></div>
                        <div class="w-24 h-24 bg-slate-50 rounded-2xl flex items-center justify-center overflow-hidden border border-slate-100 shadow-inner shrink-0 relative z-10 transition-transform duration-500 group-hover:scale-105">
                            @if($appointment->doctorProfile->user->getProfilePhotoUrl())
                                <img src="{{ $appointment->doctorProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl font-black text-slate-200 uppercase">{{ substr($appointment->doctorProfile->user->first_name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 relative z-10">
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Dr. {{ $appointment->doctorProfile->user->name }}</h3>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1 italic">{{ $appointment->doctorProfile->specialties->first()?->name ?? 'Specialist' }}</p>
                            <div class="mt-6 flex flex-wrap gap-4">
                                <a href="{{ route('doctors.show', $appointment->doctorProfile) }}" class="text-[10px] font-black text-primary uppercase tracking-widest border-b-2 border-primary/20 pb-0.5 hover:border-primary transition-all">View Profile</a>
                                <div class="w-px h-3 bg-slate-200 mt-1"></div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $appointment->doctorProfile->practice_city }}, {{ $appointment->doctorProfile->practice_zip_code }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Summary -->
                    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100 space-y-10">
                        <div class="grid grid-cols-2 gap-10">
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Date & Time</h4>
                                <div class="space-y-1">
                                    <p class="text-xl font-black text-slate-900 tracking-tight">{{ $appointment->appointment_datetime->format('l, F j, Y') }}</p>
                                    <p class="text-sm font-bold text-slate-500 italic">{{ $appointment->appointment_datetime->format('h:i A') }} ({{ config('app.timezone') }})</p>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Visit Type</h4>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    </div>
                                    <p class="text-lg font-black text-slate-800 tracking-tight">Video Visit</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-10 border-t border-slate-50">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Patient Notes</h4>
                            <p class="text-sm font-bold text-slate-600 leading-relaxed italic">
                                "{{ $appointment->notes ?? 'No notes provided.' }}"
                            </p>
                        </div>

                        @if($appointment->insurancePlan)
                            <div class="pt-10 border-t border-slate-50">
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Insurance Info</h4>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center border border-green-100">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-black text-slate-900 tracking-tight">{{ $appointment->insurancePlan->provider->name }}</p>
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ $appointment->insurancePlan->name }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Status History (Timeline) -->
                    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-10 border-b border-slate-50 pb-6">Appointment Timeline</h4>
                        <div class="space-y-10 relative">
                            <div class="absolute left-[19px] top-2 bottom-2 w-0.5 bg-slate-50"></div>
                            @foreach($appointment->statusHistories as $history)
                                <div class="relative flex items-start gap-8 group">
                                    <div class="w-10 h-10 rounded-full bg-white border-2 {{ $loop->first ? 'border-primary ring-4 ring-primary/10' : 'border-slate-100' }} flex items-center justify-center relative z-10">
                                        <div class="w-2 h-2 rounded-full {{ $loop->first ? 'bg-primary animate-pulse' : 'bg-slate-200' }}"></div>
                                    </div>
                                    <div class="flex-1 pt-1">
                                        <div class="flex justify-between items-center mb-1">
                                            <h5 class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $history->status }}</h5>
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $history->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-xs font-bold text-slate-500 italic">{{ $history->comment ?? 'Status successfully updated.' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Chat Interface Link -->
                    @if($appointment->status !== 'pending' && $appointment->conversation())
                        <div class="mt-8 bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Chat with your provider?</h3>
                                    <p class="text-sm font-bold text-slate-500">The chat has been moved to our dedicated Messenger portal.</p>
                                </div>
                            </div>
                            <a href="{{ route('messages.index', $appointment->conversation()) }}" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/20">
                                Open Messenger
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Actions & Payment -->
                <div class="space-y-8">
                    
                    <!-- Primary Actions -->
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl shadow-slate-900/20">
                        <h2 class="text-white text-xl font-black mb-8 italic tracking-tight">Need to make a change?</h2>
                        <div class="space-y-4">
                            @if($appointment->status === 'reschedule_requested')
                                <div class="bg-yellow-500/10 border border-yellow-500/20 p-4 rounded-2xl text-center mb-4">
                                    <p class="text-xs font-bold text-yellow-500 uppercase tracking-widest">Doctor proposed a new time</p>
                                </div>
                                <form action="{{ route('patient.appointments.reply-reschedule', $appointment) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="accept">
                                    <button type="submit" class="group w-full bg-green-500 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center justify-center gap-3 hover:bg-green-600 transition-all mb-4">
                                        Accept New Time
                                    </button>
                                </form>
                                <form action="{{ route('patient.appointments.reply-reschedule', $appointment) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit" class="w-full bg-red-600/20 text-red-500 border border-red-500/20 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center justify-center gap-3 hover:bg-red-600 hover:text-white transition-all">
                                        Reject Reschedule
                                    </button>
                                </form>
                            @elseif($appointment->appointment_datetime->isAfter(now()->addHours(24)))
                                <a href="{{ route('patient.appointments.reschedule', $appointment) }}" class="group w-full bg-primary text-slate-900 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center justify-center gap-3 hover:scale-[1.03] active:scale-95 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Reschedule Visit
                                </a>
                                <button class="w-full bg-white/10 text-white/60 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center justify-center gap-3 hover:bg-red-500/10 hover:text-red-500 transition-all border border-white/5">
                                    Cancel Appointment
                                </button>
                            @else
                                <div class="bg-white/5 rounded-2xl p-6 border border-white/5 text-center">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest leading-relaxed">
                                        @if($appointment->appointment_datetime->isPast())
                                            This appointment has already passed.
                                        @else
                                            Rescheduling is only available 24+ hours before.
                                        @endif
                                    </p>
                                </div>
                                @if($appointment->appointment_datetime->isPast())
                                    <a href="{{ route('doctors.show', $appointment->doctorProfile) }}" class="w-full bg-primary text-slate-900 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center justify-center gap-3 hover:scale-[1.03] active:scale-95 transition-all">
                                        Book Again
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    @if($appointment->payment)
                        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden group">
                             <div class="absolute inset-0 bg-gradient-to-br from-transparent via-slate-50/50 to-slate-100/50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <h2 class="text-xl font-black text-slate-900 tracking-tight mb-8 italic uppercase relative z-10">Payment Summary</h2>
                            <div class="space-y-6 relative z-10">
                                <div class="flex justify-between items-center text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <span>Consultation Fee</span>
                                    <span class="text-slate-900 font-black">${{ number_format($appointment->payment->amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</span>
                                    <span class="px-2.5 py-0.5 bg-green-50 text-green-600 text-[9px] font-black uppercase tracking-widest rounded-md border border-green-100">
                                        {{ $appointment->payment->status }}
                                    </span>
                                </div>
                                <div class="pt-6 border-t border-slate-50 flex justify-between items-center">
                                    <span class="text-xs font-black text-slate-900 uppercase">Paid via Stripe</span>
                                    <img src="https://stripe.com/img/v3/home/logos/stripe.svg" class="h-4 opacity-40" alt="Stripe">
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
