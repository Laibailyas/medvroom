<x-app-layout>
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-10">
                <a href="{{ url()->previous() }}"
                    class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-100 text-slate-400 hover:text-slate-900 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter leading-none">Review and book</h1>
            </div>

            <!-- Provider Summary Card -->
            <div
                class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 mb-8 flex items-start gap-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-50/50 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                <div
                    class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center overflow-hidden border border-slate-100 shadow-sm relative z-10 shrink-0">
                    <img src="{{ $doctor->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 relative z-10">
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Dr. {{ $doctor->user->name }}</h3>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">
                        {{ $doctor->specialties->first()?->name ?? 'Specialist' }}</p>
                    <div
                        class="flex flex-wrap items-center gap-6 mt-5 text-[11px] font-black uppercase tracking-widest text-slate-500">
                        <div class="flex items-center gap-2.5">
                            <div
                                class="w-8 h-8 bg-slate-50 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-slate-900 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            {{ \Carbon\Carbon::parse($date)->format('D, M j') }} at {{ $time }}
                        </div>
                        <div class="flex items-center gap-2.5">
                            <div
                                class="w-8 h-8 bg-slate-50 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-slate-900 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                            Video Visit
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('booking.checkout') }}" method="POST" class="space-y-8">
                @csrf
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="time" value="{{ $time }}">
                <input type="hidden" name="specialty_id" value="{{ $specialty_id }}">

                <!-- Patient Section -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                    <h4
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 border-b border-slate-50 pb-4">
                        Patient information</h4>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center font-black text-slate-900 border border-slate-100">
                                {{ substr(auth()->user()->first_name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-xl font-black text-slate-900">{{ auth()->user()->name }} <span
                                        class="text-slate-300">(me)</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                    <h4
                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 border-b border-slate-50 pb-4">
                        Contact information</h4>
                    <div class="space-y-8">
                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Phone
                                number</label>
                            <input type="tel" name="phone" value="{{ auth()->user()->mobile }}"
                                placeholder="+1 (555) 000-0000"
                                class="w-full bg-slate-50/50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-0 focus:border-primary transition-all">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2">
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Street
                                    address</label>
                                <input type="text" name="address" placeholder="123 Medical Way"
                                    class="w-full bg-slate-50/50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-0 focus:border-primary transition-all">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">City</label>
                                <input type="text" name="city" placeholder="New York"
                                    class="w-full bg-slate-50/50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-0 focus:border-primary transition-all">
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Zip
                                    code</label>
                                <input type="text" name="zip" placeholder="10001"
                                    class="w-full bg-slate-50/50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-slate-900 focus:ring-0 focus:border-primary transition-all">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Section -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-10 border-b border-slate-50 pb-6">
                        <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Summary</h4>
                        <div class="text-right">
                            <p class="text-3xl font-black text-slate-900 tracking-tighter leading-none">
                                ${{ number_format($amount, 2) }}</p>
                            <p
                                class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-2 px-3 py-1 bg-slate-50 rounded-full inline-block border border-slate-100">
                                Consultation Fee</p>
                        </div>
                    </div>

                    <div class="space-y-4 mb-10">
                        <div class="flex items-start gap-4 bg-slate-50/80 p-6 rounded-[1.5rem] border border-slate-100">
                            <div class="relative flex items-center justify-center mt-0.5">
                                <input type="checkbox" id="telehealth_consent" required
                                    class="w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            </div>
                            <label for="telehealth_consent" class="text-[11px] font-bold text-slate-500 leading-relaxed italic">
                                I have read and agree to the <a href="{{ route('telehealth-consent') }}" target="_blank"
                                    class="text-primary hover:underline font-black not-italic">Telehealth Informed Consent</a>. I understand that I am consenting to receive care via telehealth.
                            </label>
                        </div>

                        <div class="flex items-start gap-4 bg-slate-50/80 p-6 rounded-[1.5rem] border border-slate-100">
                            <div class="relative flex items-center justify-center mt-0.5">
                                <input type="checkbox" id="terms" required
                                    class="w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            </div>
                            <label for="terms" class="text-[11px] font-bold text-slate-500 leading-relaxed italic">
                                I certify that the information provided is correct and I agree to the <a href="{{ route('terms') }}" target="_blank"
                                    class="text-primary hover:underline font-black not-italic">Terms of Use</a> and <a href="{{ route('privacy') }}" target="_blank"
                                    class="text-primary hover:underline font-black not-italic">Privacy Policy</a>. I
                                understand that the platform handles payments securely via Stripe.
                            </label>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 text-white py-6 rounded-[1.5rem] font-black uppercase tracking-[0.25em] shadow-2xl shadow-slate-900/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-4 relative overflow-hidden group">
                        <div
                            class="absolute inset-0 bg-primary transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        </div>
                        <span class="relative z-10 group-hover:text-slate-900">Proceed to Payment</span>
                        <svg class="w-4 h-4 text-primary group-hover:text-slate-900 relative z-10 transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>

                    <div class="flex items-center justify-center gap-4 mt-8 opacity-40">
                        <img src="https://stripe.com/img/v3/home/logos/stripe.svg" class="h-6" alt="Stripe">
                        <div class="w-px h-4 bg-slate-300"></div>
                        <span
                            class="text-[9px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-1.5">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Secure Hosted Checkout
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <style>
            .scrollbar-premium::-webkit-scrollbar {
                width: 6px;
            }

            .scrollbar-premium::-webkit-scrollbar-track {
                background: transparent;
            }

            .scrollbar-premium::-webkit-scrollbar-thumb {
                background: #e2e8f0;
                border-radius: 10px;
            }
        </style>
    @endpush
</x-app-layout>
