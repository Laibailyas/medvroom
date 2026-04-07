<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Help Header (Simplified) -->
        <div class="bg-[#ffde00] py-12 px-4 shadow-sm border-b border-slate-100">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8">
                <!-- Breadcrumbs -->
                <nav class="flex text-[11px] font-black uppercase tracking-widest text-slate-600 mb-4 md:mb-0 truncate">
                    <a href="{{ route('help.index', ['type' => $article->category->type === 'both' ? 'patient' : $article->category->type]) }}" class="hover:text-slate-900 shrink-0">
                        All {{ ucfirst($article->category->type === 'provider' ? 'provider' : 'patient') }} Collections
                    </a>
                    <span class="mx-2 text-slate-400 shrink-0">›</span>
                    <a href="{{ route('help.category', $article->category) }}" class="hover:text-slate-900 truncate">{{ $article->category->name }}</a>
                    <span class="mx-2 text-slate-400 shrink-0">›</span>
                    <span class="text-slate-400 truncate">{{ $article->title }}</span>
                </nav>

                <!-- Search Input (Small) -->
                <form action="{{ route('help.index') }}" method="GET" class="w-full md:w-64">
                    <input type="hidden" name="type" value="{{ $article->category->type === 'provider' ? 'provider' : 'patient' }}">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="q" 
                            placeholder="Search articles..." 
                            class="block w-full pl-9 pr-4 py-2 border-none rounded-lg shadow-sm focus:ring-2 focus:ring-slate-400 text-sm font-bold text-slate-700"
                        >
                    </div>
                </form>
            </div>
        </div>

        <!-- Article Content -->
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 pb-24">
            <header class="mb-12 border-b border-slate-100 pb-12">
                <h1 class="text-4xl md:text-5xl font-black text-slate-800 mb-6 tracking-tight leading-tight">{{ $article->title }}</h1>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">
                    Last Updated: {{ $article->updated_at->diffForHumans() }}
                </p>
            </header>

            <!-- Main Text Content (Quill HTML) -->
            <div class="prose-container">
                <!-- We apply basic styling for common Quill output -->
                <div class="prose prose-slate max-w-none text-slate-700 font-medium leading-relaxed
                    prose-headings:font-black prose-headings:text-slate-800 prose-headings:tracking-tight
                    prose-p:mb-6 prose-ul:mb-6 prose-li:mb-2 prose-h2:mt-12 prose-h2:mb-6 uppercase-headings">
                    {!! $article->content !!}
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles->isNotEmpty())
                <div class="mt-20 border-t border-slate-100 pt-16">
                    <h3 class="text-xl font-black text-slate-800 mb-8 tracking-tight">Related Articles</h3>
                    <div class="bg-white border border-slate-100 rounded-2xl divide-y divide-slate-100 shadow-sm">
                        @foreach($relatedArticles as $related)
                            <a href="{{ route('help.article', $related) }}" class="flex items-center justify-between p-6 hover:bg-slate-50 transition-all group">
                                <span class="text-[17px] font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">{{ $related->title }}</span>
                                <svg class="w-4 h-4 text-slate-300 group-hover:text-slate-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- <!-- Feedback Section (Simplified Mockup) -->
            <div class="mt-20 bg-slate-50 rounded-2xl p-12 text-center border border-slate-200/50">
                <p class="text-sm font-black text-slate-600 uppercase tracking-widest mb-6">Did this answer your question?</p>
                <div class="flex justify-center gap-4">
                    <button class="w-16 h-16 bg-white border border-slate-200 rounded-xl text-3xl hover:scale-110 transition-transform shadow-sm">😞</button>
                    <button class="w-16 h-16 bg-white border border-slate-200 rounded-xl text-3xl hover:scale-110 transition-transform shadow-sm">😐</button>
                    <button class="w-16 h-16 bg-white border border-slate-200 rounded-xl text-3xl hover:scale-110 transition-transform shadow-sm">😃</button>
                </div>
            </div> --}}
        </article>
    </div>

    <!-- Custom styling for the Quill content -->
    <style>
        .prose-container .prose h1, 
        .prose-container .prose h2, 
        .prose-container .prose h3 {
            font-family: 'Instrument Sans', sans-serif;
            text-transform: none; /* Override Zocdoc's usual uppercase style if desired, but here we follow standard headers */
        }
        .prose-container .prose p {
            margin-bottom: 1.5rem;
        }
    </style>
</x-app-layout>
