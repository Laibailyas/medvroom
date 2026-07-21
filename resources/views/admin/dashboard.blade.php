<x-admin-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Stats Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Total Patients -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Patients</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_patients']) }}</h3>
                </div>
            </div>
        </div>

        <!-- Active Providers -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1a.3.3 0 1 0 .2-.3Z"/><circle cx="8" cy="9" r="4"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Providers</p>
                        <h3 class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_doctors']) }}</h3>
                    </div>
                </div>
                @if($stats['pending_providers'] > 0)
                    <a href="{{ route('admin.providers.index', ['verified' => '0']) }}" class="shrink-0 px-2 py-1 bg-amber-100 text-amber-700 text-[10px] font-black uppercase tracking-widest rounded-full hover:bg-amber-200 transition-colors">
                        {{ $stats['pending_providers'] }} pending
                    </a>
                @endif
            </div>
        </div>

        <!-- Total Appointments -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Appointments</p>
                    <h3 class="text-2xl font-bold text-slate-900">{{ number_format($stats['total_appointments']) }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm transition-all hover:shadow-md">
            <div class="flex items-center">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-lg mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="1" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-slate-900">${{ number_format($stats['total_revenue'], 2) }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- Charts & Activity Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Appointments Chart (real data) -->
        <div class="lg:col-span-2 bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-800">Appointment Trends</h3>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Last 12 months</span>
            </div>
            <div id="appointments-chart" class="h-80 w-full"></div>
        </div>

        <!-- Recent Appointments -->
        <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-800">Recent Activity</h3>
                <a href="{{ route('admin.appointments.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">View all</a>
            </div>
            
            <div class="space-y-4">
                @forelse($stats['recent_appointments'] as $appointment)
                    @php
                        $patientName = $appointment->patientProfile?->user?->name ?? 'Unknown Patient';
                        $doctorName  = $appointment->doctorProfile?->user?->name  ?? 'Unknown Provider';
                    @endphp
                    <div class="flex items-start pb-4 border-b border-slate-50 last:border-0 last:pb-0">
                        <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 mr-3 text-xs shrink-0 uppercase">
                            {{ substr($patientName, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-900 truncate">{{ $patientName }}</p>
                            <p class="text-xs text-slate-500 truncate">with {{ $doctorName }}</p>
                        </div>
                        <div class="text-right shrink-0 ml-2">
                            <p class="text-xs font-medium text-slate-700">{{ $appointment->appointment_datetime->format('M d') }}</p>
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold uppercase {{ $appointment->status == 'completed' ? 'bg-emerald-50 text-emerald-600' : 'bg-amber-50 text-amber-600' }}">
                                {{ $appointment->status }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 text-center py-8 italic">No recent appointments found</p>
                @endforelse
            </div>
        </div>

    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                series: [{
                    name: 'Appointments',
                    data: {!! json_encode($stats['chart_data']) !!}
                }],
                chart: {
                    height: 320,
                    type: 'area',
                    toolbar: { show: false },
                    fontFamily: 'Instrument Sans, sans-serif'
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 3, colors: ['#4f46e5'] },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [20, 100, 100, 100]
                    }
                },
                xaxis: {
                    categories: {!! json_encode($stats['chart_labels']) !!},
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                },
                yaxis: { show: false },
                grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
                colors: ['#4f46e5']
            };

            var chart = new ApexCharts(document.querySelector("#appointments-chart"), options);
            chart.render();
        });
    </script>
    @endpush
</x-admin-layout>
