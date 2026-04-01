<x-app-layout>
    <!-- Hero Section -->
    <section class="relative bg-[#fffce6] pt-20 pb-28 min-h-[600px] flex items-center overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="max-w-xl">
                    <h1 class="text-5xl md:text-6xl font-black tracking-tight text-[#2d333f] mb-8 leading-[1.1]">
                        Book local <br />
                        who take your <span class="text-secondary">insurance</span>
                    </h1>

                    <!-- Zocdoc 3-Field Search Engine -->
                    <div class="bg-white rounded-xl shadow-2xl shadow-yellow-900/10 border border-yellow-200 p-1.5 relative z-20">
                        <div class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-slate-100">
                            <!-- Field 1: Reason -->
                            <div class="flex-[1.2] flex flex-col px-4 py-3">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-0.5">Condition / Specialty</label>
                                <div class="flex items-center flex-1">
                                    <input type="text" placeholder="Condition, specialty, doctor..." class="w-full text-sm font-bold text-slate-700 placeholder-slate-300 focus:outline-none bg-transparent">
                                </div>
                            </div>
                            <!-- Field 2: Location -->
                            <div class="flex-1 flex flex-col px-4 py-3">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-0.5">Location</label>
                                <div class="flex items-center flex-1">
                                    <input type="text" placeholder="City, state, or ZIP code" class="w-full text-sm font-bold text-slate-700 placeholder-slate-300 focus:outline-none bg-transparent">
                                </div>
                            </div>
                            <!-- Field 3: Insurance -->
                            <div class="flex-1 flex flex-col px-4 py-3">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-0.5">Insurance</label>
                                <div class="flex items-center flex-1">
                                    <input type="text" placeholder="Choose your carrier" class="w-full text-sm font-bold text-slate-700 placeholder-slate-300 focus:outline-none bg-transparent">
                                </div>
                            </div>
                            <!-- Search Button -->
                            <div class="p-1 flex items-center">
                                <button class="w-full lg:w-16 h-14 bg-[#fff04b] hover:bg-[#ffe600] rounded-lg flex items-center justify-center text-slate-900 transition-all shadow-sm active:scale-95 group">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="hidden lg:flex justify-end pr-8">
                    <img src="/hero_illustration_hands_card_1775055031796.png" alt="Health Care" class="max-w-[400px] animate-float drop-shadow-2xl translate-x-20">
                </div>
            </div>
        </div>
        
        <!-- Decorative subtle accent -->
        <div class="absolute -bottom-1 left-0 right-0 h-1bg-white skew-y-1 origin-right"></div>
    </section>

    <!-- Insurance Carriers -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-8">Featured insurance carriers on MedVroom</p>
            <div class="flex flex-wrap items-center justify-between gap-8 opacity-60 hover:opacity-100 transition-opacity duration-500">
                @foreach($featuredInsurances as $insurance)
                    <img src="{{ $insurance->logo }}" alt="{{ $insurance->name }}" class="h-8 md:h-12 w-auto grayscale hover:grayscale-0 transition-all duration-300 transform hover:scale-105">
                @endforeach
                <a href="#" class="text-sm font-bold text-slate-400 hover:text-primary transition-colors underline decoration-slate-200 underline-offset-4">See all +1,000 carrier plans</a>
            </div>
        </div>
    </section>

    <!-- Top Searched Specialties -->
    <section class="py-24 bg-[#fffef4]/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-xl font-black text-slate-800 mb-12 uppercase tracking-wide">Top-searched specialties</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                @foreach($specialties->take(6) as $specialty)
                    <a href="#" class="group block bg-[#fffef4] border border-yellow-100 p-8 rounded-2xl text-center shadow-sm hover:shadow-xl hover:shadow-yellow-900/5 hover:border-yellow-200 transition-all duration-300 transform hover:-translate-y-1">
                        <div class="w-16 h-16 mx-auto mb-6 flex items-center justify-center bg-white rounded-full shadow-inner shadow-yellow-900/5 group-hover:scale-110 transition-transform">
                            <!-- In a real app, icons would be mapped or stored as SVGs -->
                            <svg class="w-8 h-8 text-[#ffe600]" fill="currentColor" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-black text-slate-700 group-hover:text-slate-900 transition-colors uppercase tracking-tight">{{ $specialty->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Value Propositions -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tighter italic">MedVroom helps you when you need care</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="bg-white rounded-[2.5rem] p-1 shadow-2xl shadow-indigo-900/5 border border-slate-50 flex flex-col group overflow-hidden">
                    <div class="bg-[#f0f9ff] h-64 rounded-t-[2.3rem] flex items-center justify-center p-8 overflow-hidden">
                        <img src="/feature_doctors_holding_card_1775055067077.png" alt="Caring Doctors" class="group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-10 text-center flex-1">
                        <h3 class="text-xl font-black text-slate-800 mb-4 leading-tight">Find a doctor who <br/>takes your insurance</h3>
                        <a href="#" class="inline-block mt-4 text-xs font-black uppercase tracking-widest text-slate-900 border-b-4 border-[#fff04b] hover:border-[#ffe600] pb-1 transition-colors">Start searching</a>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-[2.5rem] p-1 shadow-2xl shadow-indigo-900/5 border border-slate-50 flex flex-col group overflow-hidden">
                    <div class="bg-[#fdf2f8] h-64 rounded-t-[2.3rem] flex items-center justify-center p-8 overflow-hidden">
                        <img src="/feature_doctor_star_rating_1775055177169.png" alt="Reviews" class="group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="p-10 text-center flex-1">
                        <h3 class="text-xl font-black text-slate-800 mb-4 leading-tight">See doctors from <br/>our verified network</h3>
                        <a href="#" class="inline-block mt-4 text-xs font-black uppercase tracking-widest text-slate-900 border-b-4 border-[#fff04b] hover:border-[#ffe600] pb-1 transition-colors">Read reviews</a>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-[2.5rem] p-1 shadow-2xl shadow-indigo-900/5 border border-slate-50 flex flex-col group overflow-hidden">
                    <div class="bg-[#eff6ff] h-64 rounded-t-[2.3rem] flex items-center justify-center p-12 overflow-hidden relative">
                        <div class="w-32 h-32 bg-[#fff04b] rounded-full absolute -top-10 -right-10 opacity-20"></div>
                        <div class="w-24 h-24 bg-secondary rounded-full absolute -bottom-8 -left-8 opacity-10"></div>
                        <div class="relative z-10 p-6 bg-white rounded-xl shadow-lg border border-slate-100/50">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                                </div>
                                <div class="flex-1 space-y-1">
                                    <div class="h-1.5 w-16 bg-slate-100 rounded"></div>
                                    <div class="h-1.5 w-10 bg-slate-50 rounded"></div>
                                </div>
                                <div class="flex space-x-0.5">
                                    @for($i=0; $i<5; $i++) <div class="w-1.5 h-1.5 text-yellow-400">★</div> @endfor
                                </div>
                            </div>
                            <div class="h-2 w-full bg-[#fff04b]/30 rounded mb-2"></div>
                            <div class="h-2 w-3/4 bg-slate-50 rounded"></div>
                        </div>
                    </div>
                    <div class="p-10 text-center flex-1">
                        <h3 class="text-xl font-black text-slate-800 mb-4 leading-tight">Personalize your search <br/>to find high-quality care</h3>
                        <a href="#" class="inline-block mt-4 text-xs font-black uppercase tracking-widest text-slate-900 border-b-4 border-[#fff04b] hover:border-[#ffe600] pb-1 transition-colors">Apply filters</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Practice CTA -->
    <section class="py-24 bg-white border-t border-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-20">
                <div class="flex-1 relative">
                    <img src="/practice_cta_doctor_desk_1775055348654.png" alt="Join MedVroom" class="w-full relative z-10">
                    <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-[#fff04b]/20 rounded-full blur-3xl"></div>
                </div>
                <div class="flex-1 space-y-8">
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400">Section for healthcare providers</p>
                    <h2 class="text-4xl font-black text-slate-800 leading-tight">Are you a practice interested in <span class="italic">filling your calendar?</span></h2>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-secondary/10 rounded-full flex items-center justify-center text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-600">You reach more people in our massive local patient network.</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-secondary/10 rounded-full flex items-center justify-center text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-600">You provide a seamless digital booking experience for your patients.</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-secondary/10 rounded-full flex items-center justify-center text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-600">You strengthen your online reputation with verified patient reviews.</span>
                        </li>
                    </ul>
                    <a href="{{ route('register.doctor') }}" class="inline-flex items-center px-10 py-4 bg-[#fff04b] hover:bg-[#ffe600] text-slate-900 text-sm font-black uppercase tracking-widest rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        List your practice on MedVroom
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Health Systems -->
    <section class="py-24 bg-white border-t border-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-block px-8 py-3 bg-slate-50 rounded-full mb-12">
                <p class="text-sm font-bold text-slate-500">Trusted by top health systems we know</p>
            </div>
            
            <div class="flex flex-wrap items-center justify-center gap-16 opacity-40">
                <span class="text-2xl font-black italic text-slate-900 tracking-tighter">Montefiore</span>
                <span class="text-2xl font-black text-slate-900 tracking-tighter flex items-center gap-1">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    Methodist
                </span>
                <span class="text-2xl font-black text-slate-900 uppercase tracking-widest">Mount Sinai</span>
                <span class="text-2xl font-black italic underline decoration-slate-400 decoration-4 text-slate-900">Beth Israel Health</span>
            </div>
        </div>
    </section>

    <!-- Footer Grids -->
    <section class="py-24 bg-[#fffef4]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16">
                <!-- Find by City -->
                <div>
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-10 border-l-4 border-[#fff04b] pl-4">Find doctors and dentists by city</h2>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-8">
                        @foreach(['New York City', 'Houston', 'Los Angeles', 'Atlanta', 'Chicago', 'Dallas', 'Philadelphia', 'Austin', 'Miami', 'San Francisco', 'Phoenix', 'San Diego'] as $city)
                            <a href="#" class="text-xs font-bold text-slate-500 hover:text-primary transition-colors">{{ $city }}</a>
                        @endforeach
                    </div>
                </div>

                <!-- Visit Reasons -->
                <div>
                    <h2 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-10 border-l-4 border-secondary pl-4">Common visit reasons</h2>
                    <div class="grid grid-cols-2 gap-y-4 gap-x-8">
                        @foreach(['Cardiology', 'Dermatology', 'Psychiatry', 'Dentistry', 'Eye Care', 'Urology', 'Internal Medicine', 'Pediatrics'] as $reason)
                            <a href="#" class="text-xs font-bold text-slate-500 hover:text-primary transition-colors">{{ $reason }}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Join as Provider Box -->
            <div class="mt-24 p-12 bg-white rounded-[3rem] border border-yellow-100 shadow-2xl shadow-yellow-900/5 relative overflow-hidden group">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#fff04b] rounded-full opacity-5 group-hover:scale-110 transition-transform duration-700"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-12">
                    <div class="max-w-xl text-center md:text-left">
                        <h3 class="text-3xl font-black text-slate-800 mb-4 leading-tight italic tracking-tighter">Are you a provider?</h3>
                        <p class="text-slate-500 font-bold leading-relaxed">Join the network that helps patients find you and book appointments instantly. Together, we're building better health care for everyone.</p>
                    </div>
                    <a href="{{ route('register.doctor') }}" class="px-10 py-5 bg-[#fff04b] hover:bg-[#ffe600] text-slate-900 text-sm font-black uppercase tracking-widest rounded-2xl shadow-lg border-b-4 border-yellow-300/50 hover:border-yellow-400 transition-all active:scale-95">
                        List your practice
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
