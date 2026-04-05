<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Appointments') }}
        </h2>
    </x-slot>

    <div class="bg-slate-50 min-h-screen pb-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Appointments</h1>
                    <p class="text-sm font-bold text-slate-500 mt-1">Manage your appointment requests and schedule.</p>
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

            <!-- Tabs -->
            <div class="flex space-x-2 bg-slate-200/50 p-1.5 rounded-2xl mb-8 w-fit">
                <a href="{{ route('doctor.appointments.index', ['tab' => 'requests']) }}" 
                   class="px-5 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all {{ $tab === 'requests' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200/50' }}">
                    Action Required
                </a>
                <a href="{{ route('doctor.appointments.index', ['tab' => 'upcoming']) }}" 
                   class="px-5 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all {{ $tab === 'upcoming' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200/50' }}">
                    Upcoming
                </a>
                <a href="{{ route('doctor.appointments.index', ['tab' => 'past']) }}" 
                   class="px-5 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-widest transition-all {{ $tab === 'past' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200/50' }}">
                    Past & Cancelled
                </a>
            </div>

            <!-- Appointments List -->
            @if($appointments->isEmpty())
                <div class="bg-white rounded-[2.5rem] p-16 text-center border border-slate-100 shadow-sm">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-2">No {{ $tab }} appointments</h3>
                    <p class="text-sm font-bold text-slate-400">You're all caught up for now.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($appointments as $appointment)
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-6 transition hover:shadow-md">
                            
                            <div class="flex items-center gap-6">
                                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center overflow-hidden border border-slate-100 shrink-0">
                                    @if($appointment->patientProfile->user->getProfilePhotoUrl())
                                        <img src="{{ $appointment->patientProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-2xl font-black text-slate-300">{{ substr($appointment->patientProfile->user->first_name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('doctor.patients.show', $appointment->patientProfile) }}" class="text-lg font-black text-slate-900 hover:text-primary transition">{{ $appointment->patientProfile->user->name }}</a>
                                    
                                    <div class="flex items-center gap-3 mt-1 text-sm font-bold text-slate-500">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ $appointment->appointment_datetime->format('M d, Y') }}
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $appointment->appointment_datetime->format('g:i A') }}
                                        </div>
                                    </div>
                                    @if($appointment->notes)
                                        <p class="text-xs font-bold text-slate-400 mt-2 italic flex items-start gap-1">
                                            <svg class="w-3.5 h-3.5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            "{{ Str::limit($appointment->notes, 60) }}"
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col items-end gap-3" x-data="{ showReject: false, showReschedule: false }">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border 
                                    @if($appointment->status === 'confirmed') bg-green-50/50 text-green-600 border-green-200
                                    @elseif($appointment->status === 'pending') bg-yellow-50/50 text-yellow-600 border-yellow-200
                                    @elseif($appointment->status === 'reschedule_requested') bg-purple-50/50 text-purple-600 border-purple-200
                                    @elseif($appointment->status === 'cancelled' || $appointment->status === 'rejected') bg-red-50/50 text-red-600 border-red-200
                                    @elseif($appointment->status === 'completed') bg-blue-50/50 text-blue-600 border-blue-200
                                    @else bg-slate-50 text-slate-500 border-slate-200 @endif">
                                    {{ str_replace('_', ' ', $appointment->status) }}
                                </span>

                                <!-- Actions -->
                                <div class="flex flex-wrap gap-2 md:w-48 shrink-0 md:justify-end">
                                    <a href="{{ route('doctor.appointments.show', $appointment) }}" class="w-full px-3 py-2 text-[10px] font-black uppercase tracking-wider bg-slate-100 text-slate-600 rounded-xl shadow-sm hover:bg-slate-200 transition-colors text-center border border-slate-200">View Details</a>
                                    @if($appointment->status !== 'pending' && $appointment->conversation())
                                        <a href="{{ route('messages.index', $appointment->conversation()) }}" class="w-full px-3 py-2 text-[10px] font-black uppercase tracking-wider bg-slate-900 text-white rounded-xl shadow-sm hover:bg-slate-800 transition-colors text-center">Open Messenger</a>
                                    @endif
                                    
                                    @if( ($tab === 'requests' && in_array($appointment->status, ['pending', 'reschedule_requested'])) || ($tab === 'upcoming' && $appointment->status === 'confirmed') )
                                    <div class="flex items-center gap-2">
                                        @if($tab === 'requests')
                                            <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="px-3 py-2 text-xs font-black uppercase tracking-wider bg-green-500 text-white rounded-lg shadow-sm hover:bg-green-600 transition-colors">Accept</button>
                                            </form>
                                        @else
                                            <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="px-3 py-2 text-xs font-black uppercase tracking-wider bg-blue-500 text-white rounded-lg shadow-sm hover:bg-blue-600 transition-colors">Complete</button>
                                            </form>
                                        @endif
                                        
                                        <button @click="showReschedule = true" class="px-3 py-2 text-xs font-black uppercase tracking-wider bg-slate-100 text-slate-600 rounded-lg shadow-sm hover:bg-slate-200 transition-colors">Reschedule</button>
                                        
                                        <button @click="showReject = true" class="px-3 py-2 text-xs font-black uppercase tracking-wider bg-red-50 text-red-600 rounded-lg shadow-sm hover:bg-red-100 transition-colors">{{ $tab === 'upcoming' ? 'Cancel' : 'Reject' }}</button>
                                    </div>

                                    <!-- Reject/Cancel Modal inline -->
                                    <div x-show="showReject" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                                        <div @click.away="showReject = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                            <h3 class="font-black text-xl mb-4 text-slate-900 tracking-tight">{{ $tab === 'upcoming' ? 'Cancel Appointment' : 'Reject Appointment' }}</h3>
                                            <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="cancelled">
                                                <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:border-red-500 focus:ring-red-500" placeholder="{{ $tab === 'upcoming' ? 'Reason for cancellation...' : 'Reason for rejection...' }}"></textarea>
                                                <div class="flex justify-end gap-3 mt-2">
                                                    <button type="button" @click="showReject = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Go Back</button>
                                                    <button type="submit" class="px-5 py-2.5 text-sm font-bold bg-red-600 text-white rounded-xl shadow-lg shadow-red-600/20 hover:bg-red-700 transition-colors">Confirm {{ $tab === 'upcoming' ? 'Cancel' : 'Reject' }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Reschedule Modal inline -->
                                    <div x-show="showReschedule" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                                        <div @click.away="showReschedule = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                            <h3 class="font-black text-xl mb-4 text-slate-900 tracking-tight">Propose Reschedule</h3>
                                            <form action="{{ route('doctor.appointments.reschedule', $appointment) }}" method="POST">
                                                @csrf
                                                <div class="mb-4 text-left">
                                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">New Date & Time</label>
                                                    <input type="datetime-local" name="new_datetime" required class="w-full rounded-xl border-slate-200 text-sm font-bold focus:border-primary focus:ring-primary shadow-sm" value="{{ $appointment->appointment_datetime->format('Y-m-d\TH:i') }}">
                                                </div>
                                                <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:border-primary focus:ring-primary shadow-sm" placeholder="Please provide a message to the patient..."></textarea>
                                                <div class="flex justify-end gap-3 mt-2">
                                                    <button type="button" @click="showReschedule = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Cancel</button>
                                                    <button type="submit" class="px-5 py-2.5 text-sm font-black text-slate-900 bg-primary rounded-xl shadow-lg shadow-yellow-900/20 hover:scale-105 active:scale-95 transition-all">Send Request</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $appointments->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
