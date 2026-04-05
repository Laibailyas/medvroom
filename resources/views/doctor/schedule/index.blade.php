<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Weekly Schedule Settings') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <a href="{{ route('doctor.dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-primary transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Dashboard
            </a>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 max-w-4xl">
            <div class="mb-8">
                <h3 class="text-xl font-bold text-slate-900">Manage Your Availability</h3>
                <p class="text-sm text-slate-500 mt-1">Select the days you are available for appointments and define your working hours. Days left unchecked will show as "NO APPTS" to patients.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl text-sm font-bold border border-green-100 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-xl text-sm font-bold border border-red-100">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('doctor.schedule.store') }}" method="POST">
                @csrf

                <div class="mb-8 p-6 bg-slate-50/50 rounded-2xl border border-slate-100">
                    <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4">Consultation Fee</h4>
                    <div class="flex items-center gap-4">
                        <div class="relative w-48">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-bold">$</span>
                            <input type="number" name="consultation_fee" step="0.01" value="{{ old('consultation_fee', auth()->user()->doctorProfile->consultation_fee ?? 150) }}" class="w-full bg-white border-slate-200 rounded-xl pl-8 pr-4 py-3 text-sm font-bold text-slate-900 focus:border-primary focus:ring-0">
                        </div>
                        <span class="text-sm font-bold text-slate-500">per session</span>
                    </div>
                </div>

                <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-4">Availability</h4>
                <div class="space-y-4">
                    @foreach($days as $dayIndex => $dayName)
                        @php
                            $schedule = $schedules->get($dayIndex);
                            $isEnabled = $schedule ? true : false;
                        @endphp
                        
                        <div x-data="{ enabled: {{ $isEnabled ? 'true' : 'false' }} }" 
                             class="flex flex-col md:flex-row md:items-center gap-4 p-4 rounded-2xl border transition-colors"
                             :class="enabled ? 'border-primary/30 bg-primary/5' : 'border-slate-100 bg-slate-50/50'">
                            
                            <!-- Checkbox and Day -->
                            <div class="flex items-center gap-3 md:w-48">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="schedules[{{ $dayIndex }}][enabled]" value="1" class="sr-only peer" x-model="enabled">
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                </label>
                                <span class="font-bold whitespace-nowrap" :class="enabled ? 'text-slate-900' : 'text-slate-400'">{{ $dayName }}</span>
                            </div>

                            <!-- Time Selection -->
                            <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-4" x-show="enabled" x-collapse>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Start Time</label>
                                    <input type="time" name="schedules[{{ $dayIndex }}][start_time]" 
                                           value="{{ old('schedules.'.$dayIndex.'.start_time', $schedule ? \Carbon\Carbon::parse($schedule->start_time)->format('H:i') : '09:00') }}"
                                           class="w-full bg-white border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:border-primary focus:ring-0">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">End Time</label>
                                    <input type="time" name="schedules[{{ $dayIndex }}][end_time]" 
                                           value="{{ old('schedules.'.$dayIndex.'.end_time', $schedule ? \Carbon\Carbon::parse($schedule->end_time)->format('H:i') : '17:00') }}"
                                           class="w-full bg-white border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:border-primary focus:ring-0">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Duration (min)</label>
                                    <select name="schedules[{{ $dayIndex }}][slot_duration_minutes]" class="w-full bg-white border-slate-200 rounded-xl text-sm font-bold text-slate-700 focus:border-primary focus:ring-0">
                                        @foreach([15, 30, 45, 60] as $duration)
                                            <option value="{{ $duration }}" {{ old('schedules.'.$dayIndex.'.slot_duration_minutes', $schedule->slot_duration_minutes ?? 30) == $duration ? 'selected' : '' }}>
                                                {{ $duration }} mins
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="flex-1 text-sm font-bold text-slate-400 hidden md:block" x-show="!enabled">
                                Unavailable
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-primary hover:bg-primary-hover text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-primary/20 transition-all active:scale-95">
                        Save Schedule
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
