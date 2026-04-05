<div x-data="chatInterface({{ $conversation->id }}, {{ auth()->id() }}, {{ $conversation->is_active ? 'true' : 'false' }})" class="bg-white rounded-[2rem] border border-slate-100 shadow-sm flex flex-col h-[500px]">
    <!-- Header -->
    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-lg font-black text-slate-900 tracking-tight">Interactive Chat</h3>
        <div class="flex items-center gap-4">
            <template x-if="!isActive">
                 <span class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest bg-slate-100 text-slate-500 flex items-center gap-2 border border-slate-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Read Only
                </span>
            </template>
            <span class="px-2.5 py-1 rounded-md text-[9px] font-black uppercase tracking-widest bg-green-50 text-green-600 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Activity Logging
            </span>
        </div>
    </div>

    <!-- Messages Window -->
    <div class="flex-1 p-6 overflow-y-auto space-y-4" x-ref="messagesContainer">
        <!-- Loader -->
        <div x-show="loading" class="flex justify-center items-center py-4 text-slate-400">
            <svg class="w-6 h-6 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
        </div>

        <template x-for="msg in messages" :key="msg.id">
            <div>
                <!-- System Message -->
                <template x-if="msg.metadata && msg.metadata.is_system">
                    <div class="my-6 text-center">
                        <span class="inline-block px-4 py-2 bg-slate-50 border border-slate-100 shadow-inner text-slate-500 rounded-xl text-[10px] font-black uppercase tracking-widest" x-text="msg.message_body"></span>
                    </div>
                </template>

                <!-- Regular Message -->
                <template x-if="!msg.metadata || !msg.metadata.is_system">
                    <div class="flex flex-col gap-1 group" :class="msg.sender_id === userId ? 'items-end' : 'items-start'">
                        <div class="flex items-center gap-2 relative" :style="confirmingDelete === msg.id ? 'min-width: 180px' : ''">
                            <!-- Custom Deletion Confirmation Overlay -->
                            <template x-if="confirmingDelete === msg.id">
                                <div class="absolute inset-0 bg-white/95 backdrop-blur-md z-10 rounded-2xl flex flex-col items-center justify-center gap-2 p-3 shadow-xl border border-red-100 animate-in fade-in zoom-in duration-200">
                                    <span class="text-[9px] font-black text-red-600 uppercase tracking-[0.2em]">Delete Message?</span>
                                    <div class="flex items-center gap-2">
                                        <button @click="executeDelete(msg.id)" class="px-4 py-1.5 bg-red-600 text-white rounded-lg text-[10px] font-black uppercase hover:bg-red-700 transition-all active:scale-95 shadow-sm shadow-red-200">Yes</button>
                                        <button @click="confirmingDelete = null" class="px-4 py-1.5 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase hover:bg-slate-200 transition-all active:scale-95">No</button>
                                    </div>
                                </div>
                            </template>

                            <div class="max-w-[320px] md:max-w-md rounded-2xl p-4 shadow-sm" 
                                 :class="msg.sender_id === userId 
                                    ? (msg.is_deleted ? 'bg-slate-100 text-slate-400 italic' : 'bg-primary text-slate-900') 
                                    : (msg.is_deleted ? 'bg-slate-50 text-slate-400 italic border border-slate-100' : 'bg-slate-50 border border-slate-100 text-slate-700')">
                                <p class="text-[10px] uppercase tracking-widest font-black mb-1 opacity-50" x-text="msg.sender_name"></p>
                                <template x-if="msg.is_deleted">
                                    <p class="text-xs font-bold leading-relaxed flex items-center gap-1.5 text-slate-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                        This message was deleted
                                    </p>
                                </template>
                                <template x-if="!msg.is_deleted">
                                    <p class="text-sm font-bold leading-relaxed whitespace-pre-wrap" x-text="msg.message_body"></p>
                                </template>
                            </div>
                        </div>

                        <!-- Sub-message Actions Row (Only for own messages) -->
                        <template x-if="msg.sender_id === userId && !msg.is_deleted && confirmingDelete !== msg.id">
                            <div class="flex items-center gap-3 px-2 mt-0.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                <template x-if="isActive">
                                    <button @click="confirmingDelete = msg.id" 
                                            class="flex items-center gap-1 text-[9px] font-black text-slate-400 hover:text-red-500 uppercase tracking-widest transition-colors tracking-[0.1em]">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Delete
                                    </button>
                                </template>
                                <span class="text-[9px] text-slate-300 font-bold" x-text="formatTime(msg.created_at)"></span>
                            </div>
                        </template>
                        <template x-if="msg.sender_id !== userId || msg.is_deleted">
                             <div class="px-2 mt-0.5">
                                <span class="text-[9px] text-slate-300 font-bold" x-text="formatTime(msg.created_at)"></span>
                             </div>
                        </template>
                    </div>
                </template>
            </div>
        </template>
    </div>

    <!-- Input Box -->
    <div class="p-6 border-t border-slate-100 bg-slate-50/50 rounded-b-[2rem]">
        <template x-if="isActive">
            <form @submit.prevent="sendMessage" class="flex items-center gap-3">
                <input type="text" x-model="newMessage" placeholder="Type a message..." required class="flex-1 rounded-xl border-slate-200 text-sm font-bold focus:border-primary focus:ring-primary shadow-sm py-3" :disabled="sending">
                <button type="submit" class="px-6 py-3 bg-slate-900 text-white rounded-xl text-sm font-bold hover:bg-slate-800 transition-colors shadow-sm disabled:opacity-50" :disabled="sending || newMessage.trim() === ''">
                    <span x-show="!sending">Send</span>
                    <svg x-show="sending" class="w-5 h-5 animate-spin mx-auto" style="display:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </button>
            </form>
        </template>
        <template x-if="!isActive">
            <div class="flex items-center justify-center p-4 bg-white border border-slate-100 rounded-xl shadow-inner">
                <div class="flex items-center gap-3 text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span class="text-sm font-bold uppercase tracking-widest">Chatting is locked. Confirm an appointment to resume.</span>
                </div>
            </div>
        </template>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chatInterface', (conversationId, userId, isActive) => ({
            conversationId,
            userId,
            isActive,
            messages: [],
            newMessage: '',
            loading: true,
            sending: false,
            confirmingDelete: null,

            init() {
                this.fetchMessages();

                if (window.Echo) {
                    window.Echo.private(`conversation.${this.conversationId}`)
                        .listen('.message.sent', (data) => {
                            this.messages.push(data);
                            this.scrollToBottom();
                        })
                        .listen('.message.deleted', (data) => {
                            const index = this.messages.findIndex(m => m.id === data.id);
                            if (index !== -1) {
                                this.messages[index].is_deleted = true;
                                this.messages[index].message_body = 'This message was deleted';
                            }
                        });
                }
            },

            fetchMessages() {
                axios.get(`/conversations/${this.conversationId}/messages`)
                    .then(response => {
                        this.messages = response.data;
                        this.loading = false;
                        this.scrollToBottom();
                    })
                    .catch(error => console.error(error));
            },

            sendMessage() {
                if (!this.newMessage.trim()) return;

                this.sending = true;
                axios.post(`/conversations/${this.conversationId}/messages`, {
                    message: this.newMessage
                }).then(response => {
                    this.messages.push(response.data);
                    this.newMessage = '';
                    this.scrollToBottom();
                }).catch(error => {
                    console.error(error);
                }).finally(() => {
                    this.sending = false;
                });
            },

            executeDelete(messageId) {
                this.confirmingDelete = null;
                axios.delete(`/conversations/${this.conversationId}/messages/${messageId}`)
                    .then(response => {
                        const index = this.messages.findIndex(m => m.id === messageId);
                        if (index !== -1) {
                            this.messages[index].is_deleted = true;
                            this.messages[index].message_body = 'This message was deleted';
                        }
                    })
                    .catch(error => console.error(error));
            },

            formatTime(timestamp) {
                if (!timestamp) return '';
                const date = new Date(timestamp);
                return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            },

            scrollToBottom() {
                setTimeout(() => {
                    if (this.$refs.messagesContainer) {
                        this.$refs.messagesContainer.scrollTop = this.$refs.messagesContainer.scrollHeight;
                    }
                }, 50);
            }
        }));
    });
</script>
