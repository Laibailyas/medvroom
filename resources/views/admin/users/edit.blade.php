<x-admin-layout>
    <x-slot name="header">
        Edit User: {{ $user->name }}
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Directory
            </a>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold leading-none bg-slate-100 text-slate-500 uppercase tracking-widest">ID: #{{ $user->id }}</span>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-8">
                @csrf
                @method('PATCH')
                
                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Full Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all @error('name') border-rose-300 ring-rose-100 @enderror"
                            required
                        >
                        @error('name')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-1">Email Address</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all @error('email') border-rose-300 ring-rose-100 @enderror"
                            required
                        >
                        @error('email')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label for="role" class="block text-sm font-bold text-slate-700 mb-1">System Role</label>
                        <select 
                            name="role" 
                            id="role" 
                            class="w-full px-4 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm transition-all @error('role') border-rose-300 ring-rose-100 @enderror"
                            required
                        >
                            <option value="patient" {{ old('role', $user->role) === 'patient' ? 'selected' : '' }}>Patient (Default)</option>
                            <option value="doctor" {{ old('role', $user->role) === 'doctor' ? 'selected' : '' }}>Healthcare Provider (Doctor)</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>System Administrator</option>
                        </select>
                        <p class="mt-2 text-xs text-slate-500 font-medium">Changing a user's role may affect their access to clinical or administrative interfaces.</p>
                        @error('role')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    @if($user->role === 'doctor')
                        <div class="p-4 bg-blue-50/50 border border-blue-100 rounded-lg">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-blue-600 mt-0.5 mr-3 shrink-0"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/></svg>
                                <div>
                                    <p class="text-sm font-bold text-blue-900 mb-1">Doctor Profile Detected</p>
                                    <p class="text-xs text-blue-700 leading-relaxed mb-3">This user has an associated clinical profile. To manage verification status or clinical metadata, please use the Provider Management module.</p>
                                    <a href="{{ route('admin.doctors.edit', $user->doctorProfile) }}" class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-blue-600 hover:text-blue-800 transition-colors">
                                        Open Profile <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Footer Actions -->
                <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition text-sm">Cancel</a>
                    <x-button>Update User Account</x-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
