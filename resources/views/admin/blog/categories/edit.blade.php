<x-admin-layout>
    <x-slot name="header">Edit Blog Category</x-slot>

    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.blog.categories.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Categories
            </a>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <form action="{{ route('admin.blog.categories.update', $category) }}" method="POST" class="p-8">
                @csrf
                @method('PATCH')
                <div class="space-y-6 text-sm">
                    <div>
                        <x-form.label for="name">Name <span class="text-rose-500">*</span></x-form.label>
                        <x-form.input id="name" name="name" type="text" value="{{ old('name', $category->name) }}" required :error="$errors->has('name')" />
                        <x-form.error :messages="$errors->get('name')" />
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.blog.categories.index') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">Cancel</a>
                    <x-button>Save Changes</x-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
