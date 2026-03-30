<div
    class="flex flex-col z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto !h-screen !min-h-screen bg-white border-r border-slate-200 w-64 transition-all duration-200 ease-in-out shrink-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64 lg:translate-x-0'"
    @click.outside="sidebarOpen = false"
    @keydown.escape.window="sidebarOpen = false"
>
    <!-- Sidebar Header -->
    <div class="flex items-center justify-between px-6 h-16 border-b border-slate-100">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">M</span>
            </div>
            <span class="text-lg font-bold text-slate-800 tracking-tight">MyDoc Admin</span>
        </a>
    </div>

    <!-- Sidebar Content -->
    <div class="flex flex-col flex-1 overflow-y-auto overflow-x-hidden py-4 px-4 space-y-6">
        
        <!-- General Section -->
        <div>
            <h3 class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Main Menu</h3>
            <div class="space-y-1">
                <x-admin.sidebar-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" icon="dashboard">
                    Dashboard
                </x-admin.sidebar-link>
            </div>
        </div>

        <!-- Directory Section -->
        <div>
            <h3 class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Directory</h3>
            <div class="space-y-1">
                <x-admin.sidebar-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" icon="users">
                    Users & Patients
                </x-admin.sidebar-link>
                <x-admin.sidebar-link :href="route('admin.doctors.index')" :active="request()->routeIs('admin.doctors.*')" icon="doctor">
                    Doctors
                </x-admin.sidebar-link>
            </div>
        </div>

        <!-- Clinical Section -->
        <div>
            <h3 class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Clinical Data</h3>
            <div class="space-y-1">
                <x-admin.sidebar-link :href="route('admin.specialties.index')" :active="request()->routeIs('admin.specialties.*')" icon="specialty">
                    Specialties
                </x-admin.sidebar-link>
                <x-admin.sidebar-link :href="route('admin.symptoms.index')" :active="request()->routeIs('admin.symptoms.*')" icon="symptom">
                    Symptoms
                </x-admin.sidebar-link>
            </div>
        </div>

        <!-- Insurance Section -->
        <div>
            <h3 class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Insurance</h3>
            <div class="space-y-1">
                <x-admin.sidebar-link :href="route('admin.insurance-providers.index')" :active="request()->routeIs('admin.insurance-providers.*')" icon="insurance">
                    Carriers & Plans
                </x-admin.sidebar-link>
            </div>
        </div>

        <!-- Operations Section -->
        <div>
            <h3 class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Operations</h3>
            <div class="space-y-1">
                <x-admin.sidebar-link :href="route('admin.appointments.index')" :active="request()->routeIs('admin.appointments.*')" icon="appointment">
                    Appointments
                </x-admin.sidebar-link>
                <x-admin.sidebar-link :href="route('admin.reviews.index')" :active="request()->routeIs('admin.reviews.*')" icon="reviews">
                    Moderation
                </x-admin.sidebar-link>
            </div>
        </div>

    </div>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-slate-100">
        <div class="bg-slate-50 rounded-lg p-3 flex items-center">
            <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold mr-3 text-xs">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-slate-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500 truncate">System Administrator</p>
            </div>
        </div>
    </div>
</div>
