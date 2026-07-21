<x-provider-onboarding-layout title="License & Identifiers" description="Step 3 of 8" currentStep="3">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden"
         x-data="{
            npi: '',
            npiLoading: false,
            npiFound: false,
            npiError: '',
            npiProvider: { name: '', specialty: '', address: '', raw: '' },
            npiLookup() {
                if (this.npi.length !== 10) return;
                this.npiLoading = true;
                this.npiError = '';
                this.npiFound = false;

                fetch(`/register/provider/npi-lookup?npi=${this.npi}`)
                    .then(res => res.json())
                    .then(data => {
                        this.npiLoading = false;
                        if (data.found) {
                            this.npiFound = true;
                            this.npiProvider = data;
                            document.getElementById('npi_number').value = this.npi;
                        } else {
                            this.npiError = data.error || 'No provider found with this NPI number.';
                        }
                    })
                    .catch(() => {
                        this.npiLoading = false;
                        this.npiError = 'Something went wrong. Please check your connection.';
                    });
            }
         }">
        <form method="POST" action="{{ route('provider.register.license.store') }}" enctype="multipart/form-data" class="p-8 lg:p-12 space-y-10">
            @csrf
            <input type="hidden" name="npi_confirmed" :value="npiFound ? 1 : 0">
            <input type="hidden" name="npi_raw" :value="npiFound ? JSON.stringify(npiProvider.raw) : ''">

            {{-- NPI Lookup --}}
            <div class="p-6 bg-indigo-50 border border-indigo-100 rounded-3xl">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-9 h-9 bg-indigo-600 text-white rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                    <div>
                        <h5 class="text-sm font-black text-slate-900">NPI Lookup</h5>
                        <p class="text-xs font-medium text-slate-500">Enter your 10-digit NPI to auto-verify your identity</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="relative">
                        <input
                            type="text"
                            x-model="npi"
                            maxlength="10"
                            @input="npi = npi.replace(/\D/g, ''); if (npi.length === 10) npiLookup(); else { npiFound = false; npiError = ''; }"
                            placeholder="1234567890"
                            class="w-full px-5 py-4 bg-white border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                        >
                        <div class="absolute right-5 top-1/2 -translate-y-1/2" x-show="npiLoading">
                            <svg class="animate-spin h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>

                    <template x-if="npiError">
                        <p class="text-sm font-bold text-rose-600" x-text="npiError"></p>
                    </template>

                    <template x-if="npiFound">
                        <div class="flex items-center justify-between p-4 bg-white border-2 border-emerald-200 rounded-2xl">
                            <div class="flex items-center space-x-3">
                                <div class="w-9 h-9 bg-emerald-500 text-white rounded-xl flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-black text-slate-900" x-text="npiProvider.name"></p>
                                    <p class="text-xs font-bold text-slate-500 mt-0.5" x-text="npiProvider.specialty || 'Verified against NPI registry'"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Required Fields --}}
            <div class="space-y-6">
                <h4 class="text-sm font-black uppercase tracking-widest text-slate-500">Required</h4>

                <div>
                    <label for="license_type" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">License Type</label>
                    <div class="relative">
                        <select
                            name="license_type"
                            id="license_type"
                            required
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all appearance-none"
                        >
                            <option value="">Select Type</option>
                            <option value="MD" {{ old('license_type', $profile->provider_type) == 'MD' ? 'selected' : '' }}>Medical Doctor (MD)</option>
                            <option value="DO" {{ old('license_type', $profile->provider_type) == 'DO' ? 'selected' : '' }}>Doctor of Osteopathic Medicine (DO)</option>
                            <option value="NP" {{ old('license_type', $profile->provider_type) == 'NP' ? 'selected' : '' }}>Nurse Practitioner (NP / APRN)</option>
                            <option value="PA" {{ old('license_type', $profile->provider_type) == 'PA' ? 'selected' : '' }}>Physician Assistant (PA)</option>
                            <option value="RN" {{ old('license_type', $profile->provider_type) == 'RN' ? 'selected' : '' }}>Registered Nurse (RN)</option>
                            
                            <option value="PSY" {{ old('license_type', $profile->provider_type) == 'PSY' ? 'selected' : '' }}>Psychologist (PhD/PsyD)</option>
                            <option value="LCSW" {{ old('license_type', $profile->provider_type) == 'LCSW' ? 'selected' : '' }}>Licensed Clinical Social Worker (LCSW)</option>
                            <option value="LPC" {{ old('license_type', $profile->provider_type) == 'LPC' ? 'selected' : '' }}>Licensed Professional Counselor (LPC/LPCC/LCPC)</option>
                            <option value="LMHC" {{ old('license_type', $profile->provider_type) == 'LMHC' ? 'selected' : '' }}>Licensed Mental Health Counselor (LMHC)</option>
                            <option value="LMFT" {{ old('license_type', $profile->provider_type) == 'LMFT' ? 'selected' : '' }}>Licensed Marriage & Family Therapist (LMFT)</option>
                            <option value="PMHNP" {{ old('license_type', $profile->provider_type) == 'PMHNP' ? 'selected' : '' }}>Psychiatric Mental Health Nurse Practitioner (PMHNP)</option>
                           
                            <option value="CNM" {{ old('license_type', $profile->provider_type) == 'CNM' ? 'selected' : '' }}>Certified Nurse Midwife (CNM)</option>
                            
                            <option value="PT" {{ old('license_type', $profile->provider_type) == 'PT' ? 'selected' : '' }}>Physical Therapist (PT)</option>
                            <option value="OT" {{ old('license_type', $profile->provider_type) == 'OT' ? 'selected' : '' }}>Occupational Therapist (OT)</option>
                            <option value="SLP" {{ old('license_type', $profile->provider_type) == 'SLP' ? 'selected' : '' }}>Speech-Language Pathologist (SLP)</option>
                            <option value="AuD" {{ old('license_type', $profile->provider_type) == 'AuD' ? 'selected' : '' }}>Audiologist (AuD)</option>
                            <option value="DC" {{ old('license_type', $profile->provider_type) == 'DC' ? 'selected' : '' }}>Chiropractor (DC)</option>
                            <option value="DPM" {{ old('license_type', $profile->provider_type) == 'DPM' ? 'selected' : '' }}>Podiatrist (DPM)</option>
                            <option value="OD" {{ old('license_type', $profile->provider_type) == 'OD' ? 'selected' : '' }}>Optometrist (OD)</option>
                            <option value="DDS" {{ old('license_type', $profile->provider_type) == 'DDS' ? 'selected' : '' }}>Dentist (DDS/DMD)</option>
                            <option value="RDN" {{ old('license_type', $profile->provider_type) == 'RDN' ? 'selected' : '' }}>Registered Dietitian Nutritionist (RDN/RD)</option>
                            <option value="LCD" {{ old('license_type', $profile->provider_type) == 'LCD' ? 'selected' : '' }}>Licensed Clinical Dietitian (where applicable)</option>
                            <option value="Other" {{ old('license_type', $profile->provider_type) == 'Other' ? 'selected' : '' }}>Other (Specify)</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('license_type')" class="mt-2" />
                </div>

                <div>
                    <label for="license_number" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">License Number</label>
                    <input
                        type="text"
                        name="license_number"
                        id="license_number"
                        value="{{ old('license_number', $profile->license_number) }}"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                        placeholder="A12345"
                    >
                    <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
                </div>

                <div>
                    <label for="license_expiration_date" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">License Expiration Date</label>
                    <input
                        type="date"
                        name="license_expiration_date"
                        id="license_expiration_date"
                        value="{{ old('license_expiration_date', optional($profile->license_expiration_date)->format('Y-m-d')) }}"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all"
                    >
                    <x-input-error :messages="$errors->get('license_expiration_date')" class="mt-2" />
                </div>

                <div>
                    <label for="npi_number" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">NPI Number</label>
                    <input
                        type="text"
                        name="npi_number"
                        id="npi_number"
                        value="{{ old('npi_number', $profile->npi_number) }}"
                        maxlength="10"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                        placeholder="10-digit NPI"
                    >
                    <p class="mt-2 text-xs font-medium text-slate-400">Auto-filled by the NPI lookup above, or enter manually.</p>
                    <x-input-error :messages="$errors->get('npi_number')" class="mt-2" />
                </div>

                <div>
                    <label for="state_of_licensure" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">State of Licensure</label>
                    <div class="relative">
                        <select
                            name="state_of_licensure"
                            id="state_of_licensure"
                            required
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all appearance-none"
                        >
                            <option value="">Select State</option>
                            <option value="AL" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'AL' ? 'selected' : '' }}>Alabama</option>
                            <option value="AK" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'AK' ? 'selected' : '' }}>Alaska</option>
                            <option value="AZ" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'AZ' ? 'selected' : '' }}>Arizona</option>
                            <option value="AR" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'AR' ? 'selected' : '' }}>Arkansas</option>
                            <option value="CA" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'CA' ? 'selected' : '' }}>California</option>
                            <option value="CO" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'CO' ? 'selected' : '' }}>Colorado</option>
                            <option value="CT" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'CT' ? 'selected' : '' }}>Connecticut</option>
                            <option value="DE" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'DE' ? 'selected' : '' }}>Delaware</option>
                            <option value="FL" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'FL' ? 'selected' : '' }}>Florida</option>
                            <option value="GA" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'GA' ? 'selected' : '' }}>Georgia</option>
                            <option value="HI" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'HI' ? 'selected' : '' }}>Hawaii</option>
                            <option value="ID" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'ID' ? 'selected' : '' }}>Idaho</option>
                            <option value="IL" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'IL' ? 'selected' : '' }}>Illinois</option>
                            <option value="IN" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'IN' ? 'selected' : '' }}>Indiana</option>
                            <option value="IA" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'IA' ? 'selected' : '' }}>Iowa</option>
                            <option value="KS" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'KS' ? 'selected' : '' }}>Kansas</option>
                            <option value="KY" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'KY' ? 'selected' : '' }}>Kentucky</option>
                            <option value="LA" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'LA' ? 'selected' : '' }}>Louisiana</option>
                            <option value="ME" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'ME' ? 'selected' : '' }}>Maine</option>
                            <option value="MD" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'MD' ? 'selected' : '' }}>Maryland</option>
                            <option value="MA" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                            <option value="MI" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'MI' ? 'selected' : '' }}>Michigan</option>
                            <option value="MN" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'MN' ? 'selected' : '' }}>Minnesota</option>
                            <option value="MS" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'MS' ? 'selected' : '' }}>Mississippi</option>
                            <option value="MO" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'MO' ? 'selected' : '' }}>Missouri</option>
                            <option value="MT" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'MT' ? 'selected' : '' }}>Montana</option>
                            <option value="NE" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'NE' ? 'selected' : '' }}>Nebraska</option>
                            <option value="NV" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'NV' ? 'selected' : '' }}>Nevada</option>
                            <option value="NH" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                            <option value="NJ" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                            <option value="NM" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'NM' ? 'selected' : '' }}>New Mexico</option>
                            <option value="NY" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'NY' ? 'selected' : '' }}>New York</option>
                            <option value="NC" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'NC' ? 'selected' : '' }}>North Carolina</option>
                            <option value="ND" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'ND' ? 'selected' : '' }}>North Dakota</option>
                            <option value="OH" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'OH' ? 'selected' : '' }}>Ohio</option>
                            <option value="OK" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                            <option value="OR" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'OR' ? 'selected' : '' }}>Oregon</option>
                            <option value="PA" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                            <option value="RI" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                            <option value="SC" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'SC' ? 'selected' : '' }}>South Carolina</option>
                            <option value="SD" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'SD' ? 'selected' : '' }}>South Dakota</option>
                            <option value="TN" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'TN' ? 'selected' : '' }}>Tennessee</option>
                            <option value="TX" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'TX' ? 'selected' : '' }}>Texas</option>
                            <option value="UT" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'UT' ? 'selected' : '' }}>Utah</option>
                            <option value="VT" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'VT' ? 'selected' : '' }}>Vermont</option>
                            <option value="VA" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'VA' ? 'selected' : '' }}>Virginia</option>
                            <option value="WA" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'WA' ? 'selected' : '' }}>Washington</option>
                            <option value="WV" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'WV' ? 'selected' : '' }}>West Virginia</option>
                            <option value="WI" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                            <option value="WY" {{ old('state_of_licensure', data_get($profile->license_states, 0)) == 'WY' ? 'selected' : '' }}>Wyoming</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('state_of_licensure')" class="mt-2" />
                </div>
            </div>

            {{-- Required Document Uploads --}}
            <div class="pt-8 border-t border-slate-100 space-y-6">
                <div class="flex items-center space-x-2">
                    <h4 class="text-sm font-black uppercase tracking-widest text-slate-500">Upload Documents</h4>
                    <span class="text-xs font-bold text-slate-400">🔒 Securely Encrypted</span>
                </div>

                <div x-data="{ fileName: '' }">
                    <label class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-3">
                        Government ID
                        @unless($profile->document_id_path)<span class="text-rose-600">*</span>@endunless
                    </label>
                    @if($profile->document_id_path)
                        <p class="text-xs font-bold text-emerald-600 mb-2">✓ Already on file — upload a new file only if you need to replace it.</p>
                    @endif
                    <label class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-indigo-600 transition-all group">
                        <input type="file" name="document_id" {{ $profile->document_id_path ? '' : 'required' }} accept=".pdf,.png,.jpg,.jpeg" class="sr-only" @change="fileName = $event.target.files[0].name">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-slate-500 font-bold group-hover:text-indigo-600" x-text="fileName || 'Click to upload or drag and drop'"></p>
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-widest">PDF, PNG, JPG (MAX. 10MB)</p>
                        </div>
                    </label>
                    <x-input-error :messages="$errors->get('document_id')" class="mt-2" />
                </div>

                <div x-data="{ fileName: '' }">
                    <label class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-3">
                        Malpractice Insurance
                        @unless($profile->document_malpractice_path)<span class="text-rose-600">*</span>@endunless
                    </label>
                    @if($profile->document_malpractice_path)
                        <p class="text-xs font-bold text-emerald-600 mb-2">✓ Already on file — upload a new file only if you need to replace it.</p>
                    @endif
                    <label class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-indigo-600 transition-all group">
                        <input type="file" name="document_malpractice" {{ $profile->document_malpractice_path ? '' : 'required' }} accept=".pdf,.png,.jpg,.jpeg" class="sr-only" @change="fileName = $event.target.files[0].name">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-slate-500 font-bold group-hover:text-indigo-600" x-text="fileName || 'Click to upload or drag and drop'"></p>
                            <p class="text-xs text-slate-400 font-medium uppercase tracking-widest">PDF, PNG, JPG (MAX. 10MB)</p>
                        </div>
                    </label>
                    <x-input-error :messages="$errors->get('document_malpractice')" class="mt-2" />
                </div>
            </div>

            {{-- Optional --}}
            <div class="pt-8 border-t border-slate-100 space-y-6">
                <div class="flex items-center space-x-3">
                    <h4 class="text-sm font-black uppercase tracking-widest text-slate-500">Optional</h4>
                </div>

                <div>
                    <label for="dea_number" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">DEA Number <span class="font-medium text-slate-400 lowercase tracking-normal">(if applicable)</span></label>
                    <input
                        type="text"
                        name="dea_number"
                        id="dea_number"
                        value="{{ old('dea_number', $profile->dea_number) }}"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                        placeholder="AB1234567"
                    >
                    <x-input-error :messages="$errors->get('dea_number')" class="mt-2" />
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Verify &amp; Continue
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>