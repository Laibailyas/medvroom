<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class LegalContentSeeder extends Seeder
{
    public function run(): void
    {
        // NOTE: system_settings has a NOT NULL `group` column with no default —
        // the first run failed on this. Adjust the group value below ('legal')
        // if your table uses a different convention (check what value existing
        // rows like `terms_conditions` or `provider_agreement`, if any, use).
        SystemSetting::updateOrCreate(['key' => 'provider_agreement'], ['group' => 'legal', 'value' => ['content' => $this->providerAgreement()]]);
        SystemSetting::updateOrCreate(['key' => 'baa'], ['group' => 'legal', 'value' => ['content' => $this->baa()]]);
        SystemSetting::updateOrCreate(['key' => 'pricing_terms'], ['group' => 'legal', 'value' => ['content' => $this->pricingTerms()]]);
    }

    private function baa(): string
    {
        return <<<HTML
<p><strong>Last updated:</strong> July 18, 2026</p>
<p><strong>Covered Entity:</strong> [Provider] ("Covered Entity")<br>
<strong>Business Associate:</strong> MedVroom, Inc., a Delaware corporation ("Business Associate")<br>
<strong>Effective Date:</strong> [Date of Acceptance]</p>

<h2>1. Purpose</h2>
<p>This Agreement governs the use, disclosure, creation, receipt, maintenance, and transmission of Protected Health Information ("PHI") by Business Associate on behalf of Covered Entity, in compliance with the Health Insurance Portability and Accountability Act of 1996 ("HIPAA"), the Health Information Technology for Economic and Clinical Health Act ("HITECH"), and all applicable regulations, including 45 CFR Parts 160 and 164.</p>

<h2>2. Definitions</h2>
<p>All capitalized terms not otherwise defined herein shall have the meanings set forth under HIPAA, HITECH, and their implementing regulations.</p>

<h2>3. Permitted Uses and Disclosures</h2>
<p>Business Associate may use or disclose PHI only as necessary to perform services for Covered Entity through the MedVroom platform, including:</p>
<ul>
<li>Patient-provider matching</li>
<li>Appointment scheduling and management</li>
<li>Care coordination and communication facilitation</li>
<li>Platform operations, analytics, and administrative support</li>
</ul>
<p>Business Associate may also use PHI for its proper management, administration, or legal responsibilities, as permitted under HIPAA, and may disclose PHI as required by law. Business Associate shall not use or disclose PHI in any manner that would violate HIPAA if done by Covered Entity.</p>

<h2>4. Prohibited Uses and Disclosures</h2>
<p>Business Associate shall not: sell PHI; use PHI for marketing or advertising without prior written authorization; use or disclose PHI except as permitted under this Agreement or required by law; or attempt to re-identify de-identified data.</p>

<h2>5. Safeguards</h2>
<p>Business Associate shall implement and maintain appropriate administrative, physical, and technical safeguards to protect PHI, including:</p>
<ul>
<li>Encryption of electronic PHI at rest and in transit</li>
<li>Access controls, authentication mechanisms, and role-based access restrictions</li>
<li>Audit logs and monitoring systems</li>
<li>Workforce training and confidentiality obligations</li>
<li>Regular security risk assessments and vulnerability management</li>
</ul>

<h2>6. Breach Notification</h2>
<p>Business Associate shall notify Covered Entity without unreasonable delay and in no event later than fifteen (15) calendar days after discovery of any Breach, Security Incident, or unauthorized access involving PHI. Such notice shall include all information required under 45 CFR &sect; 164.410 and applicable HIPAA regulations.</p>

<h2>7. Subcontractors</h2>
<p>Business Associate shall ensure that any subcontractor that creates, receives, maintains, or transmits PHI is bound by written agreements imposing the same restrictions and obligations as this Agreement. Business Associate remains fully responsible for the acts and omissions of its subcontractors.</p>

<h2>8. Access, Amendment, and Disclosure Accounting</h2>
<p>Business Associate shall make PHI available to Covered Entity in a timely manner (not to exceed ten (10) business days) to enable Covered Entity to fulfill obligations related to individual access requests, amendment requests, and accounting of disclosures.</p>

<h2>9. Government Access</h2>
<p>Business Associate shall make its internal practices, books, and records relating to PHI available to the Secretary of the U.S. Department of Health and Human Services ("HHS") upon request for compliance review.</p>

<h2>10. Term and Termination</h2>
<p>10.1 This Agreement shall remain in effect as long as Business Associate maintains or processes PHI on behalf of Covered Entity.</p>
<p>10.2 Either party may terminate this Agreement upon written notice if the other party materially breaches this Agreement and fails to cure such breach within thirty (30) days.</p>
<p>10.3 Upon termination: Business Associate shall return or securely destroy all PHI within thirty (30) days, where feasible. If return or destruction is not feasible, PHI shall remain protected under this Agreement indefinitely. Business Associate shall not retain PHI except as required by law.</p>

<h2>11. Indemnification</h2>
<p>Business Associate shall indemnify, defend, and hold harmless Covered Entity from any claims, damages, liabilities, losses, costs, or expenses (including reasonable attorneys' fees) arising out of any breach of this Agreement, any violation of HIPAA by Business Associate or its subcontractors, or any unauthorized use or disclosure of PHI.</p>

<h2>12. Insurance</h2>
<p>Business Associate shall maintain cyber liability and/or professional liability insurance with minimum coverage of $1,000,000 per occurrence and $3,000,000 aggregate. Upon request, Business Associate shall provide a certificate of insurance.</p>

<h2>13. Miscellaneous</h2>
<p><strong>Ownership.</strong> Covered Entity retains all rights, title, and interest in PHI.</p>
<p><strong>No Agency.</strong> Nothing in this Agreement creates an agency, partnership, joint venture, or employment relationship.</p>
<p><strong>Governing Law.</strong> This Agreement shall be governed by applicable federal law and the laws of the State in which Covered Entity operates, without regard to conflict of law principles.</p>
<p><strong>Survival.</strong> All obligations relating to PHI protection, confidentiality, indemnification, and insurance shall survive termination.</p>
<p><strong>Severability.</strong> If any provision is held invalid, the remaining provisions shall remain in full force and effect.</p>
<p><strong>Entire Agreement.</strong> This Agreement constitutes the entire agreement regarding PHI between the parties and may only be modified in writing or as required by law.</p>

<h2>14. Electronic Acceptance</h2>
<p>By clicking "I Agree," Covered Entity acknowledges and agrees to be bound by this Agreement as of the Effective Date. Covered Entity and Business Associate each intend that electronic acceptance shall have the same legal effect as a handwritten signature.</p>
HTML;
    }

    private function providerAgreement(): string
    {
        return <<<HTML
<p><strong>Effective Date:</strong> July 18, 2026</p>
<p>This Provider Agreement ("Agreement") is entered into between MedVroom, Inc. ("MedVroom," "Platform," "we," "us") and the healthcare provider or entity ("Provider," "you"). By registering, accessing, or using the Platform, you agree to be legally bound by this Agreement.</p>

<h2>1. Platform Services</h2>
<p>MedVroom provides a technology marketplace that enables Providers to list services, manage availability, and receive appointment requests. MedVroom does NOT provide medical care, practice medicine, employ or supervise Providers, or control clinical decisions.</p>

<h2>2. Independent Contractor Status</h2>
<p>Provider is an independent contractor. Nothing in this Agreement creates employment, agency, partnership, or joint venture. Provider retains full control over pricing, services, and clinical decisions.</p>

<h2>3. Provider Representations &amp; Warranties</h2>
<p>Provider represents and warrants that all licenses are valid, active, and unrestricted; Provider complies with all federal and state laws; Provider maintains all required certifications, registrations, and malpractice insurance; and Provider is not excluded from any government healthcare program. Provider must immediately notify MedVroom of any license suspension, investigation, disciplinary action, or lapse in insurance.</p>

<h2>4. Provider Responsibilities</h2>
<p>Provider agrees to deliver care consistent with accepted medical standards, maintain accurate profile and availability, honor scheduled appointments or provide reasonable notice, and independently verify patient identity, insurance eligibility, and treatment appropriateness.</p>

<h2>5. Telehealth Compliance</h2>
<p>Provider is solely responsible for telehealth compliance, including state-specific telehealth laws, licensure in the patient's location, obtaining informed consent, and maintaining proper documentation. MedVroom does not verify or guarantee telehealth eligibility.</p>

<h2>6. No Reliance on Platform</h2>
<p>Provider acknowledges that MedVroom does not guarantee patient volume, listings, visibility, or promotions. Provider does not rely on MedVroom for business success.</p>

<h2>7. Appointments &amp; Platform Use</h2>
<p>Provider agrees to maintain accurate scheduling, avoid double-booking, and act in good faith. MedVroom reserves the right to monitor activity, suspend or restrict access, or remove listings at its sole discretion.</p>

<h2>8. Fees &amp; Payments</h2>
<p><strong>8.1 Free Trial Period.</strong> New Providers receive a 30-day free trial with full platform access. No credit card is required to start. During the trial period, Providers may receive bookings, and applicable per-booking fees will be charged upon booking confirmation unless otherwise stated.</p>
<p><strong>8.2 Subscription and Per-Booking Fees.</strong> After the 30-day trial, Providers must select a plan (Basic or Premium) and provide a valid payment method to continue receiving new patient bookings. Fees consist of a recurring monthly subscription fee (billed on the 31st day and monthly thereafter), and a per-booking service fee charged immediately upon booking confirmation (or after the patient's 24-hour cancellation window expires).</p>
<p><strong>8.3 Promoted Listings.</strong> Providers may purchase a Promoted add-on for additional monthly fees to receive enhanced visibility.</p>
<p><strong>8.4 Payment Terms.</strong> All fees are processed securely through Stripe. By accepting a booking, Provider authorizes immediate charge of the applicable per-booking fee. Monthly subscriptions are charged automatically. Failure to maintain valid payment information may result in suspension of the Provider's profile visibility. MedVroom reserves the right to modify pricing with 30 days' notice. Continued use after notice constitutes acceptance of updated pricing. Fees are non-refundable except as expressly provided in this Agreement.</p>

<h2>9. Insurance &amp; Billing Disclaimer</h2>
<p>Provider is solely responsible for verifying insurance coverage, communicating costs to patients, and billing compliance. MedVroom does not guarantee insurance acceptance or reimbursement.</p>

<h2>10. Patient Data &amp; Privacy</h2>
<p>Provider agrees to comply with all applicable privacy laws, including HIPAA, and to safeguard patient information. MedVroom functions primarily as a scheduling and technology platform. Providers are responsible for handling medical records, intake, and treatment data through their own systems.</p>
<p>Provider acknowledges that MedVroom may act as a Business Associate when it receives, creates, maintains, or transmits Protected Health Information (PHI) on Provider's behalf. Provider agrees to execute MedVroom's Business Associate Agreement (BAA) as a condition of using the Platform for any services involving PHI. Provider must execute the BAA prior to activation of any features that involve the exchange of PHI. Failure to execute the BAA may result in suspension or termination of Provider's account.</p>
<p>Provider remains solely responsible for its own compliance as a Covered Entity (or Business Associate) under HIPAA.</p>

<h2>11. Prohibited Conduct</h2>
<p>Provider shall not misrepresent credentials, licensure status, insurance participation, or any other profile information; submit false information or engage in fraud; manipulate reviews (including incentivizing, faking, suppressing, or exchanging reviews); solicit patients to move bookings off-platform; or engage in any activity prohibited by our Acceptable Use Policy, which is incorporated into this Agreement by reference.</p>
<p>Provider acknowledges that all content submitted to the Platform (including profile information, availability, and responses to reviews) must fully comply with the Acceptable Use Policy. MedVroom reserves the right to monitor, moderate, remove content, suspend, or terminate a Provider's account for violations of this Agreement or the Acceptable Use Policy.</p>

<h2>12. Reviews &amp; Content</h2>
<p>Patients may submit reviews. MedVroom may remove or moderate content at its discretion. Provider may not solicit or falsify reviews.</p>

<h2>13. Suspension &amp; Termination</h2>
<p>MedVroom may suspend or terminate Provider's account at any time for violations of this Agreement, legal or compliance risk, patient safety concerns, inaccurate information, or failure to pay any subscription or per-booking fees when due.</p>
<p>During any suspension due to non-payment, Provider's profile will be hidden from patient search results, but the account will remain active. Provider may reactivate the account by paying all outstanding balances. Provider may terminate this Agreement at any time with notice, but remains responsible for all fees accrued up to the termination date.</p>

<h2>14. Non-Circumvention</h2>
<p>Provider agrees not to circumvent the MedVroom platform to avoid applicable fees. This includes soliciting patients obtained through MedVroom to transact outside the platform. This restriction applies during the term of this Agreement and for 12 months following the last patient interaction facilitated through MedVroom. Violation may result in immediate suspension, termination, financial penalties, and legal action.</p>

<h2>15. Force Majeure</h2>
<p>MedVroom shall not be liable for failure or delay resulting from causes beyond its reasonable control (system outages, internet failures, natural disasters, third-party service interruptions, etc.).</p>

<h2>16. Disclaimer of Warranties</h2>
<p>The Platform is provided "AS IS" and "AS AVAILABLE" with no warranties of any kind, express or implied. MedVroom disclaims all warranties to the fullest extent permitted by law.</p>

<h2>17. Limitation of Liability</h2>
<p>To the fullest extent permitted by law, MedVroom shall not be liable for medical malpractice, provider actions, patient disputes, loss of revenue, data, or business, or indirect or consequential damages. Total liability shall not exceed the fees paid by Provider to MedVroom in the 6 months preceding the claim.</p>

<h2>18. No Platform Liability for Medical Services</h2>
<p>Provider agrees that MedVroom has no responsibility for patient care. Provider assumes full liability for all medical services and shall defend and indemnify MedVroom against malpractice claims, patient injury claims, and regulatory violations.</p>

<h2>19. Indemnification</h2>
<p>Provider agrees to defend, indemnify, and hold harmless MedVroom from any claims arising out of medical services provided, violation of laws, breach of this Agreement, or inaccurate information submitted.</p>

<h2>20. Dispute Resolution; Binding Arbitration and Class Action Waiver</h2>
<p><strong>Important: this section affects your legal rights.</strong> It requires most disputes between you and MedVroom to be resolved through binding individual arbitration instead of court proceedings, and includes a waiver of class actions and jury trials.</p>
<p><strong>20.1 Informal Dispute Resolution.</strong> Before initiating arbitration, the complaining party must first send a written Pre-Arbitration Notice to legal@medvroom.com including name, account information, contact details, a detailed description of the claim and relief sought, and signature. For 60 days after receipt of a complete notice, the parties will attempt in good faith to resolve the dispute. This is a required condition precedent to arbitration.</p>
<p><strong>20.2 Agreement to Arbitrate.</strong> If unresolved after 60 days, the dispute shall be resolved exclusively through final and binding individual arbitration administered by the American Arbitration Association (AAA) under its Commercial (or Consumer) Arbitration Rules, governed by the Federal Arbitration Act. Arbitration will be conducted virtually or, at Provider's election, in the county of Provider's primary practice.</p>
<p><strong>20.3 Class Action Waiver.</strong> All disputes must be brought on an individual basis only. Both parties waive any right to bring or participate in a class, collective, consolidated, or representative action, and waive the right to a jury trial to the fullest extent permitted by law.</p>
<p><strong>20.4 Small Claims Court Exception.</strong> Either party may bring an individual claim in small claims court in the county of Provider's primary practice (or MedVroom's principal place of business) if it qualifies and remains strictly individual.</p>
<p><strong>20.5 Mass Filing Procedures.</strong> If 25 or more similar, coordinated claims are filed, the AAA's Mass Arbitration Supplementary Rules (or equivalent) shall apply.</p>
<p><strong>20.6 Costs and Fees.</strong> Governed by applicable AAA Rules; MedVroom will not seek attorneys' fees or costs unless the arbitrator finds the claim frivolous or in bad faith.</p>
<p><strong>20.7 Opt-Out Right.</strong> You may opt out by sending signed written notice to legal@medvroom.com within 30 days of first accepting this Agreement, stating you are opting out and including full name, practice name, and license number.</p>
<p><strong>20.8 Survival.</strong> This Section 20 survives termination or expiration of this Agreement.</p>

<h2>21. Governing Law</h2>
<p>This Agreement is governed by the laws of the State of Washington, without regard to conflict of law principles, and subject to applicable federal law. Disputes not subject to arbitration shall be resolved exclusively in the state or federal courts located in Spokane County, Washington.</p>

<h2>22. Severability</h2>
<p>If any provision is found unenforceable, it shall be modified to the minimum extent necessary, and the remaining provisions shall remain in full force.</p>

<h2>23. Entire Agreement</h2>
<p>This Agreement constitutes the entire agreement between the parties and supersedes all prior agreements.</p>

<h2>24. Electronic Acceptance</h2>
<p>This Agreement is entered into electronically and is enforceable under the Electronic Signatures in Global and National Commerce Act (E-SIGN Act).</p>
HTML;
    }

    private function pricingTerms(): string
    {
        return <<<HTML
<p><strong>Last Updated:</strong> 28 June, 2026</p>

<h2>1. Overview</h2>
<p>This Pricing, Fees &amp; Payment Terms Policy ("Policy") explains how fees are charged, when payments occur, and how billing works on the MedVroom platform. By using MedVroom as a provider, you agree to the Provider Agreement and this Policy, which is incorporated by reference.</p>

<h2>2. Free Trial</h2>
<p>MedVroom offers a 30-day free trial for new providers. During the trial period, no subscription fees are charged, providers may access platform features subject to eligibility, and per-booking fees may still apply depending on platform usage (if applicable, disclosed before booking acceptance).</p>
<p><strong>Trial Expiration.</strong> On Day 29&ndash;30, providers will receive reminders to add a payment method. On Day 31, if no valid payment method is added, provider profile visibility may be limited or paused; the account remains active for login and payment setup.</p>

<h2>3. Subscription Plans</h2>
<p><strong>Basic Plan</strong> &mdash; $49/mo, $65 per new patient booking. Standard profile listing, basic analytics.</p>
<p><strong>Premium Plan</strong> &mdash; $149/mo, $45 per new patient booking. Priority search ranking, advanced analytics.</p>
<p><strong>Promoted Add-On</strong> &mdash; +$99/mo, same per-booking fee as selected plan. Sponsored placement, increased visibility.</p>

<h2>4. Per-Booking Fees</h2>
<p>MedVroom charges a per-booking platform fee for each confirmed patient booking. The exact fee is displayed before a provider accepts a booking. Fees are charged immediately upon acceptance of a booking. A booking is only confirmed after successful payment processing; if payment fails, the booking is not confirmed. All per-booking fees are disclosed in the provider dashboard and booking interface prior to acceptance.</p>

<h2>5. Billing Authorization</h2>
<p>By using the platform, you authorize MedVroom, Inc. and its payment processor (including Stripe and Stripe Connect) to charge your stored payment method for subscription fees, charge per-booking fees upon booking acceptance, and charge applicable promotional or optional service fees selected by you. This authorization remains in effect until your account is terminated or payment authorization is withdrawn in accordance with platform policies.</p>

<h2>6. Payment Timing</h2>
<p><strong>Subscription Fees</strong> &mdash; Charged monthly starting after the free trial period ends; automatically recurring unless canceled.</p>
<p><strong>Per-Booking Fees</strong> &mdash; Charged instantly at the time a booking is accepted; each booking triggers a separate transaction.</p>

<h2>7. Failed Payments</h2>
<p>If a payment fails, the platform may retry the charge, provider access or visibility may be restricted, and pending bookings may not be confirmed until payment is successful. MedVroom reserves the right to suspend or limit accounts with unresolved payment failures.</p>

<h2>8. Refunds</h2>
<p>Unless otherwise required by law or explicitly stated in writing, subscription fees are non-refundable and per-booking fees are non-refundable once a booking is confirmed.</p>

<h2>9. Pricing Changes</h2>
<p>MedVroom may update pricing or fees at any time. Providers will be notified in advance where required by law. Continued use of the platform after changes take effect constitutes acceptance of updated pricing.</p>

<h2>10. Payment Processing (Stripe)</h2>
<p>Payments are processed through third-party payment providers, including Stripe and Stripe Connect. MedVroom does not store full payment card details. By using the platform, you agree to the applicable terms of Stripe and its connected services.</p>

<h2>11. Taxes</h2>
<p>Providers are responsible for any applicable taxes arising from payments, fees, or services under this Policy.</p>

<h2>12. Account Suspension &amp; Access</h2>
<p>MedVroom may restrict profile visibility, suspend booking access, or pause account features if payment obligations are not met or if fraud, misuse, or policy violations are detected.</p>

<h2>13. Disputes</h2>
<p>Any billing disputes must be submitted through the provider support system. Providers agree to attempt resolution in good faith before initiating chargebacks.</p>

<h2>14. Order of Priority</h2>
<p>In the event of conflict between documents, the order of priority is: (1) Provider Agreement, (2) this Pricing, Fees &amp; Payment Terms Policy, (3) Platform dashboard disclosures.</p>

<h2>15. Contact</h2>
<p>MedVroom, Inc.<br>Billing Support: support@medvroom.com</p>
HTML;
    }
}
