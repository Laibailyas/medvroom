@props(['availability', 'startDate', 'endDate', 'doctor'])

<div class="availability-grid flex gap-1 py-2 overflow-x-auto scrollbar-hide">
    @php
        $current = $startDate->copy();
    @endphp
    @while ($current <= $endDate)
        @php
            $dateKey = $current->format('Y-m-d');
            $slots = $availability[$dateKey] ?? [];
            $count = count($slots);
            $isToday = $current->isToday();
        @endphp
        
        <div class="flex-1 min-w-[55px] text-center">
            <!-- Day/Date Header -->
            <div class="text-[10px] leading-tight {{ $isToday ? 'text-slate-900 font-black' : 'text-slate-500 font-semibold' }} mb-1.5 mt-1">
                <div class="uppercase">{{ $current->format('D') }}</div>
                <div class="text-[9px] opacity-75">{{ $current->format('M j') }}</div>
            </div>
            
            <!-- Availability Box -->
            @if ($count > 0)
                <div @click="$dispatch('open-booking-modal', { doctor: @js($doctor), date: '{{ $dateKey }}', slots: @js($slots) })" 
                     class="group cursor-pointer transform active:scale-95 transition-all duration-200">
                    <div class="bg-[#faffb8] hover:bg-[#fff952] rounded-xl p-1.5 h-[52px] flex flex-col items-center justify-center border border-yellow-100 shadow-sm transition-colors">
                        <span class="text-xs font-black text-slate-900 leading-none mb-0.5">{{ $count }}</span>
                        <span class="text-[8px] font-bold text-slate-700 uppercase tracking-tighter leading-none">appts</span>
                    </div>
                </div>
            @else
                <div class="bg-slate-50/50 rounded-xl p-1.5 h-[52px] flex flex-col items-center justify-center border border-slate-100/50">
                    <span class="text-[8px] font-bold text-slate-300 leading-none uppercase mb-0.5">No</span>
                    <span class="text-[8px] font-bold text-slate-300 uppercase tracking-tighter leading-none">appts</span>
                </div>
            @endif
        </div>
        @php $current->addDay(); @endphp
    @endwhile
    
    <!-- More Button -->
    <div class="flex-1 min-w-[55px] text-center self-end">
        <a href="#" class="group block transform active:scale-95 transition-all duration-200">
            <div class="bg-white hover:bg-slate-50 rounded-xl p-1.5 h-[52px] flex flex-col items-center justify-center border-2 border-slate-100 transition-all font-black">
                <span class="text-[9px] text-slate-900 uppercase tracking-tighter">More</span>
            </div>
        </a>
    </div>
</div>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
