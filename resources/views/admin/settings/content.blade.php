<x-admin-layout>
    <x-slot name="header">
        Content Settings
    </x-slot>

    <!-- Quill Styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <div class="max-w-2xl">
            <p class="text-sm text-slate-500 font-medium">
                Manage your platform's legal and content pages.
            </p>
        </div>
    </div>

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-xl flex items-center justify-between shadow-sm animate-pulse-subtle">
            <div class="flex items-center space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                <span class="text-sm font-bold uppercase tracking-wider">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>
    @endif

    <div x-data="{ activeTab: 'privacy' }" class="grid lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <nav class="space-y-2">
                @php
                    $tabs = [
                        'privacy' => 'Privacy Policy',
                        'terms' => 'Terms & Conditions',
                        'review_policy' => 'Review Policy',
                        'telehealth_consent' => 'Telehealth Consent',
                        'provider_agreement' => 'Provider Agreement',
                        'acceptable_use_policy' => 'Acceptable Use Policy',
                        'cookie_policy' => 'Cookie Policy',
                    ];
                @endphp
                @foreach($tabs as $key => $label)
                    <button 
                        @click="activeTab = '{{ $key }}'; setTimeout(() => window.dispatchEvent(new Event('resize')), 50);"
                        :class="activeTab === '{{ $key }}' ? 'bg-indigo-50 text-indigo-700 border-indigo-200 shadow-sm' : 'bg-white text-slate-600 border-slate-100 hover:bg-slate-50'"
                        class="w-full flex items-center justify-between px-5 py-4 text-sm font-black uppercase tracking-widest border rounded-xl transition-all duration-300 text-left"
                    >
                        <span>{{ $label }}</span>
                        <svg x-show="activeTab === '{{ $key }}'" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Content Area -->
        <div class="lg:col-span-3 space-y-8">
            <form id="content-settings-form" action="{{ route('admin.content-settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                @foreach([
                    ['key' => 'privacy', 'route' => 'privacy', 'label' => 'Privacy Policy', 'data' => $privacy, 'desc' => "Manage the content of your site's Privacy Policy page."],
                    ['key' => 'terms', 'route' => 'terms', 'label' => 'Terms & Conditions', 'data' => $terms, 'desc' => "Manage the content of your site's Terms & Conditions page."],
                    ['key' => 'review_policy', 'route' => 'review-policy', 'label' => 'Review & Content Policy', 'data' => $review_policy, 'desc' => "Manage the content of your site's Review & Content Policy page."],
                    ['key' => 'telehealth_consent', 'route' => 'telehealth-consent', 'label' => 'Telehealth Informed Consent', 'data' => $telehealth_consent, 'desc' => "Manage the content of your site's Telehealth Informed Consent page."],
                    ['key' => 'provider_agreement', 'route' => 'provider-agreement', 'label' => 'Provider Agreement', 'data' => $provider_agreement, 'desc' => "Manage the content of your site's Provider Agreement page."],
                    ['key' => 'acceptable_use_policy', 'route' => 'acceptable-use-policy', 'label' => 'Acceptable Use Policy', 'data' => $acceptable_use_policy, 'desc' => "Manage the content of your site's Acceptable Use Policy page."],
                    ['key' => 'cookie_policy', 'route' => 'cookie-policy', 'label' => 'Cookie Policy', 'data' => $cookie_policy, 'desc' => "Manage the content of your site's Cookie Policy page."],
                ] as $item)
                    <div x-show="activeTab === '{{ $item['key'] }}'" style="display: none;" class="bg-white rounded-2xl border border-slate-200 shadow-xl overflow-hidden">
                        <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $item['label'] }}</h3>
                                <p class="text-sm text-slate-500 font-medium">{{ $item['desc'] }}</p>
                            </div>
                            <a href="{{ route($item['route']) }}" target="_blank" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-700 bg-indigo-50 hover:bg-indigo-100 px-4 py-2 rounded-lg transition-colors group">
                                Open Page
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:-translate-y-0.5 group-hover:translate-x-0.5 transition-transform"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
                            </a>
                        </div>
                        <div class="p-8 space-y-6">
                            <div>
                                <x-form.label for="{{ $item['key'] }}_title">Page Title <span class="text-rose-500">*</span></x-form.label>
                                <x-form.input id="{{ $item['key'] }}_title" name="{{ $item['key'] }}_title" type="text" value="{{ old($item['key'] . '_title', $item['data']['title'] ?? '') }}" required />
                                <x-form.error :messages="$errors->get($item['key'] . '_title')" />
                            </div>

                            <div>
                                <x-form.label for="{{ $item['key'] }}_content">Content</x-form.label>
                                <div class="border border-slate-200 rounded-lg overflow-hidden @error($item['key'] . '_content') border-rose-300 ring-rose-100 @enderror">
                                    <div id="{{ str_replace('_', '-', $item['key']) }}-editor" class="h-96 border-0"></div>
                                </div>
                                <input type="hidden" name="{{ $item['key'] }}_content" id="{{ str_replace('_', '-', $item['key']) }}-content-input">
                                <x-form.error :messages="$errors->get($item['key'] . '_content')" class="mt-2" />
                            </div>
                        </div>
                        <div class="p-8 border-t border-slate-100 bg-slate-50 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-8 py-3 bg-slate-900 hover:bg-black text-white text-sm font-black uppercase tracking-widest rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                                Save Changes
                            </button>
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
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

            const sections = [
                { key: 'privacy', content: `{!! old('privacy_content', $privacy['content'] ?? '') !!}` },
                { key: 'terms', content: `{!! old('terms_content', $terms['content'] ?? '') !!}` },
                { key: 'review-policy', content: `{!! old('review_policy_content', $review_policy['content'] ?? '') !!}` },
                { key: 'telehealth-consent', content: `{!! old('telehealth_consent_content', $telehealth_consent['content'] ?? '') !!}` },
                { key: 'provider-agreement', content: `{!! old('provider_agreement_content', $provider_agreement['content'] ?? '') !!}` },
                { key: 'acceptable-use-policy', content: `{!! old('acceptable_use_policy_content', $acceptable_use_policy['content'] ?? '') !!}` },
                { key: 'cookie-policy', content: `{!! old('cookie_policy_content', $cookie_policy['content'] ?? '') !!}` },
            ];

            const quills = {};

            sections.forEach(function(section) {
                var q = new Quill('#' + section.key + '-editor', quillOptions);
                if (section.content) {
                    q.root.innerHTML = section.content;
                }
                quills[section.key] = q;
            });

            // Sync content before submit
            var form = document.querySelector('#content-settings-form');
            form.onsubmit = function() {
                sections.forEach(function(section) {
                    var input = document.querySelector('#' + section.key + '-content-input');
                    input.value = quills[section.key].root.innerHTML;
                    if (input.value === '<p><br></p>') input.value = '';
                });
            };
        });
    </script>
</x-admin-layout>
