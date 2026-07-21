@props(['title' => '', 'description' => '', 'currentStep' => 0])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name', 'MedVroom') }}</title>

    @if(config('site.favicon'))
        <link rel="icon" type="image/png" href="{{ Storage::url(config('site.favicon')) }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900 text-[15px]">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Sidebar / Progress (Left) -->
        <div class="lg:w-[400px] bg-slate-900 text-white p-8 lg:p-12 flex flex-col justify-between shrink-0 relative overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>

            <div class="relative z-10">
               <img
            src="{{ asset('build/assets/whitelogo.png') }}"
            alt="Medvroom"
            class="h-10 object-contain group-hover:scale-105 transition-transform duration-200" style="width: 260px; object-fit: cover;"
        >

                @if($currentStep > 0)
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-white mb-8">Provider Onboarding</h2>
                    <nav class="space-y-4">
                        @php
                            // Matches the controller's actual flow: Account -> Practice -> License
                            // -> Practice Details -> Payment Setup -> Legal Agreements -> Profile Builder.
                            // "Security" and "Review" were removed: those steps have no view in the
                            // current flow (verify()/review() controller methods just redirect away),
                            // so leaving them in the sidebar stranded users after Legal Agreements.
                            $steps = [
                                1 => 'Account',
                                2 => 'Identity',
                                3 => 'License',
                                4 => 'Practice Details',
                                5 => 'Payment Setup',
                                6 => 'Legal Agreements',
                                7 => 'Agreements',
                                8 => 'Profile',
                            ];
                            $totalSteps = count($steps);
                        @endphp

                        @foreach($steps as $stepNum => $stepLabel)
                        <div class="flex items-center space-x-4">
                            <div @class([
                                'w-8 h-8 rounded-full flex items-center justify-center text-xs font-black transition-all',
                                'bg-indigo-600 text-white ring-4 ring-indigo-500/30' => $currentStep == $stepNum,
                                'bg-emerald-500 text-white' => $currentStep > $stepNum,
                                'bg-slate-800 text-slate-500' => $currentStep < $stepNum,
                            ])>
                                @if($currentStep > $stepNum)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                @else
                                    {{ $stepNum }}
                                @endif
                            </div>
                            <span @class([
                                'text-sm font-bold transition-all',
                                'text-white' => $currentStep == $stepNum,
                                'text-emerald-400' => $currentStep > $stepNum,
                                'text-slate-500' => $currentStep < $stepNum,
                            ])>{{ $stepLabel }}</span>
                        </div>
                        @endforeach
                    </nav>
                </div>
                @else
                <div class="mt-20">
                    <h1 class="text-5xl font-black leading-tight text-white mb-6" style="font-weight: 700 !important;">Grow your practice with {{ config('app.name') }}</h1>
                    <p class="text-slate-400 text-lg leading-relaxed">Join thousands of providers who trust {{ config('app.name') }} to connect with patients and manage their clinical operations.</p>
                </div>
                @endif
            </div>


        </div>

        <!-- Content (Right) -->
        <main class="flex-1 overflow-y-auto bg-white lg:bg-slate-50">
            <div class="max-w-3xl mx-auto px-6 py-12 lg:py-20">
                <div class="mb-10 flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight leading-tight">{{ $title }}</h2>
                        @if($description)
                            <p class="text-slate-500 mt-2 font-semibold">{{ $description }}</p>
                        @endif
                    </div>
                    @if($currentStep > 0)
                    <div class="text-right">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Progress</p>
                        <p class="text-xl font-black text-indigo-600 leading-none mt-1">{{ round(($currentStep / 8) * 100) }}%</p>
                    </div>
                    @endif
                </div>

                {{ $slot }}
            </div>
        </main>
    </div>
    @stack('scripts')
</body>
</html>