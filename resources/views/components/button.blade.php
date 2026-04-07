@props(['variant' => 'primary', 'type' => 'submit', 'size' => 'md'])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold rounded-md transition-all outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none active:scale-[0.98]';

    $variants = [
        'primary' => 'bg-primary text-white hover:bg-primary-hover border border-transparent focus:ring-primary shadow-sm',
        'secondary' => 'bg-white text-slate-700 hover:bg-slate-50 border border-slate-300 focus:ring-slate-400 shadow-sm',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 border border-transparent focus:ring-red-500 shadow-sm',
    ];

    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-6 py-2.5 text-sm',
        'lg' => 'px-8 py-3 text-sm',
        'full' => 'w-full py-4 text-sm',
        'icon' => 'p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 shadow-none border-none active:scale-100', // Specialized for admin row deletion
    ];

    $variantClasses = $variants[$variant] ?? $variants['primary'];
    
    // For icon variant, we override the variant classes to strip out standard danger red backgrounds
    if ($size === 'icon' && $variant === 'danger') {
        $variantClasses = 'bg-transparent text-slate-400 hover:text-red-600 hover:bg-red-50';
    }

    $sizeClasses = $sizes[$size] ?? $sizes['md'];
    
    $tag = $attributes->has('href') ? 'a' : 'button';
@endphp

<{{ $tag }} {{ $attributes->merge(['type' => ($tag === 'button' ? $type : null), 'class' => trim($baseClasses . ' ' . $variantClasses . ' ' . $sizeClasses)]) }}>
    {{ $slot }}
</{{ $tag }}>
