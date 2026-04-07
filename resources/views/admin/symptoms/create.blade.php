<x-admin-layout>
    <x-slot name="header">
        Create New Symptom
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.symptoms.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Repository
            </a>
        </div>

        <form action="{{ route('admin.symptoms.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest leading-none">Condition Documentation</h2>
                    </div>
                    <div class="p-6">
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Symptom Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}"
                            placeholder="e.g. Back Pain, Fever, Anxiety"
                            class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-semibold"
                            required
                        >
                        <p class="mt-2 text-xs text-slate-400 font-medium leading-relaxed">Use common terms that patients search for. A URL-friendly slug will be automatically generated.</p>
                        @error('name')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Specialty Mapping -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest leading-none">Map to Specialized Care</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-slate-500 mb-6 font-medium leading-relaxed font-medium">Select which medical specialties typically treat this symptom. You can select multiple for broad conditions.</p>

                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
                            @forelse($specialties as $specialty)
                                <label class="relative flex items-center p-3 rounded-lg border border-slate-200 cursor-pointer hover:bg-slate-50 transition-colors group">
                                    <input 
                                        type="checkbox" 
                                        name="specialties[]" 
                                        value="{{ $specialty->id }}"
                                        class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                                        {{ in_array($specialty->id, old('specialties', [])) ? 'checked' : '' }}
                                    >
                                    <span class="ml-3 text-xs font-bold text-slate-700 group-hover:text-slate-900">{{ $specialty->name }}</span>
                                </label>
                            @empty
                                <div class="col-span-full py-8 text-center bg-slate-50 border border-dashed border-slate-200 rounded-xl">
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">No specialties found</p>
                                    <a href="{{ route('admin.specialties.create') }}" class="mt-2 inline-flex items-center text-xs text-indigo-600 font-black hover:underline">Create First Specialty &rarr;</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.symptoms.index') }}" class="px-6 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">Cancel</a>
                    <x-button>Document Symptom</x-button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
