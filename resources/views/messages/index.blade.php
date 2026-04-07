<x-app-layout>
    <div class="flex h-[calc(100vh-64px)] overflow-hidden bg-white">
        <!-- Messenger Sidebar -->
        <div class="w-80 md:w-96 flex flex-col border-r border-slate-100 flex-shrink-0 bg-slate-50/30">
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-2xl font-black text-slate-900 tracking-tight mb-4 italic uppercase">Messages</h2>
                <div class="relative">
                    <input type="text" placeholder="Search conversations..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-100 bg-white text-sm font-bold focus:border-primary focus:ring-primary shadow-sm">
                    <svg class="absolute left-3 top-3 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Conversation List -->
            <div class="flex-1 overflow-y-auto divide-y divide-slate-50">
                @forelse($conversations as $conv)
                    <a href="{{ route('messages.index', $conv) }}" 
                       class="flex items-center gap-4 p-5 hover:bg-slate-50 transition-all border-l-4 {{ isset($conversation) && $conversation->id === $conv->id ? 'bg-white border-primary shadow-sm' : 'border-transparent' }}">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-slate-100 shadow-sm flex-shrink-0 flex items-center justify-center overflow-hidden">
                            @if($conv->partner && $conv->partner->getProfilePhotoUrl())
                                <img src="{{ $conv->partner->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            @elseif($conv->partner)
                                <span class="text-lg font-black text-slate-200 uppercase">{{ substr($conv->partner->first_name, 0, 1) }}</span>
                            @else
                                <span class="text-lg font-black text-slate-200 uppercase">?</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start mb-0.5">
                                <h4 class="font-bold text-slate-900 truncate">{{ $conv->partner?->name ?? 'Unknown User' }}</h4>
                                <span class="text-[10px] font-bold text-slate-400 whitespace-nowrap">{{ $conv->last_message_at ? $conv->last_message_at->shortRelativeDiffForHumans() : '' }}</span>
                            </div>
                            <p class="text-xs {{ isset($conversation) && $conversation->id === $conv->id ? 'text-slate-600' : 'text-slate-400 font-medium' }} truncate">
                                @if($conv->messages->first())
                                    {{ $conv->messages->first()->message_body }}
                                @else
                                    No messages yet.
                                @endif
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="p-10 text-center text-slate-400">
                        <p class="text-sm font-bold">No conversations yet.</p>
                        <p class="text-xs mt-1">Book an appointment to start chatting.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col bg-white">
            @if(isset($conversation))
                <!-- Chat Partner Header -->
                <div class="px-8 py-5 border-b border-slate-100 flex items-center justify-between bg-white shadow-sm shrink-0">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center overflow-hidden">
                            @if($conversation->partner && $conversation->partner->getProfilePhotoUrl())
                                <img src="{{ $conversation->partner->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            @elseif($conversation->partner)
                                <span class="text-sm font-black text-slate-200 uppercase">{{ substr($conversation->partner->first_name, 0, 1) }}</span>
                            @else
                                <span class="text-sm font-black text-slate-200 uppercase">?</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-black text-slate-900">{{ $conversation->partner?->name ?? 'Unknown User' }}</h3>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Active Partner</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                         <a href="{{ auth()->user()->isDoctor() ? route('doctor.patients.show', $conversation->patient_id) : route('doctors.show', $conversation->doctor_id) }}" 
                            class="p-2 text-slate-400 hover:text-slate-900 transition-colors bg-slate-50 rounded-lg border border-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Chat Body (Reusing the component but in a scrollable container) -->
                <div class="flex-1 overflow-hidden">
                    <x-chat-interface :conversation="$conversation" />
                </div>
            @else
                <!-- No Conversation Selected -->
                <div class="flex-1 flex flex-col items-center justify-center bg-slate-50 p-10 text-center">
                    <div class="w-32 h-32 bg-white rounded-[2rem] shadow-xl shadow-slate-200 flex items-center justify-center mb-6 border border-slate-100">
                        <svg class="w-16 h-16 text-primary animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight italic mb-2">Select a Conversation</h2>
                    <p class="text-slate-500 font-bold max-w-sm">Choose one of your active patient/doctor threads from the left sidebar to begin real-time chatting.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Styles for the messenger feel -->
    @push('styles')
    <style>
        .animate-bounce-slow {
            animation: bounce 3s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(-5%); animation-timing-function: cubic-bezier(0.8, 0, 1, 1); }
            50% { transform: translateY(0); animation-timing-function: cubic-bezier(0, 0, 0.2, 1); }
        }
        /* Override app layout container if needed but x-app-layout usually does full screen */
    </style>
    @endpush
</x-app-layout>
