<x-app-layout>
    <div class="bg-[#f9f8f1] min-h-screen py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-black text-slate-800 mb-12 tracking-tight">Privacy Policy</h1>
            
            <div class="bg-white rounded-3xl p-8 md:p-16 shadow-sm border border-slate-100 prose prose-slate max-w-none">
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-8">Last Updated: April 1, 2026</p>
                
                <div class="space-y-12 text-slate-600 font-bold leading-relaxed">
                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">1. Introduction</h2>
                        <p>
                            Welcome to MedVroom. We are committed to protecting your personal information and your right to privacy. If you have any questions or concerns about our policy or our practices with regards to your personal information, please contact us at {{ \App\Constants\Contacts::EMAIL }}.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">2. Information We Collect</h2>
                        <p>
                            We collect personal information that you voluntarily provide to us when you register on the Website, express an interest in obtaining information about us or our products and Services, when you participate in activities on the Website or otherwise when you contact us.
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Personal information (name, address, email, phone number).</li>
                            <li>Health-related information (insurance provider, medical specialty interests).</li>
                            <li>Payment data (processed through secure third-party gateways).</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">3. How We Use Your Information</h2>
                        <p>
                            We use the information we collect or receive:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>To facilitate account creation and logon process.</li>
                            <li>To send you marketing and promotional communications.</li>
                            <li>To facilitate medical appointment bookings.</li>
                            <li>To respond to user inquiries/offer support to users.</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">4. Sharing Your Information</h2>
                        <p>
                            We only share information with your consent, to comply with laws, to provide you with services, to protect your rights, or to fulfill business obligations.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">5. HIPAA Compliance</h2>
                        <p>
                            MedVroom takes the security and privacy of your health information seriously. We implement administrative, physical, and technical safeguards to protect Protected Health Information (PHI) in accordance with the Health Insurance Portability and Accountability Act (HIPAA) standards.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">6. Your Privacy Rights</h2>
                        <p>
                            In some regions, such as the European Economic Area (EEA) and United Kingdom (UK), you have certain rights under applicable data protection laws. These may include the right (i) to request access and obtain a copy of your personal information, (ii) to request rectification or erasure; (iii) to restrict the processing of your personal information; and (iv) if applicable, to data portability.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">7. Contact Us</h2>
                        <p>
                            If you have questions or comments about this policy, you may email us at {{ \App\Constants\Contacts::EMAIL }} or by post to our office at:
                        </p>
                        <address class="not-italic mt-4">
                            {{ \App\Constants\Contacts::ADDRESS_NY['name'] }} Office<br>
                            {{ \App\Constants\Contacts::ADDRESS_NY['street'] }}, {{ \App\Constants\Contacts::ADDRESS_NY['floor'] }}<br>
                            {{ \App\Constants\Contacts::ADDRESS_NY['city_state_zip'] }}
                        </address>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
