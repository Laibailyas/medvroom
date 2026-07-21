<x-admin-layout>
    <x-slot name="header">
        Add New User
    </x-slot>

    <div class="max-w-2xl mx-auto pb-12">
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Users
            </a>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest">New User Details</h2>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="first_name" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all placeholder:text-slate-300"
                            placeholder="Jane">
                        <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
                    </div>
                    <div>
                        <label for="middle_name" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Middle <span class="font-normal text-slate-400 normal-case">(opt.)</span></label>
                        <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all placeholder:text-slate-300"
                            placeholder="M.">
                    </div>
                    <div>
                        <label for="last_name" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all placeholder:text-slate-300"
                            placeholder="Doe">
                        <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all placeholder:text-slate-300"
                        placeholder="jane@example.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all">
                    </div>
                </div>

                <div>
                    <label for="role" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Role</label>
                    <div class="relative">
                        <select name="role" id="role" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all appearance-none">
                            <option value="patient" {{ old('role') === 'patient' ? 'selected' : '' }}>Patient</option>
                            <option value="doctor"  {{ old('role') === 'doctor'  ? 'selected' : '' }}>Provider / Doctor</option>
                            <option value="admin"   {{ old('role') === 'admin'   ? 'selected' : '' }}>Administrator</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('role')" class="mt-1" />
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
