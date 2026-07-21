@php
    $siteSettings = \App\Models\SystemSetting::where('key', 'site_settings')->first()?->value ?? [];
    $defaultTitle = !empty($siteSettings['meta_title']) ? $siteSettings['meta_title'] : config('app.name', 'MedVroom');
    $defaultDescription = !empty($siteSettings['meta_description']) ? $siteSettings['meta_description'] : 'MedVroom: Find doctors, read reviews, and book appointments online. High-quality care at your fingertips.';
    $faviconUrl = !empty($siteSettings['favicon_url']) ? Storage::url($siteSettings['favicon_url']) : null;
    $logoUrl = !empty($siteSettings['logo_url']) ? Storage::url($siteSettings['logo_url']) : null;
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

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    @if($logoUrl)
                        <img src="{{ asset('build/assets/logo.jpeg') }}" alt="{{ $defaultTitle }}" class="h-20 object-contain mx-auto">
                    @else
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    @endif
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <x-cookie-banner />
    </body>
</html>
