<x-admin-layout>
    <x-slot name="header">
        Provider Directory
    </x-slot>

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <!-- Filter Tabs -->
        <div class="flex items-center space-x-1 p-1 bg-slate-100 rounded-xl overflow-hidden">
            <a href="{{ route('admin.providers.index') }}" class="px-4 py-2 text-xs font-black uppercase tracking-widest leading-none transition-all rounded-lg {{ !request('verified') ? 'bg-white text-indigo-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                ALL
            </a>
            <a href="{{ route('admin.providers.index', ['verified' => '0']) }}" class="px-4 py-2 text-xs font-black uppercase tracking-widest leading-none transition-all rounded-lg {{ request('verified') === '0' ? 'bg-white text-rose-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                PENDING
            </a>
            <a href="{{ route('admin.providers.index', ['verified' => '1']) }}" class="px-4 py-2 text-xs font-black uppercase tracking-widest leading-none transition-all rounded-lg {{ request('verified') === '1' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                VERIFIED
            </a>
        </div>

        <!-- Search Bar -->
        <div class="relative max-w-sm w-full">
            <form action="{{ route('admin.providers.index') }}" method="GET">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search providers..."
                    class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all shadow-sm"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
            </form>
        </div>
    </div>

    <!-- Providers Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Provider</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Specialties</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Verification</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Patients</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($doctors as $doctor)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-1 overflow-hidden shadow-inner shrink-0 leading-none">
                                        <div class="text-xs font-black text-indigo-200">IMG</div>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-black text-slate-900 leading-none mb-1">Dr. {{ $doctor->user->name }}</p>
                                        <p class="text-xs text-slate-500 tracking-tight font-medium">{{ $doctor->clinic_name ?: 'Professional Office' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5 max-w-xs">
                                    @forelse($doctor->specialties as $specialty)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-indigo-50 text-indigo-700 uppercase tracking-wide">
                                            {{ $specialty->name }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-slate-300 font-medium">No specialties mapped</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.providers.toggle-verify', $doctor) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest leading-none shadow-sm transition {{ $doctor->is_verified ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-rose-100 text-rose-800 hover:bg-rose-200' }}">
                                        {{ $doctor->is_verified ? 'VERIFIED' : 'PENDING' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-bold text-slate-600">
                                0
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-1">
                                    <a href="{{ route('admin.providers.edit', $doctor) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Manage Profile">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                    </a>
                                    <form action="{{ route('admin.providers.destroy', $doctor) }}" method="POST"
                                          onsubmit="return confirm('Delete provider {{ addslashes($doctor->user->name) }}? This cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Delete Provider">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="m19 6-.867 12.142A2 2 0 0 1 16.138 20H7.862a2 2 0 0 1-1.995-1.858L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500 italic">
                                No providers found matching your filters.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($doctors->hasPages())
            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-200">
                {{ $doctors->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
