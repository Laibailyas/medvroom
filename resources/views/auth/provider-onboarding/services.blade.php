<x-provider-onboarding-layout title="Services & Insurance" description="Step 5 of 10 • Practice Offerings" currentStep="5">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.services.store') }}" class="p-8 lg:p-12 space-y-10">
            @csrf

            <div class="space-y-10">
                <!-- Specialties -->
                <div>
                    <h4 class="text-sm font-black uppercase tracking-widest text-slate-500 mb-6">Select your Specialties</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-[300px] overflow-y-auto p-4 bg-slate-50 rounded-3xl border border-slate-100">
                        @foreach($specialties as $specialty)
                        <label class="flex items-center p-3 bg-white border border-slate-100 rounded-xl cursor-pointer hover:border-indigo-600 transition-all group">
                            <input type="checkbox" name="specialties[]" value="{{ $specialty->id }}" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 mr-3">
                            <span class="text-sm font-bold text-slate-700">{{ $specialty->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('specialties')" class="mt-2" />
                </div>

                <!-- Insurance -->
                <div>
                    <h4 class="text-sm font-black uppercase tracking-widest text-slate-500 mb-6">Insurances Accepted</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-[300px] overflow-y-auto p-4 bg-slate-50 rounded-3xl border border-slate-100">
                        @foreach($insurances as $insurance)
                        <label class="flex items-center p-3 bg-white border border-slate-100 rounded-xl cursor-pointer hover:border-indigo-600 transition-all group">
                            <input type="checkbox" name="insurances[]" value="{{ $insurance->id }}" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 mr-3">
                            <span class="text-sm font-bold text-slate-700">{{ $insurance->name }}</span>
                        </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('insurances')" class="mt-2" />
                </div>

                <!-- Visit Types -->
                <div>
                    <h4 class="text-sm font-black uppercase tracking-widest text-slate-500 mb-6">Visit Types Offered</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative flex items-center p-6 bg-slate-50 border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100 transition-all group">
                            <input type="checkbox" name="visit_types[]" value="in-person" class="sr-only peer" checked>
                            <div class="w-6 h-6 border-2 border-slate-300 rounded-lg flex items-center justify-center peer-checked:border-indigo-600 peer-checked:bg-indigo-600 mr-4 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 peer-checked:opacity-100 transition-all"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <div>
                                <span class="block text-lg font-black text-slate-900 leading-none">In-person</span>
                                <span class="text-xs font-bold text-slate-500 mt-1 uppercase tracking-widest">Office visit</span>
                            </div>
                            <div class="absolute inset-0 border-2 border-indigo-600 rounded-2xl opacity-0 peer-checked:opacity-100 transition-all pointer-events-none"></div>
                        </label>
                        <label class="relative flex items-center p-6 bg-slate-50 border-2 border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-100 transition-all group">
                            <input type="checkbox" name="visit_types[]" value="telehealth" class="sr-only peer">
                            <div class="w-6 h-6 border-2 border-slate-300 rounded-lg flex items-center justify-center peer-checked:border-indigo-600 peer-checked:bg-indigo-600 mr-4 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="opacity-0 peer-checked:opacity-100 transition-all"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <div>
                                <span class="block text-lg font-black text-slate-900 leading-none">Telehealth</span>
                                <span class="text-xs font-bold text-slate-500 mt-1 uppercase tracking-widest">Video call</span>
                            </div>
                            <div class="absolute inset-0 border-2 border-indigo-600 rounded-2xl opacity-0 peer-checked:opacity-100 transition-all pointer-events-none"></div>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('visit_types')" class="mt-2" />
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Continue to Schedule
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>
