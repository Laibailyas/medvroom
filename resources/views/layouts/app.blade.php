<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' | ' . config('app.name', 'MedVroom') : config('app.name', 'MedVroom') }}</title>
        <meta name="description" content="{{ $description ?? 'Find and book the best doctors near you with MedVroom. Local doctors, verified reviews, and instant booking.' }}">

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

        @stack('scripts')
    </body>
</html>
