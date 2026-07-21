<x-provider-onboarding-layout title="Practice Details" description="Step 4 of 8 " currentStep="4">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.details.store') }}" class="p-8 lg:p-12 space-y-10">
            @csrf

            <div class="space-y-10">

                {{-- Address --}}
                <div class="space-y-4">
                    <h4 class="text-sm font-black uppercase tracking-widest text-slate-500">Practice Address</h4>

                    <div x-data="{ virtual: {{ old('virtual_only', $profile->virtual_only) ? 'true' : 'false' }} }">
                        <label class="flex items-center space-x-3 cursor-pointer mb-4 select-none">
                            <input type="checkbox" name="virtual_only" value="1" x-model="virtual" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500" {{ old('virtual_only', $profile->virtual_only) ? 'checked' : '' }}>
                            <span class="text-sm font-bold text-slate-700">Virtual only — I don't have a physical office</span>
                        </label>

                        <div x-show="!virtual" x-transition class="space-y-4">
                            @if($profile->clinic_address)
                                <p class="text-xs font-medium text-slate-400">Currently on file: <span class="font-bold text-slate-600">{{ $profile->clinic_address }}</span> — re-enter below to update.</p>
                            @endif
                            <div>
                                <label for="address_line1" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Street Address</label>
                                <input
                                    type="text"
                                    name="address_line1"
                                    id="address_line1"
                                    value="{{ old('address_line1') }}"
                                    class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                                    placeholder="123 Medical Dr, Suite 100"
                                >
                                <x-input-error :messages="$errors->get('address_line1')" class="mt-2" />
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <div class="col-span-2 md:col-span-1">
                                    <label for="address_city" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">City</label>
                                    <input type="text" name="address_city" id="address_city" value="{{ old('address_city') }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400" placeholder="New York">
                                </div>
                                <div>
                                    <label for="address_state" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">State</label>
                                    <input type="text" name="address_state" id="address_state" value="{{ old('address_state') }}" maxlength="2" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 uppercase" placeholder="NY">
                                </div>
                                <div>
                                    <label for="address_zip" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">ZIP</label>
                                    <input type="text" name="address_zip" id="address_zip" value="{{ old('address_zip', $profile->practice_zip_code) }}" maxlength="10" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400" placeholder="10001">
                                </div>
                            </div>
                        </div>

                        <div x-show="virtual" class="p-4 bg-indigo-50 border border-indigo-100 rounded-2xl">
                            <p class="text-sm font-bold text-indigo-700">✓ Your profile will show as telehealth / virtual only.</p>
                        </div>
                    </div>
                </div>

                {{-- Services Offered --}}
                <div class="space-y-4" x-data="{
                    customServices: {{ json_encode(array_values(array_diff(old('services', []), [
                        'Annual Physical', 'Urgent Care', 'Mental Health', 'Chronic Disease Management',
                        'Preventive Care', 'Telehealth Consult', 'Pediatric Care', 'Women\'s Health',
                        'Geriatric Care', 'Sports Medicine', 'Nutrition Counseling', 'Lab Orders',
                        'Prescription Refills', 'Specialist Referrals', 'Vaccinations', 'Minor Procedures'
                    ]))) }},
                    newService: '',
                    addService() {
                        let val = this.newService.trim();
                        if (val && !this.customServices.includes(val)) {
                            this.customServices.push(val);
                        }
                        this.newService = '';
                    },
                    removeService(s) {
                        this.customServices = this.customServices.filter(x => x !== s);
                    }
                }">
                    <h4 class="text-sm font-black uppercase tracking-widest text-slate-500">Services Offered</h4>
                    <div class="flex flex-wrap gap-3">
                        @foreach([
                            'Annual Physical', 'Urgent Care', 'Mental Health', 'Chronic Disease Management',
                            'Preventive Care', 'Telehealth Consult', 'Pediatric Care', 'Women\'s Health',
                            'Geriatric Care', 'Sports Medicine', 'Nutrition Counseling', 'Lab Orders',
                            'Prescription Refills', 'Specialist Referrals', 'Vaccinations', 'Minor Procedures'
                        ] as $service)
                        <label class="relative">
                            <input type="checkbox" name="services[]" value="{{ $service }}" class="sr-only peer" {{ in_array($service, old('services', $profile->services_offered ?? [])) ? 'checked' : '' }}>
                            <span class="block px-4 py-2 bg-slate-100 border-2 border-slate-100 rounded-xl text-sm font-bold text-slate-700 cursor-pointer transition-all peer-checked:bg-indigo-600 peer-checked:border-indigo-600 peer-checked:text-white hover:border-indigo-300">
                                {{ $service }}
                            </span>
                        </label>
                        @endforeach

                        {{-- Custom services added by user --}}
                        <template x-for="s in customServices" :key="s">
                            <div class="relative flex items-center px-4 py-2 bg-indigo-600 border-2 border-indigo-600 rounded-xl">
                                <input type="hidden" name="services[]" :value="s">
                                <span class="text-sm font-bold text-white" x-text="s"></span>
                                <button type="button" @click="removeService(s)" class="ml-2 text-indigo-200 hover:text-white transition-colors leading-none">&times;</button>
                            </div>
                        </template>
                    </div>

                    {{-- Add custom service --}}
                    <div class="flex items-center gap-3 mt-2">
                        <input
                            type="text"
                            x-model="newService"
                            @keydown.enter.prevent="addService()"
                            placeholder="Add your own service…"
                            class="flex-1 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold placeholder:text-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        >
                        <button
                            type="button"
                            @click="addService()"
                            class="shrink-0 px-4 py-3 bg-indigo-600 text-white text-sm font-black rounded-xl hover:bg-indigo-700 transition-colors"
                        >
                            + Add
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('services')" class="mt-2" />
                </div>

                {{-- Insurance Accepted --}}
                <div class="space-y-4">
                    <h4 class="text-sm font-black uppercase tracking-widest text-slate-500">Insurance Accepted</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach([
                            'Blue Cross Blue Shield', 'Aetna', 'UnitedHealthcare', 'Cigna',
                            'Humana', 'Medicare', 'Medicaid', 'Anthem',
                            'Molina Healthcare', 'Kaiser Permanente', 'WellCare', 'Centene',
                        ] as $insurance)
                        <label class="flex items-center p-3 bg-slate-50 border border-slate-100 rounded-xl cursor-pointer hover:border-indigo-400 transition-all group">
                            <input type="checkbox" name="insurances[]" value="{{ $insurance }}" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 mr-3" {{ in_array($insurance, old('insurances', $profile->insurances_accepted ?? [])) ? 'checked' : '' }}>
                            <span class="text-sm font-bold text-slate-700">{{ $insurance }}</span>
                        </label>
                        @endforeach
                    </div>
                    <p class="text-xs font-medium text-slate-400">Don't see your plan? You can add more from your dashboard.</p>
                    <x-input-error :messages="$errors->get('insurances')" class="mt-2" />
                </div>

            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Continue
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>