<x-app-layout>
    <div class="bg-[#f8f5ee] min-h-screen">

        {{-- Hero / Header --}}
        <div class="bg-[#ffde00] border-b-4 border-black">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex flex-col md:flex-row items-center justify-between gap-8">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-black/50 mb-2">From MedVroom</p>
                    <h1 class="text-5xl font-black text-black leading-none tracking-tight">Blogs</h1>
                    <p class="mt-3 text-sm font-bold text-black/70 max-w-xs">All the ways we need you to take care of yourself. Real advice. Real talk.</p>
                </div>
                <div class="flex-shrink-0">
                    {{-- Decorative Z --}}
                    <div class="w-24 h-24 bg-black rounded-2xl flex items-center justify-center rotate-6 shadow-xl">
                        <span class="text-5xl font-black text-[#ffde00] leading-none">Z</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Category Pills --}}
        @if($categories->isNotEmpty())
        <div class="border-b border-black/10 bg-white sticky top-0 z-30 shadow-sm">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-2 overflow-x-auto py-3 scrollbar-hide">
                    <a href="{{ route('blog.index') }}" class="flex-shrink-0 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider bg-black text-white">All</a>
                    @foreach($categories as $cat)
                        <a href="#cat-{{ $cat->id }}" class="flex-shrink-0 px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-wider border-2 border-black text-black hover:bg-black hover:text-[#ffde00] transition-colors">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-16">

            {{-- Featured Post --}}
            @if($featuredPost)
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-black/40">Latest</span>
                    <div class="flex-1 h-px bg-black/10"></div>
                </div>

                <a href="{{ route('blog.show', $featuredPost) }}" class="group grid grid-cols-1 md:grid-cols-2 gap-0 rounded-2xl overflow-hidden border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all">
                    <div class="aspect-[4/3] md:aspect-auto overflow-hidden bg-slate-100">
                        @if($featuredPost->featured_image)
                            <img src="{{ Storage::url($featuredPost->featured_image) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full min-h-[280px] bg-gradient-to-br from-indigo-100 to-purple-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-indigo-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white p-8 flex flex-col justify-center">
                        <span class="inline-block bg-[#ffde00] text-black text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full mb-4 self-start">{{ $featuredPost->category->name }}</span>
                        <h2 class="text-2xl md:text-3xl font-black text-slate-900 leading-tight mb-4 group-hover:text-indigo-700 transition-colors">{{ $featuredPost->title }}</h2>
                        @if($featuredPost->excerpt)
                            <p class="text-sm text-slate-600 font-medium leading-relaxed mb-6">{{ $featuredPost->excerpt }}</p>
                        @endif
                        <div class="flex items-center gap-3 text-xs text-slate-400 font-bold uppercase tracking-wider mt-auto">
                            @if($featuredPost->author_name)
                                <span>{{ $featuredPost->author_name }}</span>
                                <span>·</span>
                            @endif
                            <span>{{ $featuredPost->published_at?->format('M j, Y') }}</span>
                        </div>
                    </div>
                </a>
            </section>
            @endif

            {{-- Recent Posts Grid --}}
            @if($recentPosts->isNotEmpty())
            <section>
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-black/40">More Stories</span>
                    <div class="flex-1 h-px bg-black/10"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentPosts as $post)
                        <a href="{{ route('blog.show', $post) }}" class="group bg-white rounded-2xl border-2 border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] transition-all overflow-hidden flex flex-col">
                            <div class="aspect-[16/9] overflow-hidden bg-slate-100">
                                @if($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-amber-50 to-yellow-100 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-amber-300"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-5 flex flex-col flex-1">
                                <span class="inline-block bg-[#ffde00] text-black text-[9px] font-black uppercase tracking-wider px-2.5 py-0.5 rounded-full mb-3 self-start">{{ $post->category->name }}</span>
                                <h3 class="text-base font-black text-slate-900 leading-snug mb-3 group-hover:text-indigo-700 transition-colors flex-1">{{ $post->title }}</h3>
                                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-auto">{{ $post->published_at?->format('M j, Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Empty State --}}
            @if(!$featuredPost && $recentPosts->isEmpty())
            <div class="text-center py-24">
                <p class="text-4xl mb-4">📝</p>
                <h2 class="text-2xl font-black text-slate-700 mb-2">No posts yet</h2>
                <p class="text-slate-500">Check back soon for health insights and tips.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
