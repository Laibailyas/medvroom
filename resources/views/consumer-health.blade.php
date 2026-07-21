<x-app-layout title="Consumer Health Data Privacy Policy" description="Consumer Health Data Privacy Policy">
    <div class="bg-slate-50 py-16 sm:py-24 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100">

            <!-- Header -->
            <div class="text-center mb-12 border-b border-slate-100 pb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl uppercase font-[700]">
                    MEDVROOM CONSUMER HEALTH DATA PRIVACY POLICY
                </h1>
                <p class="mt-2 text-sm text-slate-500">Effective Date: {{ now()->format('F d, Y') }}</p>
            </div>

            <!-- Policy Content -->
            <div class="space-y-10 text-slate-600 leading-relaxed text-base">

                <!-- Intro -->
                <section>
                    <p class="mb-2">
                        This Consumer Health Data Privacy Policy supplements our main Privacy Policy
                        and applies specifically to &ldquo;Consumer Health Data&rdquo; as defined under
                        applicable state laws, including (but not limited to):
                    </p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Washington My Health My Data Act</li>
                        <li>Connecticut Data Privacy Act (as it relates to health data)</li>
                        <li>Nevada Consumer Health Data Privacy Law</li>
                        <li>Any similar future state consumer health privacy laws</li>
                    </ul>
                </section>

                <!-- Section 1 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">1.</span> WHAT IS CONSUMER HEALTH DATA?
                    </h2>
                    <p>
                        It includes information that relates to your past, present, or future physical
                        or mental health, health conditions, treatments, or similar health-related
                        details collected through the Platform (e.g., appointment details or limited
                        reason-for-visit descriptions).
                    </p>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">2.</span> OUR PRACTICES REGARDING CONSUMER HEALTH DATA
                    </h2>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>We collect and process Consumer Health Data only as strictly necessary to provide booking, scheduling, and platform services.</li>
                        <li>We do not sell Consumer Health Data.</li>
                        <li>We do not use it for targeted advertising or unrelated purposes.</li>
                        <li>We require signed Business Associate Agreements (BAAs) with Providers before sharing any Protected Health Information.</li>
                        <li>We apply heightened security and access controls to this data.</li>
                    </ul>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">3.</span> YOUR RIGHTS
                    </h2>
                    <p class="mb-2">
                        Depending on your state of residence, you may have additional rights regarding
                        your Consumer Health Data, including the right to:
                    </p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-4">
                        <li>Access and obtain a copy</li>
                        <li>Request deletion</li>
                        <li>Withdraw consent (where consent is the legal basis)</li>
                        <li>Opt out of any sharing beyond what is necessary for services</li>
                    </ul>
                    <p>
                        To exercise these rights, email
                        <a href="mailto:support@medvroom.com" class="text-[#1D41DA] font-medium hover:underline">support@medvroom.com</a>.
                    </p>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">4.</span> CHANGES
                    </h2>
                    <p>
                        We may update this supplement. Continued use constitutes acceptance of updates.
                    </p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>