<x-admin-layout>
    <x-slot name="header">
        Email Log Detail
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.mail-logs.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
            Back to Delivery Logs
        </a>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Metadata Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 overflow-hidden">
                <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest leading-none mb-6">Delivery Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter mb-1">Recipient</p>
                        <p class="text-sm font-semibold text-slate-900 break-all">{{ $mailLog->recipient }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter mb-1">Subject</p>
                        <p class="text-sm font-semibold text-slate-900">{{ $mailLog->subject }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter mb-1">Log ID</p>
                        <p class="text-sm font-medium text-slate-600 font-mono text-xs">#{{ $mailLog->id }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter mb-1">Sent At</p>
                        <p class="text-sm font-semibold text-slate-900">{{ $mailLog->sent_at->format('M d, Y H:i:s') }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-tighter mb-1">Status</p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-emerald-100 text-emerald-800">
                            {{ $mailLog->status }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Hint Card -->
            <div class="bg-indigo-50/50 rounded-xl border border-indigo-100 p-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-indigo-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h4 class="text-sm font-bold text-indigo-900">Content Preview</h4>
                        <p class="text-xs text-indigo-600/80 mt-1 leading-relaxed">
                            This is a visual representation of what the user received. Note that some styles might vary depending on the user's email client.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Email Content Preview -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden h-full flex flex-col min-h-[600px]">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest leading-none">Email Content</h3>
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 rounded-full bg-slate-200"></span>
                        <span class="w-3 h-3 rounded-full bg-slate-200"></span>
                        <span class="w-3 h-3 rounded-full bg-slate-200"></span>
                    </div>
                </div>
                
                <div class="flex-grow p-4 bg-slate-100/30 overflow-hidden">
                    <div class="bg-white h-full overflow-y-auto rounded shadow-sm border border-slate-200">
                        <iframe 
                            srcdoc="{{ $mailLog->body }}" 
                            class="w-full h-[800px] border-none"
                            sandbox="allow-popups allow-popups-to-escape-sandbox"
                        ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
