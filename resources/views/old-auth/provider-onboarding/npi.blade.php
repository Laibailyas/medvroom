<x-provider-onboarding-layout title="Find your medical profile" description="Step 3 of 10 • NPI Verification" currentStep="3">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden" 
         x-data="{ 
            npi: '', 
            loading: false, 
            found: false, 
            error: '',
            provider: { name: '', specialty: '', address: '', raw: '' },
            lookup() {
                if (this.npi.length !== 10) return;
                this.loading = true;
                this.error = '';
                this.found = false;
                
                fetch(`/register/provider/npi-lookup?npi=${this.npi}`)
                    .then(res => res.json())
                    .then(data => {
                        this.loading = false;
                        if (data.found) {
                            this.found = true;
                            this.provider = data;
                        } else {
                            this.error = data.error || 'No provider found with this NPI number.';
                        }
                    })
                    .catch(() => {
                        this.loading = false;
                        this.error = 'Something went wrong. Please check your connection.';
                    });
            }
         }">
        <form method="POST" action="{{ route('provider.register.npi.store') }}" class="p-8 lg:p-12 space-y-8">
            @csrf
            <input type="hidden" name="npi_confirmed" :value="found ? 1 : 0">
            <input type="hidden" name="npi_raw" :value="JSON.stringify(provider.raw)">

            <div class="space-y-6">
                <div>
                    <label for="npi_number" class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-2">NPI Number (10 Digits)</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="npi_number" 
                            id="npi_number" 
                            maxlength="10"
                            required
                            x-model="npi"
                            @input="if(npi.length === 10) lookup()"
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                            placeholder="1234567890"
                        >
                        <div class="absolute right-5 top-1/2 -translate-y-1/2" x-show="loading">
                            <svg class="animate-spin h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-2 text-xs font-medium text-slate-400">Enter your 10-digit National Provider Identifier.</p>
                    <x-input-error :messages="$errors->get('npi_number')" class="mt-2" />
                    <template x-if="error">
                        <p class="mt-2 text-sm font-bold text-rose-600" x-text="error"></p>
                    </template>
                </div>

                <!-- Preview Card (Magic Moment) -->
                <div x-show="found" x-transition class="p-6 bg-emerald-50 border-2 border-emerald-100 rounded-3xl space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-emerald-600">Profile Found</p>
                            <h4 class="text-xl font-black text-slate-900 leading-none mt-1" x-text="provider.name"></h4>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-emerald-100">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Primary Specialty</p>
                            <p class="text-sm font-bold text-slate-700 mt-1" x-text="provider.specialty || 'N/A'"></p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Primary Address</p>
                            <p class="text-sm font-bold text-slate-700 mt-1" x-text="provider.address || 'N/A'"></p>
                        </div>
                    </div>
                </div>

                <div x-show="found" class="space-y-6 pt-4">
                    <h5 class="text-sm font-black uppercase tracking-widest text-slate-500">Confirm Practice Details</h5>
                    <div class="space-y-4">
                        <div>
                            <label for="clinic_name" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Practice/Clinic Name</label>
                            <input 
                                type="text" 
                                name="clinic_name" 
                                id="clinic_name" 
                                x-model="provider.name"
                                placeholder="e.g. City Health Clinic"
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all placeholder:text-slate-400 placeholder:font-medium"
                            >
                        </div>
                        <div>
                            <label for="clinic_address" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Full Practice Address</label>
                            <textarea 
                                name="clinic_address" 
                                id="clinic_address" 
                                rows="2"
                                x-model="provider.address"
                                placeholder="123 Medical Dr, Suite 100, City, State, ZIP"
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all resize-none placeholder:text-slate-400 placeholder:font-medium"
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <x-button 
                type="submit" 
                size="full"
                class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30"
                ::disabled="!found"
            >
                Confirm & Continue
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
            
            <p x-show="!found" class="text-center text-sm font-bold text-slate-400">
                Don't have an NPI? <button type="button" class="text-indigo-600 hover:underline">Apply for one here</button>
            </p>
        </form>
    </div>
</x-provider-onboarding-layout>
