<div class="fixed inset-y-0 left-0 w-72 bg-slate-900 text-white flex flex-col z-50">
    <!-- Logo -->
    <div class="p-8 pb-12 flex items-center justify-between">
        <a href="{{ route('doctor.dashboard') }}" class="flex items-center gap-2 group">
            <img src="{{ asset('assets/white-logo.png') }}" alt="MedVroom" class="h-9 w-auto group-hover:scale-105 transition-transform duration-300">
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto">
        <x-doctor.nav-link :href="route('doctor.dashboard')" :active="request()->routeIs('doctor.dashboard')" icon="dashboard">Dashboard</x-doctor.nav-link>
        <x-doctor.nav-link :href="route('doctor.appointments.index')" :active="request()->routeIs('doctor.appointments.*')" icon="calendar">Appointments</x-doctor.nav-link>
        <x-doctor.nav-link :href="route('doctor.schedule.index')" :active="request()->routeIs('doctor.schedule.*')" icon="clock">Schedule</x-doctor.nav-link>
        <x-doctor.nav-link :href="route('doctor.patients.index')" :active="request()->routeIs('doctor.patients.*')" icon="users">Patients</x-doctor.nav-link>
        <x-doctor.nav-link :href="route('doctor.chat.index')" :active="request()->routeIs('doctor.chat.*')" icon="chat">Chat</x-doctor.nav-link>
        <x-doctor.nav-link :href="route('doctor.insurance.index')" :active="request()->routeIs('doctor.insurance.*')" icon="shield">Insurance</x-doctor.nav-link>
        <div class="pt-6 pb-2">
            <span class="px-4 text-[10px] uppercase font-black tracking-widest text-slate-500 ">Settings</span>
        </div>
        <x-doctor.nav-link :href="route('doctor.profile.edit')" :active="request()->routeIs('doctor.profile.*')" icon="user">Profile</x-doctor.nav-link>
        <x-doctor.nav-link :href="route('doctor.reviews.index')" :active="request()->routeIs('doctor.reviews.*')" icon="star">Reviews</x-doctor.nav-link>
        <x-doctor.nav-link :href="route('doctor.payouts.index')" :active="request()->routeIs('doctor.payouts.*')" icon="wallet">Payouts</x-doctor.nav-link>
        <x-doctor.nav-link :href="route('doctor.legal.index')" :active="request()->routeIs('doctor.legal.*')" icon="document">Legal &amp; Agreements</x-doctor.nav-link>
        <x-doctor.nav-link :href="route('doctor.pricing-terms.index')" :active="request()->routeIs('doctor.pricing-terms.*')" icon="document">Pricing &amp; Fee Terms</x-doctor.nav-link>
    </nav>

    <!-- User Profile -->
    <div class="p-4 mt-auto">
        <div class="bg-slate-800/50 rounded-2xl p-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl overflow-hidden bg-slate-700 border border-slate-600">
                @if(Auth::user()->getProfilePhotoUrl())
                    <img src="{{ Auth::user()->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-400 font-black">
                        {{ substr(Auth::user()->first_name, 0, 1) }}
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-black truncate">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                <p class="text-[10px] text-slate-500 font-bold truncate">Provider Portal</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                @csrf
                <button type="submit" class="text-slate-500 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </div>
</div>
