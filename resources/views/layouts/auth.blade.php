<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' | ' . config('app.name', 'MedVroom') : config('app.name', 'MedVroom') . ' - Secure Enrollment' }}</title>
        <meta name="description" content="{{ $description ?? 'Securely log in or register with MedVroom to manage your healthcare appointments and reviews.' }}">

        <!-- Google Fonts: Instrument Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Instrument Sans', sans-serif; background-color: #F7F8F9; }
        </style>
    </head>
    <body class="text-neutral-dark antialiased selection:bg-orange-100 selection:text-orange-900">

        @include('layouts.header', ['forProviders' => $forProviders ?? false])

        <main class="min-h-screen">
            {{ $slot }}
        </main>

        @include('layouts.footer')

        <x-cookie-banner />

    </body>
</html>
