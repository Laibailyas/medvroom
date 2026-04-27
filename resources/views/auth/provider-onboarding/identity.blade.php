<x-provider-onboarding-layout title="Tell us about yourself" description="Step 2 of 10 • Identity" currentStep="2">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.identity.store') }}" class="p-8 lg:p-12 space-y-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="legal_name" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Full Legal Name</label>
                    <input 
                        type="text" 
                        name="legal_name" 
                        id="legal_name" 
                        value="{{ old('legal_name', Auth::user()->name) }}"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                        placeholder="Dr. Jane Doe"
                    >
                    <x-input-error :messages="$errors->get('legal_name')" class="mt-2" />
                </div>

                <div>
                    <label for="date_of_birth" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Date of Birth</label>
                    <input 
                        type="date" 
                        name="date_of_birth" 
                        id="date_of_birth" 
                        value="{{ old('date_of_birth') }}"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all"
                    >
                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                </div>

                <div>
                    <label for="provider_type" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Provider Type</label>
                    <div class="relative">
                        <select 
                            name="provider_type" 
                            id="provider_type" 
                            required
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all appearance-none"
                        >
                            <option value="">Select Type</option>
                            <option value="MD" {{ old('provider_type') == 'MD' ? 'selected' : '' }}>MD (Doctor of Medicine)</option>
                            <option value="DO" {{ old('provider_type') == 'DO' ? 'selected' : '' }}>DO (Doctor of Osteopathic Medicine)</option>
                            <option value="NP" {{ old('provider_type') == 'NP' ? 'selected' : '' }}>NP (Nurse Practitioner)</option>
                            <option value="PA" {{ old('provider_type') == 'PA' ? 'selected' : '' }}>PA (Physician Assistant)</option>
                            <option value="DDS" {{ old('provider_type') == 'DDS' ? 'selected' : '' }}>DDS (Doctor of Dental Surgery)</option>
                            <option value="Other" {{ old('provider_type') == 'Other' ? 'selected' : '' }}>Other Specialist</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('provider_type')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-4">Are you joining as an individual or organization?</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative flex items-center p-6 bg-slate-50 border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100 transition-all group">
                            <input type="radio" name="entity_type" value="individual" class="sr-only peer" checked>
                            <div class="w-6 h-6 border-2 border-slate-300 rounded-full flex items-center justify-center peer-checked:border-indigo-600 peer-checked:bg-indigo-600 mr-4 transition-all">
                                <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-all"></div>
                            </div>
                            <div>
                                <span class="block text-lg font-black text-slate-900 leading-none">Individual</span>
                                <span class="text-xs font-bold text-slate-500 mt-1 uppercase tracking-widest">Sole practitioner</span>
                            </div>
                            <div class="absolute inset-0 border-2 border-indigo-600 rounded-2xl opacity-0 peer-checked:opacity-100 transition-all pointer-events-none"></div>
                        </label>
                        <label class="relative flex items-center p-6 bg-slate-50 border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100 transition-all group">
                            <input type="radio" name="entity_type" value="organization" class="sr-only peer">
                            <div class="w-6 h-6 border-2 border-slate-300 rounded-full flex items-center justify-center peer-checked:border-indigo-600 peer-checked:bg-indigo-600 mr-4 transition-all">
                                <div class="w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-all"></div>
                            </div>
                            <div>
                                <span class="block text-lg font-black text-slate-900 leading-none">Organization</span>
                                <span class="text-xs font-bold text-slate-500 mt-1 uppercase tracking-widest">Clinic or group</span>
                            </div>
                            <div class="absolute inset-0 border-2 border-indigo-600 rounded-2xl opacity-0 peer-checked:opacity-100 transition-all pointer-events-none"></div>
                        </label>
                    </div>
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Continue to NPI Lookup
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>
