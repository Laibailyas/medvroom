<x-admin-layout>
    <x-slot name="header">
        Review Moderation
    </x-slot>

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <!-- Filter Tabs (Rating) -->
        <div class="flex items-center space-x-1 p-1 bg-slate-100 rounded-xl overflow-hidden">
            <a href="{{ route('admin.reviews.index') }}" class="px-4 py-2 text-xs font-black uppercase tracking-widest leading-none rounded-lg transition-all {{ !request('rating') ? 'bg-white text-indigo-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                ALL
            </a>
            @foreach([5, 4, 3, 2, 1] as $r)
                <a href="{{ route('admin.reviews.index', ['rating' => $r]) }}" class="px-4 py-2 text-xs font-black uppercase tracking-widest leading-none rounded-lg transition-all {{ request('rating') == $r ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                    {{ $r }} ★
                </a>
            @endforeach
        </div>
    </div>

    <!-- Reviews Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Patient Feed</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Provider</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Rating</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Comment</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reviews as $rev)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-slate-900 leading-none mb-1">{{ $rev->patientProfile->user->name }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest tracking-tight">Patient Identity</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-slate-900 leading-none mb-1">Dr. {{ $rev->doctorProfile->user->name }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest tracking-tight">Healthcare Provider</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-1">
                                    <span class="text-xs font-black text-amber-500 leading-none">{{ $rev->rating }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" class="text-amber-500"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-sm">
                                    <p class="text-sm text-slate-600 font-medium italic leading-relaxed line-clamp-2">"{{ $rev->comment ?: 'No feedback provided.' }}"</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <form action="{{ route('admin.reviews.destroy', $rev) }}" method="POST" onsubmit="return confirm('ADMIN WARNING: Moderate this review across the platform?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-button variant="danger" size="icon" title="Moderate/Remove"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m14.5 9-5 5"/><path d="m9.5 9 5 5"/></svg></x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500 italic">
                                No clinical reviews documented yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reviews->hasPages())
            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-200">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
