<x-provider-onboarding-layout title="Basic Practice Info" description="Step 2 of 8 • About 1 minute" currentStep="2">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.practice.store') }}" class="p-8 lg:p-12 space-y-8">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="full_name" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Full Name</label>
                    <input
                        type="text"
                        name="full_name"
                        id="full_name"
                        value="{{ old('full_name', Auth::user()->name ?? '') }}"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                        placeholder="Dr. Jane Doe"
                    >
                    <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                </div>

                <div>
                    <label for="date_of_birth" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Date of Birth</label>
                    <input
                        type="date"
                        name="date_of_birth"
                        id="date_of_birth"
                        value="{{ old('date_of_birth', optional($profile->date_of_birth)->format('Y-m-d')) }}"
                        required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all"
                    >
                    <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                </div>

                <div>
                    <label for="practice_name" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Practice Name</label>
                    <input
                        type="text"
                        name="practice_name"
                        id="practice_name"
                        value="{{ old('practice_name', $profile->practice_name) }}"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                        placeholder='City Health Clinic — or leave blank for "Solo provider"'
                    >
                    <p class="mt-2 text-xs font-medium text-slate-400">Leave blank if you are a solo provider.</p>
                    <x-input-error :messages="$errors->get('practice_name')" class="mt-2" />
                </div>

                <div>
                    <label for="specialty" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Specialty</label>
                    <div class="relative">
                        <select
                            name="specialty"
                            id="specialty"
                            required
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all appearance-none"
                        >
                            <option value="">Select Specialty</option>
                            <option value="primary_care" {{ old('specialty', $profile->practice_specialty) == 'primary_care' ? 'selected' : '' }}>Primary Care</option>
                            <option value="internal_medicine" {{ old('specialty', $profile->practice_specialty) == 'internal_medicine' ? 'selected' : '' }}>Internal Medicine</option>
                            <option value="family_medicine" {{ old('specialty', $profile->practice_specialty) == 'family_medicine' ? 'selected' : '' }}>Family Medicine</option>
                            <option value="pediatrics" {{ old('specialty', $profile->practice_specialty) == 'pediatrics' ? 'selected' : '' }}>Pediatrics</option>
                            <option value="psychiatry" {{ old('specialty', $profile->practice_specialty) == 'psychiatry' ? 'selected' : '' }}>Psychiatry</option>
                            <option value="cardiology" {{ old('specialty', $profile->practice_specialty) == 'cardiology' ? 'selected' : '' }}>Cardiology</option>
                            <option value="dermatology" {{ old('specialty', $profile->practice_specialty) == 'dermatology' ? 'selected' : '' }}>Dermatology</option>
                            <option value="orthopedics" {{ old('specialty', $profile->practice_specialty) == 'orthopedics' ? 'selected' : '' }}>Orthopedics</option>
                            <option value="neurology" {{ old('specialty', $profile->practice_specialty) == 'neurology' ? 'selected' : '' }}>Neurology</option>
                            <option value="ob_gyn" {{ old('specialty', $profile->practice_specialty) == 'ob_gyn' ? 'selected' : '' }}>OB/GYN</option>
                            <option value="urology" {{ old('specialty', $profile->practice_specialty) == 'urology' ? 'selected' : '' }}>Urology</option>
                            <option value="oncology" {{ old('specialty', $profile->practice_specialty) == 'oncology' ? 'selected' : '' }}>Oncology</option>
                            <option value="endocrinology" {{ old('specialty', $profile->practice_specialty) == 'endocrinology' ? 'selected' : '' }}>Endocrinology</option>
                            <option value="gastroenterology" {{ old('specialty', $profile->practice_specialty) == 'gastroenterology' ? 'selected' : '' }}>Gastroenterology</option>
                            <option value="pulmonology" {{ old('specialty', $profile->practice_specialty) == 'pulmonology' ? 'selected' : '' }}>Pulmonology</option>
                            <option value="rheumatology" {{ old('specialty', $profile->practice_specialty) == 'rheumatology' ? 'selected' : '' }}>Rheumatology</option>
                            <option value="other" {{ old('specialty', $profile->practice_specialty) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('specialty')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="city" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">City</label>
                        <input
                            type="text"
                            name="city"
                            id="city"
                            value="{{ old('city', $profile->practice_city) }}"
                            required
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                            placeholder="New York"
                        >
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>
                    <div>
                        <label for="state" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">State</label>
                        <div class="relative">
                            <select
                                name="state"
                                id="state"
                                required
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all appearance-none"
                            >
                                <option value="">Select</option>
                                <option value="AL" {{ old('state', $profile->practice_state) == 'AL' ? 'selected' : '' }}>Alabama</option>
                                <option value="AK" {{ old('state', $profile->practice_state) == 'AK' ? 'selected' : '' }}>Alaska</option>
                                <option value="AZ" {{ old('state', $profile->practice_state) == 'AZ' ? 'selected' : '' }}>Arizona</option>
                                <option value="AR" {{ old('state', $profile->practice_state) == 'AR' ? 'selected' : '' }}>Arkansas</option>
                                <option value="CA" {{ old('state', $profile->practice_state) == 'CA' ? 'selected' : '' }}>California</option>
                                <option value="CO" {{ old('state', $profile->practice_state) == 'CO' ? 'selected' : '' }}>Colorado</option>
                                <option value="CT" {{ old('state', $profile->practice_state) == 'CT' ? 'selected' : '' }}>Connecticut</option>
                                <option value="DE" {{ old('state', $profile->practice_state) == 'DE' ? 'selected' : '' }}>Delaware</option>
                                <option value="FL" {{ old('state', $profile->practice_state) == 'FL' ? 'selected' : '' }}>Florida</option>
                                <option value="GA" {{ old('state', $profile->practice_state) == 'GA' ? 'selected' : '' }}>Georgia</option>
                                <option value="HI" {{ old('state', $profile->practice_state) == 'HI' ? 'selected' : '' }}>Hawaii</option>
                                <option value="ID" {{ old('state', $profile->practice_state) == 'ID' ? 'selected' : '' }}>Idaho</option>
                                <option value="IL" {{ old('state', $profile->practice_state) == 'IL' ? 'selected' : '' }}>Illinois</option>
                                <option value="IN" {{ old('state', $profile->practice_state) == 'IN' ? 'selected' : '' }}>Indiana</option>
                                <option value="IA" {{ old('state', $profile->practice_state) == 'IA' ? 'selected' : '' }}>Iowa</option>
                                <option value="KS" {{ old('state', $profile->practice_state) == 'KS' ? 'selected' : '' }}>Kansas</option>
                                <option value="KY" {{ old('state', $profile->practice_state) == 'KY' ? 'selected' : '' }}>Kentucky</option>
                                <option value="LA" {{ old('state', $profile->practice_state) == 'LA' ? 'selected' : '' }}>Louisiana</option>
                                <option value="ME" {{ old('state', $profile->practice_state) == 'ME' ? 'selected' : '' }}>Maine</option>
                                <option value="MD" {{ old('state', $profile->practice_state) == 'MD' ? 'selected' : '' }}>Maryland</option>
                                <option value="MA" {{ old('state', $profile->practice_state) == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                                <option value="MI" {{ old('state', $profile->practice_state) == 'MI' ? 'selected' : '' }}>Michigan</option>
                                <option value="MN" {{ old('state', $profile->practice_state) == 'MN' ? 'selected' : '' }}>Minnesota</option>
                                <option value="MS" {{ old('state', $profile->practice_state) == 'MS' ? 'selected' : '' }}>Mississippi</option>
                                <option value="MO" {{ old('state', $profile->practice_state) == 'MO' ? 'selected' : '' }}>Missouri</option>
                                <option value="MT" {{ old('state', $profile->practice_state) == 'MT' ? 'selected' : '' }}>Montana</option>
                                <option value="NE" {{ old('state', $profile->practice_state) == 'NE' ? 'selected' : '' }}>Nebraska</option>
                                <option value="NV" {{ old('state', $profile->practice_state) == 'NV' ? 'selected' : '' }}>Nevada</option>
                                <option value="NH" {{ old('state', $profile->practice_state) == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                                <option value="NJ" {{ old('state', $profile->practice_state) == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                                <option value="NM" {{ old('state', $profile->practice_state) == 'NM' ? 'selected' : '' }}>New Mexico</option>
                                <option value="NY" {{ old('state', $profile->practice_state) == 'NY' ? 'selected' : '' }}>New York</option>
                                <option value="NC" {{ old('state', $profile->practice_state) == 'NC' ? 'selected' : '' }}>North Carolina</option>
                                <option value="ND" {{ old('state', $profile->practice_state) == 'ND' ? 'selected' : '' }}>North Dakota</option>
                                <option value="OH" {{ old('state', $profile->practice_state) == 'OH' ? 'selected' : '' }}>Ohio</option>
                                <option value="OK" {{ old('state', $profile->practice_state) == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                                <option value="OR" {{ old('state', $profile->practice_state) == 'OR' ? 'selected' : '' }}>Oregon</option>
                                <option value="PA" {{ old('state', $profile->practice_state) == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                                <option value="RI" {{ old('state', $profile->practice_state) == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                                <option value="SC" {{ old('state', $profile->practice_state) == 'SC' ? 'selected' : '' }}>South Carolina</option>
                                <option value="SD" {{ old('state', $profile->practice_state) == 'SD' ? 'selected' : '' }}>South Dakota</option>
                                <option value="TN" {{ old('state', $profile->practice_state) == 'TN' ? 'selected' : '' }}>Tennessee</option>
                                <option value="TX" {{ old('state', $profile->practice_state) == 'TX' ? 'selected' : '' }}>Texas</option>
                                <option value="UT" {{ old('state', $profile->practice_state) == 'UT' ? 'selected' : '' }}>Utah</option>
                                <option value="VT" {{ old('state', $profile->practice_state) == 'VT' ? 'selected' : '' }}>Vermont</option>
                                <option value="VA" {{ old('state', $profile->practice_state) == 'VA' ? 'selected' : '' }}>Virginia</option>
                                <option value="WA" {{ old('state', $profile->practice_state) == 'WA' ? 'selected' : '' }}>Washington</option>
                                <option value="WV" {{ old('state', $profile->practice_state) == 'WV' ? 'selected' : '' }}>West Virginia</option>
                                <option value="WI" {{ old('state', $profile->practice_state) == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                                <option value="WY" {{ old('state', $profile->practice_state) == 'WY' ? 'selected' : '' }}>Wyoming</option>
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                    </div>
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Next
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>
