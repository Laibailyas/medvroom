<x-admin-layout>
    <x-slot name="header">
        Users &amp; Patients
    </x-slot>

    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="mb-6 flex items-center space-x-3 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 flex items-center space-x-3 p-4 bg-rose-50 border border-rose-200 rounded-xl">
            <p class="text-sm font-bold text-rose-800">{{ session('error') }}</p>
        </div>
    @endif

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <!-- Role Filter Tabs -->
        <div class="flex items-center space-x-1 p-1 bg-slate-100 rounded-xl">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-xs font-black uppercase tracking-widest rounded-lg transition-all {{ !request('role') ? 'bg-white text-indigo-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">All</a>
            <a href="{{ route('admin.users.index', ['role' => 'patient']) }}" class="px-4 py-2 text-xs font-black uppercase tracking-widest rounded-lg transition-all {{ request('role') === 'patient' ? 'bg-white text-blue-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Patients</a>
            <a href="{{ route('admin.users.index', ['role' => 'doctor']) }}" class="px-4 py-2 text-xs font-black uppercase tracking-widest rounded-lg transition-all {{ request('role') === 'doctor' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Providers</a>
            <a href="{{ route('admin.users.index', ['role' => 'admin']) }}" class="px-4 py-2 text-xs font-black uppercase tracking-widest rounded-lg transition-all {{ request('role') === 'admin' ? 'bg-white text-rose-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">Admins</a>
        </div>

        <div class="flex items-center space-x-3">
            <!-- Search -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="relative">
                @if(request('role'))<input type="hidden" name="role" value="{{ request('role') }}">@endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                    class="pl-10 pr-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm shadow-sm w-56">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
            </form>
            <!-- Create -->
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-xs font-black uppercase tracking-widest rounded-lg hover:bg-indigo-700 transition-colors shadow-sm space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                <span>Add User</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Role</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Joined</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-black text-sm shrink-0 uppercase">
                                        {{ substr($user->name ?? $user->email, 0, 1) }}
                                    </div>
                                    <p class="text-sm font-bold text-slate-900">{{ $user->name ?: '—' }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-medium">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $roleColor = match($user->role) {
                                        'admin'   => 'bg-rose-100 text-rose-700',
                                        'doctor'  => 'bg-emerald-100 text-emerald-700',
                                        'patient' => 'bg-blue-100 text-blue-700',
                                        default   => 'bg-slate-100 text-slate-600',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $roleColor }}">
                                    {{ ucfirst($user->role ?? 'user') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-xs font-bold text-slate-500">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end space-x-1">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                    </a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                          onsubmit="return confirm('Delete {{ addslashes($user->name ?? $user->email) }}? This cannot be undone.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="m19 6-.867 12.142A2 2 0 0 1 16.138 20H7.862a2 2 0 0 1-1.995-1.858L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400 italic text-sm">No users found matching your filters.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
