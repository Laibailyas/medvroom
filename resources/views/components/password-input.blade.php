@props(['disabled' => false])

<div x-data="{ show: false }" class="relative w-full">
    <input 
        :type="show ? 'text' : 'password'" 
        @disabled($disabled) 
        {{ $attributes->merge(['class' => 'w-full px-4 py-3 pr-11 bg-white border border-slate-200 rounded-md focus:ring-1 focus:ring-primary focus:border-primary text-sm font-medium transition-all outline-none']) }}
    >
    <button 
        type="button" 
        class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors"
        @click="show = !show"
        tabindex="-1"
    >
        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
            <circle cx="12" cy="12" r="3" />
        </svg>
        <svg x-show="show" x-cloak xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
            <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
            <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
            <path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
            <line x1="2" y1="2" x2="22" y2="22" />
        </svg>
    </button>
</div>
