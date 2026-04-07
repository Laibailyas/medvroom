<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title . ' | ' . config('app.name', 'MedVroom Admin') : config('app.name', 'MedVroom Admin') }}</title>
        <meta name="description" content="{{ $description ?? 'MedVroom administration panel for managing providers, appointments, and reviews.' }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
        </style>
    </head>
    <body class="bg-gray-50 text-slate-900 antialiased">
        <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">
            
            <!-- Sidebar Navigation -->
            <x-admin.sidebar />

            <!-- Main Content Area -->
            <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
                
                <!-- Top Header -->
                <header class="sticky top-0 z-30 bg-white border-b border-slate-200">
                    <div class="px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between h-16 -mb-px">
                            
                            <!-- Sidebar Mobile Toggle -->
                            <div class="flex">
                                <button
                                    class="text-slate-500 hover:text-slate-600 lg:hidden"
                                    @click.stop="sidebarOpen = !sidebarOpen"
                                    aria-controls="sidebar"
                                    :aria-expanded="sidebarOpen"
                                >
                                    <span class="sr-only">Open sidebar</span>
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="4" y="5" width="16" height="2" />
                                        <rect x="4" y="11" width="16" height="2" />
                                        <rect x="4" y="17" width="16" height="2" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Right Header Actions -->
                            <div class="flex items-center space-x-3">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-sm font-medium text-slate-500 hover:text-slate-600 transition duration-150 ease-in-out">
                                            <div class="mr-1">{{ Auth::user()->name }}</div>
                                            <svg class="w-4 h-4 fill-current ml-1" viewBox="0 0 12 12">
                                                <path d="M5.9 8L1.6 3.7c-.4-.4-.4-1 0-1.4s1-.4 1.4 0l2.9 2.9 2.9-2.9c.4-.4 1-.4 1.4 0s.4 1 0 1.4L5.9 8z" />
                                            </svg>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="grow">
                    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
                        
                        <!-- Page Header -->
                        @if (isset($header))
                            <div class="sm:flex sm:justify-between sm:items-center mb-8">
                                <div class="mb-4 sm:mb-0">
                                    <h1 class="text-2xl md:text-3xl text-slate-800 font-bold tracking-tight">
                                        {{ $header }}
                                    </h1>
                                </div>
                            </div>
                        @endif

                        {{ $slot }}
                    </div>
                </main>

            </div>
        </div>
        @stack('scripts')
    </body>
</html>
