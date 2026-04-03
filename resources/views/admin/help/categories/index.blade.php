<x-admin-layout>
    <x-slot name="header">
        Help Categories
    </x-slot>

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <div class="flex flex-1 max-w-2xl space-x-4">
        </div>

        <x-button href="{{ route('admin.help.categories.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Add Category
        </x-button>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="w-10 px-6 py-3"></th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody id="sortable-categories" class="divide-y divide-slate-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50/50 transition-colors" data-id="{{ $category->id }}">
                            <td class="px-6 py-4 whitespace-nowrap cursor-move handle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/><circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/></svg>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-slate-900 leading-none mb-1">{{ $category->name }}</p>
                                <p class="text-xs text-slate-500 tracking-tight">{{ $category->slug }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase {{ $category->type === 'patient' ? 'bg-blue-100 text-blue-800' : ($category->type === 'provider' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-800') }}">
                                    {{ $category->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.help.categories.edit', $category) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                    </a>
                                    <form action="{{ route('admin.help.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-button variant="danger" size="icon" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg></x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500 italic">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('sortable-categories');
            if (el) {
                Sortable.create(el, {
                    handle: '.handle',
                    animation: 150,
                    ghostClass: 'bg-indigo-50',
                    onEnd: function() {
                        const ids = Array.from(el.querySelectorAll('tr')).map(tr => tr.dataset.id);
                        
                        fetch('{{ route("admin.help.categories.reorder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ ids: ids })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Optional: Show a toast success message
                                console.log('Reordered successfully');
                            }
                        })
                        .catch(error => {
                            console.error('Error reordering:', error);
                            alert('Failed to save the new order. Please refresh and try again.');
                        });
                    }
                });
            }
        });
    </script>
    @endpush
</x-admin-layout>
