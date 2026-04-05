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
                {{ __('Patient Profile') }}
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

            @if(session('error'))
                <div class="mb-8 bg-red-50 border border-red-100 text-red-600 p-4 rounded-2xl text-sm font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Sidebar: Profile Details -->
                <div class="space-y-6">
                    
                    <!-- Patient ID Card -->
                    <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm text-center">
                        <div class="w-32 h-32 mx-auto rounded-full bg-slate-50 border-4 border-white shadow-lg flex items-center justify-center overflow-hidden mb-6">
                            @if($patient->user->getProfilePhotoUrl())
                                <img src="{{ $patient->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-5xl font-black text-slate-200">{{ substr($patient->user->first_name, 0, 1) }}</span>
                            @endif
                        </div>
                        <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ $patient->user->name }}</h1>
                        <p class="text-sm font-bold text-slate-400 mt-1 uppercase tracking-widest">
                            @if($patient->date_of_birth)
                                {{ $patient->date_of_birth->age }} years old
                            @else
                                Age not specified
                            @endif
                            •
                            {{ ucfirst($patient->sex ?? 'Unspecified') }}
                        </p>

                        <div class="mt-8 space-y-4 text-left">
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center flex-shrink-0 text-slate-400 border border-slate-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <span class="font-bold truncate" title="{{ $patient->user->email }}">{{ $patient->user->email }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-slate-600">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center flex-shrink-0 text-slate-400 border border-slate-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <span class="font-bold">{{ $patient->user->phone ?? 'No phone number' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Medical Notes -->
                    <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Medical Notes</h3>
                        @if($patient->medical_notes)
                            <p class="text-sm text-slate-700 leading-relaxed font-medium">
                                {{ $patient->medical_notes }}
                            </p>
                        @else
                            <p class="text-sm text-slate-400 italic">No special medical notes provided by patient.</p>
                        @endif
                    </div>

                    <!-- Insurance Information -->
                    <div class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Insurance Directory</h3>
                        @if($patient->insurancePlans->isEmpty())
                            <p class="text-sm text-slate-400 italic">No insurance information on file.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($patient->insurancePlans as $plan)
                                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl">
                                        <div class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">{{ $plan->plan_type }}</div>
                                        <div class="font-bold text-slate-900 text-sm">{{ $plan->provider->name }}</div>
                                        <div class="text-xs text-slate-500 font-medium truncate">{{ $plan->name }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Column: Appointment History -->
                <div class="lg:col-span-2 space-y-6">
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight mb-6">Interaction History</h2>

                    @foreach($appointments as $appointment)
                        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 transition hover:shadow-md
                            {{ $appointment->status === 'reschedule_requested' ? 'border-purple-200 bg-purple-50/10' : '' }}
                            {{ in_array($appointment->status, ['cancelled', 'rejected']) ? 'opacity-70 bg-slate-50' : '' }}" x-data="{ showReject: false, showReschedule: false }">
                            
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                                
                                <div>
                                    <div class="flex items-center gap-3 mb-2">
                                        <span class="px-2.5 py-1 rounded-md text-[9px] font-black uppercase tracking-widest
                                            @if($appointment->status === 'confirmed') bg-green-100 text-green-700
                                            @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-700
                                            @elseif($appointment->status === 'reschedule_requested') bg-purple-100 text-purple-700
                                            @elseif($appointment->status === 'completed') bg-blue-100 text-blue-700
                                            @else bg-slate-200 text-slate-600 @endif">
                                            {{ str_replace('_', ' ', $appointment->status) }}
                                        </span>
                                        @if($appointment->appointment_datetime->isPast() && !in_array($appointment->status, ['cancelled', 'rejected', 'completed']))
                                            <span class="px-2.5 py-1 rounded-md text-[9px] font-black uppercase tracking-widest bg-red-50 text-red-600">
                                                Past Due
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center gap-4 mt-4 text-sm font-bold text-slate-700">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ $appointment->appointment_datetime->format('l, F j, Y') }}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4 mt-2 text-sm font-bold text-slate-700">
                                        <div class="flex items-center gap-1.5">
                                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $appointment->appointment_datetime->format('g:i A') }}
                                        </div>
                                    </div>

                                    @if($appointment->notes)
                                        <p class="text-xs font-bold text-slate-500 mt-4 italic border-l-2 border-slate-200 pl-3 py-1">
                                            "{{ $appointment->notes }}"
                                        </p>
                                    @endif
                                    
                                    @if($appointment->latestStatusHistory && $appointment->latestStatusHistory->comment)
                                        <div class="mt-4 bg-slate-50 p-3 rounded-xl border border-slate-100">
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-1">Status Update Note</span>
                                            <p class="text-xs font-bold text-slate-600">
                                                {{ $appointment->latestStatusHistory->comment }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex flex-wrap gap-2 md:w-48 shrink-0 md:justify-end">
                                    @if(in_array($appointment->status, ['pending', 'reschedule_requested']))
                                        <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST" class="w-full">
                                            @csrf
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" class="w-full px-3 py-2 text-xs font-black uppercase tracking-wider bg-green-500 text-white rounded-xl shadow-sm hover:bg-green-600 transition-colors">Accept</button>
                                        </form>
                                    @elseif($appointment->status === 'confirmed' && $appointment->appointment_datetime->isPast())
                                        <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST" class="w-full">
                                            @csrf
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="w-full px-3 py-2 text-xs font-black uppercase tracking-wider bg-blue-500 text-white rounded-xl shadow-sm hover:bg-blue-600 transition-colors">Complete</button>
                                        </form>
                                    @elseif($appointment->status === 'confirmed')
                                        <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST" class="w-full">
                                            @csrf
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="w-full px-3 py-2 text-xs font-black uppercase tracking-wider bg-blue-500 text-white rounded-xl shadow-sm hover:bg-blue-600 transition-colors">Complete</button>
                                        </form>
                                    @endif
                                    
                                    @if(!in_array($appointment->status, ['cancelled', 'rejected', 'completed']) && $appointment->appointment_datetime->isFuture())
                                        <button @click="showReschedule = true" class="w-full px-3 py-2 text-xs font-black uppercase tracking-wider bg-slate-100 text-slate-600 rounded-xl shadow-sm hover:bg-slate-200 transition-colors">Reschedule</button>
                                        <button @click="showReject = true" class="w-full px-3 py-2 text-xs font-black uppercase tracking-wider bg-red-50 text-red-600 rounded-xl shadow-sm hover:bg-red-100 transition-colors">
                                            {{ $appointment->status === 'confirmed' ? 'Cancel' : 'Reject' }}
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <!-- Reject/Cancel Modal inline -->
                            <div x-show="showReject" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                                <div @click.away="showReject = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                    <h3 class="font-black text-xl mb-4 text-slate-900 tracking-tight">{{ $appointment->status === 'confirmed' ? 'Cancel Appointment' : 'Reject Appointment' }}</h3>
                                    <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="cancelled">
                                        <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:border-red-500 focus:ring-red-500" placeholder="{{ $appointment->status === 'confirmed' ? 'Reason for cancellation...' : 'Reason for rejection...' }}"></textarea>
                                        <div class="flex justify-end gap-3 mt-2">
                                            <button type="button" @click="showReject = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Go Back</button>
                                            <button type="submit" class="px-5 py-2.5 text-sm font-bold bg-red-600 text-white rounded-xl shadow-lg shadow-red-600/20 hover:bg-red-700 transition-colors">Confirm {{ $appointment->status === 'confirmed' ? 'Cancel' : 'Reject' }}</button>
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
                        </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
