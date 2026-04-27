<x-admin-layout>
    <x-slot name="header">
        Appointment Details: #{{ $appointment->id }}
    </x-slot>

    <div class="max-w-5xl mx-auto pb-12">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.appointments.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Tracker
            </a>
            
            @php
                $statusClasses = [
                    'pending' => 'bg-amber-100 text-amber-800',
                    'confirmed' => 'bg-blue-100 text-blue-800',
                    'cancelled' => 'bg-rose-100 text-rose-800',
                    'completed' => 'bg-emerald-100 text-emerald-800',
                ][$appointment->status] ?? 'bg-slate-100 text-slate-800';
            @endphp
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $statusClasses }} shadow-sm">
                    Current Status: {{ $appointment->status }}
                </span>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Core Info Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest">Appointment Summary</h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Schedule</p>
                                <p class="text-lg font-black text-slate-900 leading-none mb-1">{{ $appointment->appointment_datetime->format('F d, Y') }}</p>
                                <p class="text-sm font-bold text-indigo-600">{{ $appointment->appointment_datetime->format('h:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Reason for Visit</p>
                                <p class="text-sm font-semibold text-slate-800 leading-relaxed">{{ $appointment->reason_for_visit ?: 'General Consultation' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Entity Info (Patient/Doctor) -->
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Patient -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Patient Identity</p>
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-sm shadow-inner shrink-0">
                                {{ substr($appointment->patientProfile->user->name, 0, 1) }}
                            </div>
                            <div class="ml-4 overflow-hidden">
                                <p class="text-sm font-black text-slate-900 truncate">{{ $appointment->patientProfile->user->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $appointment->patientProfile->user->email }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Doctor -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 line-clamp-1">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-4">Healthcare Provider</p>
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm shadow-inner shrink-0">
                                PR
                            </div>
                            <div class="ml-4 overflow-hidden">
                                <p class="text-sm font-black text-slate-900 truncate">Provider {{ $appointment->doctorProfile->user->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ $appointment->doctorProfile->clinic_name ?: 'Specialist' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Audit Log (Status History) -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest">Encounter Timeline</h2>
                        <span class="px-2 py-0.5 rounded bg-slate-100 text-[10px] font-black text-slate-500">{{ $appointment->statusHistories->count() }} EVENTS</span>
                    </div>
                    <div class="p-8">
                        <div class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:h-full before:w-0.5 before:bg-slate-100 before:content-['']">
                            @foreach($appointment->statusHistories as $event)
                                <div class="relative flex items-start group">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border-4 border-white bg-indigo-50 text-indigo-600 shadow-sm z-10 transition-transform group-hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                    </div>
                                    <div class="ml-6">
                                        <div class="flex items-center space-x-2 mb-1">
                                            <span class="text-xs font-black uppercase tracking-widest text-slate-900">{{ $event->status }}</span>
                                            <span class="text-[10px] font-bold text-slate-400">&bull; {{ $event->created_at->format('M d, H:i A') }}</span>
                                        </div>
                                        <p class="text-sm text-slate-600 leading-relaxed italic mb-1">"{{ $event->notes ?: 'No clinical notes provided.' }}"</p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Updated by: {{ $event->changedBy->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Administrative Actions -->
            <div class="space-y-8">
                <div class="bg-slate-900 rounded-2xl p-8 text-white shadow-xl shadow-slate-200/50">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] mb-6 text-slate-400">Control Panel</h3>
                    
                    <form action="{{ route('admin.appointments.transition', $appointment) }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="status" class="block text-xs font-black uppercase tracking-widest mb-2 opacity-60">Transition To</label>
                            <select 
                                name="status" 
                                id="status" 
                                class="w-full bg-slate-800 border-none rounded-xl py-3 px-4 text-sm font-bold focus:ring-2 focus:ring-indigo-500 transition-all text-white cursor-pointer"
                            >
                                <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Mark as Pending</option>
                                <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirm Appointment</option>
                                <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Administrative Cancel</option>
                                <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Mark as Completed</option>
                            </select>
                        </div>

                        <div>
                            <label for="comment" class="block text-xs font-black uppercase tracking-widest mb-2 opacity-60">Status Note</label>
                            <textarea 
                                name="comment" 
                                id="comment" 
                                rows="3" 
                                placeholder="Log the reason for this transition..."
                                class="w-full bg-slate-800 border-none rounded-xl py-3 px-4 text-sm font-medium focus:ring-2 focus:ring-indigo-500 transition-all text-slate-300 resize-none"
                            ></textarea>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full bg-indigo-500 hover:bg-indigo-600 active:scale-[0.98] transition-all py-3 rounded-xl text-sm font-black uppercase tracking-widest shadow-lg shadow-indigo-500/30"
                        >
                            Update Encounter
                        </button>
                    </form>
                </div>

                <!-- Caution Zone -->
                <div class="bg-rose-50 border border-rose-100 rounded-2xl p-6">
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-rose-800 mb-2">Caution Zone</h3>
                    <p class="text-xs text-rose-600 leading-relaxed mb-4 font-medium">Removing an appointment will also eliminate it from the provider's active calendar. Consider cancelling instead for data integrity.</p>
                    <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('ADMIN WARNING: Permanent deletion cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 border border-rose-200 text-rose-600 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-rose-100 transition-colors">
                            Permanently Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
