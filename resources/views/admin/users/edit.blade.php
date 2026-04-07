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
                    <!-- Names -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- First Name -->
                        <div>
                            <x-form.label for="first_name">First Name</x-form.label>
                            <x-form.input id="first_name" name="first_name" type="text" value="{{ old('first_name', $user->first_name) }}" required :error="$errors->has('first_name')" />
                            <x-form.error :messages="$errors->get('first_name')" />
                        </div>

                        <!-- Middle Name -->
                        <div>
                            <x-form.label for="middle_name">Middle Name</x-form.label>
                            <x-form.input id="middle_name" name="middle_name" type="text" value="{{ old('middle_name', $user->middle_name) }}" :error="$errors->has('middle_name')" />
                            <x-form.error :messages="$errors->get('middle_name')" />
                        </div>

                        <!-- Last Name -->
                        <div>
                            <x-form.label for="last_name">Last Name</x-form.label>
                            <x-form.input id="last_name" name="last_name" type="text" value="{{ old('last_name', $user->last_name) }}" required :error="$errors->has('last_name')" />
                            <x-form.error :messages="$errors->get('last_name')" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <x-form.label for="email">Email Address</x-form.label>
                        <x-form.input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required :error="$errors->has('email')" />
                        <x-form.error :messages="$errors->get('email')" />
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <x-form.label for="role">System Role</x-form.label>
                        <x-form.select id="role" name="role" required :error="$errors->has('role')">
                            <option value="patient" {{ old('role', $user->role) === 'patient' ? 'selected' : '' }}>Patient (Default)</option>
                            <option value="doctor" {{ old('role', $user->role) === 'doctor' ? 'selected' : '' }}>Healthcare Provider (Doctor)</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>System Administrator</option>
                        </x-form.select>
                        <p class="mt-2 text-xs text-slate-500 font-medium">Changing a user's role may affect their access to clinical or administrative interfaces.</p>
                        <x-form.error :messages="$errors->get('role')" />
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
