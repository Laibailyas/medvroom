<x-provider-onboarding-layout title="Set your availability" description="Step 6 of 10 • Weekly Schedule" currentStep="6">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden"
         x-data="{ 
            days: [
                { id: 1, name: 'Monday', active: true, start: '09:00', end: '17:00' },
                { id: 2, name: 'Tuesday', active: true, start: '09:00', end: '17:00' },
                { id: 3, name: 'Wednesday', active: true, start: '09:00', end: '17:00' },
                { id: 4, name: 'Thursday', active: true, start: '09:00', end: '17:00' },
                { id: 5, name: 'Friday', active: true, start: '09:00', end: '17:00' },
                { id: 6, name: 'Saturday', active: false, start: '09:00', end: '17:00' },
                { id: 0, name: 'Sunday', active: false, start: '09:00', end: '17:00' }
            ]
         }">
        <form method="POST" action="{{ route('provider.register.schedule.store') }}" class="p-8 lg:p-12 space-y-10">
            @csrf

            <div class="space-y-6">
                <p class="text-slate-600 font-medium text-center max-w-md mx-auto">
                    Set your standard working hours. You can refine this and block specific dates in your dashboard later.
                </p>

                <div class="space-y-4">
                    <template x-for="(day, index) in days" :key="day.id">
                        <div class="flex flex-col md:flex-row items-center gap-4 p-4 rounded-2xl transition-all" :class="day.active ? 'bg-slate-50 border border-slate-100' : 'opacity-50'">
                            <div class="w-full md:w-32 flex items-center space-x-3">
                                <input type="checkbox" x-model="day.active" class="w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                                <span class="text-sm font-black text-slate-900" x-text="day.name"></span>
                            </div>

                            <div class="flex-1 flex items-center gap-4 w-full" x-show="day.active">
                                <input type="hidden" :name="`schedule[${index}][day]`" :value="day.id">
                                <div class="flex-1">
                                    <input type="time" :name="`schedule[${index}][start]`" x-model="day.start" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 text-sm font-bold">
                                </div>
                                <span class="text-slate-400 font-bold">to</span>
                                <div class="flex-1">
                                    <input type="time" :name="`schedule[${index}][end]`" x-model="day.end" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 text-sm font-bold">
                                </div>
                            </div>
                            
                            <div class="flex-1 text-center py-3 text-slate-400 text-sm font-bold italic" x-show="!day.active">
                                Closed
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Continue to Documents
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>
