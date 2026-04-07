@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-bold text-slate-800']) }}>
    {{ $value ?? $slot }}
</label>
