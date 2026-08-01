<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter text-slate-900">Clinical Profile</h1>
                <p class="text-slate-500 font-bold mt-1 uppercase tracking-widest text-[10px]">Manage your professional digital presence and practice details.</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" form="profile-form" class="px-8 py-4 bg-primary text-slate-900 rounded-[1.5rem] font-black text-sm hover:scale-105 transition-all shadow-xl shadow-primary/20 ">
                    Save Changes
                </button>
            </div>
        </div>

        <form id="profile-form" action="{{ route('doctor.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 pb-20">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Identity & Photo -->
                <div class="space-y-8">
                    <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-slate-900/10 text-center relative overflow-hidden group">
                        <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-all duration-700"></div>
                        
                        <!-- Photo Upload -->
                        <div class="relative inline-block mb-8 group/photo">
                            <div class="w-32 h-32 rounded-[2.75rem] overflow-hidden bg-slate-800 border-4 border-slate-800 shadow-2xl relative">
                                <img src="{{ Auth::user()->getProfilePhotoUrl() }}" class="w-full h-full object-cover group-hover/photo:scale-110 transition-transform duration-500">
                                <label class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover/photo:opacity-100 transition-opacity cursor-pointer">
                                    <input type="file" name="profile_photo" class="hidden">
                                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </label>
                            </div>
                            <div class="absolute -right-2 -bottom-2 bg-primary text-slate-900 p-2 rounded-xl shadow-lg border-4 border-slate-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>

                        <div class="space-y-4 text-left">
                            <div>
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-1">First Name</label>
                                <input type="text" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" class="w-full bg-slate-800/50 border-0 rounded-2xl p-4 text-sm font-black tracking-tight text-white focus:ring-2 focus:ring-primary h-14 mt-1">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-1">Last Name</label>
                                <input type="text" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" class="w-full bg-slate-800/50 border-0 rounded-2xl p-4 text-sm font-black tracking-tight text-white focus:ring-2 focus:ring-primary h-14 mt-1">
                            </div>
                        </div>
                    </div>

                    <!-- Clinical Stats Quick Info -->
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm">
                        <h3 class="text-xl font-black tracking-tighter mb-6">Expertise Overview</h3>
                        <div class="space-y-5">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Clinical Experience (Years)</label>
                                <input type="number" name="experience_years" value="{{ old('experience_years', $doctor->experience_years) }}" class="w-full bg-slate-50 border-0 rounded-2xl p-4 text-sm font-black tracking-tight text-slate-900 focus:ring-2 focus:ring-primary h-14 mt-1">
                            </div>
                            <div>
    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">License Type</label>
    <select name="license_type_id" class="w-full bg-slate-50 border-0 rounded-2xl p-4 text-sm font-black tracking-tight text-slate-900 focus:ring-2 focus:ring-primary h-14 mt-1">
        <option value="">Select license type</option>
        @foreach($licenseTypes as $license)
            <option value="{{ $license->id }}" {{ old('license_type_id', $doctor->license_type_id) == $license->id ? 'selected' : '' }}>
                {{ $license->name }}
            </option>
        @endforeach
    </select>
</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Bio & Professional details -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About Me -->
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 md:p-12 shadow-sm">
                        <h2 class="text-2xl font-black tracking-tighter mb-8 flex items-center gap-3">
                            <span class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            About Your Practice
                        </h2>
                        <div class="space-y-8">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block px-1">Professional Bio</label>
                                <textarea name="bio" rows="6" class="w-full bg-slate-50 border-0 rounded-3xl p-6 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-primary leading-relaxed" placeholder="Share your clinical background, philosophy, and special interests...">{{ old('bio', $doctor->bio) }}</textarea>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block px-1">Practice / Clinic Name</label>
                                    <input type="text" name="practice_name" value="{{ old('practice_name', $doctor->practice_name) }}" class="w-full bg-slate-50 border-0 rounded-2xl p-4 text-sm font-black tracking-tight text-slate-900 focus:ring-2 focus:ring-primary h-14" placeholder="e.g. MedVroom Health Center">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block px-1">Primary Clinical Address</label>
                                    <input type="text" name="clinic_address" value="{{ old('clinic_address', $doctor->clinic_address) }}" class="w-full bg-slate-50 border-0 rounded-2xl p-4 text-sm font-black tracking-tight text-slate-900 focus:ring-2 focus:ring-primary h-14" placeholder="Full street address...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Specialties & Languages -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Specialties -->
                        <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm h-full">
                            <h3 class="text-xl font-black tracking-tighter mb-6">Medical Specialties</h3>
                            <div class="max-h-64 overflow-y-auto pr-2 space-y-2 custom-scrollbar">
                                @foreach($specialties as $specialty)
                                    <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-slate-100 transition-colors">
                                        <input type="checkbox" name="specialties[]" value="{{ $specialty->id }}" {{ in_array($specialty->id, $doctor->specialties->pluck('id')->toArray()) ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary">
                                        <span class="text-xs font-bold text-slate-700">{{ $specialty->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Languages -->
                       <!-- Languages -->
<div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm h-full">
    <h3 class="text-xl font-black tracking-tighter mb-2">Languages Spoken</h3>
    <p class="text-xs text-slate-400 font-bold mb-6">Select all languages you speak with patients.</p>

    <div class="max-h-64 overflow-y-auto pr-2 space-y-2 custom-scrollbar">
        @foreach($languages as $language)
            @if($language->code !== 'other')
                <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-slate-100 transition-colors">
                    <input type="checkbox" name="languages[]" value="{{ $language->id }}" {{ in_array($language->id, $doctor->languages->pluck('id')->toArray()) ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary">
                    <span class="text-xs font-bold text-slate-700">{{ $language->name }}</span>
                </label>
            @endif
        @endforeach

        @php
            $otherLanguage = $languages->firstWhere('code', 'other');
        @endphp
        @if($otherLanguage)
            <label class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl cursor-pointer hover:bg-slate-100 transition-colors">
                <input type="checkbox" name="languages[]" value="{{ $otherLanguage->id }}" {{ in_array($otherLanguage->id, $doctor->languages->pluck('id')->toArray()) ? 'checked' : '' }} class="rounded border-slate-300 text-primary focus:ring-primary">
                <span class="text-xs font-bold text-slate-700">Other (please specify)</span>
            </label>
        @endif
    </div>

    <div class="mt-3">
        <input type="text" name="other_language" value="{{ old('other_language', $doctor->other_language) }}" placeholder="Specify other language..." class="w-full bg-slate-50 border-0 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-primary h-14">
    </div>
</div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('styles')
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #e2e8f0; }
    </style>
    @endpush
</x-doctor-layout>