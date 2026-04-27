<x-app-layout>
    <div class="bg-[#fcfbf7] min-h-screen pb-20" x-data="{ tab: 'highlights' }">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Left Column: Provider Info & Tabs -->
                <div class="lg:col-span-2 space-y-10">
                    
                    <!-- 1. Header: Provider Identity -->
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
                        <div class="w-32 h-32 md:w-36 md:h-36 bg-white rounded-full flex-shrink-0 flex items-center justify-center overflow-hidden border shadow-sm">
                            @if($doctor->user->getProfilePhotoUrl())
                                <img src="{{ $doctor->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-4xl font-black text-slate-200">{{ substr($doctor->user->first_name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="text-center md:text-left pt-2">
                            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Dr. {{ $doctor->user->name }}</h1>
                            <p class="text-lg font-bold text-slate-500">{{ $doctor->specialties->first()?->name ?? 'Specialist' }}</p>
                            <div class="mt-2 inline-flex items-center gap-1.5 px-2 py-0.5 bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-widest rounded leading-none">
                                {{ $doctor->practice_zip_code ?? 'CO' }}
                            </div>
                        </div>
                    </div>

                    <!-- 2. Review Highlight Box -->
                    <div class="bg-primary/5 rounded-[2rem] p-8 border border-primary/5 flex flex-col md:flex-row gap-8 items-stretch transition-all hover:shadow-xl hover:shadow-primary/5">
                        <div class="md:w-32 flex flex-col items-center justify-center border-b md:border-b-0 md:border-r border-primary/10 pb-6 md:pb-0 md:pr-8">
                            <div class="text-4xl font-black text-slate-800 mb-2">
                                {{ number_format($doctor->reviews->avg('rating') ?: 0, 2) }}
                            </div>
                            <div class="flex text-yellow-400">
                                @for($i=1; $i<=5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= ($doctor->reviews->avg('rating') ?: 0) ? 'fill-current' : 'text-slate-200 fill-current' }}" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                @endfor
                            </div>
                        </div>
                        <div class="flex-1 space-y-4">
                            @if($featuredReview)
                                <blockquote class="text-lg font-bold text-slate-700 italic leading-relaxed">
                                    "{{ Str::limit($featuredReview->comment, 140) }}"
                                </blockquote>
                                <div class="flex items-center justify-between">
                                    <div class="text-xs font-black text-slate-400 uppercase tracking-widest">
                                        {{ $featuredReview->patientProfile?->user?->name ?? 'Patient' }} • {{ $featuredReview->created_at->format('F d, Y') }}
                                    </div>
                                    <button @click="tab = 'reviews'" class="text-sm font-black text-slate-800 border-b-2 border-primary pb-0.5 hover:text-primary transition-colors">
                                        See all {{ $doctor->reviews->count() }} reviews
                                    </button>
                                </div>
                            @else
                                <div class="flex h-full items-center text-slate-400 font-bold italic">
                                    New provider on MedVroom. Be the first to write a review!
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- 3. Navigation Tabs -->
                    <div class="border-b border-slate-200 sticky top-0 bg-[#fcfbf7]/90 backdrop-blur z-30">
                        <div class="flex items-center gap-10 overflow-x-auto no-scrollbar py-1">
                            @foreach(['highlights', 'about', 'insurances', 'reviews'] as $t)
                                <button 
                                    @click="tab = '{{ $t }}'"
                                    :class="tab === '{{ $t }}' ? 'border-primary text-slate-900' : 'border-transparent text-slate-400 hover:text-slate-600'"
                                    class="text-xs font-black uppercase tracking-widest py-4 border-b-4 transition-all duration-300"
                                >
                                    {{ $t }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- 4. Tab Content -->
                    <div class="min-h-[400px]">
                        
                        <!-- Highlights Tab -->
                        <div x-show="tab === 'highlights'" x-cloak class="space-y-12 animate-in fade-in slide-in-from-bottom-2 duration-500">
                            <!-- New Patient Available Badge -->
                            <div class="flex items-start gap-5 group">
                                <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center shadow-sm transition-transform group-hover:scale-110">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-800 italic uppercase">New patient appointments</h3>
                                    <p class="text-sm font-bold text-slate-500">Appointments available for new patients on MedVroom.</p>
                                </div>
                            </div>
                            
                            <!-- In-Network Insurances -->
                            <div class="flex items-start gap-5 group border-t border-slate-100 pt-10">
                                <div class="w-12 h-12 bg-secondary/5 text-secondary rounded-2xl flex items-center justify-center shadow-sm transition-transform group-hover:scale-110">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-black text-slate-800 italic uppercase mb-2">In-network insurances</h3>
                                    <div class="text-sm font-bold text-slate-500 leading-relaxed mb-4">
                                        @foreach($insuranceGroups->take(5) as $provider => $plans)
                                            {{ $provider }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                        @if($insuranceGroups->count() > 5)
                                            <span class="text-slate-400">+ {{ $insuranceGroups->count() - 5 }} more</span>
                                        @endif
                                    </div>
                                    <button @click="tab = 'insurances'" class="text-xs font-black text-primary underline decoration-primary/30 underline-offset-4 uppercase tracking-widest hover:text-primary-dark">See all in-network plans</button>
                                </div>
                            </div>
                        </div>

                        <!-- About Tab -->
                        <div x-show="tab === 'about'" x-cloak class="space-y-8 animate-in fade-in duration-300">
                            <h3 class="text-xl font-black text-slate-800 italic uppercase">About the provider</h3>
                            <p class="text-lg font-bold text-slate-500 leading-relaxed max-w-2xl italic">
                                {{ $doctor->bio ?? 'The provider is a dedicated healthcare professional specializing in ' . ($doctor->specialties->first()?->name ?? 'medical care') . '. They are committed to providing personalized and high-quality treatment to all patients.' }}
                            </p>
                            
                            <div class="grid grid-cols-2 gap-8 pt-8 border-t border-slate-100">
                                <div>
                                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Specialties</h4>
                                    <ul class="text-sm font-bold text-slate-700 space-y-1">
                                        @foreach($doctor->specialties as $specialty)
                                            <li class="italic">{{ $specialty->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black uppercase tracking-widest text-slate-400 mb-2">Education</h4>
                                    <p class="text-sm font-bold text-slate-700 italic">Medical School Credentials</p>
                                </div>
                            </div>
                        </div>

                        <!-- Insurances Tab -->
                        <div x-show="tab === 'insurances'" x-cloak class="space-y-8 animate-in fade-in duration-300">
                            <h3 class="text-xl font-black text-slate-800 italic uppercase">In-network insurances</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($insuranceGroups as $provider => $plans)
                                    <div class="p-6 bg-white rounded-3xl border border-slate-100 shadow-sm">
                                        <h4 class="font-black text-slate-800 mb-3 border-b border-slate-50 pb-2">{{ $provider }}</h4>
                                        <div class="space-y-1">
                                            @foreach($plans as $plan)
                                                <div class="text-sm font-bold text-slate-500 italic">• {{ $plan->name }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div x-show="tab === 'reviews'" x-cloak class="space-y-10 animate-in fade-in duration-300">
                            <h3 class="text-xl font-black text-slate-800 italic uppercase">Verified Patient Reviews</h3>
                            <div class="space-y-6">
                                @forelse($doctor->reviews as $review)
                                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 group">
                                        <div class="flex items-center justify-between mb-6">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-primary font-black overflow-hidden shadow-inner group-hover:scale-110 transition-transform">
                                                    @if($review->patientProfile?->user)
                                                        <img src="{{ $review->patientProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                                                    @else
                                                        <svg class="w-6 h-6 text-slate-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $review->patientProfile?->user?->name ?? 'Patient' }}</div>
                                                    <div class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">{{ $review->created_at->format('F d, Y') }}</div>
                                                </div>
                                            </div>
                                            <div class="flex text-yellow-400">
                                                @for($i=1; $i<=5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-slate-100' }}" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-lg font-bold text-slate-600 leading-relaxed italic italic">"{{ $review->comment }}"</p>
                                    </div>
                                @empty
                                    <div class="text-center py-20 text-slate-400 border-2 border-dashed border-slate-100 rounded-[3rem]">
                                        <p class="text-sm font-bold italic uppercase tracking-widest">Zero reviews found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Right Column: Sticky Booking Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-12 space-y-8" x-data="{ patientType: 'new', visitType: 'video' }">
                        <div class="bg-white rounded-[2.5rem] p-10 border border-slate-100 shadow-2xl shadow-yellow-900/5 transition-all hover:shadow-yellow-900/10">
                            <h2 class="text-2xl font-black text-slate-800 tracking-tighter italic mb-2">Book an appointment for free</h2>
                            <p class="text-xs font-bold text-slate-400 mb-8">The office partners with MedVroom to schedule appointments</p>
                            
                            <!-- Scheduling Details -->
                            <div class="space-y-6">
                                <div>
                                    <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-2">Scheduling details</label>
                                    <div class="relative group">
                                        <select class="w-full bg-slate-50 border-none rounded-2xl py-4 pl-6 pr-12 text-sm font-bold text-slate-700 appearance-none focus:ring-2 focus:ring-primary/20 cursor-pointer">
                                            <option>General Consultation</option>
                                            <option>Follow-up Visit</option>
                                            <option>New Patient Exam</option>
                                        </select>
                                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 transition-transform group-hover:translate-y-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Insurance Check Card -->
                                <div class="bg-green-50 border border-green-100 rounded-2xl p-4 flex items-center gap-4">
                                    <div class="w-10 h-10 bg-green-500/10 text-green-600 rounded-full flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <div class="text-xs font-black text-green-700/80 uppercase tracking-tight">This provider is in-network</div>
                                </div>

                                <!-- Patient Type Toggle -->
                                <div class="flex p-1 bg-slate-50 rounded-2xl">
                                    <button 
                                        @click="patientType = 'new'"
                                        :class="patientType === 'new' ? 'bg-white shadow-sm' : 'text-slate-400'"
                                        class="flex-1 py-3 text-xs font-black uppercase tracking-widest rounded-xl transition-all"
                                    >
                                        <span x-show="patientType === 'new'" class="mr-1">✓</span> New Patient
                                    </button>
                                    <button 
                                        @click="patientType = 'existing'"
                                        :class="patientType === 'existing' ? 'bg-white shadow-sm' : 'text-slate-400'"
                                        class="flex-1 py-3 text-xs font-black uppercase tracking-widest rounded-xl transition-all"
                                    >
                                        <span x-show="patientType === 'existing'" class="mr-1">✓</span> Existing
                                    </button>
                                </div>

                                 <!-- Availability Grid -->
                                 <div class="pt-2">
                                     <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-4">Available appointments</label>
                                     <div class="bg-slate-50/50 rounded-3xl p-4 border border-slate-100">
                                         <x-availability-grid :doctor="$doctor" :availability="$doctor->availability" :startDate="$startDate" :endDate="$endDate" />
                                     </div>
                                 </div>

                                 <!-- CTA Section -->
                                 <div class="pt-4">
                                     <p class="text-[10px] text-slate-400 font-bold leading-relaxed px-1 text-center">
                                         Select a time above to begin your booking. MedVroom is free to use for all patients.
                                     </p>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <x-booking-modal />
</x-app-layout>
