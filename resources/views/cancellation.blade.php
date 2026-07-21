<x-app-layout :title="$setting['title']" :description="$setting['title']">
    <div class="bg-slate-50 py-16 sm:py-24 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100">
            
            <!-- Header Section -->
            <div class="text-center mb-12 border-b border-slate-100 pb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl uppercase font-[700]">
                    MEDVROOM CANCELLATION & NO-SHOW POLICY
                </h1>
                <p class="mt-2 text-sm text-slate-500">Effective Date: {{ now()->format('F d, Y') }}</p>
            </div>
            
            <!-- Policy Content -->
            <div class="space-y-10 text-slate-600 leading-relaxed text-base">
                
                <!-- Section 1 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">1.</span> PATIENT RESPONSIBILITY
                    </h2>
                    <p class="mb-2">Patients must cancel or reschedule appointments:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>At least <span class="font-bold text-slate-800">24 hours in advance</span> (unless provider specifies otherwise)</li>
                    </ul>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">2.</span> LATE CANCELLATIONS
                    </h2>
                    <p class="mb-2">Cancellations made within 24 hours may result in:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>A cancellation fee (set by provider)</li>
                        <li>Limited ability to rebook</li>
                    </ul>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">3.</span> NO-SHOWS
                    </h2>
                    <p class="mb-2">Failure to attend an appointment may result in:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Fees</li>
                        <li>Account restrictions</li>
                    </ul>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">4.</span> PROVIDER CANCELLATIONS
                    </h2>
                    <p class="mb-2">Providers may cancel due to:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-3">
                        <li>Emergencies</li>
                        <li>Scheduling conflicts</li>
                    </ul>
                    <p>Patients will be notified and may reschedule.</p>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">5.</span> REFUNDS
                    </h2>
                    <p class="mb-2">Refunds are subject to:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Provider policy</li>
                        <li>Payment processor rules</li>
                    </ul>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">6.</span> PLATFORM ROLE
                    </h2>
                    <p class="mb-2">MedVroom is not responsible for:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Fees charged by providers</li>
                        <li>Disputes between patient and provider</li>
                    </ul>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>