<?php
    $title = 'Book local doctors who take your insurance';
    $description = 'Find and book top-rated doctors, dentists, and specialists who take your insurance. Read verified patient reviews and book appointments online instantly with MedVroom.';
?>
<x-app-layout :title="$title" :description="$description">
    <!-- Hero Section -->
    <section class="relative bg-[#fffdf0] pt-24 pb-32 min-h-[700px] flex items-center overflow-hidden">
        <!-- Background Decorative Elements -->
        <div class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-[600px] h-[600px] bg-yellow-200/30 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-[500px] h-[500px] bg-secondary/10 rounded-full blur-[100px]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="max-w-2xl">
                    <!-- Badge -->
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-white/80 border border-yellow-200 shadow-sm mb-6 animate-fade-in-down">
                        <span class="flex h-2 w-2 rounded-full bg-secondary animate-pulse"></span>
                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">Trusted by 10M+ Patients</span>
                    </div>

                    <h1 class="text-6xl md:text-7xl font-black tracking-tighter text-slate-800 mb-8 leading-[1]">
                        Find & book <br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-800 to-slate-500">top-rated doctors</span> <br />
                        who take your <span class="text-secondary italic underline decoration-yellow-300 decoration-8 underline-offset-4">insurance</span>
                    </h1>

                    <!-- Reimagined Search Engine -->
                    <form action="{{ route('search') }}" method="GET" class="bg-white/70 backdrop-blur-xl rounded-2xl shadow-2xl shadow-yellow-900/10 border border-white p-2 relative z-20 transition-all hover:shadow-yellow-900/15">
                        <div class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-slate-100/50">
                            <!-- Field 1: Reason -->
                            <div class="flex-[1.2] flex flex-col px-5 py-4 group">
                                <label class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1 group-focus-within:text-secondary transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                    <span>Condition / Specialty</span>
                                </label>
                                <div class="flex items-center flex-1">
                                    <input type="text" name="q" placeholder="Dentist, OBGYN, etc..." class="w-full text-base font-bold text-slate-700 placeholder-slate-300 focus:outline-none focus:ring-0 border-none p-0 bg-transparent">
                                </div>
                            </div>
                            <!-- Field 2: Location -->
                            <div class="flex-1 flex flex-col px-5 py-4 group">
                                <label class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1 group-focus-within:text-secondary transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span>Location</span>
                                </label>
                                <div class="flex items-center flex-1">
                                    <input type="text" name="location" placeholder="City or ZIP" class="w-full text-base font-bold text-slate-700 placeholder-slate-300 focus:outline-none focus:ring-0 border-none p-0 bg-transparent">
                                </div>
                            </div>
                            <!-- Field 3: Insurance -->
                            <div class="flex-1 flex flex-col px-5 py-4 group">
                                <label class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1 group-focus-within:text-secondary transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    <span>Insurance</span>
                                </label>
                                <div class="flex items-center flex-1">
                                    <input type="text" name="insurance" placeholder="Choose carrier" class="w-full text-base font-bold text-slate-700 placeholder-slate-300 focus:outline-none focus:ring-0 border-none p-0 bg-transparent">
                                </div>
                            </div>
                            <!-- Search Button -->
                            <div class="p-2 flex items-center">
                                <button type="submit" class="w-full lg:w-20 h-16 bg-[#fff04b] hover:bg-[#ffe600] rounded-xl flex items-center justify-center text-slate-900 transition-all shadow-xl shadow-yellow-500/20 active:scale-95 group overflow-hidden relative">
                                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                                    <svg class="w-7 h-7 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3.5"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </button>
                            </div>
                        </div>
                    </form>

                    <p class="mt-6 text-xs font-bold text-slate-400 italic">Popular: Primary Care, OB-GYN, Dentist, Psychiatrist</p>
                </div>

                <!-- Hero Illustration with Floating Elements -->
                <div class="hidden lg:flex justify-end relative">
                    <div class="relative group">
                        <!-- Main Image -->
                        <div class="relative z-10 rounded-[3rem] overflow-hidden shadow-2xl transition-transform duration-700 hover:scale-[1.02]">
                            <img src="https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?q=80&w=800&auto=format&fit=crop" alt="Health Care" class="max-w-[450px]">
                        </div>

                        <!-- Floating Card 1 -->
                        <div class="absolute -top-6 -right-12 z-20 bg-white p-4 rounded-2xl shadow-2xl shadow-indigo-900/20 animate-float">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rating</p>
                                    <p class="text-sm font-black text-slate-800">5.0 Star Care</p>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Card 2 -->
                        <div class="absolute -bottom-10 -left-12 z-20 bg-white/80 backdrop-blur-md p-5 rounded-3xl shadow-2xl shadow-yellow-900/20 animate-float-delayed border border-white/50">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-2xl bg-[#fff04b] flex items-center justify-center text-slate-900">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Available</p>
                                    <p class="text-sm font-black text-slate-800">Book for Tomorrow</p>
                                </div>
                            </div>
                        </div>

                        <!-- Abstract Shapes -->
                        <div class="absolute -top-20 -left-20 w-40 h-40 bg-secondary/5 rounded-full blur-2xl"></div>
                        <div class="absolute -bottom-20 -right-20 w-32 h-32 bg-yellow-200/20 rounded-full blur-2xl"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Decor -->
        <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent overflow-hidden">
             <div class="absolute bottom-0 left-0 right-0 h-1 bg-white skew-y-1 origin-right"></div>
        </div>
    </section>

    <!-- Insurance Carriers -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs font-black text-slate-400 uppercase tracking-widest mb-8">Featured insurance carriers on MedVroom</p>
            <div class="flex flex-wrap items-center justify-between gap-8 opacity-60 hover:opacity-100 transition-opacity duration-500">
                @foreach($featuredInsurances as $insurance)
                    <img src="{{ $insurance->logo_url }}" alt="{{ $insurance->name }}" class="h-8 md:h-12 w-auto grayscale hover:grayscale-0 transition-all duration-300 transform hover:scale-105">
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
                            @if($specialty->is_emoji)
                                <span class="text-2xl font-bold uppercase tracking-widest">{!! $specialty->icon_url !!}</span>
                            @else
                                <img src="{{ $specialty->icon_url }}" alt="{{ $specialty->name }}" class="w-10 h-10 object-contain">
                            @endif
                        </div>
                        <h3 class="text-sm font-black text-slate-700 group-hover:text-slate-900 transition-colors uppercase tracking-tight">{{ $specialty->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Value Propositions -->
    <section class="py-32 bg-white relative overflow-hidden">
        <div class="absolute top-1/2 left-0 -translate-y-1/2 w-64 h-64 bg-secondary/5 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-24">
                <h2 class="text-4xl font-black text-slate-800 uppercase tracking-tighter italic leading-none">
                    MedVroom helps you <br/>
                    <span class="text-secondary not-italic text-5xl">get the care you need</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="group bg-white rounded-[3rem] p-2 shadow-2xl shadow-indigo-900/5 border border-slate-100 flex flex-col transition-all duration-500 hover:shadow-indigo-900/15 hover:-translate-y-2">
                    <div class="bg-[#f0f9ff] h-72 rounded-[2.8rem] flex items-center justify-center overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=800&auto=format&fit=crop" alt="Caring Doctors" class="group-hover:scale-110 transition-transform duration-1000 object-cover w-full h-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#f0f9ff]/50 to-transparent"></div>
                    </div>
                    <div class="p-12 text-center flex-1 flex flex-col items-center">
                        <h3 class="text-2xl font-black text-slate-800 mb-6 leading-tight tracking-tight">Find a doctor who <br/>takes your insurance</h3>
                        <a href="{{ route('search') }}" class="mt-auto inline-flex flex-col items-center group/btn">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover/btn:text-slate-900 transition-colors uppercase">Start searching</span>
                            <div class="h-1 w-12 bg-[#fff04b] mt-2 group-hover/btn:w-20 transition-all duration-500 rounded-full"></div>
                        </a>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group bg-white rounded-[3rem] p-2 shadow-2xl shadow-indigo-900/5 border border-slate-100 flex flex-col transition-all duration-500 hover:shadow-indigo-900/15 hover:-translate-y-2">
                    <div class="bg-[#fff7ed] h-72 rounded-[2.8rem] flex items-center justify-center overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?q=80&w=800&auto=format&fit=crop" alt="Reviews" class="group-hover:scale-110 transition-transform duration-1000 object-cover w-full h-full">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#fff7ed]/50 to-transparent"></div>
                    </div>
                    <div class="p-12 text-center flex-1 flex flex-col items-center">
                        <h3 class="text-2xl font-black text-slate-800 mb-6 leading-tight tracking-tight">See doctors from <br/>our verified network</h3>
                        <a href="{{ route('search', ['sort' => 'reviews']) }}" class="mt-auto inline-flex flex-col items-center group/btn">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover/btn:text-slate-900 transition-colors uppercase">Read reviews</span>
                            <div class="h-1 w-12 bg-secondary mt-2 group-hover/btn:w-20 transition-all duration-500 rounded-full"></div>
                        </a>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group bg-white rounded-[3rem] p-2 shadow-2xl shadow-indigo-900/5 border border-slate-100 flex flex-col transition-all duration-500 hover:shadow-indigo-900/15 hover:-translate-y-2">
                    <div class="bg-[#f5f3ff] h-72 rounded-[2.8rem] flex items-center justify-center overflow-hidden relative">
                         <!-- Abstract UI element fallback -->
                        <div class="absolute top-10 right-10 w-32 h-32 bg-yellow-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000"></div>
                        <div class="relative z-10 p-8 pt-12 bg-white/60 backdrop-blur-md rounded-3xl border border-white shadow-xl max-w-[240px] transform group-hover:rotate-2 transition-transform">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                                </div>
                                <div class="flex-1 space-y-2">
                                    <div class="h-2 w-16 bg-slate-200 rounded"></div>
                                    <div class="h-1.5 w-10 bg-slate-100 rounded"></div>
                                </div>
                                <div class="flex space-x-0.5">
                                    @for($i=0; $i<5; $i++) <div class="w-2 h-2 text-yellow-400">★</div> @endfor
                                </div>
                            </div>
                            <div class="h-3 w-full bg-[#fff04b]/40 rounded-full mb-3"></div>
                            <div class="h-3 w-3/4 bg-slate-100 rounded-full"></div>
                        </div>
                    </div>
                    <div class="p-12 text-center flex-1 flex flex-col items-center">
                        <h3 class="text-2xl font-black text-slate-800 mb-6 leading-tight tracking-tight">Personalize your search <br/>to find high-quality care</h3>
                        <a href="{{ route('search', ['filters' => 'active']) }}" class="mt-auto inline-flex flex-col items-center group/btn">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover/btn:text-slate-900 transition-colors uppercase">Apply filters</span>
                            <div class="h-1 w-12 bg-slate-800 mt-2 group-hover/btn:w-20 transition-all duration-500 rounded-full"></div>
                        </a>
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
                    <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?q=80&w=800&auto=format&fit=crop" alt="Join MedVroom" class="w-full relative z-10 rounded-3xl shadow-2xl">
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
