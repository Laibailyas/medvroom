<x-admin-layout>
    <x-slot name="header">
        Manage Provider: {{ $doctor->user->name }}
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.doctors.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Directory
            </a>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest leading-none {{ $doctor->is_verified ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                    {{ $doctor->is_verified ? 'VERIFIED' : 'UNVERIFIED' }}
                </span>
            </div>
        </div>

        <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="space-y-6">
                <!-- Verification Section -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest">Verification & Approval</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-100">
                            <div>
                                <p class="text-sm font-bold text-slate-700">Official Verification</p>
                                <p class="text-xs text-slate-500">Verified doctors appear with a checkmark and are prioritized in search results.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_verified" value="0">
                                <input type="checkbox" name="is_verified" value="1" class="sr-only peer" {{ old('is_verified', $doctor->is_verified) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Clinical Details -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest">Clinical Metadata</h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <!-- Specialty Multi-select (Simple version for now) -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Specialties</label>
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach($specialties as $specialty)
                                    <label class="relative flex items-center p-3 rounded-lg border border-slate-200 cursor-pointer hover:bg-slate-50 transition-colors group">
                                        <input 
                                            type="checkbox" 
                                            name="specialties[]" 
                                            value="{{ $specialty->id }}"
                                            class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                                            {{ in_array($specialty->id, old('specialties', $doctor->specialties->pluck('id')->toArray())) ? 'checked' : '' }}
                                        >
                                        <span class="ml-3 text-xs font-bold text-slate-600 group-hover:text-slate-900">{{ $specialty->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="experience_years" class="block text-sm font-bold text-slate-700 mb-1">Years of Experience</label>
                                <input 
                                    type="number" 
                                    name="experience_years" 
                                    id="experience_years" 
                                    value="{{ old('experience_years', $doctor->experience_years) }}"
                                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                >
                            </div>
                            <div>
                                <label for="consultation_fee" class="block text-sm font-bold text-slate-700 mb-1">Consultation Fee ($)</label>
                                <input 
                                    type="number" 
                                    step="0.01"
                                    name="consultation_fee" 
                                    id="consultation_fee" 
                                    value="{{ old('consultation_fee', $doctor->consultation_fee) }}"
                                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="clinic_name" class="block text-sm font-bold text-slate-700 mb-1">Practice/Clinic Name</label>
                            <input 
                                type="text" 
                                name="clinic_name" 
                                id="clinic_name" 
                                value="{{ old('clinic_name', $doctor->clinic_name) }}"
                                class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                            >
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.doctors.index') }}" class="px-6 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">Discard Changes</a>
                    <button type="submit" class="inline-flex items-center px-8 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-indigo-700 active:bg-indigo-800 shadow-sm transition">
                        Save Metadata
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
