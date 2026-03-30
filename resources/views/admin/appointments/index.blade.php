<x-admin-layout>
    <x-slot name="header">
        Appointment Tracker
    </x-slot>

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <!-- Filter Bar -->
        <div class="flex flex-1 max-w-3xl space-x-4">
            <div class="relative flex-1">
                <form action="{{ route('admin.appointments.index') }}" method="GET">
                    <input 
                        type="date" 
                        name="date" 
                        value="{{ request('date') }}"
                        class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all shadow-sm"
                    >
                </form>
            </div>
            
            <div class="w-48">
                <form action="{{ route('admin.appointments.index') }}" method="GET" id="statusFilterForm">
                    <select 
                        name="status" 
                        onchange="document.getElementById('statusFilterForm').submit()"
                        class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all shadow-sm"
                    >
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </form>
            </div>
        </div>
    </div>

    <!-- Appointments Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Schedule</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Patient</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Provider</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Status</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($appointments as $app)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-black text-slate-900 leading-none mb-1">{{ $app->appointment_datetime->format('M d, Y') }}</p>
                                <p class="text-xs text-slate-500 font-bold uppercase tracking-widest">{{ $app->appointment_datetime->format('h:i A') }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-[10px] shadow-inner">
                                        {{ substr($app->patientProfile->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-semibold text-slate-900 leading-none">{{ $app->patientProfile->user->name }}</p>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Patient</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-slate-900 leading-none">Dr. {{ $app->doctorProfile->user->name }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Provider</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-amber-100 text-amber-800',
                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                        'cancelled' => 'bg-rose-100 text-rose-800',
                                        'completed' => 'bg-emerald-100 text-emerald-800',
                                    ][$app->status] ?? 'bg-slate-100 text-slate-800';
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest leading-none {{ $statusClasses }} shadow-sm">
                                    {{ $app->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.appointments.show', $app) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="View Details">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 corner-radius-2 18 13 2 13 2"/><circle cx="12" cy="12" r="3"/><path d="M3 12c.3-2.1 1.7-3.9 3.5-5.1C8.3 5.4 10.1 5 12 5c1.9 0 3.7.4 5.5 1.9 1.8 1.2 3.2 3 3.5 5.1-.3 2.1-1.7 3.9-3.5 5.1-1.8 1.5-3.6 1.9-5.5 1.9-1.9 0-3.7-.4-5.5-1.9-1.8-1.2-3.2-3-3.5-5.1Z"/></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500 italic">
                                No appointments found matching your filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($appointments->hasPages())
            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-200">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
