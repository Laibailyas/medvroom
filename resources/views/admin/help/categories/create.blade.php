<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Add Help Category') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.help.categories.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Categories
            </a>
        </div>
        
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <form action="{{ route('admin.help.categories.store') }}" method="POST" class="p-8">
            @csrf

            <div class="space-y-6 text-sm">
                <div>
                    <x-form.label for="name">Name <span class="text-rose-500">*</span></x-form.label>
                    <x-form.input id="name" name="name" type="text" value="{{ old('name') }}" required :error="$errors->has('name')" />
                    <x-form.error :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-form.label for="type">Target Audience <span class="text-rose-500">*</span></x-form.label>
                    <x-form.select id="type" name="type" :error="$errors->has('type')">
                        <option value="patient" {{ old('type') === 'patient' ? 'selected' : '' }}>Patient</option>
                        <option value="provider" {{ old('type') === 'provider' ? 'selected' : '' }}>Provider</option>
                        <option value="both" {{ old('type', 'both') === 'both' ? 'selected' : '' }}>Both</option>
                    </x-form.select>
                    <x-form.error :messages="$errors->get('type')" />
                </div>

                <div>
                    <x-form.label for="description">Description</x-form.label>
                    <x-form.textarea id="description" name="description" rows="3" :error="$errors->has('description')">{{ old('description') }}</x-form.textarea>
                    <x-form.error :messages="$errors->get('description')" />
                </div>

                <div>
                    <x-form.label for="icon">Icon (Optional)</x-form.label>
                    <x-form.input id="icon" name="icon" type="text" placeholder="e.g. appointment, user, heart" value="{{ old('icon') }}" :error="$errors->has('icon')" />
                    <p class="text-xs text-slate-400 mt-1">Short name for the icon used in the UI.</p>
                    <x-form.error :messages="$errors->get('icon')" />
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.help.categories.index') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition text-sm">Cancel</a>
                <x-button>Create Category</x-button>
            </div>

            </form>
        </div>
    </div>
</x-admin-layout>
