<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Doctor Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <!-- Welcome Message -->
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">Welcome back, Dr. {{ auth()->user()->last_name ?? auth()->user()->name }}</h1>
            <p class="text-slate-500">Here's a quick overview of your schedule and patients.</p>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Today's Appointments -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Today</h3>
                    <p class="text-2xl font-black text-slate-900 mt-1">{{ count($todaysAppointments) }}</p>
                </div>
            </div>

            <!-- Total Patients -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Total Patients</h3>
                    <p class="text-2xl font-black text-slate-900 mt-1">{{ $totalPatients }}</p>
                </div>
            </div>

            <!-- Pending Requests -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-yellow-50 text-yellow-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Pending</h3>
                    <p class="text-2xl font-black text-slate-900 mt-1">{{ $pendingRequests }}</p>
                </div>
            </div>

            <!-- Upcoming Total -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex items-center gap-4 hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-500 uppercase tracking-wider">Upcoming</h3>
                    <p class="text-2xl font-black text-slate-900 mt-1">{{ count($upcomingAppointments) }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Today's Appointments -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-slate-900">Today's Appointments</h2>
                    </div>
                    
                    @if($todaysAppointments->isEmpty())
                        <div class="p-12 text-center text-slate-400">
                            <p class="mb-2">No appointments scheduled for today.</p>
                            <svg class="w-12 h-12 mx-auto text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    @else
                        <div class="divide-y divide-slate-100">
                            @foreach($todaysAppointments as $appointment)
                                <div class="p-6 hover:bg-slate-50 transition flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 text-slate-400 flex items-center justify-center font-bold">
                                            @if($appointment->patientProfile->user->getProfilePhotoUrl())
                                                <img src="{{ $appointment->patientProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                                            @else
                                                {{ substr($appointment->patientProfile->user->first_name, 0, 1) }}
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('doctor.patients.show', $appointment->patientProfile) }}" class="font-bold text-slate-900 hover:text-primary transition">{{ $appointment->patientProfile->user->name }}</a>
                                            <p class="text-sm text-slate-500 flex items-center gap-1">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ $appointment->appointment_datetime->format('g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div x-data="{ showReject: false, showReschedule: false }">
                                            <div class="flex flex-col gap-2 mt-2 w-full">
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('doctor.appointments.show', $appointment) }}" class="flex-1 p-1 px-2 text-[10px] font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-lg text-center">Details</a>
                                                    @if($appointment->status !== 'pending' && $appointment->conversation())
                                                        <a href="{{ route('messages.index', $appointment->conversation()) }}" class="flex-1 p-1 px-2 text-[10px] font-bold bg-primary text-slate-900 hover:bg-primary/90 rounded-lg text-center">Chat</a>
                                                    @endif
                                                </div>
                                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider text-center
                                                    @if($appointment->status === 'confirmed') bg-green-100 text-green-700
                                                    @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-700
                                                    @elseif($appointment->status === 'reschedule_requested') bg-purple-100 text-purple-700
                                                    @else bg-slate-100 text-slate-700 @endif">
                                                    {{ str_replace('_', ' ', $appointment->status) }}
                                                </span>
                                            </div>    
                                            @if($appointment->status === 'pending' || $appointment->status === 'reschedule_requested')
                                                <!-- Accept Form -->
                                                <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="p-1 px-2 text-xs font-bold bg-green-50 text-green-600 hover:bg-green-100 rounded-lg">Accept</button>
                                                </form>
                                                
                                                <!-- Reject Button -->
                                                <button @click="showReject = true" class="p-1 px-2 text-xs font-bold bg-red-50 text-red-600 hover:bg-red-100 rounded-lg">Reject</button>
                                                
                                                <!-- Reschedule Button -->
                                                <button @click="showReschedule = true" class="p-1 px-2 text-xs font-bold bg-slate-50 text-slate-600 hover:bg-slate-100 rounded-lg border border-slate-200">Reschedule</button>
                                            @elseif($appointment->status === 'confirmed')
                                                <!-- Complete Form -->
                                                <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="p-1 px-2 text-xs font-bold bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg">Complete</button>
                                                </form>
                                                
                                                <!-- Cancel Button -->
                                                <button @click="showReject = true" class="p-1 px-2 text-xs font-bold bg-red-50 text-red-600 hover:bg-red-100 rounded-lg">Cancel</button>
                                                
                                                <!-- Reschedule Button -->
                                                <button @click="showReschedule = true" class="p-1 px-2 text-xs font-bold bg-slate-50 text-slate-600 hover:bg-slate-100 rounded-lg border border-slate-200">Reschedule</button>
                                            @endif
                                        </div>

                                        <!-- Reject/Cancel Modal inline -->
                                        <div x-show="showReject" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                                            <div @click.away="showReject = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                                <h3 class="font-black text-xl mb-4 text-slate-900 tracking-tight">{{ $appointment->status === 'confirmed' ? 'Cancel Appointment' : 'Reject Appointment' }}</h3>
                                                <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:border-red-500 focus:ring-red-500" placeholder="{{ $appointment->status === 'confirmed' ? 'Reason for cancellation...' : 'Reason for rejection...' }}"></textarea>
                                                    <div class="flex justify-end gap-3 mt-2">
                                                        <button type="button" @click="showReject = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Go Back</button>
                                                        <button type="submit" class="px-5 py-2.5 text-sm font-bold bg-red-600 text-white rounded-xl shadow-lg shadow-red-600/20 hover:bg-red-700 transition-colors">Confirm {{ $appointment->status === 'confirmed' ? 'Cancel' : 'Reject' }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Reschedule Modal inline -->
                                        <div x-show="showReschedule" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                                            <div @click.away="showReschedule = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                                <h3 class="font-black text-xl mb-4 text-slate-900 tracking-tight">Propose Reschedule</h3>
                                                <form action="{{ route('doctor.appointments.reschedule', $appointment) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-4">
                                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">New Date & Time</label>
                                                        <input type="datetime-local" name="new_datetime" required class="w-full rounded-xl border-slate-200 text-sm font-bold focus:border-primary focus:ring-primary shadow-sm" value="{{ $appointment->appointment_datetime->format('Y-m-d\TH:i') }}">
                                                    </div>
                                                    <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:border-primary focus:ring-primary shadow-sm" placeholder="Please provide a message to the patient..."></textarea>
                                                    <div class="flex justify-end gap-3 mt-2">
                                                        <button type="button" @click="showReschedule = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Cancel</button>
                                                        <button type="submit" class="px-5 py-2.5 text-sm font-black text-slate-900 bg-primary rounded-xl shadow-lg shadow-yellow-900/20 hover:bg-primary-hover active:scale-95 transition-all">Send Request</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

                <!-- Pending Appointments action section -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center justify-between">
                        Action Required
                        <span class="bg-red-100 text-red-600 text-xs py-1 px-2.5 rounded-full">{{ $pendingRequests }}</span>
                    </h2>
                    
                    @if($pendingAppointments->isEmpty())
                        <div class="text-center py-8 text-slate-400 text-sm">
                            You're all caught up!
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($pendingAppointments as $appointment)
                                <div class="flex flex-col border border-yellow-200 bg-yellow-50/30 rounded-xl p-4 transition">
                                    <div class="flex items-start justify-between mb-3">
                                        <div>
                                            <a href="{{ route('doctor.patients.show', $appointment->patientProfile) }}" class="font-bold text-slate-900 leading-tight hover:text-primary transition block">{{ $appointment->patientProfile->user->name }}</a>
                                            <div class="text-[11px] font-black text-slate-500 uppercase tracking-widest mt-1">
                                                {{ $appointment->appointment_datetime->format('M d • g:i A') }}
                                            </div>
                                        </div>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $appointment->status === 'reschedule_requested' ? 'bg-purple-100 text-purple-700' : 'bg-yellow-200 text-yellow-800' }}">
                                            {{ str_replace('_', ' ', $appointment->status) }}
                                        </span>
                                    </div>
                                    
                                    <div x-data="{ showReject: false, showReschedule: false }">
                                            <div class="flex items-center gap-2 mt-2">
                                                <a href="{{ route('doctor.appointments.show', $appointment) }}" class="flex-1 py-2 text-xs font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-lg text-center shadow-sm">Details</a>
                                                @if($appointment->conversation())
                                                    <a href="{{ route('messages.index', $appointment->conversation()) }}" class="flex-1 py-2 text-xs font-bold bg-slate-900 text-white hover:bg-slate-800 rounded-lg shadow-sm text-center">Open Messenger</a>
                                                @endif
                                            </div>
                                            <div class="flex items-center gap-2 mt-2">
                                                <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST" class="flex-1">
                                                    @csrf
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="w-full py-2 text-xs font-bold bg-green-500 text-white hover:bg-green-600 rounded-lg shadow-sm">Accept</button>
                                                </form>
                                            </div>
                                            <div class="flex items-center gap-2 mt-2">
                                                <button @click="showReschedule = true" class="flex-1 py-2 text-xs font-bold bg-white text-slate-600 hover:bg-slate-50 rounded-lg border border-slate-200 shadow-sm">Reschedule</button>
                                                <button @click="showReject = true" class="px-3 py-2 text-xs font-bold bg-white text-red-600 hover:bg-red-50 rounded-lg border border-red-100 shadow-sm">Reject</button>
                                            </div>

                                        <!-- Reject Modal inline -->
                                        <div x-show="showReject" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                                            <div @click.away="showReject = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                                <h3 class="font-black text-xl mb-4 text-slate-900">Reject Appointment</h3>
                                                <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:ring-red-500 focus:border-red-500" placeholder="Reason for rejection..."></textarea>
                                                    <div class="flex justify-end gap-3 mt-2">
                                                        <button type="button" @click="showReject = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl">Cancel</button>
                                                        <button type="submit" class="px-5 py-2.5 text-sm font-bold bg-red-600 text-white rounded-xl hover:bg-red-700 shadow-lg shadow-red-600/20">Reject</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Reschedule Modal inline -->
                                        <div x-show="showReschedule" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                                            <div @click.away="showReschedule = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                                <h3 class="font-black text-xl mb-4 text-slate-900">Propose Reschedule</h3>
                                                <form action="{{ route('doctor.appointments.reschedule', $appointment) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-4">
                                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">New Date & Time</label>
                                                        <input type="datetime-local" name="new_datetime" required class="w-full rounded-xl border-slate-200 text-sm font-bold focus:ring-primary focus:border-primary" value="{{ $appointment->appointment_datetime->format('Y-m-d\TH:i') }}">
                                                    </div>
                                                    <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:ring-primary focus:border-primary" placeholder="Message to patient..."></textarea>
                                                    <div class="flex justify-end gap-3 mt-2">
                                                        <button type="button" @click="showReschedule = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl">Cancel</button>
                                                        <button type="submit" class="px-5 py-2.5 text-sm font-black text-slate-900 bg-primary rounded-xl shadow-lg shadow-yellow-900/20">Send Request</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Upcoming Confirmed</h2>
                    
                    @if($upcomingAppointments->isEmpty())
                        <div class="text-center py-8 text-slate-400 text-sm">
                            No upcoming confirmed appointments.
                        </div>
                    @else
                        <div class="space-y-5">
                            @foreach($upcomingAppointments as $appointment)
                                <div class="flex flex-col border border-slate-100 rounded-xl p-4 hover:shadow-sm transition" x-data="{ showReject: false, showReschedule: false }">
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('doctor.patients.show', $appointment->patientProfile) }}" class="font-bold text-slate-900 mb-1 hover:text-primary transition">{{ $appointment->patientProfile->user->name }}</a>
                                        <div class="flex flex-wrap gap-2 mt-1">
                                            <a href="{{ route('doctor.appointments.show', $appointment) }}" class="p-1 px-3 text-[10px] font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-lg">Details</a>
                                            @if($appointment->conversation())
                                                <a href="{{ route('messages.index', $appointment->conversation()) }}" class="p-1 px-3 text-[10px] font-bold bg-primary text-slate-900 hover:bg-primary/90 rounded-lg">Messenger</a>
                                            @endif
                                            <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="completed">
                                                <button type="submit" class="p-1 px-2 text-[10px] font-bold bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg">Complete</button>
                                            </form>
                                            <button @click="showReschedule = true" class="p-1 px-2 text-[10px] font-bold bg-slate-50 text-slate-600 hover:bg-slate-100 rounded-lg border border-slate-200">Reschedule</button>
                                            <button @click="showReject = true" class="p-1 px-2 text-[10px] font-bold bg-red-50 text-red-600 hover:bg-red-100 rounded-lg">Cancel</button>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between text-sm text-slate-500 mt-2">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ $appointment->appointment_datetime->format('M d') }}
                                        </div>
                                        <div class="flex items-center gap-1 font-medium text-slate-600">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $appointment->appointment_datetime->format('g:i A') }}
                                        </div>
                                    </div>

                                    <!-- Reject/Cancel Modal inline -->
                                    <div x-show="showReject" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                                        <div @click.away="showReject = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                            <h3 class="font-black text-xl mb-4 text-slate-900 tracking-tight">Cancel Appointment</h3>
                                            <form action="{{ route('doctor.appointments.status', $appointment) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="cancelled">
                                                <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:border-red-500 focus:ring-red-500" placeholder="Reason for cancellation..."></textarea>
                                                <div class="flex justify-end gap-3 mt-2">
                                                    <button type="button" @click="showReject = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Go Back</button>
                                                    <button type="submit" class="px-5 py-2.5 text-sm font-bold bg-red-600 text-white rounded-xl shadow-lg shadow-red-600/20 hover:bg-red-700 transition-colors">Confirm Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Reschedule Modal inline -->
                                    <div x-show="showReschedule" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm">
                                        <div @click.away="showReschedule = false" class="bg-white p-6 rounded-[2rem] max-w-sm w-full shadow-2xl">
                                            <h3 class="font-black text-xl mb-4 text-slate-900 tracking-tight">Propose Reschedule</h3>
                                            <form action="{{ route('doctor.appointments.reschedule', $appointment) }}" method="POST">
                                                @csrf
                                                <div class="mb-4">
                                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">New Date & Time</label>
                                                    <input type="datetime-local" name="new_datetime" required class="w-full rounded-xl border-slate-200 text-sm font-bold focus:border-primary focus:ring-primary shadow-sm" value="{{ $appointment->appointment_datetime->format('Y-m-d\TH:i') }}">
                                                </div>
                                                <textarea name="comment" required class="w-full rounded-xl border-slate-200 text-sm font-bold mb-4 focus:border-primary focus:ring-primary shadow-sm" placeholder="Please provide a message to the patient..."></textarea>
                                                <div class="flex justify-end gap-3 mt-2">
                                                    <button type="button" @click="showReschedule = false" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition-colors">Cancel</button>
                                                    <button type="submit" class="px-5 py-2.5 text-sm font-black text-slate-900 bg-primary rounded-xl shadow-lg shadow-yellow-900/20 hover:scale-105 active:scale-95 transition-all">Send Request</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
