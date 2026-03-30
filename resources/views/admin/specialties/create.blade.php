<x-admin-layout>
    <x-slot name="header">
        Add New Specialty
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.specialties.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to List
            </a>
        </div>

        <form action="{{ route('admin.specialties.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest leading-none">Basic Classification</h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid md:grid-cols-4 gap-6">
                            <div class="md:col-span-1">
                                <label for="icon" class="block text-sm font-bold text-slate-700 mb-1">Icon (Emoji/SVG)</label>
                                <input 
                                    type="text" 
                                    name="icon" 
                                    id="icon" 
                                    value="{{ old('icon') }}"
                                    placeholder="e.g. 🩺"
                                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg text-center"
                                >
                            </div>
                            <div class="md:col-span-3">
                                <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Specialty Name</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    value="{{ old('name') }}"
                                    placeholder="e.g. Cardiology, Dermatology"
                                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-semibold"
                                    required
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Symptom Mapping -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest leading-none">Symptom Mapping</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-slate-500 mb-6 font-medium leading-relaxed">Select which symptoms should lead patients to this specialty. You can manage the symptom repository in the Clinical section.</p>

                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
                            @forelse($symptoms as $symptom)
                                <label class="relative flex items-center p-3 rounded-lg border border-slate-200 cursor-pointer hover:bg-slate-50 transition-colors group">
                                    <input 
                                        type="checkbox" 
                                        name="symptoms[]" 
                                        value="{{ $symptom->id }}"
                                        class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                                        {{ in_array($symptom->id, old('symptoms', [])) ? 'checked' : '' }}
                                    >
                                    <span class="ml-3 text-xs font-bold text-slate-700 group-hover:text-slate-900">{{ $symptom->name }}</span>
                                </label>
                            @empty
                                <div class="col-span-full py-8 text-center bg-slate-50 border border-dashed border-slate-200 rounded-xl">
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">No symptoms repo found</p>
                                    <a href="{{ route('admin.symptoms.create') }}" class="mt-2 inline-flex items-center text-xs text-indigo-600 font-black hover:underline">Create First Symptom &rarr;</a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.specialties.index') }}" class="px-6 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">Cancel</a>
                    <button type="submit" class="inline-flex items-center px-8 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-indigo-700 active:bg-indigo-800 shadow-sm transition">
                        Register Specialty
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
