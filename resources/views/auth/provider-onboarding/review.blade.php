<x-provider-onboarding-layout title="Final Application Review" description="Step 10 of 10 • Review" currentStep="10">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.submit') }}" class="p-8 lg:p-12 space-y-10">
            @csrf

            <div class="space-y-8">
                <!-- Profile Summary -->
                <div class="p-6 bg-slate-50 border border-slate-100 rounded-3xl space-y-6">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-black text-slate-900">Profile Information</h4>
                        <a href="{{ route('provider.register.identity') }}" class="text-xs font-black uppercase tracking-widest text-indigo-600 hover:underline">Edit</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Full Name</p>
                            <p class="text-sm font-bold text-slate-700 mt-1">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Email</p>
                            <p class="text-sm font-bold text-slate-700 mt-1">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Provider Type</p>
                            <p class="text-sm font-bold text-slate-700 mt-1">{{ $profile->provider_type }} ({{ ucfirst($profile->entity_type) }})</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">NPI Number</p>
                            <p class="text-sm font-bold text-slate-700 mt-1">{{ $profile->npi_number }}</p>
                        </div>
                    </div>
                </div>

                <!-- Practice Summary -->
                <div class="p-6 bg-slate-50 border border-slate-100 rounded-3xl space-y-6">
                    <div class="flex items-center justify-between">
                        <h4 class="text-lg font-black text-slate-900">Practice & Services</h4>
                        <a href="{{ route('provider.register.license') }}" class="text-xs font-black uppercase tracking-widest text-indigo-600 hover:underline">Edit</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Practice Address</p>
                            <p class="text-sm font-bold text-slate-700 mt-1">{{ $profile->clinic_address }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Specialties</p>
                            <p class="text-sm font-bold text-slate-700 mt-1">
                                {{ $profile->specialties->pluck('name')->implode(', ') ?: 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Visit Types</p>
                            <p class="text-sm font-bold text-slate-700 mt-1 uppercase">
                                {{ collect($profile->visit_types)->implode(' & ') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-indigo-50 border border-indigo-100 rounded-3xl">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-indigo-600 text-white rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                        </div>
                        <div>
                            <h5 class="text-sm font-black text-slate-900">Ready to Submit?</h5>
                            <p class="text-xs font-bold text-slate-500 mt-0.5">Verification typically takes 24–48 hours.</p>
                        </div>
                    </div>
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Submit Application
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>
