<x-app-layout title="Business Associate Agreement" description="Business Associate Agreement">    <div class="bg-slate-50 py-16 sm:py-24 font-sans">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100">

            <!-- Header -->
            <div class="text-center mb-12 border-b border-slate-100 pb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl uppercase font-[700]">
                    BUSINESS ASSOCIATE AGREEMENT (BAA)
                </h1>
                <p class="mt-2 text-sm text-slate-500">
                    Last updated: {{ now()->format('F d, Y') }}
                </p>
            </div>

            <!-- Agreement Content -->
            <div class="space-y-10 text-slate-600 leading-relaxed text-base">

                <section>
                    <p><strong>Covered Entity:</strong> [Provider] ("Covered Entity")</p>
                    <p><strong>Business Associate:</strong> MedVroom, Inc., a Delaware corporation ("Business Associate")</p>
                    <p><strong>Effective Date:</strong> [Date of Acceptance]</p>
                </section>

                <!-- Section 1 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">1.</span> PURPOSE
                    </h2>
                    <p>
                        This Agreement governs the use, disclosure, creation, receipt, maintenance,
                        and transmission of Protected Health Information ("PHI") by Business Associate
                        on behalf of Covered Entity, in compliance with the Health Insurance Portability
                        and Accountability Act of 1996 ("HIPAA"), the Health Information Technology
                        for Economic and Clinical Health Act ("HITECH"), and all applicable regulations,
                        including 45 CFR Parts 160 and 164.
                    </p>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">2.</span> DEFINITIONS
                    </h2>
                    <p>
                        All capitalized terms not otherwise defined herein shall have the meanings
                        set forth under HIPAA, HITECH, and their implementing regulations.
                    </p>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">3.</span> PERMITTED USES AND DISCLOSURES
                    </h2>

                    <p class="mb-2">
                        Business Associate may use or disclose PHI only as necessary to perform
                        services for Covered Entity through the MedVroom platform, including:
                    </p>

                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-4">
                        <li>Patient-provider matching</li>
                        <li>Appointment scheduling and management</li>
                        <li>Care coordination and communication facilitation</li>
                        <li>Platform operations, analytics, and administrative support</li>
                    </ul>

                    <p class="mb-2">Business Associate may also:</p>

                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Use PHI for its proper management, administration, or legal responsibilities, as permitted under HIPAA.</li>
                        <li>Disclose PHI as required by law.</li>
                    </ul>

                    <p class="mt-4">
                        Business Associate shall not use or disclose PHI in any manner that would violate HIPAA if done by Covered Entity.
                    </p>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">4.</span> PROHIBITED USES AND DISCLOSURES
                    </h2>

                    <p class="mb-2">Business Associate shall not:</p>

                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Sell PHI.</li>
                        <li>Use PHI for marketing or advertising without prior written authorization.</li>
                        <li>Use or disclose PHI except as permitted under this Agreement or required by law.</li>
                        <li>Attempt to re-identify de-identified data.</li>
                    </ul>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">5.</span> SAFEGUARDS
                    </h2>

                    <p class="mb-2">
                        Business Associate shall implement and maintain appropriate administrative,
                        physical, and technical safeguards to protect PHI, including:
                    </p>

                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Encryption of electronic PHI at rest and in transit.</li>
                        <li>Access controls, authentication mechanisms, and role-based access restrictions.</li>
                        <li>Audit logs and monitoring systems.</li>
                        <li>Workforce training and confidentiality obligations.</li>
                        <li>Regular security risk assessments and vulnerability management.</li>
                    </ul>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">6.</span> BREACH NOTIFICATION
                    </h2>

                    <p>
                        Business Associate shall notify Covered Entity without unreasonable delay
                        and in no event later than fifteen (15) calendar days after discovery of
                        any Breach, Security Incident, or unauthorized access involving PHI.
                    </p>

                    <p class="mt-4">
                        Such notice shall include all information required under 45 CFR § 164.410
                        and applicable HIPAA regulations.
                    </p>
                </section>

                <!-- Section 7 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">7.</span> SUBCONTRACTORS
                    </h2>

                    <p>
                        Business Associate shall ensure that any subcontractor that creates,
                        receives, maintains, or transmits PHI is bound by written agreements
                        imposing the same restrictions and obligations as this Agreement.
                    </p>

                    <p class="mt-4">
                        Business Associate remains fully responsible for the acts and omissions
                        of its subcontractors.
                    </p>
                </section>

                <!-- Section 8 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">8.</span> ACCESS, AMENDMENT, AND DISCLOSURE ACCOUNTING
                    </h2>

                    <p class="mb-2">
                        Business Associate shall make PHI available to Covered Entity in a timely
                        manner (not to exceed ten (10) business days) to enable Covered Entity
                        to fulfill obligations related to:
                    </p>

                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Individual access requests.</li>
                        <li>Amendment requests.</li>
                        <li>Accounting of disclosures.</li>
                    </ul>
                </section>

                <!-- Section 9 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">9.</span> GOVERNMENT ACCESS
                    </h2>

                    <p>
                        Business Associate shall make its internal practices, books, and records
                        relating to PHI available to the Secretary of the U.S. Department of Health
                        and Human Services ("HHS") upon request for compliance review.
                    </p>
                </section>

                <!-- Section 10 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">10.</span> TERM AND TERMINATION
                    </h2>

                    <div class="space-y-4 pl-4 border-l-2 border-slate-100">
                        <div>
                            <h3 class="font-[700] text-[#1D41DA]">10.1</h3>
                            <p>
                                This Agreement shall remain in effect as long as Business Associate
                                maintains or processes PHI on behalf of Covered Entity.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-[700] text-[#1D41DA]">10.2</h3>
                            <p>
                                Either party may terminate this Agreement upon written notice if
                                the other party materially breaches this Agreement and fails to cure
                                such breach within thirty (30) days.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-[700] text-[#1D41DA]">10.3</h3>

                            <p class="mb-2">Upon termination:</p>

                            <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                                <li>Business Associate shall return or securely destroy all PHI within thirty (30) days, where feasible.</li>
                                <li>If return or destruction is not feasible, PHI shall remain protected under this Agreement indefinitely.</li>
                                <li>Business Associate shall not retain PHI except as required by law.</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Section 11 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">11.</span> INDEMNIFICATION
                    </h2>

                    <p class="mb-2">
                        Business Associate shall indemnify, defend, and hold harmless Covered Entity
                        from any claims, damages, liabilities, losses, costs, or expenses (including
                        reasonable attorneys’ fees) arising out of:
                    </p>

                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>Any breach of this Agreement.</li>
                        <li>Any violation of HIPAA by Business Associate or its subcontractors.</li>
                        <li>Any unauthorized use or disclosure of PHI.</li>
                    </ul>
                </section>

                <!-- Section 12 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">12.</span> INSURANCE
                    </h2>

                    <p class="mb-2">
                        Business Associate shall maintain cyber liability and/or professional
                        liability insurance with minimum coverage of:
                    </p>

                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>$1,000,000 per occurrence.</li>
                        <li>$3,000,000 aggregate.</li>
                    </ul>

                    <p class="mt-4">
                        Upon request, Business Associate shall provide a certificate of insurance.
                    </p>
                </section>

                <!-- Section 13 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">13.</span> MISCELLANEOUS
                    </h2>

                    <div class="space-y-4 pl-4 border-l-2 border-slate-100">

                        <div>
                            <h3 class="font-[700] text-[#1D41DA]">Ownership</h3>
                            <p>Covered Entity retains all rights, title, and interest in PHI.</p>
                        </div>

                        <div>
                            <h3 class="font-[700] text-[#1D41DA]">No Agency</h3>
                            <p>Nothing in this Agreement creates an agency, partnership, joint venture, or employment relationship.</p>
                        </div>

                        <div>
                            <h3 class="font-[700] text-[#1D41DA]">Governing Law</h3>
                            <p>
                                This Agreement shall be governed by applicable federal law and the
                                laws of the State in which Covered Entity operates, without regard
                                to conflict of law principles.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-[700] text-[#1D41DA]">Survival</h3>
                            <p>
                                All obligations relating to PHI protection, confidentiality,
                                indemnification, and insurance shall survive termination.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-[700] text-[#1D41DA]">Severability</h3>
                            <p>
                                If any provision is held invalid, the remaining provisions shall
                                remain in full force and effect.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-[700] text-[#1D41DA]">Entire Agreement</h3>
                            <p>
                                This Agreement constitutes the entire agreement regarding PHI
                                between the parties and may only be modified in writing or as
                                required by law.
                            </p>
                        </div>

                    </div>
                </section>

                <!-- Section 14 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">14.</span> ELECTRONIC ACCEPTANCE
                    </h2>

                    <p class="mb-4">
                        By clicking <strong>"I Agree,"</strong> Covered Entity acknowledges and
                        agrees to be bound by this Agreement as of the Effective Date.
                    </p>

                    <p>
                        Covered Entity and Business Associate each intend that electronic
                        acceptance shall have the same legal effect as a handwritten signature.
                    </p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>