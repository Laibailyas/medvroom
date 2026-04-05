<x-admin-layout>
    <x-slot name="header">New Blog Post</x-slot>

    <!-- Quill Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.blog.posts.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Posts
            </a>
        </div>

        <form id="post-form" action="{{ route('admin.blog.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 space-y-5">
                        <div>
                            <x-form.label for="title">Title <span class="text-rose-500">*</span></x-form.label>
                            <x-form.input id="title" name="title" type="text" value="{{ old('title') }}" required :error="$errors->has('title')" placeholder="Post title..." />
                            <x-form.error :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-form.label for="excerpt">Excerpt</x-form.label>
                            <x-form.textarea id="excerpt" name="excerpt" rows="2" :error="$errors->has('excerpt')" placeholder="Short description shown in the blog listing...">{{ old('excerpt') }}</x-form.textarea>
                            <x-form.error :messages="$errors->get('excerpt')" />
                        </div>

                        <div>
                            <x-form.label for="content">Content</x-form.label>
                            <!-- Editor Container -->
                            <div class="border border-slate-200 rounded-lg overflow-hidden @error('content') border-rose-300 ring-rose-100 @enderror">
                                <div id="editor" class="h-64 border-0"></div>
                            </div>
                            <!-- Hidden Input to store Quill HTML -->
                            <input type="hidden" name="content" id="content-input">
                            <x-form.error :messages="$errors->get('content')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Publish Settings -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 space-y-5">
                        <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Publish</h3>

                        <div>
                            <x-form.label for="blog_category_id">Category <span class="text-rose-500">*</span></x-form.label>
                            <x-form.select id="blog_category_id" name="blog_category_id" :error="$errors->has('blog_category_id')">
                                <option value="">Select a category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('blog_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </x-form.select>
                            <x-form.error :messages="$errors->get('blog_category_id')" />
                        </div>

                        <div>
                            <x-form.label for="author_name">Author</x-form.label>
                            <x-form.input id="author_name" name="author_name" type="text" value="{{ old('author_name') }}" :error="$errors->has('author_name')" placeholder="e.g. Dr. Jane Smith" />
                            <x-form.error :messages="$errors->get('author_name')" />
                        </div>

                        <div class="flex items-center gap-3 pt-1">
                            <label class="flex items-center mt-6">
                                <x-form.checkbox name="is_published" value="1" :checked="old('is_published', '1')" />
                                <span class="text-sm font-bold text-slate-700 ml-2">Publish immediately</span>
                            </label>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 space-y-4">
                        <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wider">Featured Image</h3>
                        <div>
                            <input type="file" id="featured_image" name="featured_image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <x-form.error :messages="$errors->get('featured_image')" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('admin.blog.posts.index') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">Cancel</a>
                        <x-button>Create Post</x-button>
                    </div>
                </div>
            </div>
        </form>
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

            @if(old('content'))
            quill.root.innerHTML = `{!! old('content') !!}`;
            @endif

            // Sync content before submit
            var form = document.querySelector('#post-form');
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
