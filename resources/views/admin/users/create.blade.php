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
                    <!-- Names -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- First Name -->
                        <div>
                            <x-form.label for="first_name">First Name</x-form.label>
                            <x-form.input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}" placeholder="John" required :error="$errors->has('first_name')" />
                            <x-form.error :messages="$errors->get('first_name')" />
                        </div>

                        <!-- Middle Name -->
                        <div>
                            <x-form.label for="middle_name">Middle Name</x-form.label>
                            <x-form.input id="middle_name" name="middle_name" type="text" value="{{ old('middle_name') }}" placeholder="Quincy" :error="$errors->has('middle_name')" />
                            <x-form.error :messages="$errors->get('middle_name')" />
                        </div>

                        <!-- Last Name -->
                        <div>
                            <x-form.label for="last_name">Last Name</x-form.label>
                            <x-form.input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}" placeholder="Doe" required :error="$errors->has('last_name')" />
                            <x-form.error :messages="$errors->get('last_name')" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <x-form.label for="email">Email Address</x-form.label>
                        <x-form.input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="john@example.com" required :error="$errors->has('email')" />
                        <x-form.error :messages="$errors->get('email')" />
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <x-form.label for="role">Account Type / Role</x-form.label>
                        <x-form.select id="role" name="role" required :error="$errors->has('role')">
                            <option value="patient" {{ old('role') === 'patient' ? 'selected' : '' }}>Patient (Patient Profile created automatically)</option>
                            <option value="doctor" {{ old('role') === 'doctor' ? 'selected' : '' }}>Healthcare Provider (Doctor Profile created automatically)</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>System Administrator</option>
                        </x-form.select>
                        <x-form.error :messages="$errors->get('role')" />
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Password -->
                        <div>
                            <x-form.label for="password">Temporary Password</x-form.label>
                            <x-form.input id="password" name="password" type="password" required :error="$errors->has('password')" />
                        </div>
                        <!-- Password Confirmation -->
                        <div>
                            <x-form.label for="password_confirmation">Confirm Password</x-form.label>
                            <x-form.input id="password_confirmation" name="password_confirmation" type="password" required />
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="mt-10 pt-8 border-t border-slate-100 flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-2 text-sm font-bold text-slate-600 hover:text-slate-800 transition">Cancel</a>
                    <x-button>Register User Account</x-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
