<x-admin-layout>
    <x-slot name="header">
        Manage Provider: {{ $doctor->user->name }}
    </x-slot>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.providers.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Directory
            </a>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-widest leading-none {{ $doctor->is_verified ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                    {{ $doctor->is_verified ? 'VERIFIED' : 'UNVERIFIED' }}
                </span>
            </div>
        </div>

        {{-- Flash messages --}}
        @foreach (['success' => 'emerald', 'error' => 'rose', 'info' => 'indigo'] as $type => $color)
            @if (session($type))
                <div class="mb-6 flex items-start space-x-3 p-4 bg-{{ $color }}-50 border border-{{ $color }}-100 rounded-xl">
                    <div class="shrink-0 w-5 h-5 mt-0.5 rounded-full bg-{{ $color }}-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                    </div>
                    <p class="text-sm font-bold text-{{ $color }}-800">{{ session($type) }}</p>
                </div>
            @endif
        @endforeach

        <div class="space-y-6">

            {{-- ─── 1-click Decision Panel ─────────────────────────── --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden"
                 x-data="{ decision: '{{ $doctor->is_verified ? 'approve' : '' }}', note: '' }">

                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest">Verification Decision</h2>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">1-Click Actions</span>
                </div>

                <div class="p-6 space-y-5">

                    {{-- Current status info --}}
                    <div class="flex items-center space-x-2 p-3 rounded-lg bg-slate-50 border border-slate-100">
                        <div class="w-2 h-2 rounded-full {{ $doctor->is_verified ? 'bg-emerald-500' : 'bg-amber-400' }}"></div>
                        <p class="text-xs font-bold text-slate-600">
                            Current Status: <span class="{{ $doctor->is_verified ? 'text-emerald-700' : 'text-amber-700' }}">{{ $doctor->is_verified ? 'Verified & Active' : 'Pending Review' }}</span>
                        </p>
                    </div>

                    {{-- Decision buttons --}}
                    <div class="grid grid-cols-3 gap-3">

                        {{-- Approve --}}
                        <button type="button"
                            @click="decision = 'approve'"
                            :class="decision === 'approve'
                                ? 'border-emerald-500 bg-emerald-50 text-emerald-800 ring-2 ring-emerald-300 ring-offset-1'
                                : 'border-slate-200 bg-white text-slate-600 hover:border-emerald-300 hover:bg-emerald-50/50'"
                            class="relative flex flex-col items-center p-4 rounded-xl border-2 transition-all cursor-pointer group">
                            <div :class="decision === 'approve' ? 'bg-emerald-500 text-white' : 'bg-slate-100 text-slate-400 group-hover:bg-emerald-100 group-hover:text-emerald-600'"
                                 class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">Approve</span>
                            <span class="text-[10px] font-medium text-slate-400 mt-0.5">Verify provider</span>
                            <div x-show="decision === 'approve'" class="absolute top-2 right-2 w-3 h-3 bg-emerald-500 rounded-full"></div>
                        </button>

                        {{-- Reject --}}
                        <button type="button"
                            @click="decision = 'reject'"
                            :class="decision === 'reject'
                                ? 'border-rose-500 bg-rose-50 text-rose-800 ring-2 ring-rose-300 ring-offset-1'
                                : 'border-slate-200 bg-white text-slate-600 hover:border-rose-300 hover:bg-rose-50/50'"
                            class="relative flex flex-col items-center p-4 rounded-xl border-2 transition-all cursor-pointer group">
                            <div :class="decision === 'reject' ? 'bg-rose-500 text-white' : 'bg-slate-100 text-slate-400 group-hover:bg-rose-100 group-hover:text-rose-600'"
                                 class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">Reject</span>
                            <span class="text-[10px] font-medium text-slate-400 mt-0.5">Deny access</span>
                            <div x-show="decision === 'reject'" class="absolute top-2 right-2 w-3 h-3 bg-rose-500 rounded-full"></div>
                        </button>

                        {{-- Request Info --}}
                        <button type="button"
                            @click="decision = 'request_info'"
                            :class="decision === 'request_info'
                                ? 'border-amber-400 bg-amber-50 text-amber-800 ring-2 ring-amber-300 ring-offset-1'
                                : 'border-slate-200 bg-white text-slate-600 hover:border-amber-300 hover:bg-amber-50/50'"
                            class="relative flex flex-col items-center p-4 rounded-xl border-2 transition-all cursor-pointer group">
                            <div :class="decision === 'request_info' ? 'bg-amber-400 text-white' : 'bg-slate-100 text-slate-400 group-hover:bg-amber-100 group-hover:text-amber-600'"
                                 class="w-10 h-10 rounded-full flex items-center justify-center mb-2 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                            </div>
                            <span class="text-xs font-black uppercase tracking-widest">Request Info</span>
                            <span class="text-[10px] font-medium text-slate-400 mt-0.5">Ask for more</span>
                            <div x-show="decision === 'request_info'" class="absolute top-2 right-2 w-3 h-3 bg-amber-400 rounded-full"></div>
                        </button>

                    </div>

                    {{-- Optional note --}}
                    <div x-show="decision !== ''" x-transition>
                        <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">
                            Admin Note
                            <span class="normal-case font-normal text-slate-400 ml-1">(optional — saved to provider profile)</span>
                        </label>
                        <textarea
                            x-model="note"
                            rows="3"
                            placeholder="Add a note explaining this decision…"
                            class="w-full px-4 py-3 border border-slate-200 rounded-lg text-sm font-medium text-slate-700 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none transition-all"
                        ></textarea>
                    </div>

                    {{-- Submit form --}}
                    <form x-show="decision !== ''" x-transition
                          action="{{ route('admin.providers.decide', $doctor) }}" method="POST"
                          x-on:submit="$el.querySelector('[name=note]').value = note">
                        @csrf
                        <input type="hidden" name="decision" :value="decision">
                        <input type="hidden" name="note" value="">

                        <button type="submit"
                            :class="{
                                'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-200': decision === 'approve',
                                'bg-rose-600 hover:bg-rose-700 shadow-rose-200': decision === 'reject',
                                'bg-amber-500 hover:bg-amber-600 shadow-amber-200': decision === 'request_info',
                            }"
                            class="w-full py-3.5 rounded-xl text-white text-sm font-black uppercase tracking-[0.2em] shadow-lg transition-all active:scale-[0.98]">
                            <span x-text="{
                                'approve': '✓ Approve & Verify Provider',
                                'reject': '✗ Reject Provider Application',
                                'request_info': '? Send Information Request'
                            }[decision]"></span>
                        </button>
                    </form>

                    <p x-show="decision === ''" class="text-center text-xs text-slate-400 font-medium pt-2">
                        Select an action above to proceed.
                    </p>
                </div>
            </div>

            {{-- ─── Clinical Details ────────────────────────────────── --}}
            <form action="{{ route('admin.providers.update', $doctor) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="space-y-6">
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest">Clinical Metadata</h2>
                        </div>
                        <div class="p-6 space-y-6">
                            <!-- Specialty Multi-select -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Specialties</label>
                                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($specialties as $specialty)
                                        <label class="relative flex items-center p-3 rounded-lg border border-slate-200 cursor-pointer hover:bg-slate-50 transition-colors group">
                                            <input
                                                type="checkbox"
                                                name="specialties[]"
                                                value="{{ $specialty->id }}"
                                                class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                                                {{ in_array($specialty->id, old('specialties', $doctor->specialties->pluck('id')->toArray())) ? 'checked' : '' }}
                                            >
                                            <span class="ml-3 text-xs font-bold text-slate-600 group-hover:text-slate-900">{{ $specialty->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="experience_years" class="block text-sm font-bold text-slate-700 mb-1">Years of Experience</label>
                                    <input
                                        type="number"
                                        name="experience_years"
                                        id="experience_years"
                                        value="{{ old('experience_years', $doctor->experience_years) }}"
                                        class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                    >
                                </div>
                                <div>
                                    <label for="consultation_fee" class="block text-sm font-bold text-slate-700 mb-1">Consultation Fee ($)</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="consultation_fee"
                                        id="consultation_fee"
                                        value="{{ old('consultation_fee', $doctor->consultation_fee) }}"
                                        class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                    >
                                </div>
                            </div>

                            <div>
                                <label for="clinic_name" class="block text-sm font-bold text-slate-700 mb-1">Practice/Clinic Name</label>
                                <input
                                    type="text"
                                    name="clinic_name"
                                    id="clinic_name"
                                    value="{{ old('clinic_name', $doctor->clinic_name) }}"
                                    class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                >
                            </div>

                            @if($doctor->admin_note)
                                <div class="p-4 bg-amber-50 border border-amber-100 rounded-lg">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-amber-600 mb-1">Last Admin Note</p>
                                    <p class="text-sm text-amber-800 font-medium">{{ $doctor->admin_note }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('admin.providers.index') }}" class="px-6 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">Discard Changes</a>
                        <x-button>Save Metadata</x-button>
                    </div>
                </div>
            </form>

            {{-- ─── Danger Zone ─────────────────────────────────────── --}}
            <div class="bg-rose-50 border border-rose-100 rounded-xl overflow-hidden">
                <div class="p-5 border-b border-rose-100 bg-rose-100/50 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-rose-600"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                    <h3 class="text-xs font-black uppercase tracking-widest text-rose-800">Danger Zone</h3>
                </div>
                <div class="p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-rose-800">Remove Provider Profile</p>
                        <p class="text-xs text-rose-600 mt-0.5 max-w-md leading-relaxed">
                            Permanently deletes this provider and all associated data. This cannot be undone. Consider revoking verification instead.
                        </p>
                    </div>
                    <form action="{{ route('admin.providers.destroy', $doctor) }}" method="POST"
                          onsubmit="return confirm('ADMIN WARNING: Permanently delete provider {{ addslashes($doctor->user->name) }}? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="shrink-0 ml-6 px-5 py-2.5 bg-white border-2 border-rose-300 text-rose-700 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all">
                            Delete Provider
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
