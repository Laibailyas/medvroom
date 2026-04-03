<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Help Header (Simplified) -->
        <div class="bg-[#ffde00] py-12 px-4 shadow-sm border-b border-slate-100">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8">
                <!-- Breadcrumbs -->
                <nav class="flex text-[11px] font-black uppercase tracking-widest text-slate-600 mb-4 md:mb-0">
                    <a href="{{ route('help.index') }}" class="hover:text-slate-900">All Collections</a>
                    <span class="mx-2 text-slate-400">›</span>
                    <span class="text-slate-400">Search Results</span>
                </nav>

                <!-- Search Input (Small) -->
                <form action="{{ route('help.index') }}" method="GET" class="w-full md:w-64">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ $query }}"
                            placeholder="Search articles..." 
                            class="block w-full pl-9 pr-4 py-2 border-none rounded-lg shadow-sm focus:ring-2 focus:ring-slate-400 text-sm font-bold text-slate-700"
                        >
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 pb-24">
            <header class="mb-12">
                <h1 class="text-3xl font-black text-slate-800 mb-2 tracking-tight">Search Results for "{{ $query }}"</h1>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">{{ $articles->count() }} results</p>
            </header>

            <!-- Articles List -->
            <div class="space-y-4">
                @forelse($articles as $article)
                    <a href="{{ route('help.article', $article) }}" class="p-8 bg-white border border-slate-100 rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all group block">
                        <h3 class="text-xl font-black text-slate-800 mb-2 tracking-tight group-hover:text-indigo-600 transition-colors">{{ $article->title }}</h3>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">{{ $article->category->name }}</p>
                        <!-- Extract first 150 characters of non-html content for snippet -->
                        <p class="mt-4 text-slate-500 font-bold leading-relaxed line-clamp-2">
                            {{ Str::limit(strip_tags($article->content), 150) }}
                        </p>
                    </a>
                @empty
                    <div class="text-center py-20 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                        <svg class="mx-auto h-12 w-12 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <h3 class="text-lg font-black text-slate-800 mb-2">No results found</h3>
                        <p class="text-slate-500 font-bold">Try different keywords or browse our collections.</p>
                        <a href="{{ route('help.index') }}" class="mt-6 inline-block text-indigo-600 font-black uppercase tracking-widest text-sm hover:underline">Back to collections</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
