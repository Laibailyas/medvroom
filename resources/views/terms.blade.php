<x-app-layout>
    <div class="bg-[#f9f8f1] min-h-screen py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-black text-slate-800 mb-12 tracking-tight">Terms & Conditions</h1>
            
            <div class="bg-white rounded-3xl p-8 md:p-16 shadow-sm border border-slate-100 prose prose-slate max-w-none">
                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-8">Last Updated: April 1, 2026</p>
                
                <div class="space-y-12 text-slate-600 font-bold leading-relaxed">
                    <p class="italic">Please read these Terms & Conditions carefully before using the MedVroom website and services.</p>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">1. Agreement to Terms</h2>
                        <p>
                            By access or using our Services, you agree to be bound by these Terms. If you disagree with any part of the terms, then you may not access the Service.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">2. Use of Services</h2>
                        <p>
                            MedVroom provides a platform for patients to find healthcare providers, see availability, and book appointments. We do not provide medical advice or services directly.
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>You must be at least 18 years old to use this Service.</li>
                            <li>You agree to provide accurate information when creating an account or booking an appointment.</li>
                            <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">3. Patient Responsibilities</h2>
                        <p>
                            Patients are responsible for:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Verifying their own insurance coverage with their provider.</li>
                            <li>Arriving on time for scheduled appointments.</li>
                            <li>Providing accurate medical history to their selected providers.</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">4. Provider Responsibilities</h2>
                        <p>
                            Providers agree to:
                        </p>
                        <ul class="list-disc pl-6 space-y-2">
                            <li>Maintain up-to-date availability and specialty information.</li>
                            <li>Ensure all professional licenses and credentials are valid and current.</li>
                            <li>Abide by all applicable medical ethics and laws, including HIPAA.</li>
                        </ul>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">5. Limitation of Liability</h2>
                        <p>
                            In no event shall MedVroom, its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">6. Governing Law</h2>
                        <p>
                            These Terms shall be governed and construed in accordance with the laws of the State of New York, United States, without regard to its conflict of law provisions.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">7. Changes to Terms</h2>
                        <p>
                            We reserve the right, at our sole discretion, to modify or replace these Terms at any time. We will notify you of any changes by posting the new Terms on this page.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-2xl font-black text-slate-800 mb-6 uppercase tracking-tight italic">8. Contact Details</h2>
                        <p>
                            If you have any questions about these Terms, please contact us:
                        </p>
                        <address class="not-italic mt-4">
                            Email: {{ \App\Constants\Contacts::EMAIL }}<br>
                            Address: {{ \App\Constants\Contacts::ADDRESS_NY['street'] }}, {{ \App\Constants\Contacts::ADDRESS_NY['city_state_zip'] }}
                        </address>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
