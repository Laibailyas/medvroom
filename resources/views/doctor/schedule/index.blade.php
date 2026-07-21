<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter text-slate-900">Weekly Schedule</h1>
                <p class="text-slate-500 font-bold mt-1 uppercase tracking-widest text-[10px]">Define your standard clinical availability and consultation rates.</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" form="schedule-form" class="px-8 py-4 bg-primary text-slate-900 rounded-[1.5rem] font-black text-sm hover:scale-105 transition-all shadow-xl shadow-primary/20 ">
                    Save Changes
                </button>
            </div>
        </div>

        <form id="schedule-form" action="{{ route('doctor.schedule.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Consultation Fee Card -->
            <div class="bg-slate-900 rounded-[2.5rem] p-8 md:p-12 text-white shadow-2xl shadow-slate-900/10">
                <div class="max-w-2xl">
                    <h2 class="text-2xl font-black tracking-tighter mb-2">Practice Economics</h2>
                    <p class="text-slate-500 font-bold text-sm mb-8 leading-relaxed ">Set your base consultation fee. This amount will be displayed to patients during the booking process.</p>
                    
                    <div class="relative group max-w-xs">
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-500 font-black text-xl group-focus-within:text-primary transition-colors">$</div>
                        <input 
                            type="number" 
                            name="consultation_fee" 
                            step="0.01" 
                            value="{{ old('consultation_fee', Auth::user()->doctorProfile->consultation_fee) }}"
                            class="w-full bg-slate-800/50 border-2 border-slate-700 rounded-2xl py-5 pl-12 pr-6 text-xl font-black tracking-tighter text-white focus:border-primary focus:ring-0 transition-all placeholder:text-slate-700"
                            placeholder="0.00"
                        >
                    </div>
                </div>
            </div>

            <!-- Weekly Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($days as $index => $dayName)
                    @php
                        $daySchedule = $schedules->get($index);
                        $isEnabled = (bool) $daySchedule;
                    @endphp
                    <div 
                        x-data="{ enabled: {{ $isEnabled ? 'true' : 'false' }} }"
                        class="bg-white rounded-[2rem] border border-slate-100 p-8 shadow-sm transition-all duration-500 group overflow-hidden relative"
                        :class="enabled ? 'ring-2 ring-primary bg-white' : 'bg-slate-50/50 opacity-80'"
                    >
                        <!-- Day Header -->
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-4">
                                <div 
                                    class="w-12 h-12 rounded-xl flex items-center justify-center font-black transition-colors"
                                    :class="enabled ? 'bg-primary text-slate-900' : 'bg-white border border-slate-200 text-slate-400'"
                                >
                                    {{ substr($dayName, 0, 1) }}
                                </div>
                                <div>
                                    <h3 class="text-xl font-black tracking-tighter" :class="enabled ? 'text-slate-900' : 'text-slate-400'">{{ $dayName }}</h3>
                                    <p class="text-[10px] font-black uppercase tracking-widest" :class="enabled ? 'text-primary' : 'text-slate-400'">
                                        <span x-show="enabled">Active Workspace</span>
                                        <span x-show="!enabled">Day Off</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Toggle Switch -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="schedules[{{ $index }}][enabled]" x-model="enabled" value="1" class="sr-only peer">
                                <div class="w-14 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                        </div>

                        <!-- Time Controls -->
                        <div x-show="enabled" x-collapse x-cloak class="grid grid-cols-2 gap-4">
                            <!-- Start Time -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Opens At</label>
                                <input 
                                    type="time" 
                                    name="schedules[{{ $index }}][start_time]" 
                                    value="{{ old("schedules.$index.start_time", $daySchedule?->start_time ? date('H:i', strtotime($daySchedule->start_time)) : '09:00') }}"
                                    class="w-full bg-slate-50 border-0 rounded-2xl p-4 text-sm font-black tracking-tight text-slate-900 focus:ring-2 focus:ring-primary h-14"
                                >
                            </div>
                            <!-- End Time -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1">Closes At</label>
                                <input 
                                    type="time" 
                                    name="schedules[{{ $index }}][end_time]" 
                                    value="{{ old("schedules.$index.end_time", $daySchedule?->end_time ? date('H:i', strtotime($daySchedule->end_time)) : '17:00') }}"
                                    class="w-full bg-slate-50 border-0 rounded-2xl p-4 text-sm font-black tracking-tight text-slate-900 focus:ring-2 focus:ring-primary h-14"
                                >
                            </div>
                            <!-- Slot Duration -->
                            <div class="col-span-2 mt-4">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-1 mb-2 block">Slot Intensity (Minutes)</label>
                                <div class="flex items-center gap-3">
                                    @foreach([15, 30, 45, 60] as $mins)
                                        <label class="flex-1">
                                            <input 
                                                type="radio" 
                                                name="schedules[{{ $index }}][slot_duration_minutes]" 
                                                value="{{ $mins }}" 
                                                {{ (old("schedules.$index.slot_duration_minutes", $daySchedule?->slot_duration_minutes ?? 30) == $mins) ? 'checked' : '' }}
                                                class="sr-only peer"
                                            >
                                            <div class="text-center py-3 rounded-xl bg-slate-50 border-2 border-transparent peer-checked:border-primary peer-checked:bg-white text-xs font-black text-slate-400 peer-checked:text-slate-900 transition-all cursor-pointer">
                                                {{ $mins }}m
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Empty State Icon -->
                        <div x-show="!enabled" class="flex items-center justify-center py-8">
                            <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
</x-doctor-layout>
