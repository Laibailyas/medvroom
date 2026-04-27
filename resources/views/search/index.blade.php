<x-app-layout>
    <div x-data="{}" class="h-[calc(100vh-64px)] flex flex-col bg-white overflow-hidden">
        <!-- Top Filter Bar -->
        <div class="flex-none bg-white border-b border-slate-100 px-6 py-4 shadow-sm z-30">
            <div class="max-w-full mx-auto flex flex-wrap items-center gap-3">
                <div class="flex items-center gap-2 mr-4">
                    <span class="w-3 h-3 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Active Results</span>
                </div>
                <button
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm">Date
                    & Time</button>
                <button
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm">Annual
                    Physical</button>
                <button
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm">Specialty</button>
                <button
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm">Gender</button>
                <button
                    class="bg-slate-50 hover:bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest border border-slate-200 transition-all shadow-sm">In-person/video</button>
                <button
                    class="ml-auto bg-slate-900 text-white px-5 py-2.5 rounded-full text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-slate-900/20 hover:scale-105 active:scale-95">More
                    filters</button>
            </div>
        </div>

        <div class="flex-1 flex overflow-hidden lg:flex-row flex-col">
            <!-- Left Side: Results -->
            <div class="flex-1 overflow-y-auto bg-slate-50/40 px-4 sm:px-8 lg:px-12 py-12 scrollbar-premium">
                <div class="max-w-5xl mx-auto">
                    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-6">
                        <div class="relative group">
                            <div
                                class="absolute -left-6 top-1/2 -translate-y-1/2 w-1.5 h-12 bg-primary rounded-full transform scale-y-0 group-hover:scale-y-100 transition-transform duration-500">
                            </div>
                            <h1 class="text-5xl font-black text-slate-900 tracking-tighter leading-none mb-3">
                                {{ $doctors->total() }} <span class="text-primary italic">Providers</span>
                            </h1>
                            <div class="flex items-center gap-3">
                                <span class="flex h-2 w-2 relative">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                </span>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-[0.2em]">
                                    Available in <span
                                        class="text-slate-900">{{ request('location', 'Brooklyn, NY') }}</span> •
                                    {{ $userTimezone }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-4">Sort
                                by:</span>
                            <button
                                class="text-[10px] font-black text-slate-900 uppercase tracking-tighter px-4 py-2 bg-slate-50 rounded-xl transition-all">Best
                                Match</button>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @forelse($doctors as $doctor)
                            <x-doctor-card :doctor="$doctor" :startDate="$startDate" :endDate="$endDate" />
                        @empty
                            <div class="bg-white rounded-[2.5rem] p-16 text-center shadow-sm border border-slate-100">
                                <div
                                    class="w-24 h-24 bg-slate-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-black text-slate-900 mb-2 tracking-tight">No match found</h3>
                                <p class="text-slate-500 font-medium">Try adjusting your filters or search location</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-20 pb-20">
                        {{ $doctors->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>

            <!-- Right Side: Map -->
            <div
                class="hidden lg:block lg:w-[38%] xl:w-[35%] relative bg-slate-50 border-l border-slate-100 transition-all overflow-hidden">
                <div id="search-map" class="w-full h-full z-10"></div>

                <!-- Map UI Overlays -->
                <div class="absolute top-8 left-1/2 -translate-x-1/2 z-20 w-fit">
                    <button
                        class="bg-slate-900 text-white px-8 py-4 rounded-2xl shadow-2xl border border-slate-800 text-[11px] font-black uppercase tracking-[0.2em] hover:bg-slate-800 hover:scale-105 active:scale-95 transition-all flex items-center gap-3 whitespace-nowrap group">
                        <svg class="w-4 h-4 text-primary group-hover:rotate-45 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Search this area
                    </button>
                </div>

                <div class="absolute bottom-8 right-8 z-20 flex flex-col gap-2">
                    {{-- <button onclick="leafletMap?.zoomIn()" class="w-12 h-12 bg-white text-slate-900 rounded-xl shadow-xl flex items-center justify-center font-black text-xl hover:bg-slate-50 transition-all border border-slate-100">+</button>
                    <button onclick="leafletMap?.zoomOut()" class="w-12 h-12 bg-white text-slate-900 rounded-xl shadow-xl flex items-center justify-center font-black text-xl hover:bg-slate-50 transition-all border border-slate-100">-</button> --}}
                </div>
            </div>
        </div>
    </div>

    <x-booking-modal />

    @push('styles')
        <style>
            .leaflet-container {
                font-family: inherit;
                background: #f8fafc;
            }

            .leaflet-popup-content-wrapper {
                border-radius: 2rem;
                padding: 0;
                overflow: hidden;
                border: none;
                box-shadow: 0 30px 60px -12px rgba(15, 23, 42, 0.2);
            }

            .leaflet-popup-content {
                margin: 0;
                width: 260px !important;
            }

            .leaflet-popup-tip {
                display: none;
            }

            .custom-marker {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .scrollbar-premium::-webkit-scrollbar {
                width: 10px;
            }

            .scrollbar-premium::-webkit-scrollbar-track {
                background: transparent;
            }

            .scrollbar-premium::-webkit-scrollbar-thumb {
                background: #e2e8f0;
                border-radius: 20px;
                border: 3px solid #f8fafc;
            }

            .scrollbar-premium::-webkit-scrollbar-thumb:hover {
                background: #cbd5e1;
            }
        </style>
    @endpush


    @push('scripts')
        <script>
            var leafletMap = null;
            document.addEventListener('DOMContentLoaded', function() {

                const doctors = @json($doctors->items());

                leafletMap = window.L.map('search-map', {
                    zoomControl: false,
                    attributionControl: false
                }).setView([40.7128, -74.0060], 13);

                L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                    maxZoom: 20
                }).addTo(leafletMap);

                const markers = [];

                doctors.forEach(doctor => {
                    if (doctor.latitude && doctor.longitude) {
                        const icon = L.divIcon({
                            className: 'custom-marker',
                            html: `
                            <div class="relative group pointer-events-auto">
                                <div class="bg-slate-900 group-hover:bg-primary transition-all duration-300 text-white group-hover:text-slate-900 p-2 px-3 rounded-xl shadow-2xl border-2 border-white transform hover:scale-110 active:scale-95 flex flex-col items-center min-w-[140px]">
                                    <div class="text-[10px] font-black truncate max-w-[120px]">Dr. ${doctor.user.name}</div>
                                    <div class="text-[8px] font-bold uppercase tracking-widest opacity-80">${doctor.specialties[0]?.name || 'Specialist'}</div>
                                </div>
                                <div class="w-3 h-3 bg-slate-900 mx-auto -mt-2 rounded-sm rotate-45 border-r-2 border-b-2 border-white group-hover:bg-primary group-hover:border-white transition-all duration-300"></div>
                            </div>
                        `,
                            iconSize: [140, 50],
                            iconAnchor: [70, 50]
                        });

                        const marker = L.marker([doctor.latitude, doctor.longitude], {
                            icon: icon
                        }).addTo(leafletMap);

                        const popupContent = `
                        <div class="p-6 bg-white overflow-hidden relative">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-50 rounded-full -mr-12 -mt-12 opacity-50 blur-2xl"></div>
                            <div class="flex items-start gap-4 mb-5 relative z-10">
                                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shrink-0 overflow-hidden font-black text-primary text-xl border border-slate-100 shadow-sm">
                                    ${doctor.user.first_name ? doctor.user.first_name[0] : 'D'}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="text-[13px] font-black text-slate-900 truncate leading-tight tracking-tight">Dr. ${doctor.user.name}</div>
                                    <div class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">${doctor.specialties[0]?.name || 'Specialist'}</div>
                                    <div class="flex text-yellow-400 gap-0.5 mt-2">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-[10px] font-black text-slate-800 ml-1">4.9</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 relative z-10">
                                <a href="/doctors/${doctor.id}" class="w-full bg-slate-900 text-white text-center py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-slate-800 transition-all">View Details</a>
                                <a href="/doctors/${doctor.id}" class="w-full bg-primary text-slate-900 text-center py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-yellow-900/10">Book Now</a>
                            </div>
                        </div>
                    `;

                        marker.bindPopup(popupContent, {
                            minWidth: 260,
                            maxWidth: 260,
                            closeButton: false
                        });
                        markers.push(marker);
                    }
                });

                if (markers.length > 0) {
                    const group = new L.featureGroup(markers);
                    leafletMap.fitBounds(group.getBounds().pad(0.15));
                }
            });
        </script>
    @endpush
</x-app-layout>
