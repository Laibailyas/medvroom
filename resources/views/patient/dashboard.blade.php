<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Hero / Search Section -->
        <div class="bg-primary/5 rounded-3xl p-8 md:p-12 mb-10 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-8">Book local doctors who take your insurance</h1>
            
            <form action="{{ route('search') }}" method="GET" class="max-w-4xl mx-auto bg-white rounded-2xl p-2 shadow-sm border border-slate-100 flex flex-col md:flex-row items-stretch gap-2 transition-all hover:shadow-md">
                <div class="flex-1 flex items-center px-4 border-r border-slate-100 py-2">
                    <svg class="w-5 h-5 text-slate-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="q" placeholder="Condition, procedure, doctor name..." class="w-full border-none focus:ring-0 text-slate-700 placeholder-slate-400">
                </div>
                <div class="flex-1 flex items-center px-4 border-r border-slate-100 py-2">
                    <svg class="w-5 h-5 text-slate-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <input type="text" name="location" placeholder="City, state, or zip code" class="w-full border-none focus:ring-0 text-slate-700 placeholder-slate-400">
                </div>
                <div class="flex-1 flex items-center px-4 py-2">
                    <svg class="w-5 h-5 text-slate-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <input type="text" placeholder="Insurance carrier and plan" class="w-full border-none focus:ring-0 text-slate-700 placeholder-slate-400">
                </div>
                <button type="submit" class="bg-primary text-white p-4 rounded-xl hover:bg-primary-dark transition shadow-lg shadow-primary/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Well Guide & History -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Well Guide -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-50">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h2 class="text-xl font-bold text-slate-900">Well Guide</h2>
                                <p class="text-sm text-slate-500">Stay on top of your health with your personalized care checklist</p>
                            </div>
                            <svg class="w-5 h-5 text-slate-400 hover:text-primary cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-8">
                            <div class="flex justify-between text-xs text-slate-500 mb-2">
                                <span>{{ $completedCount }} of {{ $totalCount }} completed</span>
                                <span>{{ round($progress) }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                <div class="bg-primary h-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <!-- Checklist Items -->
                        <div class="space-y-6">
                            @foreach($wellGuideItems as $item)
                                <div class="flex items-start gap-4 p-4 rounded-xl transition-all hover:bg-slate-50 {{ $item['completed'] ? 'opacity-60' : '' }}">
                                    <div class="w-12 h-12 flex-shrink-0 bg-yellow-50 text-yellow-600 rounded-full flex items-center justify-center">
                                        @if($item['icon'] === 'calendar')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        @elseif($item['icon'] === 'shield')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                        @elseif($item['icon'] === 'tooth')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M12 2C9 2 7 5 7 8C7 11 9 11 11 15C11 16 10 17 9 18C7 19 6 22 12 22C18 22 17 19 15 18C14 17 13 16 13 15C15 11 17 11 17 8C17 5 15 2 12 2Z"/></svg>
                                        @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            @if(!$item['completed'])
                                                <span class="px-2 py-0.5 bg-pink-100 text-pink-600 text-[10px] uppercase font-bold rounded">Due</span>
                                            @else
                                                <span class="px-2 py-0.5 bg-green-100 text-green-600 text-[10px] uppercase font-bold rounded">Completed</span>
                                            @endif
                                            <h3 class="font-bold text-slate-800">{{ $item['title'] }}</h3>
                                        </div>
                                        <p class="text-sm text-slate-500 leading-relaxed">{{ $item['description'] }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('patient.well-guide.toggle', $item['id']) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-sm font-medium text-slate-600 hover:text-primary transition underline decoration-slate-300 underline-offset-4 decoration-dashed italic">
                                                {{ $item['completed'] ? 'Mark as due' : 'Mark as done' }}
                                            </button>
                                        </form>
                                        <a href="{{ route('search', ['q' => $item['title']]) }}" class="px-5 py-2 border border-slate-200 rounded-lg text-sm font-bold text-slate-700 hover:bg-slate-50 transition">Book</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Action Required (Reschedule Requests) at the Top -->
                @if($actionRequiredAppointments->isNotEmpty())
                    <div class="bg-yellow-50 border border-yellow-200 rounded-[2.5rem] p-6 shadow-sm mb-8 mt-8">
                        <div class="flex items-center gap-3 mb-6">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight italic">Action Required</h2>
                        </div>
                        <div class="space-y-4">
                            @foreach($actionRequiredAppointments as $appointment)
                                <div class="bg-white p-6 rounded-2xl border border-yellow-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 transition hover:shadow-md">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center overflow-hidden border border-slate-100 shrink-0">
                                            @if($appointment->doctorProfile->user->getProfilePhotoUrl())
                                                <img src="{{ Str::startsWith($appointment->doctorProfile->user->profile_photo_path, 'http') ? $appointment->doctorProfile->user->profile_photo_path : Storage::url($appointment->doctorProfile->user->profile_photo_path) }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="text-xl font-black text-primary">{{ substr($appointment->doctorProfile->user->first_name, 0, 1) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-black text-slate-900">Dr. {{ $appointment->doctorProfile->user->name }}</h3>
                                            <div class="flex flex-col gap-1 mt-1 text-sm font-bold text-slate-500">
                                                <div class="flex items-center gap-1.5 text-yellow-700">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                    Proposed Time: {{ $appointment->appointment_datetime->format('M d, Y • g:i A') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col sm:flex-row items-center gap-2">
                                        <form action="{{ route('patient.appointments.reply-reschedule', $appointment) }}" method="POST" class="w-full sm:w-auto">
                                            @csrf
                                            <input type="hidden" name="action" value="accept">
                                            <button type="submit" class="w-full px-5 py-3 text-xs font-black uppercase tracking-[0.2em] bg-yellow-500 text-white rounded-xl shadow-lg shadow-yellow-500/20 hover:scale-105 active:scale-95 transition-all">Accept Time</button>
                                        </form>
                                        <form action="{{ route('patient.appointments.reply-reschedule', $appointment) }}" method="POST" class="w-full sm:w-auto">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="w-full px-5 py-3 text-xs font-black uppercase tracking-[0.2em] bg-white text-slate-900 border border-slate-200 rounded-xl hover:bg-slate-50 active:scale-95 transition-all">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Upcoming Appointments -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden {{ $actionRequiredAppointments->isEmpty() ? 'mt-8' : '' }}">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-slate-900">Upcoming Appointments</h2>
                            <a href="{{ route('patient.appointments.index') }}" class="text-xs font-black text-primary uppercase tracking-widest hover:underline decoration-primary/30 underline-offset-4 decoration-2">Manage All</a>
                        </div>
                        @if($upcomingAppointments->isEmpty())
                            <div class="text-center py-12 text-slate-400">
                                <p>No upcoming appointments.</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($upcomingAppointments as $appointment)
                                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-white rounded-full border border-slate-100 flex items-center justify-center overflow-hidden">
                                                @if($appointment->doctorProfile->user->profile_photo_path)
                                                    <img src="{{ Storage::url($appointment->doctorProfile->user->profile_photo_path) }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-lg font-bold text-primary">{{ substr($appointment->doctorProfile->user->first_name, 0, 1) }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-900">Dr. {{ $appointment->doctorProfile->user->name }}</h4>
                                                <div class="text-sm text-slate-500">
                                                    {{ $appointment->appointment_datetime->format('M d, Y • g:i A') }} 
                                                    <span class="ml-2 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-green-100 text-green-700">{{ str_replace('_', ' ', $appointment->status) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            @if($appointment->status !== 'pending' && $appointment->conversation())
                                                <a href="{{ route('messages.index', $appointment->conversation()) }}" class="text-sm font-bold text-slate-600 hover:text-primary transition flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                                    Chat
                                                </a>
                                            @endif
                                            <a href="{{ route('patient.appointments.show', $appointment) }}" class="text-sm font-bold text-primary hover:underline">View details</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Appointment History -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-slate-900">Recent Activity</h2>
                            <a href="{{ route('patient.appointments.index') }}" class="text-xs font-black text-primary uppercase tracking-widest hover:underline decoration-primary/30 underline-offset-4 decoration-2">View All</a>
                        </div>
                        @if($pastAppointments->isEmpty())
                            <div class="text-center py-12 text-slate-400">
                                <p>No completed appointments yet.</p>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($pastAppointments as $appointment)
                                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
                                        <div class="flex items-center gap-4">
                                            <div class="w-12 h-12 bg-white rounded-full border border-slate-100 flex items-center justify-center overflow-hidden">
                                                @if($appointment->doctorProfile->user->profile_photo_path)
                                                    <img src="{{ Storage::url($appointment->doctorProfile->user->profile_photo_path) }}" class="w-full h-full object-cover">
                                                @else
                                                    <span class="text-lg font-bold text-primary">{{ substr($appointment->doctorProfile->user->first_name, 0, 1) }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-900">Dr. {{ $appointment->doctorProfile->user->name }}</h4>
                                                <div class="text-sm text-slate-500">
                                                    {{ $appointment->appointment_datetime->format('M d, Y') }} • {{ $appointment->status }}
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            @if($appointment->review)
                                                <span class="text-sm text-green-600 font-medium flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                    Reviewed
                                                </span>
                                            @else
                                                <a href="#" class="text-sm font-bold text-primary hover:underline">Write a review</a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="space-y-8">
                
                <!-- Notifications -->
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <div class="bg-primary/5 border border-primary/10 rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex h-3 w-3 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-primary"></span>
                            </span>
                            <h3 class="font-bold text-slate-900">Notifications</h3>
                        </div>
                        <div class="space-y-4">
                            @foreach(auth()->user()->unreadNotifications->take(3) as $notification)
                                <div class="text-sm text-slate-700 bg-white/50 p-3 rounded-lg border border-white/20">
                                    {{ $notification->data['message'] ?? 'You have a new update.' }}
                                </div>
                            @endforeach
                            <a href="#" class="block text-center text-xs font-bold text-primary uppercase tracking-widest mt-2">View All</a>
                        </div>
                    </div>
                @endif

                <!-- Care Team -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-slate-900">Your care team</h2>
                    </div>
                    <div class="space-y-6">
                        <!-- Example Team Member -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <span class="text-sm font-medium text-slate-600">Find a primary care doctor</span>
                            </div>
                            <a href="{{ route('search', ['q' => 'Primary Care']) }}" class="text-sm font-bold text-slate-800 border border-slate-200 px-3 py-1 rounded shadow-sm hover:bg-slate-50 transition">Add</a>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-400">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                <span class="text-sm font-medium text-slate-600">Find a dentist</span>
                            </div>
                            <a href="{{ route('search', ['q' => 'Dentist']) }}" class="text-sm font-bold text-slate-800 border border-slate-200 px-3 py-1 rounded shadow-sm hover:bg-slate-50 transition">Add</a>
                        </div>
                        
                        @foreach($careTeam as $doctor)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary overflow-hidden">
                                        @if($doctor->user->getProfilePhotoUrl())
                                            <img src="{{ $doctor->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="font-bold">{{ substr($doctor->user->first_name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-slate-900">Dr. {{ $doctor->user->last_name }}</div>
                                        <div class="text-[10px] text-slate-500 uppercase font-medium">{{ $doctor->specialties->first()?->name ?? 'Specialist' }}</div>
                                    </div>
                                </div>
                                <a href="{{ route('doctors.show', $doctor) }}" class="text-xs font-bold text-primary hover:underline">Book</a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Insurance Plans -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Your insurance plans</h2>
                    <div class="space-y-6">
                        @php
                            $types = ['Medical', 'Dental', 'Vision'];
                        @endphp
                        @foreach($types as $type)
                            @php 
                                $plan = $insurancePlans->where('plan_type', strtolower($type))->first(); 
                            @endphp
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">{{ $type }}</h4>
                                    <p class="text-[11px] text-slate-500 italic">{{ $plan ? $plan->provider->name . ' - ' . $plan->name : 'None added' }}</p>
                                </div>
                                <a href="{{ route('profile.edit', ['section' => 'insurance']) }}" class="text-sm font-bold text-slate-800 border border-slate-200 px-3 py-1 rounded shadow-sm hover:bg-slate-50 transition">
                                    {{ $plan ? 'Edit' : 'Add' }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
