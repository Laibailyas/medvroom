<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Add Help Article') }}
        </h2>
    </x-slot>

    <!-- Quill Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.help.articles.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Articles
            </a>
        </div>
        
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <form id="article-form" action="{{ route('admin.help.articles.store') }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <x-form.label for="title">Title <span class="text-rose-500">*</span></x-form.label>
                    <x-form.input id="title" name="title" type="text" value="{{ old('title') }}" required :error="$errors->has('title')" />
                    <x-form.error :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-form.label for="help_category_id">Category <span class="text-rose-500">*</span></x-form.label>
                    <x-form.select id="help_category_id" name="help_category_id" :error="$errors->has('help_category_id')">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('help_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }} ({{ ucfirst($category->type) }})
                            </option>
                        @endforeach
                    </x-form.select>
                    <x-form.error :messages="$errors->get('help_category_id')" />
                </div>


                <div class="flex items-center">
                    <label class="flex items-center mt-6">
                        <x-form.checkbox name="is_published" value="1" :checked="old('is_published', '1')" />
                        <span class="text-sm font-bold text-slate-700 ml-2">Published</span>
                    </label>
                </div>
            </div>

            <div class="mb-8">
                <x-form.label>Content <span class="text-rose-500">*</span></x-form.label>
                <!-- Editor Container -->
                <div class="border border-slate-200 rounded-lg overflow-hidden @error('content') border-rose-300 ring-rose-100 @enderror">
                    <div id="editor" class="h-64 border-0"></div>
                </div>
                <!-- Hidden Input to store Quill HTML -->
                <input type="hidden" name="content" id="content-input">
                <x-form.error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.help.articles.index') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition text-sm">Cancel</a>
                <x-button>Create Article</x-button>
            </div>

            </form>
        </div>
    </div>

    <!-- Quill Scripts -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['link', 'blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['clean']
                    ]
                }
            });

            // Sync content before submit
            var form = document.querySelector('#article-form');
            form.onsubmit = function() {
                var content = document.querySelector('#content-input');
                content.value = quill.root.innerHTML;
                
                // If content is just an empty tag, clear it to trigger Laravel validation
                if (content.value === '<p><br></p>') {
                    content.value = '';
                }
            };
        });
    </script>
</x-admin-layout>
