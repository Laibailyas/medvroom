<x-provider-onboarding-layout title="Agreements & Policies" description="Step 8 of 10 • Legal Compliance" currentStep="8">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.agreements.store') }}" class="p-8 lg:p-12 space-y-10">
            @csrf

            <div class="space-y-8">
                <div class="p-6 bg-slate-50 border border-slate-100 rounded-3xl space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="mt-1">
                            <input type="checkbox" name="agreed_provider_agreement" id="agreed_provider_agreement" required class="w-6 h-6 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                        </div>
                        <label for="agreed_provider_agreement" class="flex-1 cursor-pointer">
                            <span class="block text-lg font-black text-slate-900 leading-none">Provider Agreement</span>
                            <span class="block text-sm text-slate-500 mt-2 font-medium leading-relaxed">
                                I have read and agree to the <a href="#" class="text-indigo-600 hover:underline">MedVroom Provider Agreement</a>. I understand this governs my relationship with the platform.
                            </span>
                        </label>
                    </div>

                    <div class="flex items-start space-x-4 pt-6 border-t border-slate-200">
                        <div class="mt-1">
                            <input type="checkbox" name="agreed_baa" id="agreed_baa" required class="w-6 h-6 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                        </div>
                        <label for="agreed_baa" class="flex-1 cursor-pointer">
                            <span class="block text-lg font-black text-slate-900 leading-none">Business Associate Agreement (BAA)</span>
                            <span class="block text-sm text-slate-500 mt-2 font-medium leading-relaxed">
                                I agree to the <a href="#" class="text-indigo-600 hover:underline">HIPAA Business Associate Agreement</a>. I confirm that I will maintain patient confidentiality in accordance with HIPAA standards.
                            </span>
                        </label>
                    </div>

                    <div class="flex items-start space-x-4 pt-6 border-t border-slate-200">
                        <div class="mt-1">
                            <input type="checkbox" name="agreed_license_validity" id="agreed_license_validity" required class="w-6 h-6 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                        </div>
                        <label for="agreed_license_validity" class="flex-1 cursor-pointer">
                            <span class="block text-lg font-black text-slate-900 leading-none">Credentialing Confirmation</span>
                            <span class="block text-sm text-slate-500 mt-2 font-medium leading-relaxed">
                                I confirm that all licenses provided are valid and active. I authorize MedVroom to perform credentialing checks as required by law.
                            </span>
                        </label>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                        By clicking below, you legally sign the agreements above and confirm your application for review.
                    </p>
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Continue to Final Review
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>
