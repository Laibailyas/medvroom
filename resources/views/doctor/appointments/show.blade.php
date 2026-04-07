<x-doctor-layout>
    <div class="space-y-8">
        <!-- Breadcrumbs & Actions -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('doctor.appointments.index') }}" class="w-12 h-12 bg-white border border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-slate-900 transition-all">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-3xl font-black tracking-tighter italic">Appointment Detail</h1>
                    <p class="text-slate-500 font-bold mt-0.5">Reference ID: #{{ str_pad($appointment->id, 8, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                @if($appointment->status === 'pending' || $appointment->status === 'reschedule_requested')
                    <form action="{{ route('doctor.appointments.update-status', $appointment) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="px-8 py-3 bg-primary text-slate-900 rounded-2xl font-black text-sm hover:scale-105 transition-all shadow-lg shadow-primary/20 italic">Accept Booking</button>
                    </form>
                    <button @click="$dispatch('open-modal', 'reject-appointment')" class="px-8 py-3 bg-white border border-slate-200 text-red-600 rounded-2xl font-black text-sm hover:bg-red-50 transition-all italic">Decline</button>
                @elseif($appointment->status === 'confirmed')
                    @if($appointment->appointment_datetime->isPast())
                        <form action="{{ route('doctor.appointments.update-status', $appointment) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="px-8 py-3 bg-blue-600 text-white rounded-2xl font-black text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 italic">Mark as Completed</button>
                        </form>
                    @endif
                    <button @click="$dispatch('open-modal', 'cancel-appointment')" class="px-8 py-3 bg-white border border-slate-200 text-slate-400 rounded-2xl font-black text-sm hover:text-red-600 hover:bg-red-50 transition-all italic">Cancel Visit</button>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Patient & Visit Info -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Status Banner -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-8 flex items-center justify-between">
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center text-slate-400 group">
                                <svg class="w-10 h-10 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs font-black text-slate-400 uppercase tracking-widest italic">Current Status</p>
                                <h3 class="text-2xl font-black italic tracking-tighter mt-1">{{ ucfirst(str_replace('_', ' ', $appointment->status)) }}</h3>
                                <p class="text-sm font-bold text-slate-400 mt-1">Last updated {{ $appointment->latestStatusHistory->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest italic">Scheduled Time</p>
                            <p class="text-xl font-black italic tracking-tighter mt-1">{{ $appointment->appointment_datetime->format('l, F j, Y') }}</p>
                            <p class="text-sm font-bold text-primary mt-1">{{ $appointment->appointment_datetime->format('g:i A') }}</p>
                        </div>
                    </div>
                    @if($appointment->latestStatusHistory->comment)
                        <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 italic">
                            <p class="text-sm text-slate-500 font-bold italic">“{{ $appointment->latestStatusHistory->comment }}”</p>
                        </div>
                    @endif
                </div>

                <!-- Visit Reason & Notes -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
                    <h2 class="text-2xl font-black tracking-tighter italic mb-8">Visit Information</h2>
                    <div class="space-y-8">
                        <div>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest italic mb-2">Reason for Visit</p>
                            <p class="text-lg font-bold text-slate-700 leading-relaxed">{{ $appointment->notes ?: 'Regular check-up or no specific reason provided.' }}</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="p-6 bg-slate-50 rounded-2xl">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic mb-2">Insurance Primary</p>
                                <p class="text-sm font-black italic tracking-tight text-slate-900">{{ $appointment->insurancePlan->provider->name ?? 'Direct Payment' }}</p>
                                <p class="text-xs font-bold text-slate-400 mt-0.5">{{ $appointment->insurancePlan->name ?? 'Cash/Out-of-network' }}</p>
                            </div>
                            <div class="p-6 bg-slate-50 rounded-2xl">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic mb-2">Estimated Fee</p>
                                <p class="text-sm font-black italic tracking-tight text-slate-900">${{ number_format($appointment->doctorProfile->consultation_fee, 2) }}</p>
                                <p class="text-xs font-bold text-slate-400 mt-0.5">Provider Standard Rate</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline / History -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
                    <h2 class="text-2xl font-black tracking-tighter italic mb-8">Status History</h2>
                    <div class="space-y-8">
                        @foreach($appointment->statusHistories as $history)
                            <div class="relative flex gap-6">
                                @if(!$loop->last)
                                    <div class="absolute left-6 top-10 bottom-0 w-px bg-slate-100"></div>
                                @endif
                                <div class="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0 z-10">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="pt-2">
                                    <p class="text-xs font-black italic tracking-tighter text-slate-900">
                                        Status changed to <span class="bg-slate-100 px-2 py-0.5 rounded uppercase tracking-widest text-[10px]">{{ $history->status }}</span>
                                    </p>
                                    <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase">{{ $history->created_at->format('M d, Y @ g:i A') }}</p>
                                    @if($history->comment)
                                        <p class="text-xs font-bold text-slate-500 mt-2 p-3 bg-slate-50/50 rounded-xl italic">“{{ $history->comment }}”</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Patient Profile & Messaging -->
            <div class="space-y-8">
                <!-- Patient Mini Card -->
                <div class="bg-slate-900 rounded-[2.5rem] p-8 text-white shadow-xl shadow-slate-900/10 text-center">
                    <div class="w-24 h-24 rounded-[2.5rem] overflow-hidden bg-slate-800 border-4 border-slate-800 shadow-2xl mx-auto mb-6">
                        <img src="{{ $appointment->patientProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-2xl font-black tracking-tighter italic leading-tight">{{ $appointment->patientProfile->user->name }}</h2>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest mt-1">Joined {{ $appointment->patientProfile->user->created_at->format('M Y') }}</p>
                    
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="bg-slate-800/50 p-4 rounded-2xl">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest italic mb-1">Gender</p>
                            <p class="text-xs font-black italic tracking-tighter">{{ ucfirst($appointment->patientProfile->gender) ?: 'N/A' }}</p>
                        </div>
                        <div class="bg-slate-800/50 p-4 rounded-2xl">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest italic mb-1">DOB</p>
                            <p class="text-xs font-black italic tracking-tighter">{{ $appointment->patientProfile->date_of_birth?->format('M d, Y') ?: 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-4">
                        <a href="{{ route('doctor.chat.show', $conversation) }}" class="flex items-center justify-center gap-2 w-full py-4 bg-primary text-slate-900 rounded-2xl text-xs font-black uppercase tracking-widest italic hover:scale-105 transition-all shadow-lg shadow-primary/10">
                            Send Message
                        </a>
                        <a href="{{ route('doctor.patients.show', $appointment->patientProfile) }}" class="block w-full py-4 bg-white/5 hover:bg-white/10 text-white rounded-2xl text-xs font-black uppercase tracking-widest italic transition-all">
                            View clinical History
                        </a>
                    </div>
                </div>

                <!-- Messaging Quick Links -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
                    <h2 class="text-xl font-black tracking-tighter italic mb-4 leading-none">Clinical Notes</h2>
                    <p class="text-slate-500 text-sm font-bold mb-6 italic leading-relaxed">Add internal clinical notes for this specific encounter. (Visible only to you)</p>
                    <textarea class="w-full bg-slate-50 border-0 rounded-2xl p-4 text-xs font-bold text-slate-600 focus:ring-2 focus:ring-primary h-32" placeholder="Start typing clinical encounter notes..."></textarea>
                    <button class="w-full mt-4 py-3 bg-slate-900 text-white rounded-xl text-xs font-black uppercase tracking-widest italic transition-all">Save Notes</button>
                </div>
            </div>
        </div>
    </div>
</x-doctor-layout>
