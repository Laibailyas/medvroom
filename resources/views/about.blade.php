<x-app-layout>
    <div class="bg-[#f9f8f1] min-h-screen">
        <!-- Hero Section -->
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-24 text-center">
            <h1 class="text-5xl md:text-6xl font-black text-slate-800 mb-12 tracking-tight leading-tight">
                The healthcare industry should work for patients
            </h1>
            <div class="flex justify-center mb-12">
                <img src="/about_mission_illustration_1775062689053.png" alt="Mission" class="w-24 h-24">
            </div>
            <div class="max-w-2xl mx-auto space-y-6 text-lg font-bold text-slate-600 leading-relaxed">
                <p>
                    Every month, millions of patients use MedVroom to find in-network local doctors, see their real-time availability, and book appointments instantly.
                </p>
                <p>
                    Our mission is to give power to the patient. To build the simplest, most transparent healthcare experience for everyone.
                </p>
            </div>
        </section>

        <!-- Alternating Sections -->
        
        <!-- Section 1: Power to the patient (Peach) -->
        <section class="bg-[#fbe6d5] py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="order-2 lg:order-1 flex justify-center">
                        <div class="w-64 h-64 bg-white/20 rounded-full flex items-center justify-center overflow-hidden">
                             <!-- Reduced illustration: just a simple icon or smaller image -->
                             <svg class="w-32 h-32 text-orange-400 opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2 space-y-6">
                        <h2 class="text-4xl font-black text-slate-800 tracking-tight">We give power to the patient</h2>
                        <p class="text-[17px] font-bold text-slate-700 leading-relaxed max-w-lg">
                            We're building a smarter healthcare experience. One that puts patients first by providing them with the information they need to choose the best care.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Patients deserve better (Cream) -->
        <section class="bg-[#f9f8f1] py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-6">
                        <h2 class="text-4xl font-black text-slate-800 tracking-tight">We believe patients deserve better</h2>
                        <p class="text-[17px] font-bold text-slate-700 leading-relaxed max-w-lg">
                            Finding a doctor shouldn't be a struggle. We're removing the friction of outdated lists and endless phone calls.
                        </p>
                    </div>
                    <div class="flex justify-center">
                        <img src="/feature_doctor_star_rating_1775055177169.png" alt="Better Care" class="w-64 h-64 grayscale opacity-40">
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: Doctors be doctors (Green/Teal) -->
        <section class="bg-[#e6f4f1] py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="order-2 lg:order-1 flex justify-center">
                        <!-- Reduced illustration: Icon instead of large image -->
                        <div class="w-48 h-48 bg-white/30 rounded-3xl flex items-center justify-center">
                             <svg class="w-24 h-24 text-teal-500 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2 space-y-6">
                        <h2 class="text-4xl font-black text-slate-800 tracking-tight">And we help doctors be doctors, too</h2>
                        <p class="text-[17px] font-bold text-slate-700 leading-relaxed max-w-lg">
                            We provide doctors with the tools they need to manage their practices more efficiently, so they can focus on what matters most: patient care.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Leadership Section -->
        <section class="bg-white py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight border-b-4 border-[#ffe600] inline-block pb-2">Meet our leadership team</h2>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @php
                        $leaders = [
                            ['name' => 'Oliver Kharraz, MD', 'title' => 'CEO and Founder'],
                            ['name' => 'John Doe', 'title' => 'Chief Technology Officer'],
                            ['name' => 'Jane Smith', 'title' => 'Chief Product Officer'],
                            ['name' => 'Alex Reed', 'title' => 'VP of Engineering']
                        ];
                    @endphp
                    @foreach($leaders as $leader)
                        <div class="space-y-4">
                            <div class="aspect-square bg-slate-100 rounded-xl overflow-hidden grayscale hover:grayscale-0 transition-all">
                                <!-- Using a stylized geometric placeholder for headshots -->
                                <div class="w-full h-full flex items-center justify-center bg-slate-200">
                                    <svg class="w-24 h-24 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                </div>
                            </div>
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $leader['name'] }}</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $leader['title'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Press Section -->
        <section class="bg-slate-50 py-24 border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-wrap items-center justify-center gap-16 opacity-30 grayscale">
                    <span class="text-xl font-black tracking-tighter">THE WALL STREET JOURNAL.</span>
                    <span class="text-xl font-black tracking-tighter italic">Fortune</span>
                    <span class="text-xl font-black tracking-tighter uppercase">Forbes</span>
                    <span class="text-xl font-black tracking-tighter italic font-serif underline decoration-2">The New York Times</span>
                </div>
            </div>
        </section>

        <!-- Final Vision Section -->
        <section class="py-32 text-center bg-white px-4">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-black text-slate-800 mb-8 leading-tight tracking-tighter">
                    We won't stop until patients have the healthcare experience they expect and deserve.
                </h2>
                <a href="#" class="text-lg font-black text-primary hover:underline italic">Let's build a better future together.</a>
            </div>
        </section>
    </div>
</x-app-layout>
