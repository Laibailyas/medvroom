<footer class="bg-[#2D333A] text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 mb-16">
            <!-- Brand & Links -->
            <div class="col-span-2 lg:col-span-1">
                <h3 class="text-sm font-bold uppercase tracking-widest text-slate-400 mb-6">Zocdoc</h3>
                <ul class="space-y-4">
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Home</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">About us</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Press</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Careers</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Contact us</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Help</a></li>
                </ul>
            </div>

            <!-- Discover -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-slate-400 mb-6">Discover</h3>
                <ul class="space-y-4">
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">The Paper Gown</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Provider Resources</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Community Standards</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Data and privacy</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Verified reviews</a></li>
                </ul>
            </div>

            <!-- Insurance -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-slate-400 mb-6">Insurance Carriers</h3>
                <ul class="space-y-4 font-medium text-slate-400 text-xs translate-y-3">
                    <!-- Column placeholder for insurance -->
                </ul>
            </div>

            <!-- Specialties -->
            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-slate-400 mb-6">Top Specialties</h3>
                <ul class="space-y-4 font-medium text-slate-400 text-xs translate-y-3">
                    <!-- Column placeholder for specialties -->
                </ul>
            </div>

            <!-- Mobile App -->
            <div class="col-span-2 lg:col-span-1">
                <h3 class="text-sm font-bold uppercase tracking-widest text-slate-400 mb-6 font-medium">Are you a doctor?</h3>
                <ul class="space-y-4">
                    <li><a href="{{ route('register.doctor') }}" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">List your practice on Zocdoc</a></li>
                    <li><a href="#" class="text-xs font-medium text-slate-300 hover:text-white transition-colors">Become an EHR partner</a></li>
                </ul>
                <div class="mt-8 space-y-3">
                    <a href="#" class="block bg-black p-2 rounded-lg text-center hover:bg-slate-900 transition border border-slate-700">App Store</a>
                    <a href="#" class="block bg-black p-2 rounded-lg text-center hover:bg-slate-900 transition border border-slate-700">Google Play</a>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-700 pt-8 flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <div class="flex items-center space-x-6">
                <span class="text-[11px] font-medium text-slate-500">&copy; {{ date('Y') }} Zocdoc, Inc.</span>
                <a href="#" class="text-[11px] font-medium text-slate-500 hover:text-white transition">Terms</a>
                <a href="#" class="text-[11px] font-medium text-slate-500 hover:text-white transition">Privacy</a>
                <a href="#" class="text-[11px] font-medium text-slate-500 hover:text-white transition">Your privacy choices</a>
            </div>
            <div class="flex items-center space-x-6 text-slate-500">
                <a href="#" class="hover:text-white transition"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg></a>
                <a href="#" class="hover:text-white transition"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
                <a href="#" class="hover:text-white transition"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg></a>
            </div>
        </div>
    </div>
</footer>
