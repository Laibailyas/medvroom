<x-app-layout :title="$setting['title']" :description="$setting['title']">
    <div class="bg-white py-16 sm:py-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight sm:text-4xl">{{ $setting['title'] }}</h1>
            </div>
            
            <div class="rich-text-content max-w-none">
                {!! $setting['content'] !!}
            </div>
        </div>
    </div>
</x-app-layout>
