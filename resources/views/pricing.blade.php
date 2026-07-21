<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-16 sm:py-24">

        <div class="mb-10 text-center">
            <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 text-[10px] font-black uppercase tracking-widest rounded-full mb-4">MedVroom, Inc.</span>
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 leading-tight">Pricing, Fees & Payment Terms</h1>
            <p class="mt-3 text-base font-medium text-slate-500">Last Updated: 28 June, 2026.</p>
        </div>

        <div class="space-y-10 text-sm text-slate-700 leading-relaxed">

            {{-- 1. Overview --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">1. Overview</h2>
                <p>This Pricing, Fees & Payment Terms Policy ("Policy") explains how fees are charged, when payments occur, and how billing works on the MedVroom platform.</p>
                <p class="mt-3">By using MedVroom as a provider, you agree to the Provider Agreement and this Policy, which is incorporated by reference.</p>
            </section>

            {{-- 2. Free Trial --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">2. Free Trial</h2>
                <p>MedVroom offers a 30-day free trial for new providers. During the trial period:</p>
                <ul class="list-disc pl-5 mt-3 space-y-1">
                    <li>No subscription fees are charged</li>
                    <li>Providers may access platform features subject to eligibility</li>
                    <li>Per-booking fees may still apply depending on platform usage (if applicable, disclosed before booking acceptance)</li>
                </ul>
                <div class="mt-4 p-4 bg-amber-50 border border-amber-100 rounded-2xl">
                    <p class="text-xs font-black uppercase tracking-widest text-amber-700 mb-2">Trial Expiration</p>
                    <ul class="list-disc pl-5 space-y-1 text-sm text-amber-800">
                        <li>On Day 29–30, providers will receive reminders to add a payment method</li>
                        <li>On Day 31, if no valid payment method is added, provider profile visibility may be limited or paused. The account remains active for login and payment setup.</li>
                    </ul>
                </div>
            </section>

            {{-- 3. Subscription Plans --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-4">3. Subscription Plans</h2>
                <p class="mb-5">MedVroom offers the following provider subscription plans:</p>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="p-5 bg-slate-50 border-2 border-slate-200 rounded-2xl space-y-3">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Basic Plan</p>
                        <p class="text-3xl font-black text-slate-900">$49<span class="text-base font-bold text-slate-400">/mo</span></p>
                        <p class="text-xs font-bold text-indigo-600">$65 per new patient booking</p>
                        <ul class="text-xs text-slate-600 space-y-1 font-medium pt-2 border-t border-slate-200">
                            <li>✓ Standard profile listing</li>
                            <li>✓ Basic analytics</li>
                        </ul>
                    </div>
                    <div class="p-5 bg-indigo-50 border-2 border-indigo-400 rounded-2xl space-y-3">
                        <p class="text-[10px] font-black uppercase tracking-widest text-indigo-600">Premium Plan</p>
                        <p class="text-3xl font-black text-slate-900">$149<span class="text-base font-bold text-slate-400">/mo</span></p>
                        <p class="text-xs font-bold text-indigo-600">$45 per new patient booking</p>
                        <ul class="text-xs text-slate-600 space-y-1 font-medium pt-2 border-t border-indigo-200">
                            <li>✓ Priority search ranking</li>
                            <li>✓ Advanced analytics</li>
                        </ul>
                    </div>
                    <div class="p-5 bg-slate-50 border-2 border-slate-200 rounded-2xl space-y-3">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Promoted Add-On</p>
                        <p class="text-3xl font-black text-slate-900">+$99<span class="text-base font-bold text-slate-400">/mo</span></p>
                        <p class="text-xs font-bold text-indigo-600">Same per-booking fee as selected plan</p>
                        <ul class="text-xs text-slate-600 space-y-1 font-medium pt-2 border-t border-slate-200">
                            <li>✓ Sponsored placement</li>
                            <li>✓ Increased visibility</li>
                        </ul>
                    </div>
                </div>
            </section>

            {{-- 4. Per-Booking Fees --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">4. Per-Booking Fees</h2>
                <p>In addition to subscription fees, MedVroom charges a per-booking platform fee for each confirmed patient booking. Key rules:</p>
                <ul class="list-disc pl-5 mt-3 space-y-1">
                    <li>The exact fee is displayed before a provider accepts a booking</li>
                    <li>Fees are charged immediately upon acceptance of a booking</li>
                    <li>A booking is only confirmed after successful payment processing</li>
                    <li>If payment fails, the booking is not confirmed</li>
                </ul>
                <p class="mt-3">All per-booking fees are disclosed in the provider dashboard and booking interface prior to acceptance.</p>
            </section>

            {{-- 5. Billing Authorization --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">5. Billing Authorization</h2>
                <p>By using the platform, you authorize MedVroom, Inc. and its payment processor (including Stripe and Stripe Connect) to:</p>
                <ul class="list-disc pl-5 mt-3 space-y-1">
                    <li>Charge your stored payment method for subscription fees</li>
                    <li>Charge per-booking fees upon booking acceptance</li>
                    <li>Charge applicable promotional or optional service fees selected by you</li>
                </ul>
                <p class="mt-3">This authorization remains in effect until your account is terminated or payment authorization is withdrawn in accordance with platform policies.</p>
            </section>

            {{-- 6. Payment Timing --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">6. Payment Timing</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl">
                        <p class="text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Subscription Fees</p>
                        <ul class="text-sm text-slate-700 space-y-1">
                            <li>Charged monthly starting after the free trial period ends</li>
                            <li>Automatically recurring unless canceled</li>
                        </ul>
                    </div>
                    <div class="p-4 bg-slate-50 border border-slate-200 rounded-2xl">
                        <p class="text-xs font-black uppercase tracking-widest text-slate-500 mb-2">Per-Booking Fees</p>
                        <ul class="text-sm text-slate-700 space-y-1">
                            <li>Charged instantly at the time a booking is accepted</li>
                            <li>Each booking triggers a separate transaction</li>
                        </ul>
                    </div>
                </div>
            </section>

            {{-- 7. Failed Payments --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">7. Failed Payments</h2>
                <p>If a payment fails:</p>
                <ul class="list-disc pl-5 mt-3 space-y-1">
                    <li>The platform may retry the charge</li>
                    <li>Provider access or visibility may be restricted</li>
                    <li>Pending bookings may not be confirmed until payment is successful</li>
                </ul>
                <p class="mt-3">MedVroom reserves the right to suspend or limit accounts with unresolved payment failures.</p>
            </section>

            {{-- 8. Refunds --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">8. Refunds</h2>
                <p>Unless otherwise required by law or explicitly stated in writing:</p>
                <ul class="list-disc pl-5 mt-3 space-y-1">
                    <li>Subscription fees are non-refundable</li>
                    <li>Per-booking fees are non-refundable once a booking is confirmed</li>
                </ul>
            </section>

            {{-- 9. Pricing Changes --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">9. Pricing Changes</h2>
                <p>MedVroom may update pricing or fees at any time. If pricing changes occur:</p>
                <ul class="list-disc pl-5 mt-3 space-y-1">
                    <li>Providers will be notified in advance where required by law</li>
                    <li>Continued use of the platform after changes take effect constitutes acceptance of updated pricing</li>
                </ul>
            </section>

            {{-- 10. Payment Processing --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">10. Payment Processing (Stripe)</h2>
                <p>Payments are processed through third-party payment providers, including Stripe and Stripe Connect. MedVroom does not store full payment card details. By using the platform, you agree to the applicable terms of Stripe and its connected services.</p>
            </section>

            {{-- 11. Taxes --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">11. Taxes</h2>
                <p>Providers are responsible for any applicable taxes arising from payments, fees, or services under this Policy.</p>
            </section>

            {{-- 12. Account Suspension --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">12. Account Suspension & Access</h2>
                <p>MedVroom may restrict profile visibility, suspend booking access, or pause account features if payment obligations are not met or if fraud, misuse, or policy violations are detected.</p>
            </section>

            {{-- 13. Disputes --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">13. Disputes</h2>
                <p>Any billing disputes must be submitted through the provider support system. Providers agree to attempt resolution in good faith before initiating chargebacks.</p>
            </section>

            {{-- 14. Order of Priority --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">14. Order of Priority</h2>
                <p>In the event of conflict between documents:</p>
                <ol class="list-decimal pl-5 mt-3 space-y-1">
                    <li>Provider Agreement</li>
                    <li>This Pricing, Fees & Payment Terms Policy</li>
                    <li>Platform dashboard disclosures</li>
                </ol>
            </section>

            {{-- 15. Contact --}}
            <section>
                <h2 class="text-base font-black text-slate-900 uppercase tracking-widest mb-3">15. Contact</h2>
                <div class="p-5 bg-slate-50 border border-slate-200 rounded-2xl text-sm text-slate-700 space-y-1">
                    <p class="font-bold text-slate-900">MedVroom, Inc.</p>
                    <p>Billing Support: <a href="mailto:support@medvroom.com" class="text-indigo-600 hover:underline">support@medvroom.com</a></p>
                </div>
            </section>

        </div>
    </div>
</x-app-layout>