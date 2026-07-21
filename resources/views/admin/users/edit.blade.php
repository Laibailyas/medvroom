<x-admin-layout>
    <x-slot name="header">
        Edit User: {{ $user->name ?: $user->email }}
    </x-slot>

    <div class="max-w-2xl mx-auto pb-12">
        <div class="mb-6">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1"><path d="m15 18-6-6 6-6"/></svg>
                Back to Users
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-sm font-bold text-emerald-800">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-sm font-black text-slate-900 uppercase tracking-widest">User Details</h2>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-6 space-y-6">
                @csrf @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="first_name" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">First Name</label>
                        <input type="text" name="first_name" id="first_name"
                            value="{{ old('first_name', $user->first_name) }}"
                            required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all">
                        <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
                    </div>
                    <div>
                        <label for="middle_name" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Middle Name <span class="font-normal text-slate-400 normal-case">(optional)</span></label>
                        <input type="text" name="middle_name" id="middle_name"
                            value="{{ old('middle_name', $user->middle_name) }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all">
                    </div>
                    <div>
                        <label for="last_name" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Last Name</label>
                        <input type="text" name="last_name" id="last_name"
                            value="{{ old('last_name', $user->last_name) }}"
                            required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all">
                        <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Email Address</label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <label for="role" class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Role</label>
                    <div class="relative">
                        <select name="role" id="role" required
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm font-bold transition-all appearance-none">
                            <option value="patient" {{ old('role', $user->role) === 'patient' ? 'selected' : '' }}>Patient</option>
                            <option value="doctor"  {{ old('role', $user->role) === 'doctor'  ? 'selected' : '' }}>Provider / Doctor</option>
                            <option value="admin"   {{ old('role', $user->role) === 'admin'   ? 'selected' : '' }}>Administrator</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('role')" class="mt-1" />
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.users.index') }}" class="text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">Discard</a>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white text-xs font-black uppercase tracking-widest rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Danger Zone --}}
        @if($user->id !== auth()->id())
        <div class="mt-6 bg-rose-50 border border-rose-100 rounded-xl overflow-hidden">
            <div class="p-5 border-b border-rose-100 bg-rose-100/50 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-rose-600"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                <h3 class="text-xs font-black uppercase tracking-widest text-rose-800">Danger Zone</h3>
            </div>
            <div class="p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-rose-800">Delete this user</p>
                    <p class="text-xs text-rose-600 mt-0.5">Permanently removes the account and all associated data.</p>
                </div>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                      onsubmit="return confirm('Permanently delete {{ addslashes($user->name ?? $user->email) }}? This cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="shrink-0 ml-6 px-5 py-2.5 bg-white border-2 border-rose-300 text-rose-700 rounded-xl text-xs font-black uppercase tracking-widest hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all">
                        Delete User
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</x-admin-layout>
