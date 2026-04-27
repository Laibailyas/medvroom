<div x-data="{ 
        isOpen: false, 
        doctor: null, 
        date: '', 
        slots: [],
        selectedTime: '',
        specialty: '',
        patientType: 'new',
        visitType: 'person'
    }"
    x-on:open-booking-modal.window="
        doctor = $event.detail.doctor;
        date = $event.detail.date;
        slots = $event.detail.slots;
        patientType = $event.detail.patientType || 'new';
        visitType = $event.detail.visitType || 'person';
        isOpen = true;
        selectedTime = '';
        specialty = '';
    "
    x-show="isOpen"
    class="fixed inset-0 z-[60] overflow-y-auto"
    style="display: none;"
>
    <!-- Overlay -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" 
        x-show="isOpen" 
        x-transition:enter="ease-out duration-300" 
        x-transition:enter-start="opacity-0" 
        x-transition:enter-end="opacity-100" 
        x-transition:leave="ease-in duration-200" 
        x-transition:leave-start="opacity-100" 
        x-transition:leave-end="opacity-0" 
        @click="isOpen = false"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-[2.5rem] bg-white p-8 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
            x-show="isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            <button @click="isOpen = false" class="absolute right-8 top-8 text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>

            <div class="flex items-center gap-6 mb-10">
                <div class="w-20 h-20 bg-yellow-50 rounded-2xl flex items-center justify-center overflow-hidden border border-yellow-100 shadow-sm">
                    <template x-if="doctor?.user?.profile_photo_url">
                        <img :src="doctor.user.profile_photo_url" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!doctor?.user?.profile_photo_url">
                        <div class="w-full h-full flex items-center justify-center bg-primary/10">
                            <span class="text-2xl font-black text-primary" x-text="doctor?.user?.name ? doctor.user.name[0] : 'D'"></span>
                        </div>
                    </template>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 leading-tight tracking-tighter">Book Appointment</h3>
                    <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1.5" x-text="doctor ? `Dr. ${doctor.user.name}` : ''"></p>
                </div>
            </div>

            <div class="space-y-10">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">1. Choose a time for <span class="text-slate-900" x-text="date"></span></label>
                    <div class="grid grid-cols-4 gap-2 max-h-48 overflow-y-auto pr-2 scrollbar-premium">
                        <template x-for="slot in slots">
                            <button @click="selectedTime = slot" 
                                :class="selectedTime === slot ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-50 text-slate-700 hover:bg-slate-100 border-transparent'"
                                class="py-3 rounded-xl text-xs font-black transition-all border shadow-sm" 
                                x-text="slot">
                            </button>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">2. Reason for visit</label>
                    <div class="relative">
                        <select x-model="specialty" class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-slate-700 focus:ring-0 focus:border-primary transition-all appearance-none">
                            <option value="">Select a reason...</option>
                            <template x-for="spec in doctor?.specialties">
                                <option :value="spec.id" x-text="spec.name"></option>
                            </template>
                            <option value="other">General Consultation</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button 
                        @click="if(selectedTime && specialty) window.location.href = `/booking/review?doctor_id=${doctor.id}&date=${date}&time=${selectedTime}&specialty_id=${specialty}&patient_type=${patientType}&visit_type=${visitType}`"
                        :disabled="!selectedTime || !specialty"
                        class="w-full bg-primary disabled:opacity-50 disabled:grayscale disabled:cursor-not-allowed text-slate-900 py-6 rounded-[1.5rem] font-black uppercase tracking-[0.2em] shadow-2xl shadow-yellow-900/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3"
                    >
                        <span>Continue to Review</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
