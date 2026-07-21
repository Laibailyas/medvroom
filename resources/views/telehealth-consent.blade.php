<x-app-layout :title="$setting['title']" :description="$setting['title']">
    <div class="bg-slate-50 py-16 sm:py-24 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100">
            
            <!-- Header Section -->
            <div class="text-center mb-12 border-b border-slate-100 pb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl uppercase font-[700]">
                    MEDVROOM TELEHEALTH INFORMED CONSENT
                </h1>
                <p class="mt-2 text-sm text-slate-500">Effective Date: {{ now()->format('F d, Y') }}</p>
            </div>
            
            <!-- Consent Content -->
            <div class="space-y-10 text-slate-600 leading-relaxed text-base">
                
                <!-- Intro -->
                <p class="font-medium text-slate-800">By using telehealth services through MedVroom, you agree to the following:</p>

                <!-- Section 1 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">1.</span> NATURE OF TELEHEALTH
                    </h2>
                    <p class="mb-2">Telehealth involves the use of electronic communications to provide healthcare remotely.</p>
                    <p class="mb-2">This may include:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Video consultations</li>
                        <li>Phone calls</li>
                        <li>Messaging</li>
                    </ul>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">2.</span> RISKS OF TELEHEALTH
                    </h2>
                    <p class="mb-2">You understand:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Technical issues may occur</li>
                        <li>Information may be delayed or incomplete</li>
                        <li>Not all conditions can be treated remotely</li>
                    </ul>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">3.</span> PRIVACY & SECURITY
                    </h2>
                    <p class="mb-2">Your information may be protected under the Health Insurance Portability and Accountability Act (HIPAA).</p>
                    <p class="mb-2">However, you acknowledge:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>No system is 100% secure</li>
                        <li>There are risks of unauthorized access</li>
                    </ul>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">4.</span> PROVIDER LICENSURE
                    </h2>
                    <p class="mb-2">You understand:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Providers must be licensed in your state</li>
                        <li>You confirm you are located in a state where the provider is licensed</li>
                    </ul>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">5.</span> EMERGENCIES
                    </h2>
                    <p class="mb-4">Telehealth is <span class="font-bold text-red-600 uppercase">NOT</span> appropriate for emergencies.</p>
                    <p class="mb-4">If you are experiencing an emergency:</p>
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-center text-red-700 font-bold">
                        <span class="text-xl mr-3">👉</span>
                        <span>Call 911 immediately</span>
                    </div>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">6.</span> CONSENT TO TREATMENT
                    </h2>
                    <p>You voluntarily consent to receive healthcare via telehealth. You acknowledge that some states require additional telehealth consent elements and you will comply with all applicable state laws.</p>
                </section>

                <!-- Section 7 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">7.</span> RIGHT TO WITHDRAW
                    </h2>
                    <p>You may withdraw consent at any time.</p>
                </section>

                <!-- Section 8 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">8.</span> RECORDING
                    </h2>
                    <p>Sessions will <span class="font-bold text-slate-800 uppercase">NOT</span> be recorded without your consent.</p>
                </section>

                <!-- Section 9: Electronic Acceptance -->
                <section>
    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
        <span class="text-[#1D41DA] mr-2">9.</span> ELECTRONIC ACCEPTANCE
    </h2>
    <p>
        Where applicable, users may be required to electronically accept certain
        agreements and provide consent before receiving services. Electronic
        acceptance is legally binding and has the same force and effect as a
        handwritten signature.
    </p>
</section>

               

            </div>
        </div>
    </div>
</x-app-layout>