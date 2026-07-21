<x-app-layout :title="$setting['title']" :description="$setting['title']">
    <div class="bg-slate-50 py-16 sm:py-24 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100">
            
            <!-- Header Section -->
            <div class="text-center mb-12 border-b border-slate-100 pb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl uppercase font-[700]">
                    MEDVROOM COOKIE POLICY
                </h1>
                <p class="mt-2 text-sm text-slate-500">Last updated: {{ now()->format('F d, Y') }}</p>
            </div>
            
            <!-- Policy Content -->
            <div class="space-y-10 text-slate-600 leading-relaxed text-base">
                
                <!-- Section 1 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">1.</span> WHAT ARE COOKIES
                    </h2>
                    <p>Cookies are small text files stored on your device when you visit a website.</p>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">2.</span> TYPES OF COOKIES WE USE
                    </h2>
                    <div class="space-y-4 pl-4 border-l-2 border-slate-100">
                        <div>
                            <h3 class="text-base font-[700] text-[#1D41DA] mb-1">Strictly Necessary Cookies</h3>
                            <p class="mb-2">Required for core functionality such as:</p>
                            <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                                <li>account login</li>
                                <li>security</li>
                                <li>booking features</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-base font-[700] text-[#1D41DA] mb-1">Functional Cookies</h3>
                            <p class="mb-2">Used to:</p>
                            <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                                <li>remember preferences</li>
                                <li>improve user experience</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-base font-[700] text-[#1D41DA] mb-1">Analytics Cookies</h3>
                            <p class="mb-2">Used to:</p>
                            <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                                <li>understand how users interact with the platform</li>
                                <li>improve performance</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">3.</span> THIRD-PARTY COOKIES
                    </h2>
                    <p>We may use third-party services (e.g., analytics providers) that place cookies on your device. These providers may collect information in accordance with their own policies.</p>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">4.</span> LEGAL BASIS FOR USE
                    </h2>
                    <p class="mb-2">Where required by law, we rely on:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>your consent for non-essential cookies</li>
                        <li>our legitimate interests for essential functionality</li>
                    </ul>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">5.</span> COMPLIANCE WITH STATE LAWS
                    </h2>
                    <p>We comply with all applicable state cookie and tracking laws, including the California Consumer Privacy Act (CCPA/CPRA), Washington My Health My Data Act, and similar privacy laws in other states.</p>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">6.</span> YOUR CHOICES
                    </h2>
                    <p class="mb-2">You can:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>accept or reject non-essential cookies via our cookie banner</li>
                        <li>modify browser settings to block cookies</li>
                    </ul>
                </section>

                <!-- Section 7 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">7.</span> COOKIE CONSENT
                    </h2>
                    <p class="mb-2">When you first visit MedVroom, you will be presented with a cookie banner allowing you to:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>accept all cookies</li>
                        <li>reject non-essential cookies</li>
                        <li>manage preferences</li>
                    </ul>
                </section>

                <!-- Section 8 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">8.</span> UPDATES
                    </h2>
                    <p>We may update this Cookie Policy periodically. Continued use of the platform after changes constitutes acceptance of the updated policy.</p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>