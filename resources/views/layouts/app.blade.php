<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyDoc - Find and book the best doctors</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Alpine.js (for simple interactions) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-surface-muted text-gray-900 overflow-x-hidden">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-surface-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div
                        class="w-10 h-10 bg-brand-blue rounded-xl flex items-center justify-center shadow-lg shadow-brand-blue/20 text-white">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M18 6h-1V4c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H6c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2M9 4h6v2H9zM6 20V8h12v12z">
                            </path>
                            <path d="M13 10h-2v3H8v2h3v3h2v-3h3v-2h-3z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-gray-900">My<span
                            class="text-brand-blue">Doc</span></span>
                </div>

                <!-- Nav Links -->
                <div class="hidden md:flex items-center gap-8 font-bold">
                    <a href="#" class="text-xs text-gray-900 hover:text-brand-blue transition-colors">List your practice on MyDoc</a>
                    <div class="h-4 w-px bg-gray-200"></div>
                    <a href="#" class="text-sm text-gray-600 hover:text-brand-blue transition-colors">Log in</a>
                    <a href="#" class="px-5 py-2 bg-brand-blue rounded-full text-sm text-white hover:bg-brand-blue/90 shadow-sm transition-all hover:scale-105 active:scale-95">Sign up</a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button class="p-2 text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 text-gray-400">
                <div class="col-span-2 md:col-span-1">
                    <div class="flex items-center gap-2 mb-6">
                        <div
                            class="w-10 h-10 bg-brand-blue rounded-xl flex items-center justify-center shadow-lg shadow-brand-blue/20 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4.8 2.3A7.3 7.3 0 1 0 11 9.7" />
                                <path d="M12 9.7V19a2 2 0 0 0 4 0v-2" />
                                <path d="M12 11h8" />
                                <path d="M20 7v4a2 2 0 0 1-2 2h-2" />
                                <circle cx="10" cy="19" r="2" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold tracking-tight text-white">MyDoc</span>
                    </div>
                    <p class="text-sm leading-relaxed mb-6">
                        Making healthcare simple, transparent, and easy to book. Find the care you need, when you need
                        it.
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-6">Search by</h3>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Specialty</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Condition</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Doctor Name</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Location</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-6">For Providers</h3>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-brand-blue transition-colors">List your practice</a>
                        </li>
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Provider Dashboard</a>
                        </li>
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Resources</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-6">About</h3>
                    <ul class="space-y-4 text-sm">
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Our Mission</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Careers</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Press</a></li>
                        <li><a href="#" class="hover:text-brand-blue transition-colors">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div
                class="mt-16 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
                <p>&copy; 2026 MyDoc Inc. All rights reserved.</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
