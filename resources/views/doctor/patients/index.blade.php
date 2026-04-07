<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter italic text-slate-900">Patient Directory</h1>
                <p class="text-slate-500 font-bold mt-1 uppercase tracking-widest text-[10px]">A centralized list of all individuals you have provided clinical care to.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative group">
                    <input type="text" placeholder="Search patients..." class="bg-white border-slate-200 rounded-2xl py-3 pl-12 pr-6 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm w-64 md:w-80">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2 group-focus-within:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>
        </div>

        <!-- Patient List Card -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 italic">Patient Profile</th>
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 italic">Contact Info</th>
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 italic">Clinical Records</th>
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 italic text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($patients as $patient)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-5">
                                        <div class="w-12 h-12 rounded-[1.25rem] overflow-hidden bg-slate-100 border-2 border-white shadow-sm shrink-0">
                                            <img src="{{ $patient->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-black text-slate-900 italic tracking-tight text-base">{{ $patient->user->name }}</p>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 italic">DOB:</span>
                                                <span class="text-[11px] font-bold text-slate-500">{{ $patient->date_of_birth?->format('M d, Y') ?? 'Not Provided' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="space-y-1">
                                        <p class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            {{ $patient->user->email }}
                                        </p>
                                        <p class="text-xs font-bold text-slate-400 flex items-center gap-2 uppercase tracking-wide">
                                            <svg class="w-4 h-4 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                            {{ $patient->user->mobile ?? 'N/A' }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="px-4 py-2 bg-slate-900/5 rounded-xl border border-slate-900/5 text-center min-w-[70px]">
                                            <p class="text-[10px] font-black uppercase text-slate-400 italic">Total</p>
                                            <p class="text-base font-black italic tracking-tighter text-slate-800 leading-none mt-1">{{ $patient->appointments_count }}</p>
                                        </div>
                                        <p class="text-xs font-bold text-slate-400 italic leading-tight">Visits with<br>Practice</p>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity translate-x-4 group-hover:translate-x-0 transition-all duration-300">
                                        <a href="{{ route('doctor.patients.show', $patient) }}" class="px-6 py-3 bg-white border border-slate-200 text-slate-900 rounded-2xl font-black text-xs hover:bg-slate-900 hover:text-white transition-all shadow-sm italic uppercase tracking-widest">
                                            Open Records
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-24 text-center">
                                    <div class="w-24 h-24 bg-slate-50 rounded-[3rem] flex items-center justify-center text-slate-300 mx-auto mb-8 animate-bounce-slow">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    </div>
                                    <h3 class="text-2xl font-black italic tracking-tighter text-slate-400">No Patient Records Yet</h3>
                                    <p class="text-sm font-bold text-slate-300 mt-2">Patients will appear here after their first booking request.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($patients->hasPages())
                <div class="px-8 py-6 border-t border-slate-50 bg-slate-50/50">
                    {{ $patients->links() }}
                </div>
            @endif
        </div>
    </div>
</x-doctor-layout>
