<x-app-layout>
    <div class="bg-slate-50 min-h-screen pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            
            <div class="flex items-center gap-4 mb-10">
                <a href="{{ route('patient.appointments.show', $appointment) }}"
                    class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-100 text-slate-400 hover:text-slate-900 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Reschedule Appointment</h1>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Dr. {{ $doctor->user->name }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Current Time & Info -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Current Time</h4>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <p class="text-lg font-black text-slate-900">{{ $appointment->appointment_datetime->format('M d, Y') }}</p>
                            <p class="text-sm font-bold text-slate-500 italic">{{ $appointment->appointment_datetime->format('h:i A') }}</p>
                        </div>
                        <div class="mt-6 flex items-start gap-3 p-4 bg-primary/5 rounded-2xl border border-primary/10">
                            <svg class="w-5 h-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-[10px] font-bold text-slate-600 leading-relaxed italic uppercase">Select a new time below to update your visit instantly.</p>
                        </div>
                    </div>

                    <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl shadow-slate-900/20">
                        <h3 class="text-white text-lg font-black italic tracking-tight mb-4">24-Hour Policy</h3>
                        <p class="text-xs font-bold text-white/50 leading-relaxed">You can reschedule this appointment freely until 24 hours before the visit. After that, please contact the office directly.</p>
                    </div>
                </div>

                <!-- Right Column: Availability Picker -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-[2.5rem] p-8 md:p-10 shadow-sm border border-slate-100" 
                         x-data="{ 
                            selectedDate: null, 
                            selectedTime: null,
                            loading: false
                         }">
                        
                        <h3 class="text-xl font-black text-slate-900 tracking-tight mb-8 italic uppercase">Choose a New Time</h3>

                        <div class="space-y-10">
                            @foreach($availability as $date => $slots)
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest">{{ \Carbon\Carbon::parse($date)->format('l, M j') }}</h4>
                                        @if(count($slots) > 3)
                                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ count($slots) }} slots</span>
                                        @endif
                                    </div>
                                    
                                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                                        @forelse($slots as $slot)
                                            <button 
                                                type="button"
                                                @click="selectedDate = '{{ $date }}'; selectedTime = '{{ $slot }}'"
                                                :class="selectedDate === '{{ $date }}' && selectedTime === '{{ $slot }}' ? 'bg-primary border-primary text-slate-900 scale-105 shadow-lg shadow-primary/20' : 'bg-slate-50 border-slate-50 text-slate-600 hover:bg-slate-100' "
                                                class="py-3 px-1 rounded-xl border-2 text-[11px] font-black transition-all duration-300">
                                                {{ $slot }}
                                            </button>
                                        @empty
                                            <div class="col-span-full py-4 bg-slate-50/50 rounded-2xl border-2 border-dashed border-slate-100 text-center">
                                                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">No slots available</span>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <div class="h-px bg-slate-50"></div>
                                @endif
                            @endforeach

                            <form action="{{ route('patient.appointments.update-reschedule', $appointment) }}" method="POST" @submit="loading = true">
                                @csrf
                                <input type="hidden" name="date" :value="selectedDate">
                                <input type="hidden" name="time" :value="selectedTime">

                                <div class="pt-10">
                                    <button 
                                        type="submit"
                                        :disabled="!selectedTime || loading"
                                        :class="!selectedTime ? 'opacity-50 grayscale cursor-not-allowed' : 'hover:scale-[1.02] active:scale-95 shadow-2xl shadow-slate-900/20'"
                                        class="w-full bg-slate-900 text-white py-6 rounded-[1.5rem] font-black uppercase tracking-[0.25em] transition-all flex items-center justify-center gap-4 relative overflow-hidden group">
                                        <div class="absolute inset-0 bg-primary transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                                        <span class="relative z-10 group-hover:text-slate-900" x-text="loading ? 'Rescheduling...' : 'Confirm New Time'"></span>
                                        <svg x-show="!loading" class="w-4 h-4 text-primary group-hover:text-slate-900 relative z-10 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
