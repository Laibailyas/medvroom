<x-app-layout :title="$setting['title']" :description="$setting['title']">
    <div class="bg-slate-50 py-16 sm:py-24 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100">
            
            <!-- Header Section -->
            <div class="text-center mb-12 border-b border-slate-100 pb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl uppercase font-[700]">
                    MEDVROOM PROVIDER AGREEMENT
                </h1>
                <p class="mt-2 text-sm text-slate-500">Effective Date: {{ now()->format('F d, Y') }}</p>
            </div>
            
            <!-- Agreement Content -->
            <div class="space-y-10 text-slate-600 leading-relaxed text-base">
                
                <!-- Intro -->
                <section class="space-y-4">
                    <p>This Provider Agreement (“Agreement”) is entered into between MedVroom, Inc. (“MedVroom,” “Platform,” “we,” “us”) and the healthcare provider or entity (“Provider,” “you”).</p>
                    <p>By registering, accessing, or using the Platform, you agree to be legally bound by this Agreement.</p>
                </section>

                <!-- Section 1 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">1.</span> PLATFORM SERVICES
                    </h2>
                    <p class="mb-2">MedVroom provides a technology marketplace that enables Providers to list services, manage availability, and receive appointment requests.</p>
                    <p class="mb-2">MedVroom does <span class="font-bold text-slate-900 uppercase">NOT</span>:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>provide medical care</li>
                        <li>practice medicine</li>
                        <li>employ or supervise Providers</li>
                        <li>control clinical decisions</li>
                    </ul>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">2.</span> INDEPENDENT CONTRACTOR STATUS
                    </h2>
                    <p>Provider is an independent contractor. Nothing in this Agreement creates employment, agency, partnership, or joint venture. Provider retains full control over pricing, services, and clinical decisions.</p>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">3.</span> PROVIDER REPRESENTATIONS & WARRANTIES
                    </h2>
                    <p class="mb-2">Provider represents and warrants that:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-2">
                        <li>all licenses are valid, active, and unrestricted</li>
                        <li>Provider complies with all federal and state laws</li>
                        <li>Provider maintains all required certifications, registrations, and malpractice insurance</li>
                        <li>Provider is not excluded from any government healthcare program</li>
                    </ul>
                    <p>Provider must immediately notify MedVroom of any license suspension, investigation, disciplinary action, or lapse in insurance.</p>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">4.</span> PROVIDER RESPONSIBILITIES
                    </h2>
                    <p class="mb-2">Provider agrees to:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                        <li>deliver care consistent with accepted medical standards</li>
                        <li>maintain accurate profile and availability</li>
                        <li>honor scheduled appointments or provide reasonable notice</li>
                        <li>independently verify patient identity, insurance eligibility, and treatment appropriateness</li>
                    </ul>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">5.</span> TELEHEALTH COMPLIANCE
                    </h2>
                    <p>Provider is solely responsible for telehealth compliance, including state-specific telehealth laws, licensure in the patient’s location, obtaining informed consent, and maintaining proper documentation. MedVroom does not verify or guarantee telehealth eligibility.</p>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">6.</span> NO RELIANCE ON PLATFORM
                    </h2>
                    <p>Provider acknowledges that MedVroom does not guarantee patient volume, listings, visibility, or promotions. Provider does not rely on MedVroom for business success.</p>
                </section>

                <!-- Section 7 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">7.</span> APPOINTMENTS & PLATFORM USE
                    </h2>
                    <p>Provider agrees to maintain accurate scheduling, avoid double-booking, and act in good faith. MedVroom reserves the right to monitor activity, suspend or restrict access, or remove listings at its sole discretion.</p>
                </section>

                <!-- Section 8 -->
                <section class="border border-slate-200 rounded-2xl p-6 sm:p-8 bg-slate-50/50 space-y-6">
                    <div>
                        <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                            <span class="text-[#1D41DA] mr-2">8.</span> FEES & PAYMENTS
                        </h2>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">8.1 Free Trial Period</h3>
                        <p>New Providers receive a 30-day free trial with full platform access. No credit card is required to start. During the trial period, Providers may receive bookings, and applicable per-booking fees will be charged upon booking confirmation unless otherwise stated.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">8.2 Subscription and Per-Booking Fees</h3>
                        <p class="mb-2">After the 30-day trial, Providers must select a plan (Basic or Premium) and provide a valid payment method to continue receiving new patient bookings.</p>
                        <p class="mb-2">Fees consist of:</p>
                        <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA]">
                            <li>A recurring monthly subscription fee (billed on the 31st day and monthly thereafter), and</li>
                            <li>A per-booking service fee charged immediately upon booking confirmation (or after the patient’s 24-hour cancellation window expires).</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">8.3 Promoted Listings</h3>
                        <p>Providers may purchase a Promoted add-on for additional monthly fees to receive enhanced visibility.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">8.4 Payment Terms</h3>
                        <p class="mb-2">All fees are processed securely through Stripe.</p>
                        <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-2">
                            <li>By accepting a booking, Provider authorizes immediate charge of the applicable per-booking fee.</li>
                            <li>Monthly subscriptions are charged automatically.</li>
                            <li>Failure to maintain valid payment information may result in suspension of the Provider’s profile visibility.</li>
                        </ul>
                        <p>MedVroom reserves the right to modify pricing with 30 days’ notice. Continued use after notice constitutes acceptance of updated pricing. Fees are non-refundable except as expressly provided in this Agreement.</p>
                    </div>
                </section>

                <!-- Section 9 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">9.</span> INSURANCE & BILLING DISCLAIMER
                    </h2>
                    <p>Provider is solely responsible for verifying insurance coverage, communicating costs to patients, and billing compliance. MedVroom does not guarantee insurance acceptance or reimbursement.</p>
                </section>

                <!-- Section 10 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">10.</span> PATIENT DATA & PRIVACY
                    </h2>
                    <p class="mb-3">Provider agrees to comply with all applicable privacy laws, including HIPAA, and to safeguard patient information.</p>
                    <p class="mb-3">MedVroom functions primarily as a scheduling and technology platform. Providers are responsible for handling medical records, intake, and treatment data through their own systems.</p>
                    <p class="mb-3">Provider acknowledges that MedVroom may act as a Business Associate when it receives, creates, maintains, or transmits Protected Health Information (PHI) on Provider’s behalf. Provider agrees to execute MedVroom’s Business Associate Agreement (BAA) as a condition of using the Platform for any services involving PHI. Provider must execute the BAA prior to activation of any features that involve the exchange of PHI. Failure to execute the BAA may result in suspension or termination of Provider’s account.</p>
                    <p>Provider remains solely responsible for its own compliance as a Covered Entity (or Business Associate) under HIPAA.</p>
                </section>

                <!-- Section 11 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">11.</span> PROHIBITED CONDUCT
                    </h2>
                    <p class="mb-3">Provider shall not misrepresent credentials, submit false information, engage in fraud, manipulate reviews, or bypass the platform to avoid fees.</p>
                    <p class="mb-2">Provider shall not:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-3">
                        <li>Misrepresent credentials, licensure status, insurance participation, or any other profile information</li>
                        <li>Submit false information or engage in fraud</li>
                        <li>Manipulate reviews (including incentivizing, faking, suppressing, or exchanging reviews)</li>
                        <li>Solicit patients to move bookings off-platform</li>
                        <li>Engage in any activity prohibited by our Acceptable Use Policy, which is incorporated into this Agreement by reference</li>
                    </ul>
                    <p class="mb-3">Provider acknowledges that all content submitted to the Platform (including profile information, availability, and responses to reviews) must fully comply with the Acceptable Use Policy.</p>
                    <p>MedVroom reserves the right to monitor, moderate, remove content, suspend, or terminate a Provider’s account for violations of this Agreement or the Acceptable Use Policy.</p>
                </section>

                <!-- Section 12 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">12.</span> REVIEWS & CONTENT
                    </h2>
                    <p>Patients may submit reviews. MedVroom may remove or moderate content at its discretion. Provider may not solicit or falsify reviews.</p>
                </section>

                <!-- Section 13 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">13.</span> SUSPENSION & TERMINATION
                    </h2>
                    <p class="mb-3">MedVroom may suspend or terminate Provider’s account at any time for violations of this Agreement, legal or compliance risk, patient safety concerns, inaccurate information, or failure to pay any subscription or per-booking fees when due.</p>
                    <p class="mb-3">During any suspension due to non-payment, Provider’s profile will be hidden from patient search results, but the account will remain active. Provider may reactivate the account by paying all outstanding balances.</p>
                    <p>Provider may terminate this Agreement at any time with notice, but remains responsible for all fees accrued up to the termination date.</p>
                </section>

                <!-- Section 14 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">14.</span> NON-CIRCUMVENTION
                    </h2>
                    <p>Provider agrees not to circumvent the MedVroom platform to avoid applicable fees. This includes soliciting patients obtained through MedVroom to transact outside the platform. This restriction applies during the term of this Agreement and for 12 months following the last patient interaction facilitated through MedVroom. Violation may result in immediate suspension, termination, financial penalties, and legal action. This includes attempting to avoid applicable subscription or per-booking fees by moving patients off-platform.</p>
                </section>

                <!-- Section 15 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">15.</span> FORCE MAJEURE
                    </h2>
                    <p>MedVroom shall not be liable for failure or delay resulting from causes beyond its reasonable control (system outages, internet failures, natural disasters, third-party service interruptions, etc.).</p>
                </section>

                <!-- Section 16 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">16.</span> DISCLAIMER OF WARRANTIES
                    </h2>
                    <p>The Platform is provided “AS IS” and “AS AVAILABLE” with no warranties of any kind, express or implied (including merchantability, fitness for a particular purpose, accuracy, non-infringement, or reliability of platform content). MedVroom disclaims all warranties to the fullest extent permitted by law.</p>
                </section>

                <!-- Section 17 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">17.</span> LIMITATION OF LIABILITY
                    </h2>
                    <p class="mb-2 uppercase tracking-wide font-medium text-slate-800 text-sm">TO THE FULLEST EXTENT PERMITTED BY LAW:</p>
                    <p class="mb-3">MedVroom shall not be liable for medical malpractice, provider actions, patient disputes, loss of revenue, data, or business, or indirect or consequential damages.</p>
                    <p><strong>TOTAL LIABILITY SHALL NOT EXCEED</strong> the fees paid by Provider to MedVroom in the 6 months preceding the claim.</p>
                </section>

                <!-- Section 18 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">18.</span> NO PLATFORM LIABILITY FOR MEDICAL SERVICES
                    </h2>
                    <p>Provider agrees that MedVroom has no responsibility for patient care. Provider assumes full liability for all medical services and shall defend and indemnify MedVroom against malpractice claims, patient injury claims, and regulatory violations.</p>
                </section>

                <!-- Section 19 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">19.</span> INDEMNIFICATION
                    </h2>
                    <p>Provider agrees to defend, indemnify, and hold harmless MedVroom from any claims arising out of medical services provided, violation of laws, breach of this Agreement, or inaccurate information submitted.</p>
                </section>

                <!-- Section 20 -->
                <section class="border border-slate-200 rounded-2xl p-6 sm:p-8 bg-slate-50/50 space-y-6">
                    <div>
                        <h2 class="text-xl font-[700] text-slate-900 mb-1 flex items-start">
                            <span class="text-[#1D41DA] mr-2">20.</span> DISPUTE RESOLUTION; BINDING ARBITRATION AND CLASS ACTION WAIVER
                        </h2>
                        <p class="text-xs font-bold text-slate-700 tracking-wider uppercase mb-4">IMPORTANT: PLEASE READ THIS SECTION CAREFULLY — IT AFFECTS YOUR LEGAL RIGHTS.</p>
                        <p>This section requires most disputes between you and MedVroom to be resolved through binding individual arbitration instead of court proceedings, and includes a waiver of class actions and jury trials. You and MedVroom agree that any Dispute (defined below) will be resolved as set forth in this Section.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">20.1 Informal Dispute Resolution</h3>
                        <p>Most issues can be resolved by contacting us at <a href="mailto:support@medvroom.com" class="text-[#1D41DA] underline">support@medvroom.com</a>. Before initiating arbitration, the complaining party must first send a written Pre-Arbitration Notice to <a href="mailto:legal@medvroom.com" class="text-[#1D41DA] underline">legal@medvroom.com</a>. The notice must include: (a) the party’s name, account information, and contact details; (b) a detailed description of the claim and the relief sought; and (c) the complaining party’s signature (or authorized representative’s signature).</p>
                        <p class="mt-2">The other party will respond using the contact information on file. For 60 days after receipt of a complete notice, the parties will attempt in good faith to resolve the Dispute. This informal process is a required condition precedent to arbitration.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">20.2 Agreement to Arbitrate</h3>
                        <p>If the Dispute is not resolved within 60 days, you and MedVroom agree that it shall be resolved exclusively through final and binding individual arbitration administered by the American Arbitration Association (AAA) under its Commercial Arbitration Rules (or Consumer Arbitration Rules if applicable) then in effect.</p>
                        <p class="mt-2">This Arbitration Agreement is governed by the Federal Arbitration Act (9 U.S.C. § 1 et seq.). The arbitration will be conducted virtually by videoconference or, at the election of the Provider, in the county where the Provider’s primary practice is located. The arbitrator’s decision will be final and binding, subject to any limited appeal rights under the FAA.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">20.3 Class Action, Collective Action, and Representative Action Waiver</h3>
                        <p class="font-medium text-slate-800">ALL DISPUTES MUST BE BROUGHT ON AN INDIVIDUAL BASIS ONLY.</p>
                        <p>You and MedVroom waive any right to bring, join, or participate in a class action, collective action, consolidated action, representative action, or private attorney general action, whether in arbitration or in court. The arbitrator may award relief only to the individual party seeking relief and only to the extent necessary to provide relief warranted by that party’s individual claim.</p>
                        <p class="mt-2 font-medium text-slate-800">YOU ARE ALSO WAIVING YOUR RIGHT TO A JURY TRIAL to the fullest extent permitted by law.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">20.4 Small Claims Court Exception</h3>
                        <p>Either party may bring an individual claim in small claims court in the county of the Provider’s primary practice (or MedVroom’s principal place of business) if the claim qualifies and remains strictly on an individual basis.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">20.5 Mass Filing Procedures</h3>
                        <p>If 25 or more similar claims are filed by or with the assistance of the same law firm, group of coordinated claimants, or otherwise coordinated (“Mass Filing”), the AAA’s Mass Arbitration Supplementary Rules (or equivalent) shall apply, including staged resolution procedures designed to promote efficiency and fairness.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">20.6 Costs and Fees</h3>
                        <p>Payment of arbitration fees and costs will be governed by the applicable AAA Rules. MedVroom will not seek to recover its attorneys’ fees or costs unless the arbitrator determines the claim is frivolous or brought in bad faith.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">20.7 Opt-Out Right</h3>
                        <p>You may opt out of this arbitration agreement by sending a signed written notice to <a href="mailto:legal@medvroom.com" class="text-[#1D41DA] underline">legal@medvroom.com</a> within 30 days after the date you first accept this Provider Agreement. The notice must clearly state that you are opting out of the arbitration agreement and include your full name, practice name, and license number. If you opt out, this Section 20 will not apply to you.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">20.8 Survival</h3>
                        <p>This Section 20 survives any termination or expiration of this Agreement.</p>
                    </div>
                </section>

                <!-- Section 21 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">21.</span> GOVERNING LAW
                    </h2>
                    <p>This Agreement shall be governed by the laws of the State of Washington, without regard to conflict of law principles, and subject to applicable federal law. Any disputes not subject to arbitration shall be resolved exclusively in the state or federal courts located in Spokane County, Washington.</p>
                </section>

                <!-- Section 22 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">22.</span> SEVERABILITY
                    </h2>
                    <p>If any provision is found unenforceable, it shall be modified to the minimum extent necessary, and the remaining provisions shall remain in full force.</p>
                </section>

                <!-- Section 23 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">23.</span> ENTIRE AGREEMENT
                    </h2>
                    <p>This Agreement constitutes the entire agreement between the parties and supersedes all prior agreements.</p>
                </section>

                <!-- Section 24 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">24.</span> ELECTRONIC ACCEPTANCE
                    </h2>
                    <p>This Agreement is entered into electronically and is enforceable under the Electronic Signatures in Global and National Commerce Act (E-SIGN Act).</p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
