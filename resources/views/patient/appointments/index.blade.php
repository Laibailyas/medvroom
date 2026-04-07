<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="flex items-center gap-4 mb-10">
            <a href="{{ route('patient.dashboard') }}"
                class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-100 text-slate-400 hover:text-slate-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Appointment History</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Full Appointment List -->
            <div class="lg:col-span-2 space-y-6">
                @forelse($appointments as $appointment)
                    <div class="rounded-[2rem] p-6 md:p-8 shadow-sm border flex flex-col md:flex-row items-center gap-6 group transition-all hover:shadow-xl hover:shadow-slate-200/50 
                        {{ $appointment->status === 'reschedule_requested' ? 'bg-yellow-50 border-yellow-300 shadow-yellow-100' : 'bg-white border-slate-100' }}">
                        <!-- Doctor Illustration/Photo -->
                        <div class="w-20 h-20 rounded-2xl flex items-center justify-center overflow-hidden border shadow-inner group-hover:scale-105 transition-transform duration-500
                            {{ $appointment->status === 'reschedule_requested' ? 'bg-white border-yellow-200' : 'bg-slate-50 border-slate-100' }}">
                            @if($appointment->doctorProfile->user->getProfilePhotoUrl())
                                <img src="{{ Str::startsWith($appointment->doctorProfile->user->profile_photo_path, 'http') ? $appointment->doctorProfile->user->profile_photo_path : Storage::url($appointment->doctorProfile->user->profile_photo_path) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl font-black {{ $appointment->status === 'reschedule_requested' ? 'text-yellow-400' : 'text-slate-200' }}">{{ substr($appointment->doctorProfile->user->first_name, 0, 1) }}</span>
                            @endif
                        </div>

                        <!-- Main Info -->
                        <div class="flex-1 text-center md:text-left">
                            <div class="flex flex-wrap items-center justify-center md:justify-start gap-2 mb-2">
                                <span class="px-2.5 py-0.5 text-[9px] font-black uppercase tracking-widest rounded-md
                                    {{ $appointment->status === 'reschedule_requested' ? 'bg-yellow-200 text-yellow-800' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $appointment->appointment_datetime->isPast() ? 'Past' : 'Upcoming' }}
                                </span>
                                <span class="px-2.5 py-0.5 text-[9px] font-black uppercase tracking-widest rounded-md
                                    @if($appointment->status === 'confirmed') bg-green-50 text-green-600
                                    @elseif($appointment->status === 'reschedule_requested') bg-yellow-200 text-yellow-800
                                    @else bg-yellow-50 text-yellow-600 @endif">
                                    {{ str_replace('_', ' ', $appointment->status) }}
                                </span>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Dr. {{ $appointment->doctorProfile->user->name }}</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1 italic">{{ $appointment->doctorProfile->specialties->first()?->name ?? 'Specialist' }}</p>
                            
                            <div class="flex items-center justify-center md:justify-start gap-4 mt-4 text-[11px] font-black text-slate-500 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $appointment->appointment_datetime->format('D, M j, Y') }}
                                </div>
                                <div class="w-1.5 h-1.5 bg-slate-200 rounded-full"></div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $appointment->appointment_datetime->format('h:i A') }}
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-2 min-w-[140px]">
                            @if($appointment->appointment_datetime->isPast())
                                @if($appointment->review)
                                    <div class="flex items-center justify-center gap-1.5 text-xs font-black text-green-600 uppercase tracking-widest py-3 px-4 bg-green-50 rounded-xl border border-green-100">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        Reviewed
                                    </div>
                                @else
                                    <a href="#" class="w-full bg-slate-900 text-white text-center py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.15em] hover:bg-slate-800 transition-all hover:scale-[1.02] active:scale-95">Write a Review</a>
                                @endif
                                <a href="{{ route('doctors.show', $appointment->doctorProfile) }}" class="w-full bg-white text-slate-900 text-center py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.15em] border border-slate-200 hover:bg-slate-50 transition-all">Book Again</a>
                            @else
                                <a href="{{ route('patient.appointments.show', $appointment) }}" class="w-full bg-primary text-slate-900 text-center py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.15em] hover:bg-primary-dark transition-all hover:scale-[1.02] active:scale-95 shadow-sm">View Details</a>
                                @if($appointment->status !== 'pending' && $appointment->conversation())
                                    <a href="{{ route('messages.index', $appointment->conversation()) }}" class="w-full bg-slate-900 text-white text-center py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.15em] hover:bg-slate-800 transition-all hover:scale-[1.02] active:scale-95 shadow-lg shadow-slate-900/10">Open Messenger</a>
                                @endif
                                @if($appointment->status === 'reschedule_requested')
                                    <div class="flex flex-col gap-2">
                                        <form action="{{ route('patient.appointments.reply-reschedule', $appointment) }}" method="POST" class="w-full">
                                            @csrf
                                            <input type="hidden" name="action" value="accept">
                                            <button type="submit" class="w-full bg-yellow-500 text-white text-center py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.15em] hover:bg-yellow-600 transition-all shadow-lg shadow-yellow-500/20 active:scale-95">Accept Time</button>
                                        </form>
                                        <form action="{{ route('patient.appointments.reply-reschedule', $appointment) }}" method="POST" class="w-full">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="w-full bg-white text-slate-900 border border-slate-200 text-center py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.15em] hover:bg-slate-50 transition-all shadow-sm active:scale-95">Reject</button>
                                        </form>
                                    </div>
                                @elseif($appointment->appointment_datetime->isAfter(now()->addHours(24)))
                                    <a href="{{ route('patient.appointments.reschedule', $appointment) }}" class="w-full bg-white text-slate-600 text-center py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.15em] border border-slate-200 hover:bg-slate-50 transition-all">Reschedule</a>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[2.5rem] p-20 text-center border-2 border-dashed border-slate-100">
                        <div class="w-20 h-20 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6 text-slate-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-2">No appointments yet</h3>
                        <p class="text-sm font-bold text-slate-400 mb-8 max-w-xs mx-auto">When you book a doctor, your activity will appear here.</p>
                        <a href="{{ route('search') }}" class="inline-flex items-center gap-2 bg-primary text-slate-900 px-8 py-4 rounded-2xl text-xs font-black uppercase tracking-[0.2em] hover:bg-primary-dark transition-all hover:scale-105 active:scale-95">Find a Doctor</a>
                    </div>
                @endforelse

                <div class="mt-10">
                    {{ $appointments->links() }}
                </div>
            </div>

            <!-- Right Column: Reused Dashboard Sidebar Elements -->
            <div class="space-y-8">
                <!-- Notifications (Optional) -->
                <div class="bg-primary/5 border border-primary/10 rounded-[2.5rem] p-8">
                    <h3 class="text-xs font-black text-primary uppercase tracking-[0.2em] mb-4">Did you know?</h3>
                    <p class="text-sm font-bold text-slate-700 leading-relaxed italic">Regular preventive visits can catch health issues early and keep your costs down.</p>
                </div>

                <!-- Care Team -->
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm transition-all hover:shadow-xl hover:shadow-slate-200/50">
                    <h2 class="text-xl font-black text-slate-900 tracking-tight mb-8 italic uppercase">Your care team</h2>
                    <div class="space-y-8">
                        @foreach($careTeam as $doctor)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-primary overflow-hidden border border-slate-100 group-hover:scale-110 transition-transform duration-300">
                                        @if($doctor->user->getProfilePhotoUrl())
                                            <img src="{{ $doctor->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="font-black">{{ substr($doctor->user->first_name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-sm font-black text-slate-900 uppercase tracking-tight">Dr. {{ $doctor->user->last_name }}</div>
                                        <div class="text-[10px] text-slate-400 uppercase font-black tracking-widest mt-0.5">{{ $doctor->specialties->first()?->name ?? 'Specialist' }}</div>
                                    </div>
                                </div>
                                <a href="{{ route('doctors.show', $doctor) }}" class="text-[10px] font-black text-primary hover:text-primary-dark uppercase tracking-widest italic border-b-2 border-primary/20 pb-0.5">Book</a>
                            </div>
                        @endforeach
                        
                        <a href="{{ route('search') }}" class="block w-full text-center py-4 bg-slate-50 rounded-2xl text-[10px] font-black text-slate-400 uppercase tracking-widest hover:bg-slate-100 transition-colors">Find New Provider</a>
                    </div>
                </div>

                <!-- Insurance Profile -->
                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm transition-all hover:shadow-xl hover:shadow-slate-200/50">
                    <h2 class="text-xl font-black text-slate-900 tracking-tight mb-8 italic uppercase">Insurance Overview</h2>
                    <div class="space-y-8">
                        @foreach(['Medical', 'Dental', 'Vision'] as $type)
                            @php 
                                $plan = $insurancePlans->where('plan_type', strtolower($type))->first(); 
                            @endphp
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-300">
                                        @if($type === 'Medical')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        @elseif($type === 'Dental')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-400">{{ $type }}</h4>
                                        <p class="text-[11px] font-black text-slate-800 mt-0.5 truncate max-w-[120px]">{{ $plan ? $plan->provider->name : 'No plan added' }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('profile.edit', ['section' => 'insurance']) }}" class="text-[10px] font-black text-slate-400 hover:text-slate-900 transition-colors uppercase tracking-widest">Edit</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
