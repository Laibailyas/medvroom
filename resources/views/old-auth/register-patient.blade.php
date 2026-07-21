<x-auth-layout title="Patient Registration" description="Create a MedVroom account to find doctors, book appointments, and manage your family's healthcare in one place.">
    <div class="max-w-xl mx-auto py-12 px-6">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-neutral-dark tracking-normal mb-8">Create an account</h1>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-8" novalidate x-data="{ sex: '{{ old('sex') }}', selectedGenders: {{ json_encode(old('extended_gender', [])) }} }"
            x-init="$watch('selectedGenders', (value, oldValue) => {
                if (value.length > oldValue.length) {
                    let added = value.filter(x => !oldValue.includes(x))[0];
                    if (added === 'Prefer not to say' || added === 'None of these apply to me') {
                        selectedGenders = [added];
                    } else {
                        selectedGenders = selectedGenders.filter(x => x !== 'Prefer not to say' && x !== 'None of these apply to me');
                    }
                }
            })">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" value="Email" class="mb-2" />
                <x-text-input 
                    id="email" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    autofocus 
                />
            {{-- @php dd($errors) @endphp --}}
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Mobile Number -->
            <div>
                <x-input-label for="mobile" value="Mobile Number" class="mb-2" />
                <x-text-input 
                    id="mobile" 
                    type="tel" 
                    name="mobile" 
                    :value="old('mobile')" 
                    placeholder="(555) 000-0000"
                />
                <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- Legal First Name -->
                <div>
                    <div class="flex items-center space-x-1 mb-2">
                        <x-input-label for="first_name" value="Legal first name" class="!mb-0" />
                        <span class="text-slate-400 text-sm cursor-help"
                            title="Enter your name as it appears on legal documents.">ⓘ</span>
                    </div>
                    <x-text-input 
                        id="first_name" 
                        type="text" 
                        name="first_name" 
                        :value="old('first_name')" 
                    />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>
                <!-- Legal Last Name -->
                <div>
                    <div class="flex items-center space-x-1 mb-2">
                        <x-input-label for="last_name" value="Legal last name" class="!mb-0" />
                        <span class="text-slate-400 text-sm cursor-help"
                            title="Enter your name as it appears on legal documents.">ⓘ</span>
                    </div>
                    <x-text-input 
                        id="last_name" 
                        type="text" 
                        name="last_name" 
                        :value="old('last_name')" 
                    />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>

            <!-- Date of Birth -->
            <div>
                <x-input-label for="date_of_birth" value="Date of birth" class="mb-2" />
                <x-text-input 
                    id="date_of_birth" 
                    type="date" 
                    name="date_of_birth" 
                    placeholder="mm/dd/yyyy"
                    :value="old('date_of_birth')"
                />
                <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
            </div>

            <!-- Sex Selection -->
            <div>
                <div class="flex items-center space-x-1 mb-3">
                    <x-input-label value="Sex" class="!mb-0" />
                    <span class="text-slate-400 text-sm cursor-help"
                        title="This helps us match you with the right providers and plans.">ⓘ</span>
                </div>
                <div class="flex items-center space-x-8">
                    <label class="flex items-center cursor-pointer group">
                        <input type="radio" name="sex" value="male" x-model="sex"
                            class="w-4 h-4 text-primary border-slate-300 focus:ring-primary">
                        <span
                            class="ms-3 text-sm font-medium text-slate-700 group-hover:text-slate-900 transition-colors">Male</span>
                    </label>
                    <label class="flex items-center cursor-pointer group">
                        <input type="radio" name="sex" value="female" x-model="sex"
                            class="w-4 h-4 text-primary border-slate-300 focus:ring-primary">
                        <span
                            class="ms-3 text-sm font-medium text-slate-700 group-hover:text-slate-900 transition-colors">Female</span>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('sex')" class="mt-2" />
                <div class="mt-6">
                    <button type="button" @click="$dispatch('open-modal', 'gender-modal')"
                        class="text-xs font-bold text-slate-600 hover:text-primary transition-colors underline decoration-slate-300 underline-offset-4">
                        Add more sex & gender info (optional)
                    </button>
                    <x-input-error :messages="$errors->get('extended_gender')" class="mt-2" />
                    <!-- Hidden extended_gender payload -->
                    <template x-for="g in selectedGenders" :key="g">
                        <input type="hidden" name="extended_gender[]" :value="g">
                    </template>
                </div>
            </div>

            <!-- Extended Gender Modal -->
            <x-modal name="gender-modal" maxWidth="md">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-xl font-bold text-slate-900">Add more sex and gender info</h2>
                        <button type="button" @click="$dispatch('close-modal', 'gender-modal')"
                            class="text-slate-400 hover:text-slate-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                        Zocdoc is committed to creating a safe experience for all patients. If you would like to share
                        any additional sex or gender options with your provider, please select all that apply.
                    </p>

                    <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2 pb-4 pt-2">
                        @php
                            $genderOptions = [
                                ['label' => 'Assigned female at birth', 'desc' => null],
                                ['label' => 'Assigned male at birth', 'desc' => null],
                                [
                                    'label' => 'Cisgender',
                                    'desc' =>
                                        'A person whose current gender corresponds to the sex they were assigned at birth',
                                ],
                                [
                                    'label' => 'Genderfluid',
                                    'desc' => 'A person who does not identify with a fixed gender',
                                ],
                                [
                                    'label' => 'Genderqueer',
                                    'desc' => 'A person who does not follow binary gender norms',
                                ],
                                [
                                    'label' => 'Intersex / variations in sex characteristics',
                                    'desc' =>
                                        'A person born with traits, including genital anatomy, reproductive organs, hormone function, and/or chromosome patterns that may not fit the typical definition of male or female',
                                ],
                                [
                                    'label' => 'Non-binary',
                                    'desc' =>
                                        'Umbrella term for a person whose gender identity lies outside the gender binary',
                                ],
                                [
                                    'label' => 'Transgender man',
                                    'desc' =>
                                        'A person whose gender is male and whose sex assigned at birth was female',
                                ],
                                [
                                    'label' => 'Transgender woman',
                                    'desc' =>
                                        'A person whose gender is female and whose sex assigned at birth was male',
                                ],
                                ['label' => 'Prefer not to say', 'desc' => null],
                                ['label' => 'None of these apply to me', 'desc' => null],
                            ];
                        @endphp

                        @foreach ($genderOptions as $option)
                            <label class="flex items-start cursor-pointer group">
                                <div class="flex items-center h-5 mt-0.5">
                                    <input type="checkbox" value="{{ $option['label'] }}" x-model="selectedGenders"
                                        class="w-4 h-4 text-primary border-slate-300 rounded focus:ring-primary">
                                </div>
                                <div class="ml-3">
                                    <span
                                        class="block text-[15px] font-medium text-slate-800">{{ $option['label'] }}</span>
                                    @if ($option['desc'])
                                        <span
                                            class="block text-[13px] text-slate-500 mt-0.5 leading-snug">{{ $option['desc'] }}</span>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <!-- Footer actions -->
                    <div class="mt-6 pt-6 border-t border-slate-100 flex justify-end space-x-3">
                        <button type="button" @click="$dispatch('close-modal', 'gender-modal')"
                            class="px-5 py-2.5 text-sm font-bold text-slate-700 bg-white border border-slate-300 rounded-md hover:bg-slate-50 transition-colors">
                            Cancel
                        </button>
                        <button type="button" @click="$dispatch('close-modal', 'gender-modal')"
                            class="px-6 py-2.5 text-sm font-bold text-white bg-primary rounded-md shadow-sm hover:bg-primary-hover transition-colors">
                            Save
                        </button>
                    </div>
                </div>
            </x-modal>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Password" class="mb-2" />
                <x-password-input 
                    id="password" 
                    name="password" 
                    required 
                    autocomplete="new-password" 
                    :value="old('password')"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" value="Confirm Password" class="mb-2" />
                <x-password-input 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password"
                    :value="old('password_confirmation')"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="pt-2 text-center">
                <p class="text-xs text-slate-500">
                    By signing up, you agree to our <a href="{{ route('acceptable-use-policy') }}" class="text-primary hover:underline font-medium">Acceptable Use Policy</a>.
                </p>
            </div>

            <div class="pt-4">
                <x-button size="full">
                    Continue
                </x-button>
            </div>

            <!-- Social Divider -->
            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-xs text-slate-400 font-medium bg-[#F7F8F9] px-4">or</div>
            </div>

            <!-- Social Buttons -->
            <div class="space-y-4">
                <a href="{{ route('social.redirect', 'google') }}"
                    class="w-full py-3 px-6 border border-slate-400 rounded-md text-sm font-bold text-slate-800 hover:bg-slate-50 transition-all flex items-center justify-center space-x-3">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    <span>Continue with Google</span>
                </a>
            </div>

            <div class="mt-8 text-center pt-2">
                <p class="text-sm font-bold text-slate-700">
                    Already have an account?
                    <a href="{{ route('login') }}"
                        class="text-primary hover:underline underline-offset-4 font-bold">Log in</a>
                </p>
            </div>
        </form>
    </div>
</x-auth-layout>
