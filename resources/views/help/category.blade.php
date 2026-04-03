<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Help Header (Simplified) -->
        <div class="bg-[#ffde00] py-12 px-4 shadow-sm border-b border-slate-100">
            <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8">
                <!-- Breadcrumbs -->
                <nav class="flex text-[11px] font-black uppercase tracking-widest text-slate-600 mb-4 md:mb-0">
                    <a href="{{ route('help.index') }}" class="hover:text-slate-900">All Collections</a>
                    <span class="mx-2 text-slate-400">›</span>
                    <span class="text-slate-400">{{ $category->name }}</span>
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
                            placeholder="Search articles..." 
                            class="block w-full pl-9 pr-4 py-2 border-none rounded-lg shadow-sm focus:ring-2 focus:ring-slate-400 text-sm font-bold text-slate-700"
                        >
                    </div>
                </form>
            </div>
        </div>

        <!-- Category Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 pb-24">
            <header class="mb-12">
                <div class="w-12 h-12 rounded-lg bg-slate-50 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h1 class="text-3xl font-black text-slate-800 mb-2 tracking-tight">{{ $category->name }}</h1>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">{{ $articles->total() }} articles</p>
                @if($category->description)
                    <p class="mt-4 text-slate-600 font-bold leading-relaxed max-w-2xl">{{ $category->description }}</p>
                @endif
            </header>

            <!-- Articles List -->
            <div class="space-y-4">
                @forelse($articles as $article)
                    <a href="{{ route('help.article', $article) }}" class="flex items-center justify-between p-6 bg-white border border-slate-100 rounded-xl shadow-sm hover:shadow-md transition-all group">
                        <span class="text-lg font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">{{ $article->title }}</span>
                        <svg class="w-5 h-5 text-slate-300 group-hover:text-slate-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @empty
                    <p class="text-center text-slate-400 py-12">No articles found in this collection.</p>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
