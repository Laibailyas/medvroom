<x-app-layout :title="$setting['title']" :description="$setting['title']">
    <div class="bg-slate-50 py-16 sm:py-24 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100">
            
            <!-- Header Section -->
            <div class="text-center mb-12 border-b border-slate-100 pb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl uppercase font-[700]">
                    MEDVROOM PRIVACY POLICY
                </h1>
                <p class="mt-2 text-sm text-slate-500">Effective Date: {{ now()->format('F d, Y') }}</p>
            </div>
            
            <!-- Policy Content -->
            <div class="space-y-10 text-slate-600 leading-relaxed text-base">
                
                <!-- Intro -->
                <section class="space-y-4">
                    <p>At MedVroom (“MedVroom,” “we,” “us,” or “our”), we are committed to protecting your privacy while providing a seamless marketplace for connecting patients with independent healthcare providers. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our website, mobile applications, and services (collectively, the “Platform”).</p>
                    <p>By using MedVroom, you consent to the practices described in this Policy. This Policy is incorporated into and subject to our Terms of Service (Patient) and Provider Agreement.</p>
                </section>

                <!-- Section 1 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">1.</span> INFORMATION WE COLLECT
                    </h2>
                    <p class="mb-4">We collect the following categories of information:</p>
                    
                    <div class="space-y-4 pl-4 border-l-2 border-slate-100">
                        <div>
                            <h3 class="text-base font-[700] text-[#1D41DA] mb-1">Personal Information</h3>
                            <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                                <li>Name, email address, phone number, date of birth, and mailing address</li>
                                <li>Account credentials and profile information</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-base font-[700] text-[#1D41DA] mb-1">Health-Related Information</h3>
                            <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                                <li>Appointment details (date, time, specialty, reason for visit – limited to short descriptions)</li>
                                <li>Provider interaction history</li>
                                <li>Limited intake information voluntarily provided</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-base font-[700] text-[#1D41DA] mb-1">Technical and Usage Data</h3>
                            <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                                <li>IP address, device information, browser type, operating system</li>
                                <li>Usage data, cookies, and similar tracking technologies (see our Cookie Policy)</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-base font-[700] text-[#1D41DA] mb-1">Automatically Collected Data</h3>
                            <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                                <li>Location data (ZIP code or city-level for provider matching)</li>
                                <li>Referral sources and interaction logs</li>
                            </ul>
                        </div>
                    </div>
                    <p class="mt-4 font-medium text-slate-800">We do not require or store detailed medical history, symptoms, clinical notes, or full medical records on our core platform.</p>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">2.</span> HIPAA STATUS & ROLE CLARIFICATION
                    </h2>
                    <p class="mb-3">MedVroom is not a healthcare provider or covered entity. Depending on the services, we may act as a Business Associate under HIPAA when we create, receive, maintain, or transmit Protected Health Information (PHI) on behalf of our healthcare provider customers (Covered Entities).</p>
                    <p class="mb-2">Where we act as a Business Associate:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-3">
                        <li>We only process PHI as permitted by our signed Business Associate Agreement (BAA) with the Provider and in accordance with HIPAA, the HITECH Act, and applicable regulations (including 2026 updates).</li>
                        <li>We enter into BAAs with Providers as required.</li>
                        <li>We implement administrative, physical, and technical safeguards to protect PHI.</li>
                    </ul>
                    <p>For more information, see our Business Associate Agreement.</p>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">3.</span> HOW WE USE INFORMATION
                    </h2>
                    <p class="mb-2">We use the information we collect to:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-3">
                        <li>Facilitate appointment booking and provider matching</li>
                        <li>Operate, maintain, and improve the Platform</li>
                        <li>Communicate with you (reminders, confirmations, support)</li>
                        <li>Process payments (via third-party processors)</li>
                        <li>Ensure safety, security, fraud prevention, and compliance with our Acceptable Use Policy</li>
                        <li>Moderate and enforce rules regarding user-generated content and reviews</li>
                        <li>Generate de-identified or aggregated analytics</li>
                        <li>Comply with legal obligations</li>
                    </ul>
                    <p>We may review user content for compliance with our Acceptable Use Policy as part of platform moderation and safety efforts.</p>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">4.</span> DATA SHARING & DISCLOSURE
                    </h2>
                    <p class="mb-4 bg-slate-50 border border-slate-200 text-sm p-4 rounded-xl italic">
                        All service providers and subcontractors are bound by our Data Processing Addendum (or equivalent contractual safeguards) and, where applicable, Business Associate Agreements
                    </p>
                    <p class="mb-2">We may share information with:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-3">
                        <li>Healthcare Providers you book with</li>
                        <li>Service providers (hosting, analytics, messaging, payment processors like Stripe) under strict contracts</li>
                        <li>As required by law, court order, or government request</li>
                    </ul>
                    <p>We do not sell your personal information or PHI. We do not share PHI except as permitted under our BAAs and HIPAA.</p>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">5.</span> DE-IDENTIFIED AND AGGREGATED DATA
                    </h2>
                    <p>We may use and disclose de-identified or aggregated data (that cannot reasonably identify you) for analytics, research, product improvement, and industry insights. Such data is no longer subject to HIPAA or most state privacy laws.</p>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">6.</span> DATA SECURITY
                    </h2>
                    <p class="mb-2">We implement industry-standard safeguards including:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-3">
                        <li>Encryption in transit (TLS) and at rest (AES-256)</li>
                        <li>Role-based access controls and audit logging</li>
                        <li>Regular security assessments and monitoring</li>
                        <li>Breach response protocols</li>
                    </ul>
                    <p>No system is 100% secure. In the event of a breach involving PHI or personal data, we will notify affected individuals and regulators as required by law.</p>
                </section>

                <!-- Section 7 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">7.</span> DATA RETENTION
                    </h2>
                    <p>We retain information only as long as necessary to provide services, comply with legal obligations, resolve disputes, and enforce agreements. PHI is retained in accordance with our BAAs and applicable retention schedules.</p>
                </section>

                <!-- Section 8 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">8.</span> YOUR PRIVACY RIGHTS
                    </h2>
                    <p class="mb-3 font-medium text-slate-800">State Privacy Rights (including California, Washington, Virginia, Colorado, Connecticut, and others):</p>
                    <p class="mb-2">Depending on your state of residence, you may have rights to:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-4">
                        <li>Access, correct, or delete your personal information</li>
                        <li>Opt out of certain processing or sharing</li>
                        <li>Limit use of sensitive/consumer health data</li>
                        <li>Receive a copy of your data in portable format</li>
                    </ul>
                    <p class="mb-4"><strong>Washington My Health My Data Act & Consumer Health Data:</strong> We treat consumer health data with heightened protections and honor all applicable rights under this law and similar state laws.</p>
                    <p>To exercise your rights, contact us at <a href="mailto:privacy@medvroom.com" class="text-[#1D41DA] underline font-medium">privacy@medvroom.com</a>. We will respond within the time required by law (typically 30–45 days).</p>
                </section>

                <!-- Section 9 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">9.</span> COOKIES & TRACKING TECHNOLOGIES
                    </h2>
                    <p class="mb-3">We use cookies and similar technologies as described in our Cookie Policy. We comply with all applicable state cookie and tracking laws.</p>
                    <p>We do not currently respond to “Do Not Track” browser signals but honor opt-out and consent preferences where required.</p>
                </section>

                <!-- Section 10 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">10.</span> CHILDREN’S PRIVACY
                    </h2>
                    <p>MedVroom is not intended for individuals under 18 years of age. We do not knowingly collect personal information from children. If we learn we have collected data from a child under 18, we will delete it.</p>
                </section>

                <!-- Section 11 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">11.</span> BREACH NOTIFICATION
                    </h2>
                    <p class="mb-2">In the event of a security incident or breach, we will:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Investigate promptly</li>
                        <li>Notify affected Providers and individuals as required by HIPAA and state law</li>
                        <li>Take appropriate remedial actions</li>
                    </ul>
                </section>

                <!-- Section 12 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">12.</span> CHANGES TO THIS PRIVACY POLICY
                    </h2>
                    <p>We may update this Policy from time to time. We will notify you of material changes by posting the new Policy with an updated effective date and, where required, by additional notice (email or in-app). Continued use after changes constitutes acceptance.</p>
                </section>

                <!-- Section 13 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">13.</span> CONTACT US
                    </h2>
                    <p>For questions, requests, or concerns about this Privacy Policy or your data:</p>
                    <p class="mt-2 font-medium">Email: <a href="mailto:support@medvroom.com" class="text-[#1D41DA] underline">support@medvroom.com</a></p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>