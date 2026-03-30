<x-admin-layout>
    <x-slot name="header">
        Symptom Directory
    </x-slot>

    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500 font-medium">Manage patient-friendly conditions and their mapping to specialized care.</p>
        <a href="{{ route('admin.symptoms.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-indigo-700 active:bg-indigo-800 transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Add New Symptom
        </a>
    </div>

    <!-- Symptoms Table -->
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Symptom Name</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Associated Specialties</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Coverage</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($symptoms as $symptom)
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-black text-slate-900 leading-none mb-1">{{ $symptom->name }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-none">/search/{{ $symptom->slug }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5 max-w-md">
                                    @foreach($symptom->specialties as $specialty)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-slate-600 uppercase tracking-wide">
                                            {{ $specialty->name }}
                                        </span>
                                    @endforeach
                                    @if($symptom->specialties->isEmpty())
                                        <span class="text-xs text-rose-300 italic font-medium leading-none">Unmapped - Add Specialty</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest leading-none {{ $symptom->specialties_count > 0 ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                    {{ $symptom->specialties_count > 0 ? 'MAPPED' : 'ORPHANED' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.symptoms.edit', $symptom) }}" class="p-1.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                    </a>
                                    <form action="{{ route('admin.symptoms.destroy', $symptom) }}" method="POST" class="inline" onsubmit="return confirm('Delete this symptom? All mappings will be removed.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-500 italic">
                                No clinical symptoms documented yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($symptoms->hasPages())
            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-200">
                {{ $symptoms->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
