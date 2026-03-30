@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative bg-[#f9f9f9] pt-16 pb-24 overflow-hidden border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mb-12">
            <h1 class="text-5xl md:text-6xl font-black tracking-tight text-gray-900 mb-6 leading-[1.1]">
                Find and book <span class="text-brand-blue">doctors</span> who actually <span class="text-brand-green">care</span>.
            </h1>
            <p class="text-xl text-gray-600 leading-relaxed font-semibold max-w-2xl">
                Read verified patient reviews, see real-time availability, and book your appointment instantly on MyDoc.
            </p>
        </div>

        <!-- Exact Zocdoc 4-Field Search Engine -->
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 p-2 relative z-20">
            <div class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-100">
                <!-- Field 1: Condition/Specialty -->
                <div class="flex-[1.5] flex items-center gap-3 px-6 py-5">
                    <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <div class="flex-1">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-[#2d333f]/60 mb-0.5">Condition / Specialty</label>
                        <input type="text" placeholder="Specialty, condition, doctor..." class="w-full text-base font-bold text-gray-900 placeholder-gray-400 focus:outline-none">
                    </div>
                </div>
                <!-- Field 2: Location -->
                <div class="flex-1 flex items-center gap-3 px-6 py-5">
                    <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <div class="flex-1">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-[#2d333f]/60 mb-0.5">Location</label>
                        <input type="text" placeholder="City or Zip code" class="w-full text-base font-bold text-gray-900 placeholder-gray-400 focus:outline-none">
                    </div>
                </div>
                <!-- Field 3: Carrier -->
                <div class="flex-1 flex items-center gap-3 px-6 py-5">
                    <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <div class="flex-1">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-[#2d333f]/60 mb-0.5">Insurance Carrier</label>
                        <input type="text" placeholder="Select carrier" class="w-full text-base font-bold text-gray-900 placeholder-gray-400 focus:outline-none">
                    </div>
                </div>
                <!-- Field 4: Plan -->
                <div class="flex-1 flex items-center gap-3 px-6 py-5">
                    <div class="w-5 h-5 shrink-0"></div> <!-- Spacer to align with icons -->
                    <div class="flex-1">
                        <label class="block text-[10px] font-black uppercase tracking-widest text-[#2d333f]/60 mb-0.5">Insurance Plan</label>
                        <input type="text" placeholder="Select plan" class="w-full text-base font-bold text-gray-900 placeholder-gray-400 focus:outline-none">
                    </div>
                </div>
                <!-- Search Button -->
                <div class="p-2 flex items-center">
                    <button class="w-full lg:w-32 h-14 bg-brand-blue rounded-xl flex items-center justify-center text-white shadow-lg hover:bg-brand-blue/90 transition-all hover:scale-[1.02] active:scale-95 group">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Trust Badge below search -->
        <div class="mt-8 flex items-center gap-6 justify-center lg:justify-start text-xs text-gray-500 font-bold uppercase tracking-wider">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-brand-green" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                Find by Insurance
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-brand-green" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                Instant Booking
            </span>
        </div>
    </div>
</section>

<!-- Specialty Grid -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-black text-gray-900 mb-10">Browse top-rated specialties</h2>

        <div class="grid grid-cols-2 lg:grid-cols-6 gap-8 text-center">
            @php
                $specialties = [
                    ['name' => 'Primary Care', 'icon' => '🩺'],
                    ['name' => 'Dentist', 'icon' => '🦷'],
                    ['name' => 'OB-GYN', 'icon' => '👩‍⚕️'],
                    ['name' => 'Dermatologist', 'icon' => '✨'],
                    ['name' => 'Psychiatrist', 'icon' => '🧠'],
                    ['name' => 'Eye Doctor', 'icon' => '👁️'],
                ];
            @endphp

            @foreach($specialties as $item)
            <div class="group cursor-pointer">
                <div class="w-24 h-24 bg-[#f0f4f9] rounded-full flex items-center justify-center text-4xl mb-4 mx-auto group-hover:bg-brand-blue/10 transition-colors duration-300">
                    {{ $item['icon'] }}
                </div>
                <h3 class="text-sm font-bold text-[#2d333f] group-hover:text-brand-blue transition-colors">{{ $item['name'] }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- How it works (Zocdoc style) -->
<section class="py-20 bg-[#f9f9f9]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-black text-gray-900 text-center mb-16">Book an appointment in 3 simple steps</h2>
        <div class="grid md:grid-cols-3 gap-12">
            <!-- Step 1 -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 text-center relative group">
                <div class="w-16 h-16 bg-brand-blue/10 rounded-2xl flex items-center justify-center text-brand-blue text-2xl font-black mb-6 mx-auto group-hover:scale-110 transition-transform">1</div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-4">Search for a doctor</h3>
                <p class="text-gray-500 font-semibold leading-relaxed">Enter your specialty, location, and insurance to see personalized results.</p>
            </div>
            <!-- Step 2 -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 text-center relative group">
                <div class="w-16 h-16 bg-brand-green/10 rounded-2xl flex items-center justify-center text-brand-green text-2xl font-black mb-6 mx-auto group-hover:scale-110 transition-transform">2</div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-4">Read verified reviews</h3>
                <p class="text-gray-500 font-semibold leading-relaxed">View authentic patient feedback and provider credentials with full transparency.</p>
            </div>
            <!-- Step 3 -->
            <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 text-center relative group">
                <div class="w-16 h-16 bg-brand-blue/10 rounded-2xl flex items-center justify-center text-brand-blue text-2xl font-black mb-6 mx-auto group-hover:scale-110 transition-transform">3</div>
                <h3 class="text-xl font-extrabold text-gray-900 mb-4">Book instantly</h3>
                <p class="text-gray-500 font-semibold leading-relaxed">Pick a time that works for you and confirm your appointment in seconds.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Doctors (Zocdoc 2025 Style) -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-16">
            <div>
                <h2 class="text-3xl font-black text-gray-900 mb-2">Top-rated doctors near you</h2>
                <p class="text-gray-500 font-bold">Providers who are highly recommended by patients like you.</p>
            </div>
            <button class="font-bold text-brand-blue hover:underline">View all results &rarr;</button>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @php
                $doctors = [
                    [
                        'name' => 'Dr. Sarah Smith', 
                        'specialty' => 'Primary Care', 
                        'rating' => '4.9', 
                        'reviews' => '1,240', 
                        'availability' => 'Available Tomorrow',
                        'image' => 'https://images.unsplash.com/photo-1559839734-2b71f1536783?auto=format&fit=crop&q=80&w=300'
                    ],
                    [
                        'name' => 'Dr. Michael Chen', 
                        'specialty' => 'Dentist', 
                        'rating' => '5.0', 
                        'reviews' => '892', 
                        'availability' => 'Available Today',
                        'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&q=80&w=300'
                    ],
                    [
                        'name' => 'Dr. Elena Rodriguez', 
                        'specialty' => 'Dermatologist', 
                        'rating' => '4.8', 
                        'reviews' => '2,105', 
                        'availability' => 'Available Thu, Mar 30',
                        'image' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&q=80&w=300'
                    ],
                ];
            @endphp

            @foreach($doctors as $doc)
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-gray-200/40 p-1 group hover:border-brand-blue/20 transition-all">
                <div class="p-6">
                    <div class="flex gap-5 mb-6">
                        <div class="w-16 h-16 rounded-full overflow-hidden shrink-0 border-2 border-gray-50">
                            <img src="{{ $doc['image'] }}" alt="{{ $doc['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-gray-900 group-hover:text-brand-blue">{{ $doc['name'] }}</h3>
                            <p class="text-sm font-bold text-gray-400 mb-1">{{ $doc['specialty'] }}</p>
                            <div class="flex items-center gap-1.5 font-black text-[#2d333f] text-sm">
                                <span class="bg-yellow-400 p-0.5 rounded leading-none text-[10px]">VERIFIED</span>
                                <span class="text-yellow-500">★ {{ $doc['rating'] }}</span>
                                <span class="text-gray-400 font-bold">({{ $doc['reviews'] }})</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-gray-100">
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-4">Availability</p>
                        <div class="flex items-center justify-between">
                            <span class="text-brand-green font-black text-xs uppercase tracking-tighter">{{ $doc['availability'] }}</span>
                            <button class="px-6 py-2.5 bg-brand-blue rounded-xl text-white font-bold text-xs hover:bg-brand-blue/90 transition-all shadow-lg shadow-brand-blue/20 active:scale-95">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</section>
@endsection
