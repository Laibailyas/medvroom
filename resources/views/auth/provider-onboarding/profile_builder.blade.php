<x-provider-onboarding-layout title="Complete Your Profile" description="Step 8 of 8 • Build while you wait" currentStep="8">
    <div class="space-y-6">

        {{-- Pending badge --}}
        <div class="flex items-center justify-center space-x-2 px-5 py-3 bg-amber-50 border border-amber-200 rounded-2xl">
            <span class="w-2 h-2 bg-amber-400 rounded-full animate-pulse"></span>
            <p class="text-sm font-black text-amber-700 uppercase tracking-widest">Pending Approval — Profile active once approved</p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
            <form method="POST" action="{{ route('provider.register.profile-builder.store') }}" enctype="multipart/form-data" class="p-8 lg:p-12 space-y-10">
                @csrf

                {{-- Bio --}}
                <div class="space-y-3">
                    <label for="bio" class="block text-sm font-black uppercase tracking-widest text-slate-500">Bio</label>
                    <textarea
                        name="bio"
                        id="bio"
                        rows="5"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-base font-medium text-slate-700 transition-all resize-none placeholder:text-slate-400"
                        placeholder="Tell patients about yourself — your experience, approach, and what makes your practice unique..."
                    >{{ old('bio', $profile->bio ?? '') }}</textarea>
                    <p class="text-xs font-medium text-slate-400">Tip: Profiles with a complete bio get 3× more patient views.</p>
                    <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                </div>

                {{-- Photo --}}
                <div class="space-y-3" x-data="{ preview: null }">
                    <label class="block text-sm font-black uppercase tracking-widest text-slate-500">Profile Photo</label>
                    <label class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-slate-50 hover:border-indigo-400 transition-all group">
                        <input
                            type="file"
                            name="profile_photo"
                            accept="image/*"
                            class="sr-only"
                            @change="preview = URL.createObjectURL($event.target.files[0])"
                        >
                        <template x-if="!preview">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <div class="w-16 h-16 bg-slate-100 text-slate-400 group-hover:text-indigo-500 rounded-full flex items-center justify-center transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm font-bold text-slate-500 group-hover:text-indigo-600 transition-colors">Click to upload your photo</p>
                                    <p class="text-xs font-medium text-slate-400 mt-1 uppercase tracking-widest">PNG, JPG up to 5MB</p>
                                </div>
                            </div>
                        </template>
                        <template x-if="preview">
                            <img :src="preview" class="w-full h-full object-cover rounded-2xl">
                        </template>
                    </label>
                    <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
                </div>

                {{-- Availability Calendar --}}
                <div class="space-y-4" x-data="{
                    days: [
                        { id: 1, name: 'Monday', active: true, start: '09:00', end: '17:00' },
                        { id: 2, name: 'Tuesday', active: true, start: '09:00', end: '17:00' },
                        { id: 3, name: 'Wednesday', active: true, start: '09:00', end: '17:00' },
                        { id: 4, name: 'Thursday', active: true, start: '09:00', end: '17:00' },
                        { id: 5, name: 'Friday', active: true, start: '09:00', end: '17:00' },
                        { id: 6, name: 'Saturday', active: false, start: '09:00', end: '13:00' },
                        { id: 0, name: 'Sunday', active: false, start: '09:00', end: '13:00' }
                    ]
                }">
                    <label class="block text-sm font-black uppercase tracking-widest text-slate-500">Availability Calendar</label>
                    <p class="text-xs font-medium text-slate-400">Set your weekly hours. You can update these anytime from your dashboard.</p>
                    <div class="space-y-3 mt-3">
                        <template x-for="(day, index) in days" :key="day.id">
                            <div class="flex flex-col md:flex-row items-center gap-4 p-4 rounded-2xl transition-all" :class="day.active ? 'bg-slate-50 border border-slate-100' : 'opacity-50'">
                                <div class="w-full md:w-32 flex items-center space-x-3">
                                    <input type="checkbox" x-model="day.active" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                                    <span class="text-sm font-black text-slate-900" x-text="day.name"></span>
                                </div>
                                <div class="flex-1 flex items-center gap-4 w-full" x-show="day.active">
                                    <input type="hidden" :name="`schedule[${index}][day]`" :value="day.id">
                                    <input type="time" :name="`schedule[${index}][start]`" x-model="day.start" class="flex-1 px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 text-sm font-bold">
                                    <span class="text-slate-400 font-bold text-sm">to</span>
                                    <input type="time" :name="`schedule[${index}][end]`" x-model="day.end" class="flex-1 px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 text-sm font-bold">
                                </div>
                                <div class="flex-1 text-center py-2 text-slate-400 text-sm font-bold italic" x-show="!day.active">Closed</div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Pricing --}}
                <div class="space-y-4">
                    <label class="block text-sm font-black uppercase tracking-widest text-slate-500">Pricing</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price_initial" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Initial Visit (USD)</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-lg font-black text-slate-400">$</span>
                                <input
                                    type="number"
                                    name="price_initial"
                                    id="price_initial"
                                    value="{{ old('price_initial', $profile->price_initial ?? '') }}"
                                    min="0"
                                    step="5"
                                    class="w-full pl-10 pr-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 text-lg font-bold transition-all"
                                    placeholder="150"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('price_initial')" class="mt-2" />
                        </div>
                        <div>
                            <label for="price_followup" class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Follow-up Visit (USD)</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-lg font-black text-slate-400">$</span>
                                <input
                                    type="number"
                                    name="price_followup"
                                    id="price_followup"
                                    value="{{ old('price_followup', $profile->price_followup ?? '') }}"
                                    min="0"
                                    step="5"
                                    class="w-full pl-10 pr-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 text-lg font-bold transition-all"
                                    placeholder="75"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('price_followup')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                    Save Profile
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </x-button>

                <p class="text-center text-sm font-medium text-slate-400">
                    Your profile will go live automatically once you're approved.
                </p>
            </form>

            {{-- Go to Dashboard / Back to other steps --}}
            <div class="px-8 lg:px-12 pb-10 -mt-4 space-y-3">
                @if($profile->application_submitted_at ?? false)
                    <a
                        href="{{ route('provider.register.status') }}"
                        class="inline-flex items-center justify-center w-full px-8 py-5 bg-white border-2 border-slate-200 text-slate-700 text-lg font-black uppercase tracking-widest rounded-2xl hover:border-indigo-300 hover:text-indigo-600 transition-colors group"
                    >
                        Need to update practice, license, or documents?
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                @endif
                <a
                    href="{{ route('dashboard') }}"
                    class="inline-flex items-center justify-center w-full px-8 py-5 bg-white border-2 border-slate-200 text-slate-700 text-lg font-black uppercase tracking-widest rounded-2xl hover:border-indigo-300 hover:text-indigo-600 transition-colors group"
                >
                    Go to Dashboard
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</x-provider-onboarding-layout>