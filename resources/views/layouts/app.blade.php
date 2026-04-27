@php
    $siteSettings = \App\Models\SystemSetting::where('key', 'site_settings')->first()?->value ?? [];
    $defaultTitle = !empty($siteSettings['meta_title']) ? $siteSettings['meta_title'] : config('app.name', 'MedVroom');
    $defaultDescription = !empty($siteSettings['meta_description']) ? $siteSettings['meta_description'] : 'Find and book the best doctors near you with MedVroom. Local doctors, verified reviews, and instant booking.';
    $faviconUrl = !empty($siteSettings['favicon_url']) ? Storage::url($siteSettings['favicon_url']) : null;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' | ' . $defaultTitle : $defaultTitle }}</title>
        <meta name="description" content="{{ $description ?? $defaultDescription }}">
        
        <!-- Open Graph / Social -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ isset($title) ? $title . ' | ' . $defaultTitle : $defaultTitle }}">
        <meta property="og:description" content="{{ $description ?? $defaultDescription }}">
        <meta property="og:site_name" content="{{ $defaultTitle }}">
        @if(!empty($siteSettings['og_image_url']))
            <meta property="og:image" content="{{ asset(Storage::url($siteSettings['og_image_url'])) }}">
        @endif
        
        @if($faviconUrl)
            <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">
        @endif

        <!-- Google Fonts: Instrument Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
        </style>

        @stack('styles')
    </head>
    <body class="antialiased bg-white text-neutral-dark">

        @include('layouts.header')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white border-b border-slate-100">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        @include('layouts.footer')

        <x-cookie-banner />

        @stack('scripts')
    </body>
</html>
