<x-app-layout :title="$setting['title']" :description="$setting['title']">
    <div class="bg-slate-50 py-16 sm:py-24 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100">
            
            <!-- Header Section -->
            <div class="text-center mb-12 border-b border-slate-100 pb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl uppercase font-[700]">
                    MEDVROOM TERMS OF SERVICE 
                </h1>
                <p class="mt-2 text-sm text-slate-500">Effective Date: {{ now()->format('F d, Y') }}</p>
            </div>
            
            <!-- Terms Content -->
            <div class="space-y-10 text-slate-600 leading-relaxed text-base">
                
                <!-- Intro -->
                <section class="space-y-4">
                    <p>Welcome to MedVroom (“MedVroom,” “we,” “us,” or “our”). These Terms of Service (“Terms”) govern your access to and use of the MedVroom platform, including our website, applications, and services.</p>
                    <p>By accessing or using MedVroom, you agree to be bound by these Terms.</p>
                </section>

                <!-- Section 1 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">1.</span> NATURE OF THE PLATFORM
                    </h2>
                    <p class="mb-2">MedVroom is a technology marketplace that connects patients with independent healthcare providers (“Providers”).</p>
                    <p class="mb-2">MedVroom:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-2">
                        <li>does not provide medical care</li>
                        <li>does not practice medicine</li>
                        <li>does not employ or control Providers</li>
                    </ul>
                    <p>All healthcare services are provided solely by independent Providers.</p>
                </section>

                <!-- Section 2 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">2.</span> ELIGIBILITY
                    </h2>
                    <p>You must be at least 18 years old to use MedVroom. By using the platform, you represent that you have the legal capacity to enter into these Terms and all information you provide is accurate.</p>
                </section>

                <!-- Section 3 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">3.</span> ACCOUNT REGISTRATION
                    </h2>
                    <p>You may be required to create an account. You agree to maintain the confidentiality of your credentials, provide accurate and updated information, and notify us of unauthorized access.</p>
                </section>

                <!-- Section 4 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">4.</span> USE OF THE PLATFORM
                    </h2>
                    <p>You agree not to use the platform for unlawful purposes, submit false or misleading information, or interfere with platform functionality.</p>
                </section>

                <!-- Section 5 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">5.</span> APPOINTMENTS & BOOKINGS
                    </h2>
                    <p>MedVroom allows you to book appointments with Providers. You acknowledge that Providers control their own availability, appointments may be canceled or rescheduled, and MedVroom does not guarantee appointment fulfillment.</p>
                </section>

                <!-- Section 6 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">6.</span> TELEHEALTH SERVICES
                    </h2>
                    <p>Providers may offer telehealth services. You acknowledge that telehealth has inherent risks and limitations, you are responsible for confirming provider licensure in your state, and MedVroom provides technology only.</p>
                </section>

                <!-- Section 7 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">7.</span> PAYMENTS
                    </h2>
                    <p>MedVroom does not control provider fees and is not responsible for billing disputes or insurance coverage. Providers may charge platform service fees (subscription or per-booking) separately from their medical service fees.</p>
                </section>

                <!-- Section 8 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">8.</span> PRIVACY
                    </h2>
                    <p>Your use of MedVroom is subject to our Privacy Policy. Certain information may be protected under HIPAA.</p>
                </section>

                <!-- Section 9 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">9.</span> USER CONTENT & REVIEWS
                    </h2>
                    <p class="mb-3">You may submit reviews, comments, and other content on the Platform.</p>
                    <p class="mb-3">You agree that all content you submit must comply with our Acceptable Use Policy, which is incorporated into these Terms. By submitting content, you represent and warrant that:</p>
                    <ul class="list-disc pl-5 space-y-1 marker:text-[#1D41DA] mb-3">
                        <li>Your content is truthful, accurate, and based on real experiences</li>
                        <li>It does not violate any applicable law or third-party rights</li>
                        <li>It complies with the prohibitions outlined in the Acceptable Use Policy (including no false reviews, harassment, spam, or personal health information of others)</li>
                    </ul>
                    <p class="mb-3">MedVroom reserves the right (but has no obligation) to review, moderate, edit, or remove any content that violates the Acceptable Use Policy, these Terms, or applicable law, at its sole discretion.</p>
                    <p>You grant MedVroom a worldwide, non-exclusive, royalty-free license to use, display, and distribute your content for the purpose of operating and promoting the Platform.</p>
                </section>

                <!-- Section 10 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">10.</span> INTELLECTUAL PROPERTY
                    </h2>
                    <p>All content, software, design, text, graphics, and functionality on the MedVroom platform are owned by or licensed to MedVroom. You are granted a limited, non-exclusive, non-transferable license for personal, non-commercial use. User-submitted content remains yours, but you grant MedVroom a worldwide, non-exclusive license to use it for platform operation.</p>
                </section>

                <!-- Section 11 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">11.</span> TERMINATION
                    </h2>
                    <p>We may suspend or terminate your access if you violate these Terms or pose a risk to the platform or users.</p>
                </section>

                <!-- Section 12 -->
                <section class="border border-slate-200 rounded-2xl p-6 sm:p-8 bg-slate-50/50 space-y-6">
                    <div>
                        <h2 class="text-xl font-[700] text-slate-900 mb-1 flex items-start">
                            <span class="text-[#1D41DA] mr-2">12.</span> MARKETPLACE DISCLAIMER, LIMITATION OF LIABILITY, RELEASE & INDEMNIFICATION
                        </h2>
                        <p class="text-xs font-bold text-amber-600 tracking-wider uppercase mb-4">IMPORTANT: THIS SECTION AFFECTS YOUR LEGAL RIGHTS. PLEASE READ CAREFULLY.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.0 Disclaimer of Warranties</h3>
                        <p>The Platform is provided “AS IS” and “AS AVAILABLE” with no warranties of any kind, express or implied (including merchantability, fitness for a particular purpose, accuracy, non-infringement, or reliability of platform content). MedVroom disclaims all warranties to the fullest extent permitted by law.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.1 Marketplace Status; No Medical Provider Relationship</h3>
                        <p>MedVroom is a technology platform that facilitates connections between patients and independent healthcare providers. MedVroom does not provide medical care and does not create a doctor–patient relationship.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.2 No Medical Advice; No Reliance</h3>
                        <p>All content is for informational purposes only and does not constitute medical advice. You agree not to rely on MedVroom for medical decisions. If you are experiencing an emergency, call 911.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.3 No Endorsement or Guarantee</h3>
                        <p>MedVroom does not guarantee provider qualifications, availability, or outcomes of care.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.4 Provider Responsibility</h3>
                        <p>Providers are independent and solely responsible for all care. MedVroom is not liable for malpractice or provider actions.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.5 Telehealth Disclaimer</h3>
                        <p>MedVroom is not responsible for telehealth connectivity, interruptions, or clinical appropriateness.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.6 Payments Disclaimer</h3>
                        <p>MedVroom acts only as a payment intermediary and is not responsible for billing disputes.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.7 Limitation of Liability</h3>
                        <p>To the maximum extent permitted by law, MedVroom shall not be liable for indirect or consequential damages. Total liability is limited to the greater of $100 USD or amounts paid in the last 6 months.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.8 State Law Carve-Out</h3>
                        <p>Limitations apply to the fullest extent permitted by law.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.9 Release of Claims</h3>
                        <p>You release MedVroom from claims arising from provider interactions and medical outcomes (including waiver of California Civil Code §1542 or similar state laws).</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.10 Indemnification</h3>
                        <p>You agree to indemnify MedVroom for claims arising from your use of the platform.</p>
                    </div>

                    <div>
                        <h3 class="text-base font-[700] text-[#1D41DA] mb-1">12.11 No Duty to Intervene</h3>
                        <p>MedVroom has no obligation to resolve disputes between users and providers.</p>
                    </div>

                    <div class="border-t border-slate-200 pt-6 space-y-4">
                        <div>
                            <h3 class="text-base font-[700] text-slate-900 mb-1">12.12 Dispute Resolution; Binding Arbitration and Class Action Waiver</h3>
                            <p class="text-xs font-bold text-slate-700 tracking-wider uppercase mb-2">IMPORTANT: PLEASE READ THIS SECTION CAREFULLY — IT AFFECTS YOUR LEGAL RIGHTS.</p>
                            <p>This section contains an arbitration agreement that requires you and MedVroom to resolve most disputes through binding individual arbitration instead of court, and includes a waiver of class actions and jury trials. You and MedVroom agree that any Dispute (defined below) will be resolved as set forth in this Section.</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-[700] text-[#1D41DA] mb-1">12.12.1 Informal Dispute Resolution</h4>
                            <p>Most issues can be resolved by contacting us at <a href="mailto:support@medvroom.com" class="text-[#1D41DA] underline">support@medvroom.com</a>. Before initiating arbitration, you must first send a written Pre-Arbitration Notice to <a href="mailto:legal@medvroom.com" class="text-[#1D41DA] underline">legal@medvroom.com</a>. The notice must include: (a) your name, account information, and contact details; (b) a detailed description of the claim and the relief sought; and (c) your personal signature.</p>
                            <p class="mt-2">MedVroom will send its notice to the contact information associated with your account. For 60 days after receipt of a complete notice, the parties will attempt in good faith to resolve the Dispute. This process is a required condition before filing arbitration.</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-[700] text-[#1D41DA] mb-1">12.12.2 Agreement to Arbitrate</h4>
                            <p>If the Dispute is not resolved within 60 days, you and MedVroom agree that it shall be resolved exclusively through final and binding individual arbitration administered by the American Arbitration Association (AAA) under its Consumer Arbitration Rules then in effect.</p>
                            <p class="mt-2">This Arbitration Agreement is governed by the Federal Arbitration Act (9 U.S.C. § 1 et seq.). The arbitration will be conducted virtually by videoconference or, at your option, in the county of your residence. The arbitrator’s decision will be final and binding, except for any appeal rights under the FAA.</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-[700] text-[#1D41DA] mb-1">12.12.3 Class Action, Collective Action, and Representative Action Waiver</h4>
                            <p class="font-medium text-slate-800">ALL DISPUTES MUST BE BROUGHT ON AN INDIVIDUAL BASIS ONLY.</p>
                            <p>You and MedVroom waive any right to bring or participate in a class action, collective action, consolidated action, representative action, or private attorney general action (in arbitration or in court). The arbitrator may award relief only to the individual party and only to the extent necessary to provide relief warranted by that party’s individual claim.</p>
                            <p class="mt-2 font-medium text-slate-800">YOU ARE ALSO WAIVING YOUR RIGHT TO A JURY TRIAL to the fullest extent permitted by law.</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-[700] text-[#1D41DA] mb-1">12.12.4 Small Claims Court Exception</h4>
                            <p>Either party may bring an individual claim in small claims court in their county of residence if the claim qualifies and remains on an individual basis.</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-[700] text-[#1D41DA] mb-1">12.12.5 Mass Filing Procedures</h4>
                            <p>If 25 or more similar claims are filed by or with the assistance of the same law firm or group of coordinated claimants (“Mass Filing”), the AAA Mass Arbitration Supplementary Rules shall apply, including staged resolution procedures.</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-[700] text-[#1D41DA] mb-1">12.12.6 Costs</h4>
                            <p>Payment of arbitration fees will be governed by the AAA Rules. MedVroom will not seek to recover its attorneys’ fees unless the arbitrator determines your claim is frivolous.</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-[700] text-[#1D41DA] mb-1">12.12.7 Opt-Out Right</h4>
                            <p>You may opt out of this arbitration agreement by sending a signed written notice to <a href="mailto:legal@medvroom.com" class="text-[#1D41DA] underline">legal@medvroom.com</a> within 30 days of the date you first accept these Terms. The notice must clearly state that you are opting out. If you opt out, this entire Section 12.12 will not apply to you.</p>
                        </div>

                        <div>
                            <h4 class="text-sm font-[700] text-[#1D41DA] mb-1">12.12.8 Survival</h4>
                            <p>This Section 12.12 survives any termination of these Terms.</p>
                        </div>
                    </div>
                </section>

                <!-- Section 13 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">13.</span> FORCE MAJEURE
                    </h2>
                    <p>MedVroom shall not be liable for any failure or delay in performance resulting from causes beyond its reasonable control, including internet or service outages, cyberattacks, natural disasters, governmental actions, or failures of third-party services.</p>
                </section>

                <!-- Section 14 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">14.</span> GOVERNING LAW
                    </h2>
                    <p>These Terms are governed by the laws of the State of Washington, without regard to conflict of law principles, and subject to applicable federal and state regulations. Any disputes not subject to arbitration shall be resolved exclusively in the state or federal courts located in Spokane County, Washington.</p>
                </section>

                <!-- Section 15 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">15.</span> ELECTRONIC ACCEPTANCE
                    </h2>
                    <p>By using MedVroom, you agree to these Terms under the Electronic Signatures in Global and National Commerce Act (E-SIGN Act).</p>
                </section>

                <!-- Section 16 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">16.</span> CHANGES TO TERMS
                    </h2>
                    <p>We may update these Terms at any time. Continued use constitutes acceptance.</p>
                </section>

                <!-- Section 17 -->
                <section>
                    <h2 class="text-xl font-[700] text-slate-900 mb-3 flex items-start">
                        <span class="text-[#1D41DA] mr-2">17.</span> CONTACT
                    </h2>
                    <p>For questions, contact: <a href="mailto:Support@MedVroom.com" class="text-[#1D41DA] underline">Support@MedVroom.com</a></p>
                </section>

              

            </div>
        </div>
    </div>
</x-app-layout>