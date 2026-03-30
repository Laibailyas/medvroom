<x-admin-layout>
    <x-slot name="header">
        Add Insurance Provider
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.insurance-providers.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <form action="{{ route('admin.insurance-providers.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <div class="space-y-6">
                    <!-- Provider Name -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Provider Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}"
                            placeholder="e.g. Aetna, Blue Cross Blue Shield"
                            class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all @error('name') border-rose-300 ring-rose-100 @enderror"
                            required
                        >
                        @error('name')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Logo Upload -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Provider Logo</label>
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <div class="h-20 w-20 rounded-xl bg-slate-100 border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                </div>
                            </div>
                            <label class="block grow">
                                <span class="sr-only">Choose logo</span>
                                <input type="file" name="logo" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                                <p class="mt-2 text-xs text-slate-400">PNG, JPG or SVG. Max 2MB.</p>
                            </label>
                        </div>
                        @error('logo')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Toggle -->
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-100">
                        <div>
                            <p class="text-sm font-bold text-slate-700">Mark as Featured</p>
                            <p class="text-xs text-slate-500">Featured providers will be prioritized in the search engine and homepage logos section.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                        </label>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.insurance-providers.index') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">Cancel</a>
                    <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white hover:bg-indigo-700 active:bg-indigo-800 shadow-sm transition">
                        Create Provider
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
