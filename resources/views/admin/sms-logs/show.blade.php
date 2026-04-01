<x-admin-layout>
    <x-slot name="header">
        SMS Log Details
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('admin.sms-logs.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-slate-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="m15 18-6-6 6-6"/></svg>
            Back to logs
        </a>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Log Metadata -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-6 border-b border-slate-100 pb-4">Delivery Metadata</h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Recipient</p>
                        <p class="text-sm font-bold text-slate-900 font-mono">{{ $smsLog->recipient }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-black uppercase tracking-widest {{ $smsLog->status === 'sent' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                            {{ $smsLog->status }}
                        </span>
                    </div>

                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Sent Timestamp</p>
                        <p class="text-sm font-bold text-slate-900">{{ $smsLog->sent_at?->format('F j, Y, g:i a') ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Internal Reference</p>
                        <p class="text-xs font-medium text-slate-500 font-mono">SMS_LOG_{{ $smsLog->id }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message Body -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden flex flex-col h-full">
                <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-800">Message Preview</h3>
                </div>
                
                <div class="p-8 flex-1 flex items-center justify-center bg-slate-100/50">
                    <div class="max-w-xs w-full bg-[#E9E9EB] text-black rounded-2xl py-3 px-4 shadow-sm relative">
                        <p class="text-[15px] leading-snug">{{ $smsLog->body }}</p>
                        <div class="absolute -bottom-1 -left-1 w-4 h-4 bg-[#E9E9EB] rounded-full"></div>
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                    <p class="text-[11px] text-slate-400 font-medium italic text-center">
                        This is a simulated preview of the SMS content. Actual delivery appearance may vary by device.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
