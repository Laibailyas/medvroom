<x-doctor-layout>
    <div class="flex h-[calc(100vh-140px)] -m-6 lg:-m-12 overflow-hidden bg-white rounded-[2.5rem] border border-slate-100 shadow-sm">
        <!-- Messenger Sidebar -->
        <div class="w-80 md:w-96 flex flex-col border-r border-slate-100 flex-shrink-0 bg-slate-50/30">
            <div class="p-8 border-b border-slate-100">
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter mb-6 italic uppercase">Patient Chat</h2>
                <div class="relative group">
                    <input type="text" placeholder="Search history..." class="w-full pl-12 pr-6 py-4 rounded-2xl border-transparent bg-white text-sm font-bold focus:ring-2 focus:ring-primary shadow-sm transition-all">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 group-focus-within:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Conversation List -->
            <div class="flex-1 overflow-y-auto divide-y divide-slate-50">
                @forelse($conversations as $conv)
                    <a href="{{ route('doctor.chat.show', $conv) }}" 
                       class="flex items-center gap-5 p-6 hover:bg-slate-50 transition-all border-l-4 {{ isset($conversation) && $conversation->id === $conv->id ? 'bg-white border-primary shadow-sm' : 'border-transparent' }}">
                        <div class="w-14 h-14 rounded-2xl bg-white border border-slate-100 shadow-sm flex-shrink-0 flex items-center justify-center overflow-hidden">
                            @if($conv->partner && $conv->partner->getProfilePhotoUrl())
                                <img src="{{ $conv->partner->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xl font-black text-slate-200 uppercase">{{ substr($conv->partner?->first_name ?? '?', 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="font-black text-slate-900 truncate italic tracking-tight">{{ $conv->partner?->name ?? 'Unknown' }}</h4>
                                <span class="text-[10px] font-black text-slate-400 whitespace-nowrap uppercase tracking-widest italic">{{ $conv->last_message_at ? $conv->last_message_at->shortRelativeDiffForHumans() : '' }}</span>
                            </div>
                            <p class="text-xs {{ isset($conversation) && $conversation->id === $conv->id ? 'text-slate-600' : 'text-slate-400 font-bold' }} truncate italic">
                                @if($conv->messages->first())
                                    {{ $conv->messages->first()->message_body }}
                                @else
                                    No messages yet.
                                @endif
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="p-12 text-center text-slate-300">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <p class="text-sm font-black italic uppercase tracking-widest">No Active Chats</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Main Chat Area -->
        <div class="flex-1 flex flex-col bg-white">
            @if(isset($conversation))
                <!-- Chat Partner Header -->
                <div class="px-10 py-6 border-b border-slate-100 flex items-center justify-between bg-white shadow-sm shrink-0">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center overflow-hidden">
                            @if($conversation->partner && $conversation->partner->getProfilePhotoUrl())
                                <img src="{{ $conversation->partner->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-lg font-black text-slate-200 uppercase">{{ substr($conversation->partner?->first_name ?? '?', 0, 1) }}</span>
                            @endif
                        </div>
                        <div>
                            <h3 class="font-black text-slate-900 text-lg italic tracking-tighter">{{ $conversation->partner?->name ?? 'Unknown User' }}</h3>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Connection Live</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                         <a href="{{ route('doctor.patients.show', $conversation->patient_id) }}" 
                            class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-900 rounded-2xl font-black text-[10px] uppercase tracking-widest italic transition-all border border-slate-200 shadow-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            View Records
                        </a>
                    </div>
                </div>

                <!-- Chat Body (Reusing the component) -->
                <div class="flex-1 overflow-hidden">
                    <x-chat-interface :conversation="$conversation" />
                </div>
            @else
                <!-- No Conversation Selected -->
                <div class="flex-1 flex flex-col items-center justify-center bg-slate-50/30 p-12 text-center">
                    <div class="w-32 h-32 bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 flex items-center justify-center mb-8 border border-slate-100">
                        <svg class="w-16 h-16 text-primary animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h2 class="text-4xl font-black text-slate-900 tracking-tighter italic mb-4">Patient Messaging</h2>
                    <p class="text-slate-400 font-bold max-w-sm italic">Communicate securely with your patients. Select a thread on the left to review history or send a new message.</p>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
    <style>
        .animate-bounce-slow {
            animation: bounce 3s infinite;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(-5%); animation-timing-function: cubic-bezier(0.8, 0, 1, 1); }
            50% { transform: translateY(0); animation-timing-function: cubic-bezier(0, 0, 0.2, 1); }
        }
    </style>
    @endpush
</x-doctor-layout>
