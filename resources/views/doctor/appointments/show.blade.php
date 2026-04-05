<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('doctor.appointments.index') }}"
                class="w-8 h-8 md:w-10 md:h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-100 text-slate-400 hover:text-slate-900 transition-colors">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-bold text-xl md:text-2xl text-slate-800 leading-tight">
                {{ __('Appointment Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="bg-slate-50 min-h-screen pb-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            
            @if(session('success'))
                <div class="mb-8 bg-green-50 border border-green-100 text-green-600 p-4 rounded-2xl text-sm font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Patient & Appointment Info -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Patient Info Card -->
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 flex items-start gap-6 relative overflow-hidden group">
                        <div class="w-24 h-24 bg-slate-50 rounded-2xl flex items-center justify-center overflow-hidden border border-slate-100 shadow-inner shrink-0 relative z-10 transition-transform duration-500 group-hover:scale-105">
                            @if($appointment->patientProfile->user->getProfilePhotoUrl())
                                <img src="{{ $appointment->patientProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl font-black text-slate-200 uppercase">{{ substr($appointment->patientProfile->user->first_name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 relative z-10">
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight">{{ $appointment->patientProfile->user->name }}</h3>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mt-1 italic">
                                {{ $appointment->patientProfile->date_of_birth ? $appointment->patientProfile->date_of_birth->age . ' years old' : 'Age not specified' }} • {{ ucfirst($appointment->patientProfile->sex ?? 'Unspecified') }}
                            </p>
                            <div class="mt-6 flex flex-wrap gap-4">
                                <a href="{{ route('doctor.patients.show', $appointment->patientProfile) }}" class="text-[10px] font-black text-primary uppercase tracking-widest border-b-2 border-primary/20 pb-0.5 hover:border-primary transition-all">View Full Profile</a>
                                <div class="w-px h-3 bg-slate-200 mt-1"></div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $appointment->patientProfile->user->email }}</span>
                            </div>
                        </div>
                        <div class="shrink-0 pt-1">
                             <span class="px-4 py-1.5 {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} text-[10px] font-black uppercase tracking-widest rounded-full border border-current opacity-80">
                                {{ str_replace('_', ' ', $appointment->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Appointment Summary -->
                    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100 space-y-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Scheduled Date & Time</h4>
                                <div class="space-y-1">
                                    <p class="text-xl font-black text-slate-900 tracking-tight">{{ $appointment->appointment_datetime->format('l, F j, Y') }}</p>
                                    <p class="text-sm font-bold text-slate-500 italic">{{ $appointment->appointment_datetime->format('h:i A') }}</p>
                                </div>
                            </div>
                            @if($appointment->insurancePlan)
                            <div>
                                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Insurance Method</h4>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-black text-slate-800 tracking-tight">{{ $appointment->insurancePlan->provider->name }}</p>
                                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $appointment->insurancePlan->name }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="pt-10 border-t border-slate-50">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Patient Complaint / Notes</h4>
                            <p class="text-sm font-bold text-slate-600 leading-relaxed italic bg-slate-50 p-6 rounded-3xl border border-slate-100">
                                "{{ $appointment->notes ?? 'No notes provided by patient.' }}"
                            </p>
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
                                    <h3 class="text-xl font-black text-slate-900 tracking-tight">Need to message the patient?</h3>
                                    <p class="text-sm font-bold text-slate-500">The chat has been moved to our dedicated Messenger portal.</p>
                                </div>
                            </div>
                            <a href="{{ route('messages.index', $appointment->conversation()) }}" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-slate-800 transition-all shadow-lg shadow-slate-900/20">
                                Open Messenger
                            </a>
                        </div>
                    @else
                        <div class="mt-8 bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100 text-center space-y-4">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto text-slate-300">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            </div>
                            <h3 class="text-lg font-black text-slate-900 tracking-tight">Chat unavailable</h3>
                            <p class="text-sm font-bold text-slate-500 max-w-sm mx-auto">Interactive chatting will be enabled once the appointment request is confirmed.</p>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Actions & Timeline -->
                <div class="space-y-8">
                    
                    <!-- Quick Actions -->
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl shadow-slate-900/20" x-data="{ showReject: false, showReschedule: false }">
                        <h2 class="text-white text-xl font-black mb-8 italic tracking-tight">Practice Actions</h2>
                        <div class="space-y-4">
                            @if($appointment->status === 'pending' || $appointment->status === 'reschedule_requested')
                                <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="w-full bg-green-500 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center justify-center gap-3 hover:bg-green-600 transition-all">
                                        Confirm Appointment
                                    </button>
                                </form>
                            @endif

                            @if(in_array($appointment->status, ['confirmed', 'reschedule_requested']))
                                <button @click="showReschedule = true" class="w-full bg-primary text-slate-900 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center justify-center gap-3 hover:scale-[1.03] active:scale-95 transition-all">
                                    Propose Reschedule
                                </button>
                                
                                @if($appointment->appointment_datetime->isPast())
                                    <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="w-full bg-blue-500 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center justify-center gap-3 hover:bg-blue-600 transition-all">
                                            Mark as Completed
                                        </button>
                                    </form>
                                @endif
                                
                                <button @click="showReject = true" class="w-full bg-white/10 text-white/60 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center justify-center gap-3 hover:bg-red-500/10 hover:text-red-500 transition-all border border-white/5">
                                    {{ $appointment->status === 'confirmed' ? 'Cancel Visit' : 'Reject Request' }}
                                </button>
                            @endif
                            
                            @if(in_array($appointment->status, ['cancelled', 'rejected', 'completed']))
                                <div class="bg-white/5 rounded-2xl p-6 border border-white/5 text-center">
                                    <p class="text-[10px] font-black text-white/40 uppercase tracking-widest leading-relaxed">
                                        Appointment is {{ $appointment->status }}. No further actions required.
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Reject Modal -->
                        <div x-show="showReject" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                            <div @click.away="showReject = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                <h3 class="font-black text-xl mb-4 text-slate-900 tracking-tight">{{ $appointment->status === 'confirmed' ? 'Cancel Appointment' : 'Reject Appointment' }}</h3>
                                <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="cancelled">
                                    <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:border-red-500 focus:ring-red-500" placeholder="{{ $appointment->status === 'confirmed' ? 'Reason for cancellation...' : 'Reason for rejection...' }}"></textarea>
                                    <div class="flex justify-end gap-3 mt-2">
                                        <button type="button" @click="showReject = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Go Back</button>
                                        <button type="submit" class="px-5 py-2.5 text-sm font-bold bg-red-600 text-white rounded-xl shadow-lg shadow-red-600/20 hover:bg-red-700 transition-colors">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Reschedule Modal -->
                        <div x-show="showReschedule" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                            <div @click.away="showReschedule = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                <h3 class="font-black text-xl mb-4 text-slate-900 tracking-tight">Propose New Time</h3>
                                <form action="{{ route('doctor.appointments.reschedule', $appointment) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 text-left">New Date & Time</label>
                                        <input type="datetime-local" name="new_datetime" required class="w-full rounded-xl border-slate-200 text-sm font-bold focus:border-primary focus:ring-primary shadow-sm" value="{{ $appointment->appointment_datetime->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:border-primary focus:ring-primary shadow-sm" placeholder="Please provide a message to the patient..."></textarea>
                                    <div class="flex justify-end gap-3 mt-2">
                                        <button type="button" @click="showReschedule = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Cancel</button>
                                        <button type="submit" class="px-5 py-2.5 text-sm font-black text-slate-900 bg-primary rounded-xl shadow-lg shadow-yellow-900/20 hover:scale-105 active:scale-95 transition-all">Send Proposal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 border-b border-slate-50 pb-4">Audit Trail</h4>
                        <div class="space-y-8 relative">
                            <div class="absolute left-[15px] top-2 bottom-2 w-px bg-slate-50"></div>
                            @foreach($appointment->statusHistories as $history)
                                <div class="relative flex items-start gap-6 group">
                                    <div class="w-8 h-8 rounded-full bg-white border-2 {{ $loop->first ? 'border-primary' : 'border-slate-100' }} flex items-center justify-center relative z-10">
                                        <div class="w-1.5 h-1.5 rounded-full {{ $loop->first ? 'bg-primary' : 'bg-slate-200' }}"></div>
                                    </div>
                                    <div class="flex-1 pt-0.5">
                                        <div class="flex flex-col mb-1">
                                            <h5 class="text-xs font-black text-slate-900 uppercase tracking-tight">{{ str_replace('_', ' ', $history->status) }}</h5>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ $history->created_at->format('M j, g:i A') }}</span>
                                        </div>
                                        @if($history->comment)
                                            <p class="text-[10px] font-bold text-slate-500 italic mt-1 bg-slate-50/50 p-2 rounded-lg leading-relaxed">{{ $history->comment }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
