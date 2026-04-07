@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-3 bg-white border border-slate-200 rounded-md focus:ring-1 focus:ring-primary focus:border-primary text-sm font-medium transition-all outline-none']) }}>
