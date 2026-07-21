<x-provider-onboarding-layout title="Legal Agreements" description="Step 6 of 8 • Required" currentStep="6">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.legal.store') }}" class="p-8 lg:p-12 space-y-10" id="legal-form">
            @csrf

            {{-- Hidden fields for audit trail --}}
            <input type="hidden" name="accepted_at" id="accepted_at">
            <input type="hidden" name="accepted_ip" id="accepted_ip">

            <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl flex items-start space-x-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-amber-600 shrink-0 mt-0.5"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>
                <p class="text-xs font-bold text-amber-800 leading-relaxed">
                    All checkboxes are required and cannot be pre-filled. Please read each agreement carefully before checking.
                </p>
            </div>

            <div class="space-y-4">

                {{-- 1. Terms of Service --}}
                <label class="flex items-start space-x-4 p-5 bg-slate-50 border-2 border-slate-100 rounded-2xl cursor-pointer hover:border-indigo-200 transition-all has-[:checked]:border-indigo-400 has-[:checked]:bg-indigo-50">
                    <input
                        type="checkbox"
                        name="agree_terms_of_service"
                        id="agree_terms_of_service"
                        required
                        class="mt-1 w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 shrink-0"
                    >
                    <div>
                        <span class="block text-sm font-black text-slate-900">Terms of Service</span>
                        <span class="block text-sm font-medium text-slate-600 mt-1 leading-relaxed">
                            I agree to the <a href="{{ route('terms') }}" target="_blank" class="text-indigo-600 hover:underline font-bold">Terms of Service</a> and <a href="{{ route('privacy') }}" target="_blank" class="text-indigo-600 hover:underline font-bold">Privacy Policy</a> governing my use of the MedVroom platform.
                        </span>
                    </div>
                </label>

                {{-- 2. Provider Agreement --}}
                <label class="flex items-start space-x-4 p-5 bg-slate-50 border-2 border-slate-100 rounded-2xl cursor-pointer hover:border-indigo-200 transition-all has-[:checked]:border-indigo-400 has-[:checked]:bg-indigo-50">
                    <input
                        type="checkbox"
                        name="agree_provider_agreement"
                        id="agree_provider_agreement"
                        required
                        class="mt-1 w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 shrink-0"
                    >
                    <div>
                        <span class="block text-sm font-black text-slate-900">Provider Agreement</span>
                        <span class="block text-sm font-medium text-slate-600 mt-1 leading-relaxed">
                            I agree to the <a href="{{ route('provider-agreement') }}" target="_blank" class="text-indigo-600 hover:underline font-bold">Provider Agreement</a> and acknowledge that I am an independent contractor and not an employee, agent, or partner of MedVroom. I am solely responsible for maintaining all required licenses, certifications, and compliance with applicable federal and state laws, including healthcare regulations.
                        </span>
                    </div>
                </label>

                {{-- 3. Insurance Accuracy Clause --}}
                <label class="flex items-start space-x-4 p-5 bg-slate-50 border-2 border-slate-100 rounded-2xl cursor-pointer hover:border-indigo-200 transition-all has-[:checked]:border-indigo-400 has-[:checked]:bg-indigo-50">
                    <input
                        type="checkbox"
                        name="agree_insurance_accuracy"
                        id="agree_insurance_accuracy"
                        required
                        class="mt-1 w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 shrink-0"
                    >
                    <div>
                        <span class="block text-sm font-black text-slate-900">Insurance Accuracy Clause</span>
                        <span class="block text-sm font-medium text-slate-600 mt-1 leading-relaxed">
                            I certify that all insurance, credentialing, and practice information I provide is true, accurate, and complete. I agree to promptly update any changes and understand that failure to do so may result in suspension or removal from the platform.
                        </span>
                    </div>
                </label>

                {{-- 4. BAA --}}
                <label class="flex items-start space-x-4 p-5 bg-slate-50 border-2 border-slate-100 rounded-2xl cursor-pointer hover:border-indigo-200 transition-all has-[:checked]:border-indigo-400 has-[:checked]:bg-indigo-50">
                    <input
                        type="checkbox"
                        name="agree_baa"
                        id="agree_baa"
                        required
                        class="mt-1 w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 shrink-0"
                    >
                    <div>
                        <span class="block text-sm font-black text-slate-900 uppercase tracking-wide">MedVroom Business Associate Agreement</span>
                        <span class="block text-sm font-medium text-slate-600 mt-1 leading-relaxed">
                            I acknowledge and agree to the <a href="{{ route('baa') }}" target="_blank" class="text-indigo-600 hover:underline font-bold">MedVroom Business Associate Agreement ("BAA")</a>, which governs the use, disclosure, safeguarding, and handling of Protected Health Information ("PHI") in accordance with the Health Insurance Portability and Accountability Act of 1996 ("HIPAA") and its implementing regulations. I understand that this agreement is legally binding and is incorporated by reference into my use of the MedVroom platform.
                        </span>
                        <span class="inline-flex items-center mt-2 px-2 py-0.5 bg-rose-100 text-rose-700 text-[10px] font-black uppercase tracking-widest rounded-full">
                            HIPAA Required
                        </span>
                    </div>
                </label>
                
                
                
                 {{-- 5. Payment authorization --}}
                <label class="flex items-start space-x-4 p-5 bg-slate-50 border-2 border-slate-100 rounded-2xl cursor-pointer hover:border-indigo-200 transition-all has-[:checked]:border-indigo-400 has-[:checked]:bg-indigo-50">
                    <input
                        type="checkbox"
                        name="agree_payment_authorization"
                        id="agree_payment_authorization"
                        required
                        class="mt-1 w-5 h-5 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 shrink-0"
                    >
                    <div>
                        <span class="block text-sm font-black text-slate-900 uppercase tracking-wide">Payment Authorization</span>
                        <span class="block text-sm font-medium text-slate-600 mt-1 leading-relaxed">
                            I authorize MedVroom, Inc. to charge applicable fees for my use of the platform per the
                            <a href="{{ route('pricing') }}" target="_blank" class="text-indigo-600 hover:underline font-bold">Pricing and Fees</a> schedule.
                        </span>
                    </div>
                </label>

            </div>

            {{-- Audit trail notice --}}
            <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-medium text-slate-500 leading-relaxed space-y-1">
                <p class="font-black text-slate-700 uppercase tracking-widest text-[10px] mb-2">Legal Record</p>
                <p>Your acceptance of the above agreements will be recorded with a timestamp and your IP address as a legally binding electronic signature under the E-SIGN Act and UETA.</p>
            </div>

            <p class="text-xs font-bold text-slate-400 text-center uppercase tracking-widest leading-relaxed">
                By clicking below, you legally accept all agreements above and submit your application for review.
            </p>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30" id="submit-btn">
                Submit for Approval
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>

    <script>
        // Capture timestamp + IP on form submit for audit trail
        document.getElementById('legal-form').addEventListener('submit', function () {
            document.getElementById('accepted_at').value = new Date().toISOString();
            // IP is captured server-side more reliably, but we populate a placeholder
            document.getElementById('accepted_ip').value = 'server-resolved';
        });
    </script>
</x-provider-onboarding-layout>