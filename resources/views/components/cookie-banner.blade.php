<div x-data="{
        showBanner: false,
        showPreferences: false,
        saving: null,
        preferences: {
            essential: true,
            functional: false,
            analytics: false
        },
        init() {
            const saved = localStorage.getItem('cookie_consent');
            if (!saved) {
                setTimeout(() => this.showBanner = true, 500);
            } else {
                try {
                    const parsed = JSON.parse(saved);
                    if (typeof parsed === 'object') {
                        this.preferences = { ...this.preferences, ...parsed };
                    } else if (saved === 'all') {
                        this.preferences = { essential: true, functional: true, analytics: true };
                    }
                } catch(e) {}
            }
        },
        save(type) {
            this.saving = type;
            if (type === 'all') {
                this.preferences = { essential: true, functional: true, analytics: true };
            } else if (type === 'essential') {
                this.preferences = { essential: true, functional: false, analytics: false };
            }
            
            localStorage.setItem('cookie_consent', JSON.stringify(this.preferences));
            
            setTimeout(() => {
                this.showBanner = false;
                this.saving = null;
                window.dispatchEvent(new CustomEvent('cookie_consent_updated', { detail: this.preferences }));
            }, 800);
        }
    }"
    @open-cookie-preferences.window="showBanner = true"
    x-show="showBanner"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="translate-y-full opacity-0"
    x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="translate-y-full opacity-0"
    style="display: none;"
    class="fixed bottom-0 left-0 right-0 z-50 p-4 md:p-6 pb-safe"
>
    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.2)] border border-slate-200 overflow-hidden">
        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 bg-slate-100 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-600"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5Z"/><path d="M8.5 8.5v.01"/><path d="M16 15.5v.01"/><path d="M12 12v.01"/><path d="M11 17v.01"/><path d="M7 14v.01"/></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 tracking-tight">Cookie Preferences</h3>
                    </div>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        We use cookies to enhance your experience. You can manage your preferences or accept all cookies. 
                        Read our <a href="{{ route('cookie-policy') }}" class="text-indigo-600 hover:text-indigo-700 font-bold underline underline-offset-4">Cookie Policy</a>.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button @click="showPreferences = !showPreferences" class="px-6 py-3 text-sm font-bold text-slate-600 bg-slate-50 hover:bg-slate-100 rounded-2xl transition-all border border-slate-200">
                        <span x-text="showPreferences ? 'Hide Preferences' : 'Manage'"></span>
                    </button>
                    <button @click="save('essential')" :disabled="saving" class="relative px-6 py-3 text-sm font-bold text-slate-700 bg-white border-2 border-slate-200 rounded-2xl hover:border-slate-300 transition-all flex items-center justify-center min-w-[140px]">
                        <span x-show="saving !== 'essential'">Reject All</span>
                        <template x-if="saving === 'essential'">
                            <svg class="w-5 h-5 text-emerald-500 animate-[scale-in_0.3s_ease-out]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </template>
                    </button>
                    <button @click="save('all')" :disabled="saving" class="relative px-8 py-3 text-sm font-bold text-white bg-slate-900 rounded-2xl shadow-lg hover:shadow-xl hover:bg-black transition-all transform hover:-translate-y-0.5 flex items-center justify-center min-w-[140px]">
                        <span x-show="saving !== 'all'">Accept All</span>
                        <template x-if="saving === 'all'">
                            <svg class="w-5 h-5 text-emerald-400 animate-[scale-in_0.3s_ease-out]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </template>
                    </button>
                </div>
            </div>

            <!-- Manage Preferences Section -->
            <div x-show="showPreferences" x-collapse>
                <div class="mt-8 pt-8 border-t border-slate-100 space-y-6">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Strictly Necessary</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Required for core functionality and security.</p>
                        </div>
                        <div class="relative inline-flex items-center cursor-not-allowed">
                            <div class="w-11 h-6 bg-slate-300 rounded-full"></div>
                            <div class="absolute left-6 w-4 h-4 bg-white rounded-full transition-transform"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Functional Cookies</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Used to remember preferences and improve experience.</p>
                        </div>
                        <button @click="preferences.functional = !preferences.functional" class="relative inline-flex items-center cursor-pointer focus:outline-none">
                            <div :class="preferences.functional ? 'bg-emerald-500' : 'bg-slate-300'" class="w-11 h-6 rounded-full transition-colors duration-200"></div>
                            <div :class="preferences.functional ? 'translate-x-6' : 'translate-x-1'" class="absolute w-4 h-4 bg-white rounded-full transition-transform duration-200"></div>
                        </button>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <div>
                            <h4 class="text-sm font-bold text-slate-900">Analytics Cookies</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Help us understand how users interact with MedVroom.</p>
                        </div>
                        <button @click="preferences.analytics = !preferences.analytics" class="relative inline-flex items-center cursor-pointer focus:outline-none">
                            <div :class="preferences.analytics ? 'bg-emerald-500' : 'bg-slate-300'" class="w-11 h-6 rounded-full transition-colors duration-200"></div>
                            <div :class="preferences.analytics ? 'translate-x-6' : 'translate-x-1'" class="absolute w-4 h-4 bg-white rounded-full transition-transform duration-200"></div>
                        </button>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button @click="save('custom')" :disabled="saving" class="px-8 py-3 text-sm font-bold text-white bg-slate-900 rounded-2xl shadow-lg hover:shadow-xl hover:bg-black transition-all flex items-center justify-center min-w-[180px]">
                            <span x-show="saving !== 'custom'">Save Preferences</span>
                            <template x-if="saving === 'custom'">
                                <svg class="w-5 h-5 text-emerald-400 animate-[scale-in_0.3s_ease-out]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </template>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes scale-in {
        0% { transform: scale(0); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
