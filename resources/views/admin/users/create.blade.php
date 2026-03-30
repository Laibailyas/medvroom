<x-admin-layout>
    <x-slot name="header">
        Add New User
    </x-slot>

    <div class="max-w-3xl mx-auto pb-12">
        <div class="mb-6 flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Directory
            </a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest leading-none">Account Configuration</h2>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="p-8">
                @csrf
                
                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Full Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name') }}"
                            placeholder="John Doe"
                            class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-semibold transition-all @error('name') border-rose-300 ring-rose-100 @enderror"
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
                            value="{{ old('email') }}"
                            placeholder="john@example.com"
                            class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-semibold transition-all @error('email') border-rose-300 ring-rose-100 @enderror"
                            required
                        >
                        @error('email')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <label for="role" class="block text-sm font-bold text-slate-700 mb-1">Account Type / Role</label>
                        <select 
                            name="role" 
                            id="role" 
                            class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all @error('role') border-rose-300 ring-rose-100 @enderror"
                            required
                        >
                            <option value="patient" {{ old('role') === 'patient' ? 'selected' : '' }}>Patient (Patient Profile created automatically)</option>
                            <option value="doctor" {{ old('role') === 'doctor' ? 'selected' : '' }}>Healthcare Provider (Doctor Profile created automatically)</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>System Administrator</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-1">Temporary Password</label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-semibold transition-all @error('password') border-rose-300 ring-rose-100 @enderror"
                                required
                            >
                        </div>
                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-1">Confirm Password</label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation" 
                                class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-semibold transition-all"
                                required
                            >
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="mt-10 pt-8 border-t border-slate-100 flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">Cancel</a>
                    <button type="submit" class="inline-flex items-center px-10 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-indigo-700 active:bg-indigo-800 shadow-lg shadow-indigo-500/30 transition-all active:scale-[0.98]">
                        Register User Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
