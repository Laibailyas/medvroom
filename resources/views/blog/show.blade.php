<x-app-layout>
    <div class="bg-[#f8f5ee] min-h-screen">

        {{-- Breadcrumb Header --}}
        <div class="bg-[#ffde00] border-b-4 border-black">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex items-center justify-between gap-4">
                <nav class="flex items-center text-[10px] font-black uppercase tracking-widest text-black/50">
                    <a href="{{ route('blog.index') }}" class="hover:text-black transition-colors">The Paper Gown</a>
                    <span class="mx-2">›</span>
                    <span class="text-black/40">{{ $post->category->name }}</span>
                </nav>
            </div>
        </div>

        {{-- Article --}}
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- Category + Title --}}
            <header class="mb-10">
                <span class="inline-block bg-[#ffde00] border-2 border-black text-black text-[10px] font-black uppercase tracking-wider px-3 py-1 rounded-full mb-4 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">{{ $post->category->name }}</span>
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight tracking-tight mt-4 mb-6">{{ $post->title }}</h1>

                @if($post->excerpt)
                    <p class="text-xl text-slate-600 font-medium leading-relaxed border-l-4 border-[#ffde00] pl-5">{{ $post->excerpt }}</p>
                @endif

                <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-6 text-xs text-slate-400 font-bold uppercase tracking-widest">
                    @if($post->author_name)
                        <span class="text-slate-700">{{ $post->author_name }}</span>
                        <span>·</span>
                    @endif
                    @if($post->published_at)
                        <span>{{ $post->published_at->format('F j, Y') }}</span>
                        <span>·</span>
                    @endif
                    <span>{{ number_format($post->views) }} {{ Str::plural('view', $post->views) }}</span>
                </div>
            </header>

            {{-- Featured Image --}}
            @if($post->featured_image)
                <figure class="mb-10 rounded-2xl overflow-hidden border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full object-cover max-h-[480px]">
                </figure>
            @endif

            {{-- Article Body --}}
            <div class="bg-white rounded-2xl border-2 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-8 md:p-12 mb-10">
                <div class="prose prose-slate max-w-none
                    prose-headings:font-black prose-headings:text-slate-900 prose-headings:tracking-tight
                    prose-p:text-slate-700 prose-p:leading-relaxed prose-p:font-medium
                    prose-a:text-indigo-600 prose-a:font-bold prose-a:no-underline hover:prose-a:underline
                    prose-li:text-slate-700 prose-li:font-medium
                    prose-blockquote:border-l-4 prose-blockquote:border-[#ffde00] prose-blockquote:bg-[#fffbea] prose-blockquote:py-2 prose-blockquote:px-4 prose-blockquote:not-italic">
                    {!! $post->content !!}
                </div>
            </div>

            {{-- Feedback --}}
            <div class="bg-white rounded-2xl border-2 border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] p-8 text-center mb-12">
                <p class="text-sm font-black text-slate-700 uppercase tracking-widest mb-5">Was this article helpful?</p>
                <div class="flex justify-center gap-4">
                    <button class="w-14 h-14 bg-[#f8f5ee] border-2 border-black rounded-xl text-2xl hover:scale-110 hover:bg-[#ffde00] transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">😞</button>
                    <button class="w-14 h-14 bg-[#f8f5ee] border-2 border-black rounded-xl text-2xl hover:scale-110 hover:bg-[#ffde00] transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">😐</button>
                    <button class="w-14 h-14 bg-[#f8f5ee] border-2 border-black rounded-xl text-2xl hover:scale-110 hover:bg-[#ffde00] transition-all shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">😃</button>
                </div>
            </div>

            {{-- Related Posts --}}
            @if($relatedPosts->isNotEmpty())
                <section>
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-black/40">Related Articles</span>
                        <div class="flex-1 h-px bg-black/10"></div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        @foreach($relatedPosts as $related)
                            <a href="{{ route('blog.show', $related) }}" class="group bg-white rounded-xl border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all overflow-hidden">
                                <div class="aspect-[16/9] overflow-hidden bg-slate-100">
                                    @if($related->featured_image)
                                        <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-amber-50 to-yellow-100"></div>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h4 class="text-sm font-black text-slate-800 leading-snug group-hover:text-indigo-700 transition-colors">{{ $related->title }}</h4>
                                    <p class="text-xs text-slate-400 font-bold uppercase tracking-wider mt-2">{{ $related->published_at?->format('M j, Y') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </article>
    </div>
</x-app-layout>
