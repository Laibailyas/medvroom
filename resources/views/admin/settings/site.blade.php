<x-admin-layout>
    <x-slot name="header">
        Site Settings
    </x-slot>

    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <div class="max-w-2xl">
            <p class="text-sm text-slate-500 font-medium">
                Manage your platform's global branding, SEO, and contact information.
            </p>
        </div>
    </div>

    @if (session('status') === 'site-settings-updated')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-xl flex items-center justify-between shadow-sm animate-pulse-subtle">
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span class="text-sm font-bold uppercase tracking-wider">Site Settings successfully updated</span>
            </div>
            <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-xl overflow-hidden">
        <form action="{{ route('admin.site-settings.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            
            <div class="space-y-12">
                <!-- Branding Section -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Branding</h3>
                    <div class="grid md:grid-cols-2 gap-8 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                        <div class="space-y-2 col-span-2">
                            <label for="site_name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Site Name</label>
                            <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $setting->value['site_name'] ?? '') }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm">
                            @error('site_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Logo</label>
                            @if(!empty($setting->value['logo_url']))
                                <div class="mb-4 bg-slate-100 p-4 rounded-xl inline-block">
                                    <img src="{{ Storage::url($setting->value['logo_url']) }}" alt="Logo" class="h-12 object-contain">
                                </div>
                            @endif
                            <input type="file" name="logo" id="logo" accept="image/*" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-500 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Favicon</label>
                            @if(!empty($setting->value['favicon_url']))
                                <div class="mb-4 bg-slate-100 p-4 rounded-xl inline-block">
                                    <img src="{{ Storage::url($setting->value['favicon_url']) }}" alt="Favicon" class="h-8 w-8 object-contain">
                                </div>
                            @endif
                            <input type="file" name="favicon" id="favicon" accept="image/*" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-500 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            @error('favicon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO Section -->
                <div class="pt-6 border-t border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">SEO & Meta</h3>
                    <div class="grid md:grid-cols-2 gap-8 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="meta_title" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $setting->value['meta_title'] ?? '') }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm">
                            @error('meta_title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2 col-span-2">
                            <label for="meta_description" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" rows="3" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm">{{ old('meta_description', $setting->value['meta_description'] ?? '') }}</textarea>
                            @error('meta_description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-4 col-span-2">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Open Graph Image (Social Sharing)</label>
                            @if(!empty($setting->value['og_image_url']))
                                <div class="mb-4 bg-slate-100 p-4 rounded-xl inline-block max-w-sm">
                                    <img src="{{ Storage::url($setting->value['og_image_url']) }}" alt="Open Graph Image" class="w-full object-cover rounded-lg shadow-sm border border-slate-200">
                                </div>
                            @endif
                            <input type="file" name="og_image" id="og_image" accept="image/*" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-500 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="text-[11px] text-slate-400 font-medium pl-1 mt-1">Recommended size: 1200x630 pixels. Used when sharing links on social media.</p>
                            @error('og_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact & Social -->
                <div class="pt-6 border-t border-slate-100">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">Contact & Social Links</h3>
                    <div class="grid md:grid-cols-2 gap-8 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                        <div class="space-y-2">
                            <label for="support_email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Support Email</label>
                            <input type="email" name="support_email" id="support_email" value="{{ old('support_email', $setting->value['support_email'] ?? '') }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm">
                            @error('support_email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="support_phone" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Support Phone</label>
                            <input type="text" name="support_phone" id="support_phone" value="{{ old('support_phone', $setting->value['support_phone'] ?? '') }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm">
                            @error('support_phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="facebook_url" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Facebook URL</label>
                            <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $setting->value['facebook_url'] ?? '') }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm" placeholder="https://facebook.com/...">
                            @error('facebook_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="twitter_url" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Twitter URL</label>
                            <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $setting->value['twitter_url'] ?? '') }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm" placeholder="https://twitter.com/...">
                            @error('twitter_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="instagram_url" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest pl-1">Instagram URL</label>
                            <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $setting->value['instagram_url'] ?? '') }}" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 outline-none transition-all shadow-sm" placeholder="https://instagram.com/...">
                            @error('instagram_url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-8 mt-8 border-t border-slate-100">
                <button type="submit" class="inline-flex items-center px-8 py-3 bg-slate-900 hover:bg-black text-white text-sm font-black uppercase tracking-widest rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Site Settings
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
