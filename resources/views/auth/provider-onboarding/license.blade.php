<x-provider-onboarding-layout title="Licensing & Practice" description="Step 4 of 10 • Credentials" currentStep="4">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden" 
         x-data="{ 
            licenses: [
                { state: '', number: '', expiry: '' }
            ],
            addLicense() {
                this.licenses.push({ state: '', number: '', expiry: '' });
            ,
            removeLicense(index) {
                if(this.licenses.length > 1) {
                    this.licenses.splice(index, 1);
                }
            }
         }">
        <form method="POST" action="{{ route('provider.register.license.store') }}" class="p-8 lg:p-12 space-y-10">
            @csrf

            <div class="space-y-8">
                <div>
                    <h4 class="text-lg font-black text-slate-900 mb-6">State Medical Licenses</h4>
                    
                    <div class="space-y-6">
                        <template x-for="(license, index) in licenses" :key="index">
                            <div class="p-6 bg-slate-50 border border-slate-100 rounded-3xl relative group">
                                <button type="button" 
                                        @click="removeLicense(index)" 
                                        x-show="licenses.length > 1"
                                        class="absolute -top-2 -right-2 w-8 h-8 bg-rose-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-rose-500/30 opacity-0 group-hover:opacity-100 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </button>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">State</label>
                                        <select :name="`licenses[${index}][state]`" required x-model="license.state" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 text-sm font-bold appearance-none">
                                            <option value="">Select</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WA">Washington</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">License Number</label>
                                        <input type="text" :name="`licenses[${index}][number]`" required x-model="license.number" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 text-sm font-bold placeholder:text-slate-400 placeholder:font-medium" placeholder="12345-AB">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Expiration Date</label>
                                        <input type="date" :name="`licenses[${index}][expiry]`" required x-model="license.expiry" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 text-sm font-bold">
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <button type="button" @click="addLicense" class="mt-6 flex items-center space-x-2 text-indigo-600 font-bold hover:text-indigo-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        <span>Add another state license</span>
                    </button>
                </div>

                <div class="pt-8 border-t border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="practice_zip_code" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">Practice ZIP Code</label>
                        <input type="text" name="practice_zip_code" id="practice_zip_code" required value="{{ old('practice_zip_code') }}" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium" placeholder="90210">
                        <x-input-error :messages="$errors->get('practice_zip_code')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-4">Do you offer Telehealth?</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex-1 relative flex items-center p-4 bg-slate-50 border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100 transition-all group">
                                <input type="radio" name="telehealth_available" value="1" class="sr-only peer" checked>
                                <div class="w-5 h-5 border-2 border-slate-300 rounded-full flex items-center justify-center peer-checked:border-indigo-600 peer-checked:bg-indigo-600 mr-3 transition-all">
                                    <div class="w-1.5 h-1.5 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-all"></div>
                                </div>
                                <span class="text-sm font-black text-slate-900 leading-none">Yes</span>
                                <div class="absolute inset-0 border-2 border-indigo-600 rounded-2xl opacity-0 peer-checked:opacity-100 transition-all pointer-events-none"></div>
                            </label>
                            <label class="flex-1 relative flex items-center p-4 bg-slate-50 border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100 transition-all group">
                                <input type="radio" name="telehealth_available" value="0" class="sr-only peer">
                                <div class="w-5 h-5 border-2 border-slate-300 rounded-full flex items-center justify-center peer-checked:border-indigo-600 peer-checked:bg-indigo-600 mr-3 transition-all">
                                    <div class="w-1.5 h-1.5 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-all"></div>
                                </div>
                                <span class="text-sm font-black text-slate-900 leading-none">No</span>
                                <div class="absolute inset-0 border-2 border-indigo-600 rounded-2xl opacity-0 peer-checked:opacity-100 transition-all pointer-events-none"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Continue to Services
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>
