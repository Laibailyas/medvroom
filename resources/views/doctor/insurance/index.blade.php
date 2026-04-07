<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter italic text-slate-900">Insurance Networks</h1>
                <p class="text-slate-500 font-bold mt-1 uppercase tracking-widest text-[10px]">Manage the insurance providers and plans your practice accepts.</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" form="insurance-form" class="px-8 py-4 bg-primary text-slate-900 rounded-[1.5rem] font-black text-sm hover:scale-105 transition-all shadow-xl shadow-primary/20 italic">
                    Update Participation
                </button>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-900 rounded-[2rem] p-8 text-white shadow-xl shadow-slate-900/10 flex items-center gap-6">
                <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center text-primary group-hover:rotate-6 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest italic leading-none">Accepted Networks</p>
                    <h3 class="text-3xl font-black italic tracking-tighter mt-1">{{ count($acceptedPlanIds) }}</h3>
                </div>
            </div>
        </div>

        <form id="insurance-form" action="{{ route('doctor.insurance.update') }}" method="POST" class="space-y-8 pb-20">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($providers as $provider)
                    <div class="bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm flex flex-col h-full group hover:ring-2 hover:ring-primary transition-all duration-500">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center overflow-hidden border border-slate-100 shrink-0">
                                    @if($provider->logo_url)
                                        <img src="{{ $provider->logo_url }}" class="w-8 h-8 object-contain">
                                    @else
                                        <span class="text-lg font-black text-slate-200">{{ substr($provider->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-black italic tracking-tighter text-slate-900">{{ $provider->name }}</h3>
                            </div>
                            <div class="text-[10px] font-black uppercase text-slate-400 italic">
                                {{ count($provider->plans) }} Plans
                            </div>
                        </div>

                        <div class="flex-1 space-y-3">
                            @foreach($provider->plans as $plan)
                                <label class="flex items-center gap-3 p-4 bg-slate-50 rounded-2xl cursor-pointer hover:bg-slate-100 transition-all border-2 border-transparent peer-checked:border-primary relative overflow-hidden group/item">
                                    <input 
                                        type="checkbox" 
                                        name="plans[]" 
                                        value="{{ $plan->id }}" 
                                        {{ in_array($plan->id, $acceptedPlanIds) ? 'checked' : '' }}
                                        class="sr-only peer"
                                    >
                                    <div class="w-5 h-5 rounded-md border-2 border-slate-200 peer-checked:bg-primary peer-checked:border-primary flex items-center justify-center transition-all">
                                        <svg class="w-3 h-3 text-slate-900 opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-bold text-slate-700 truncate peer-checked:text-slate-900">{{ $plan->name }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </form>
    </div>
</x-doctor-layout>
