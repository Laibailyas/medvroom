<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter text-slate-900">Earnings & Payouts</h1>
                <p class="text-slate-500 font-bold mt-1 uppercase tracking-widest text-[10px]">Manage your clinical revenue and automated bank transfers.</p>
            </div>
            @if(!$doctorProfile->payouts_enabled)
                <form action="{{ route('doctor.payouts.connect') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-8 py-4 bg-primary text-slate-900 rounded-[1.5rem] font-black text-sm hover:scale-105 transition-all shadow-xl shadow-primary/20 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M13.93 11a5.04 5.04 0 0 1-2.93-2.93L15.93 3h5.07l-7.07 8zM11 13.93a5.04 5.04 0 0 1 2.93 2.93L21 21h-5.07l-4.93-7.07zM13 12a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM3 21l7.07-8A5.04 5.04 0 0 1 8 10.07L3 15.93V21zm0-5.07l5.93-7.07A5.04 5.04 0 0 1 10.07 8L3 3v5.07z"/></svg>
                        Connect Stripe account
                    </button>
                </form>
            @else
                <div class="flex items-center gap-4 px-6 py-3 bg-emerald-50 rounded-2xl border border-emerald-100">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-xs font-black text-emerald-600 uppercase tracking-widest ">Payouts Active</span>
                </div>
            @endif
        </div>

        <!-- Balance Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-slate-900/10 relative overflow-hidden group">
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-primary/10 rounded-full blur-3xl group-hover:bg-primary/20 transition-all duration-700"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Available for Withdrawal</p>
                    <h2 class="text-5xl font-black tracking-tighter text-primary">${{ number_format($availableBalance, 2) }}</h2>
                    <p class="text-xs font-bold text-slate-400 mt-4 leading-relaxed max-w-xs">Funds available to be transferred to your linked bank account.</p>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-blue-500/5 rounded-full blur-3xl group-hover:bg-blue-500/10 transition-all duration-700"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Pending Clearance</p>
                    <h2 class="text-5xl font-black tracking-tighter text-slate-900">${{ number_format($pendingBalance, 2) }}</h2>
                    <p class="text-xs font-bold text-slate-400 mt-4 leading-relaxed max-w-xs">Revenue from recent appointments currently processing by Stripe.</p>
                </div>
            </div>
        </div>

        <!-- Payout History -->
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50">
                <h2 class="text-2xl font-black tracking-tighter text-slate-900 leading-none">Transaction Record</h2>
                <p class="text-xs font-bold text-slate-400 mt-2 uppercase tracking-widest">History of all transfers to your clinical practice bank account.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 ">Reference ID</th>
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 ">DateTime</th>
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 ">Amount</th>
                            <th class="px-8 py-6 text-[10px] uppercase font-black tracking-widest text-slate-400 ">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($payouts as $payout)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6 font-black text-slate-900 tracking-tight">#{{ $payout->id }}</td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black tracking-tight text-slate-700">{{ $payout->created_at->format('M d, Y') }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $payout->created_at->format('g:i A') }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-lg font-black tracking-tighter text-slate-900">${{ number_format($payout->amount, 2) }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $statusClass = match($payout->status) {
                                            'paid' => 'bg-emerald-50 text-emerald-600',
                                            'pending' => 'bg-orange-50 text-orange-600',
                                            'failed' => 'bg-red-50 text-red-600',
                                            default => 'bg-slate-50 text-slate-600'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $statusClass }}">
                                        {{ $payout->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-[2.5rem] flex items-center justify-center text-slate-300 mx-auto mb-6 shadow-sm">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                    </div>
                                    <p class="text-slate-400 font-bold tracking-tight">No transactional data recorded yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($payouts->hasPages())
                <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 font-bold">
                    {{ $payouts->links() }}
                </div>
            @endif
        </div>
    </div>
</x-doctor-layout>
