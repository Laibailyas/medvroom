<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, please verify your mobile number by entering the 6-digit code we just sent you via SMS.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification code has been sent to your mobile number.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.mobile.verify') }}">
        @csrf

        <!-- Verification Code -->
        <div>
            <x-input-label for="code" :value="__('Verification Code')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus autocomplete="one-time-code" placeholder="123456" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-button class="ms-4">
                {{ __('Verify Mobile') }}
            </x-button>
        </div>
    </form>

    <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-4">
        <form method="POST" action="{{ route('verification.mobile.resend') }}">
            @csrf
            <x-button variant="secondary" size="sm">
                {{ __('Resend Code') }}
            </x-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
