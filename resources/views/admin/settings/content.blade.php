<x-admin-layout>
    <x-slot name="header">Content Settings</x-slot>

    <!-- Quill Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="max-w-5xl mx-auto" x-data="{ tab: 'privacy' }">
        @if (session('success'))
            <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-lg p-4 text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabs -->
        <div class="flex border-b border-slate-200 mb-6">
            <button @click="tab = 'privacy'" :class="tab === 'privacy' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'" class="px-6 py-3 border-b-2 font-medium text-sm transition-colors duration-150">
                Privacy Policy
            </button>
            <button @click="tab = 'terms'" :class="tab === 'terms' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'" class="px-6 py-3 border-b-2 font-medium text-sm transition-colors duration-150">
                Terms & Conditions
            </button>
        </div>

        <form id="content-settings-form" action="{{ route('admin.content-settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Privacy Policy Tab -->
            <div x-show="tab === 'privacy'" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Privacy Policy</h3>
                        <p class="text-sm text-slate-500">Manage the content of your site's Privacy Policy page.</p>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <x-form.label for="privacy_title">Page Title <span class="text-rose-500">*</span></x-form.label>
                        <x-form.input id="privacy_title" name="privacy_title" type="text" value="{{ old('privacy_title', $privacy['title'] ?? '') }}" required />
                        <x-form.error :messages="$errors->get('privacy_title')" />
                    </div>

                    <div>
                        <x-form.label for="privacy_content">Content</x-form.label>
                        <div class="border border-slate-200 rounded-lg overflow-hidden @error('privacy_content') border-rose-300 ring-rose-100 @enderror">
                            <div id="privacy-editor" class="h-96 border-0"></div>
                        </div>
                        <input type="hidden" name="privacy_content" id="privacy-content-input">
                        <x-form.error :messages="$errors->get('privacy_content')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Terms & Conditions Tab -->
            <div x-show="tab === 'terms'" style="display: none;" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Terms & Conditions</h3>
                        <p class="text-sm text-slate-500">Manage the content of your site's Terms & Conditions page.</p>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <x-form.label for="terms_title">Page Title <span class="text-rose-500">*</span></x-form.label>
                        <x-form.input id="terms_title" name="terms_title" type="text" value="{{ old('terms_title', $terms['title'] ?? '') }}" required />
                        <x-form.error :messages="$errors->get('terms_title')" />
                    </div>

                    <div>
                        <x-form.label for="terms_content">Content</x-form.label>
                        <div class="border border-slate-200 rounded-lg overflow-hidden @error('terms_content') border-rose-300 ring-rose-100 @enderror">
                            <div id="terms-editor" class="h-96 border-0"></div>
                        </div>
                        <input type="hidden" name="terms_content" id="terms-content-input">
                        <x-form.error :messages="$errors->get('terms_content')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-button type="submit" class="px-6">Save Content Settings</x-button>
            </div>
        </form>
    </div>

    <!-- Quill Scripts -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quillOptions = {
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
            };

            // Initialize Privacy Editor
            var privacyQuill = new Quill('#privacy-editor', quillOptions);
            @if(old('privacy_content', $privacy['content'] ?? ''))
                privacyQuill.root.innerHTML = `{!! old('privacy_content', $privacy['content'] ?? '') !!}`;
            @endif

            // Initialize Terms Editor
            var termsQuill = new Quill('#terms-editor', quillOptions);
            @if(old('terms_content', $terms['content'] ?? ''))
                termsQuill.root.innerHTML = `{!! old('terms_content', $terms['content'] ?? '') !!}`;
            @endif

            // Sync content before submit
            var form = document.querySelector('#content-settings-form');
            form.onsubmit = function() {
                var privacyContent = document.querySelector('#privacy-content-input');
                privacyContent.value = privacyQuill.root.innerHTML;
                if (privacyContent.value === '<p><br></p>') privacyContent.value = '';

                var termsContent = document.querySelector('#terms-content-input');
                termsContent.value = termsQuill.root.innerHTML;
                if (termsContent.value === '<p><br></p>') termsContent.value = '';
            };
        });
    </script>
</x-admin-layout>
