<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex items-center gap-6">
                <a href="{{ route('doctor.patients.index') }}" class="w-12 h-12 bg-white border-slate-200 rounded-2xl flex items-center justify-center text-slate-400 hover:text-slate-900 transition-colors shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-4xl font-black tracking-tighter text-slate-900">Clinical History</h1>
                    <p class="text-slate-500 font-bold mt-1 uppercase tracking-widest text-[10px]">Reference Profile for {{ $patient->user->name }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('messages.index') }}" class="px-8 py-3.5 bg-slate-100 text-slate-900 rounded-2xl font-black text-xs hover:bg-slate-200 transition-all uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Send Message
                </a>
                <button class="px-8 py-3.5 bg-primary text-slate-900 rounded-2xl font-black text-xs hover:scale-105 transition-all shadow-xl shadow-primary/20 uppercase tracking-widest">
                    Create New Note
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Patient Profile & Statistics -->
            <div class="space-y-8">
                <!-- Patient Info Card -->
                <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-slate-900/10 text-center">
                    <div class="w-28 h-28 rounded-[2.75rem] overflow-hidden bg-slate-800 border-4 border-slate-800 shadow-2xl mx-auto mb-8 relative">
                        <img src="{{ $patient->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-3xl font-black tracking-tighter leading-tight">{{ $patient->user->name }}</h2>
                    <p class="text-[11px] font-black text-slate-500 uppercase tracking-widest mt-2">Member Since {{ $patient->user->created_at->format('M Y') }}</p>
                    
                    <div class="grid grid-cols-2 gap-4 mt-10">
                        <div class="bg-slate-800/50 p-5 rounded-2xl border border-white/5">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2">Biological Gender</p>
                            <p class="text-xs font-black tracking-tighter">{{ ucfirst($patient->gender) ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-slate-800/50 p-5 rounded-2xl border border-white/5">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-2">Age Records</p>
                            <p class="text-xs font-black tracking-tighter">{{ $patient->date_of_birth?->age ?? 'N/A' }} Years</p>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-white/5 flex items-center justify-between">
                        <div class="text-left">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-1">Last Interaction</p>
                            <p class="text-xs font-black tracking-tighter text-slate-300">
                                {{ $appointments->first()?->appointment_datetime->format('M d, Y') ?? 'Never' }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mb-1">Phone</p>
                            <p class="text-xs font-black tracking-tighter text-slate-300">{{ $patient->user->mobile ?? 'Hidden' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Insurance Context -->
                <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
                    <h2 class="text-xl font-black tracking-tighter mb-6">Verified Insurance</h2>
                    <div class="space-y-4">
                        @forelse($patient->insurancePlans as $plan)
                            <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 group transition-all duration-300">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ $plan->provider->name }}</p>
                                <p class="text-sm font-black tracking-tight text-slate-900">{{ $plan->name }}</p>
                                <div class="mt-4 flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                    <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest ">Coverage Active</span>
                                </div>
                            </div>
                        @empty
                            <div class="p-8 text-center bg-slate-50 rounded-2xl border-2 border-dashed border-slate-100">
                                <p class="text-xs font-bold text-slate-400 ">No insurance information on file.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Right Column: Encounter History -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-black tracking-tighter text-slate-900">Encounter Records</h2>
                            <p class="text-xs font-bold text-slate-400 mt-1">Timeline of clinical visits with your practice.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-4 py-2 bg-slate-100 rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-500">
                                {{ count($appointments) }} Total Encounters
                            </span>
                        </div>
                    </div>

                    <div class="flex-1">
                        @foreach($appointments as $appointment)
                            <div class="p-8 md:p-10 flex flex-col md:flex-row md:items-start gap-8 group hover:bg-slate-50/50 transition-colors border-b border-slate-50 last:border-0">
                                <div class="md:w-32 shrink-0">
                                    <div class="p-4 bg-slate-900 rounded-2xl text-center shadow-lg shadow-slate-900/10 transition-transform group-hover:scale-105">
                                        <p class="text-white font-black tracking-tighter text-base">{{ $appointment->appointment_datetime->format('M d') }}</p>
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-500 mt-0.5">{{ $appointment->appointment_datetime->format('Y') }}</p>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <span class="text-[9px] font-black uppercase tracking-widest px-2 py-1 bg-slate-100 rounded-full text-slate-400">
                                            {{ $appointment->appointment_datetime->format('g:i A') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-1 space-y-6">
                                    <div>
                                        <div class="flex items-center gap-3 mb-2">
                                            @php
                                                $statusColor = match($appointment->status) {
                                                    'completed' => 'text-blue-600 bg-blue-50',
                                                    'confirmed' => 'text-emerald-600 bg-emerald-50',
                                                    'cancelled' => 'text-slate-400 bg-slate-100',
                                                    default => 'text-slate-400 bg-slate-100'
                                                };
                                            @endphp
                                            <span class="text-[9px] font-black uppercase tracking-[0.15em] px-3 py-1 rounded-full {{ $statusColor }}">
                                                {{ $appointment->status }}
                                            </span>
                                        </div>
                                        <h4 class="text-lg font-black text-slate-900 tracking-tighter">{{ $appointment->notes ?: 'Follow-up clinical encounter.' }}</h4>
                                    </div>

                                    @if($appointment->review)
                                        <div class="p-6 bg-amber-50/50 rounded-2xl border border-amber-100/50 relative">
                                            <div class="flex items-center gap-1 mb-2">
                                                @for($i = 0; $i < 5; $i++)
                                                    <svg class="w-3 h-3 {{ $i < $appointment->review->rating ? 'text-amber-400 fill-current' : 'text-slate-200' }}" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.787 1.4 8.168L12 18.896l-7.334 3.869 1.4-8.168-5.934-5.787 8.2-1.192L12 .587z"/></svg>
                                                @endfor
                                            </div>
                                            <p class="text-xs font-bold text-amber-700 leading-relaxed">“{{ $appointment->review->comment }}”</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="shrink-0 flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('doctor.appointments.show', $appointment) }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-900 rounded-2xl font-black text-xs hover:bg-slate-900 hover:text-white transition-all shadow-sm uppercase tracking-widest">
                                        Open Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-doctor-layout>
