<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter ">Appointment Manager</h1>
                <p class="text-slate-500 font-bold mt-1">Manage your consultations, requests, and patient history.</p>
            </div>
            <div class="flex items-center gap-2 p-1 bg-slate-100 rounded-2xl">
                <a href="{{ route('doctor.appointments.index', ['tab' => 'requests']) }}" class="px-6 py-2.5 rounded-xl text-xs font-black tracking-tight transition-all {{ $tab === 'requests' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Requests</a>
                <a href="{{ route('doctor.appointments.index', ['tab' => 'upcoming']) }}" class="px-6 py-2.5 rounded-xl text-xs font-black tracking-tight transition-all {{ $tab === 'upcoming' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Upcoming</a>
                <a href="{{ route('doctor.appointments.index', ['tab' => 'past']) }}" class="px-6 py-2.5 rounded-xl text-xs font-black tracking-tight transition-all {{ $tab === 'past' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">History</a>
            </div>
        </div>

        <!-- Appointment List -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 ">Patient</th>
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 ">DateTime</th>
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 ">Status</th>
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($appointments as $appointment)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl overflow-hidden bg-slate-100 border-2 border-white shadow-sm shrink-0">
                                            <img src="{{ $appointment->patientProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-black text-slate-900 tracking-tight">{{ $appointment->patientProfile->user->name }}</p>
                                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">PATID: #{{ str_pad($appointment->patient_profile_id, 4, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-700 tracking-tight">{{ $appointment->appointment_datetime->format('M d, Y') }}</p>
                                    <p class="text-xs font-bold text-slate-400">{{ $appointment->appointment_datetime->format('g:i A') }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $statusClass = match($appointment->status) {
                                            'confirmed' => 'bg-emerald-50 text-emerald-600',
                                            'pending' => 'bg-orange-50 text-orange-600',
                                            'cancelled', 'rejected' => 'bg-red-50 text-red-600',
                                            'completed' => 'bg-blue-50 text-blue-600',
                                            'reschedule_requested' => 'bg-purple-50 text-purple-600',
                                            default => 'bg-slate-50 text-slate-600'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $statusClass }}">
                                        {{ str_replace('_', ' ', $appointment->status) }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('doctor.appointments.show', $appointment) }}" class="p-2 text-slate-400 hover:text-slate-900 hover:bg-white rounded-xl transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                        @if($appointment->status === 'pending')
                                            <form action="{{ route('doctor.appointments.update-status', $appointment) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="confirmed">
                                                <button type="submit" class="p-2 text-emerald-500 hover:text-white hover:bg-emerald-500 rounded-xl transition-all shadow-sm">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                </button>
                                            </form>
                                            <form action="{{ route('doctor.appointments.update-status', $appointment) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="cancelled"> <!-- Map to Rejected -->
                                                <button type="submit" class="p-2 text-red-500 hover:text-white hover:bg-red-500 rounded-xl transition-all shadow-sm">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-[2.5rem] flex items-center justify-center text-slate-300 mx-auto mb-6">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <p class="text-slate-400 font-bold tracking-tight">No appointments found in this category.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($appointments->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 font-bold">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
</x-doctor-layout>
