<footer class="bg-neutral-dark text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 mb-16">
            <!-- Brand -->
            <div class="col-span-2 lg:col-span-1">
                <a href="{{ url('/') }}" class="flex items-center space-x-2 mb-6">
                    <span class="text-lg font-black text-white">MedVroom</span>
                </a>
                <ul class="space-y-3">
                    <li><a href="{{ route('about') }}" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">About us</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Press</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Careers</a></li>
                    <li><a href="{{ route('contact') }}" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Contact us</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Help</a></li>
                </ul>
            </div>

            <!-- Discover -->
            <div>
                <h3 class="text-xs font-black uppercase tracking-widest text-slate-500 mb-5">Discover</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Health Blog</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Provider Resources</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Community Standards</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Data and privacy</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Verified reviews</a></li>
                </ul>
            </div>

            <!-- Top Specialties -->
            <div>
                <h3 class="text-xs font-black uppercase tracking-widest text-slate-500 mb-5">Top Specialties</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Primary Care</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Dermatology</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Psychiatry</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">OB-GYN</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Dentist</a></li>
                </ul>
            </div>

            <!-- Insurance -->
            <div>
                <h3 class="text-xs font-black uppercase tracking-widest text-slate-500 mb-5">Insurance</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Aetna</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">BlueCross BlueShield</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Cigna</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Humana</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">UnitedHealthcare</a></li>
                </ul>
            </div>

            <!-- For Providers -->
            <div class="col-span-2 lg:col-span-1">
                <h3 class="text-xs font-black uppercase tracking-widest text-slate-500 mb-5">For Providers</h3>
                <ul class="space-y-3 mb-8">
                    <li><a href="{{ route('register.doctor') }}" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">List your practice</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Become an EHR partner</a></li>
                    <li><a href="{{ route('login') }}" class="text-xs font-medium text-slate-400 hover:text-white transition-colors">Provider sign in</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-slate-700 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-4 md:gap-6">
                <span class="text-[11px] text-slate-500">&copy; {{ date('Y') }} MedVroom Healthcare Platform</span>
                <a href="{{ route('terms') }}" class="text-[11px] text-slate-500 hover:text-white transition">Terms</a>
                <a href="{{ route('privacy') }}" class="text-[11px] text-slate-500 hover:text-white transition">Privacy</a>
                <a href="#" class="text-[11px] text-slate-500 hover:text-white transition">Your privacy choices</a>
                <a href="#" class="text-[11px] text-slate-500 hover:text-white transition">Sitemap</a>
            </div>
            <div class="flex items-center space-x-4 text-slate-500">
                <a href="#" class="hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                </a>
                <a href="#" class="hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="#" class="hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>
