<x-admin-layout>
    <x-slot name="header">
        System Settings
    </x-slot>

    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <div class="max-w-2xl">
            <p class="text-sm text-slate-500 font-medium">
                Manage your platform's API keys, email server credentials, and service configurations. 
                <span class="text-indigo-600 font-black">Note: Database values override your .env file at runtime.</span>
            </p>
        </div>
    </div>

    @if (session('status') === 'settings-updated')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-xl flex items-center justify-between shadow-sm animate-pulse-subtle">
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span class="text-sm font-bold uppercase tracking-wider">Settings successfully synchronized</span>
            </div>
            <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    <div x-data="{ activeTab: '{{ $settings->keys()->first() }}' }" class="grid lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <nav class="space-y-2">
                @foreach($settings as $group => $items)
                    <button 
                        @click="activeTab = '{{ $group }}'"
                        :class="activeTab === '{{ $group }}' ? 'bg-indigo-50 text-indigo-700 border-indigo-200 shadow-sm' : 'bg-white text-slate-600 border-slate-100 hover:bg-slate-50'"
                        class="w-full flex items-center justify-between px-5 py-4 text-sm font-black uppercase tracking-widest border rounded-xl transition-all duration-300 text-left"
                    >
                        <span>{{ $group }}</span>
                        <svg x-show="activeTab === '{{ $group }}'" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Content Area -->
        <div class="lg:col-span-3 space-y-8">
            @foreach($settings as $group => $items)
                <div x-show="activeTab === '{{ $group }}'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-xl overflow-hidden">
                        @foreach($items as $setting)
                            <div class="p-8 border-b border-slate-100 last:border-0">
                                <div class="mb-8">
                                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $setting->group }} Configuration</h3>
                                    <p class="text-sm text-slate-500 font-medium">{{ $setting->description }}</p>
                                </div>

                                <form action="{{ route('admin.settings.update', $setting) }}" method="POST" class="space-y-6">
                                    @csrf
                                    @method('PATCH')

                                    <div class="grid md:grid-cols-2 gap-6 p-6 bg-slate-50/50 rounded-2xl border border-slate-100">
                                        @foreach($setting->value as $key => $val)
                                            <div class="space-y-2">
                                                <label for="{{ $setting->key }}_{{ $key }}" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">
                                                    {{ str_replace('_', ' ', $key) }}
                                                </label>
                                                
                                                @if(Str::contains($key, ['password', 'secret', 'key']))
                                                    <div x-data="{ show: false }" class="relative group">
                                                        <input 
                                                            :type="show ? 'text' : 'password'" 
                                                            name="value[{{ $key }}]" 
                                                            id="{{ $setting->key }}_{{ $key }}"
                                                            value="{{ $val }}"
                                                            class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-mono focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm"
                                                        >
                                                        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-indigo-600 transition-colors">
                                                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                                        </button>
                                                    </div>
                                                @else
                                                    <input 
                                                        type="text" 
                                                        name="value[{{ $key }}]" 
                                                        id="{{ $setting->key }}_{{ $key }}"
                                                        value="{{ $val }}"
                                                        class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm"
                                                    >
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="flex justify-end pt-4">
                                        <button type="submit" class="inline-flex items-center px-8 py-3 bg-slate-900 hover:bg-black text-white text-sm font-black uppercase tracking-widest rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                            Save {{ $group }} Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>
