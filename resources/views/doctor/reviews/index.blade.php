<x-doctor-layout>
    <div class="space-y-10">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter italic text-slate-900">Reputation Dashboard</h1>
                <p class="text-slate-500 font-bold mt-1 uppercase tracking-widest text-[10px]">Real-time patient feedback and clinical satisfaction analytics.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="px-6 py-3 bg-white border border-slate-100 rounded-2xl shadow-sm flex items-center gap-4">
                    <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.787 1.4 8.168L12 18.896l-7.334 3.869 1.4-8.168-5.934-5.787 8.2-1.192L12 .587z"/></svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic leading-none">Global Score</p>
                        <p class="text-xl font-black italic tracking-tighter text-slate-900 mt-0.5">{{ number_format($averageRating, 1) }} / 5.0</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left: Rating Analytics -->
            <div class="space-y-8">
                <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-slate-900/10 relative overflow-hidden group">
                    <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/10 transition-all duration-700"></div>
                    <h3 class="text-2xl font-black tracking-tighter italic mb-10 relative z-10">Score Distribution</h3>
                    
                    <div class="space-y-6 relative z-10">
                        @foreach($ratingBreakdown as $star => $data)
                            <div class="space-y-2">
                                <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest italic text-slate-500">
                                    <div class="flex items-center gap-1">
                                        <span>{{ $star }} Stars</span>
                                    </div>
                                    <span>{{ $data['count'] }} Reviews</span>
                                </div>
                                <div class="h-3 bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-primary rounded-full transition-all duration-1000 ease-out" style="width: {{ $data['percentage'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-12 pt-10 border-t border-white/5 relative z-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest italic">Total Verified Reviews</p>
                                <p class="text-3xl font-black italic tracking-tighter mt-1">{{ $totalReviews }}</p>
                            </div>
                            <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center text-primary">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Improvement Insight Card (Dummy dynamic-like content) -->
                <div class="bg-blue-600 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-blue-600/20">
                    <h4 class="text-lg font-black italic tracking-tighter mb-4">Patient Satisfaction Tip</h4>
                    <p class="text-sm font-bold text-blue-100 leading-relaxed italic">“Records show that patients who receive follow-up notes within 24 hours of their visit tend to give 4.8+ star ratings. Consider using the automated note tool.”</p>
                </div>
            </div>

            <!-- Right: Review Feed -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-8 border-b border-slate-50">
                        <h2 class="text-2xl font-black tracking-tighter italic text-slate-900 leading-none">Clinical Feedback Feed</h2>
                        <p class="text-xs font-bold text-slate-400 mt-2 uppercase tracking-widest">A comprehensive timeline of patient testimonials and scores.</p>
                    </div>

                    <div class="divide-y divide-slate-50">
                        @forelse($reviews as $review)
                            <div class="p-8 md:p-10 group hover:bg-slate-50/50 transition-all duration-300">
                                <div class="flex flex-col md:flex-row md:items-start gap-8">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center overflow-hidden shrink-0 shadow-sm transition-transform group-hover:-rotate-3">
                                        @if($review->appointment->patientProfile->user->getProfilePhotoUrl())
                                            <img src="{{ $review->appointment->patientProfile->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-xl font-black text-slate-200">{{ substr($review->appointment->patientProfile->user->first_name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1 space-y-4">
                                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                            <div>
                                                <h4 class="text-lg font-black text-slate-900 italic tracking-tighter">{{ $review->appointment->patientProfile->user->name }}</h4>
                                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic mt-0.5">Verified Visit • {{ $review->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <div class="flex items-center gap-1 bg-amber-50 px-4 py-2 rounded-xl">
                                                @for($i = 0; $i < 5; $i++)
                                                    <svg class="w-3.5 h-3.5 {{ $i < $review->rating ? 'text-amber-400 fill-current' : 'text-slate-200' }}" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.787 1.4 8.168L12 18.896l-7.334 3.869 1.4-8.168-5.934-5.787 8.2-1.192L12 .587z"/></svg>
                                                @endfor
                                            </div>
                                        </div>
                                        
                                        <div class="relative">
                                            <svg class="w-8 h-8 text-slate-100 absolute -left-4 -top-2" fill="currentColor" viewBox="0 0 32 32"><path d="M10 8c-4.418 0-8 3.582-8 8s3.582 8 8 8c1.036 0 2.023-.197 2.924-.555C14.032 25.106 17.556 26 21 26c.552 0 1-.448 1-1s-.448-1-1-1c-2.946 0-5.875-.722-8.358-2.094C16.94 20.478 18 18.36 18 16c0-4.418-3.582-8-8-8z"/></svg>
                                            <p class="text-sm font-bold text-slate-600 leading-relaxed italic relative z-10 pl-6">“{{ $review->comment }}”</p>
                                        </div>

                                        @if($review->appointment->notes)
                                            <div class="p-4 bg-slate-50 border-l-4 border-slate-200 rounded-r-xl">
                                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic mb-1">Clinical Context</p>
                                                <p class="text-xs font-bold text-slate-500 italic">{{ Str::limit($review->appointment->notes, 100) }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-20 text-center text-slate-300">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 shadow-sm">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <h3 class="text-2xl font-black italic tracking-tighter text-slate-400 uppercase">No Clinical Reviews Yet</h3>
                                <p class="text-sm font-bold text-slate-400 mt-2">Reviews will appear here after patients complete their clinical visits.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($reviews->hasPages())
                        <div class="p-8 bg-slate-50 border-t border-slate-100">
                            {{ $reviews->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-doctor-layout>
