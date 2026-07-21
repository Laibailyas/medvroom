<x-guest-layout>
    <div class="text-center mb-8">
        <div class="w-20 h-20 bg-indigo-100 text-indigo-600 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-indigo-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
        </div>
        <h2 class="text-3xl font-black text-slate-900 mb-2">Check your inbox</h2>
        <p class="text-slate-500 font-medium px-4">
            {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just sent you.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-center">
            <p class="text-emerald-700 font-bold text-sm">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-button type="submit" size="full" class="py-4 text-base font-black uppercase tracking-widest shadow-xl shadow-primary/20">
                {{ __('Resend Verification Email') }}
            </x-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm font-bold text-slate-400 hover:text-indigo-600 transition-colors uppercase tracking-widest">
                {{ __('Maybe Later? Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
