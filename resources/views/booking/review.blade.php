<x-app-layout>
    <div class="bg-slate-50 min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-10">
                <a href="{{ url()->previous() }}"
                    class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-100 text-slate-400 hover:text-slate-900 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter leading-none">Review Your Appointment</h1>
            </div>

            <p class="text-sm font-bold text-slate-500 mb-8 -mt-6">
                Please review your appointment details and the terms below before submitting your booking request.
            </p>

            @if ($errors->any() || session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm font-bold p-5 rounded-2xl mb-8">
                    {{ session('error') ?? $errors->first() }}
                </div>
            @endif

            <!-- Provider Summary Card -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 mb-8 flex items-start gap-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-50/50 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center overflow-hidden border border-slate-100 shadow-sm relative z-10 shrink-0">
                    <img src="{{ $doctor->user->getProfilePhotoUrl() }}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 relative z-10">
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Dr. {{ $doctor->user->name }}</h3>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">
                        {{ $doctor->specialties->first()?->name ?? 'Specialist' }}</p>
                    <div class="flex flex-wrap items-center gap-6 mt-5 text-[11px] font-black uppercase tracking-widest text-slate-500">
                        <div class="flex items-center gap-2.5">
                            {{ \Carbon\Carbon::parse($date)->format('D, M j') }} at {{ $time }}
                        </div>
                        <div class="flex items-center gap-2.5">
                            {{ match($visit_type) { 'virtual' => 'Virtual Visit', 'home_visit' => 'Home Visit', default => 'In-Person Visit' } }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing and Insurance Notice -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 mb-8">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Pricing and Insurance Notice</h4>
                <p class="text-2xl font-black text-slate-900 tracking-tighter mb-3">
                    Estimated Patient Responsibility: ${{ number_format($amount, 2) }}
                </p>
                <p class="text-xs font-bold text-slate-500 leading-relaxed">
                    Provider pricing, insurance coverage, deductibles, copayments, coinsurance, reimbursement, and final
                    patient responsibility are determined by the healthcare provider and/or applicable insurance carrier.
                    MedVroom does not determine or guarantee insurance coverage, reimbursement, pricing, or final payment amounts.
                </p>
            </div>

            <form action="{{ route('booking.submit') }}" method="POST" class="space-y-8" id="booking-form">
                @csrf
                <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="time" value="{{ $time }}">
                <input type="hidden" name="specialty_id" value="{{ $specialty_id }}">
                <input type="hidden" name="visit_type" value="{{ $visit_type }}">
                <input type="hidden" name="patient_type" value="{{ $patient_type }}">
                <input type="hidden" name="ack_telehealth_consent" id="ack_telehealth_consent_hidden" value="{{ $requires_telehealth_consent ? '0' : '1' }}">

                <!-- Required Booking Acknowledgments -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 border-b border-slate-50 pb-4">
                        Before You Submit Your Booking Request</h4>

                    <div class="space-y-4">
                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_information_accurate" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I certify that the information I have provided is accurate and complete to the best of my knowledge.</span>
                        </label>

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_not_guaranteed" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I understand that submitting a booking request does not guarantee an appointment. My appointment is not confirmed until the provider accepts or otherwise confirms the request through MedVroom.</span>
                        </label>

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_provider_responsible" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I understand that the healthcare provider—not MedVroom—is responsible for medical care, treatment, diagnosis, prescriptions, medical advice, billing, insurance claims, and clinical decisions.</span>
                        </label>

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_platform_role" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I understand that MedVroom is an independent technology platform that facilitates provider discovery, appointment scheduling, and related platform services. MedVroom is not a healthcare provider, medical practice, insurer, employer, or agent of the selected healthcare provider.</span>
                        </label>

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_provider_terms_may_change" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I understand that provider availability, pricing, accepted insurance plans, appointment times, and appointment requirements are determined by the provider and may change.</span>
                        </label>

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_authorize_transmission" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I authorize MedVroom to transmit my booking request and the information reasonably necessary to process and fulfill that request to the selected provider and applicable service providers acting on MedVroom's behalf.</span>
                        </label>

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_no_sensitive_info" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I understand that I should not include sensitive medical information in ordinary communications unless I am using a MedVroom feature specifically designated for secure health information communication.</span>
                        </label>

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_not_emergency" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I acknowledge that MedVroom is not an emergency service. I will not use MedVroom for emergency or urgent medical care.</span>
                        </label>
                    </div>
                </div>

                <!-- Document Acknowledgments -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 border-b border-slate-50 pb-4">
                        Document Acknowledgments</h4>

                    <div class="space-y-4">
                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_patient_terms" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I acknowledge that I have reviewed or been provided access to the <a href="{{ route('terms') }}" target="_blank" class="text-primary hover:underline">Patient Terms of Service</a>.</span>
                        </label>

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_privacy_policy" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I acknowledge that I have reviewed the <a href="{{ route('privacy') }}" target="_blank" class="text-primary hover:underline">Privacy Policy</a>.</span>
                        </label>

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_privacy_practices" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I acknowledge that I have been provided access to the applicable <a href="{{ route('consumer-health-privacy') }}" target="_blank" class="text-primary hover:underline">Notice of Privacy Practices</a>, where applicable.</span>
                        </label>

                        @if ($requires_telehealth_consent)
                            <label class="flex items-start gap-4 bg-primary/10 p-5 rounded-2xl border border-primary/30 cursor-pointer" id="telehealth-consent-row">
                                <input type="checkbox" id="ack_telehealth_consent" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                                <span class="text-[11px] font-bold text-slate-700 leading-relaxed">I acknowledge and agree to the applicable <a href="{{ route('telehealth-consent') }}" target="_blank" class="text-primary hover:underline">Telehealth Consent</a> for a virtual appointment.</span>
                            </label>
                        @endif

                        <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                            <input type="checkbox" name="ack_cancellation_policy" required class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                            <span class="text-[11px] font-bold text-slate-600 leading-relaxed">I acknowledge and agree to the selected provider's applicable <a href="{{ route('cancellation') }}" target="_blank" class="text-primary hover:underline">cancellation and no-show policy</a>, if one is provided.</span>
                        </label>
                    </div>
                </div>

                <!-- Optional communications consent -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                    <label class="flex items-start gap-4 bg-slate-50/80 p-5 rounded-2xl border border-slate-100 cursor-pointer">
                        <input type="checkbox" name="ack_sms_optin" value="1" class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                        <span class="text-[11px] font-bold text-slate-600 leading-relaxed">
                            I agree to receive appointment-related text messages from MedVroom and/or the selected provider
                            at the mobile number I provided, including appointment confirmations, reminders, scheduling
                            updates, cancellations, and other service-related messages. Message frequency varies. Message
                            and data rates may apply. Consent is not a condition of receiving healthcare services.
                            Reply STOP to opt out and HELP for help.
                        </span>
                    </label>
                    <p class="text-[10px] font-bold text-slate-400 mt-4 px-2">
                        Email and in-app appointment communications may be sent as necessary to process and administer your requested appointment.
                    </p>
                </div>

                <!-- Emergency Notice -->
                <div class="bg-red-50 border border-red-200 rounded-[2rem] p-6">
                    <p class="text-xs font-bold text-red-700 leading-relaxed">
                        MedVroom is not an emergency service. If you are experiencing a medical emergency, call 911 or your
                        local emergency services immediately, or go to the nearest emergency department. Do not use
                        MedVroom to seek emergency or urgent medical care.
                    </p>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 text-white py-6 rounded-[1.5rem] font-black uppercase tracking-[0.25em] shadow-2xl shadow-slate-900/20 hover:scale-[1.02] active:scale-95 transition-all">
                    Submit Booking Request
                </button>
            </form>
        </div>
    </div>

    @if ($requires_telehealth_consent)
        <!-- Telehealth Informed Consent Popup -->
        <div id="telehealth-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl">
                <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-4">Telehealth Informed Consent</h3>
                <p class="text-sm font-bold text-slate-600 leading-relaxed mb-6">
                    You are booking a virtual appointment. Before continuing, please review and accept the Telehealth
                    Informed Consent, which explains how virtual care works, its limitations, and your rights as a patient.
                </p>
                <a href="{{ route('telehealth-consent') }}" target="_blank" class="text-primary hover:underline text-xs font-black uppercase tracking-widest">
                    Read the full Telehealth Consent →
                </a>
                <label class="flex items-start gap-3 bg-slate-50 p-5 rounded-2xl border border-slate-100 mt-6 cursor-pointer">
                    <input type="checkbox" id="telehealth-modal-checkbox" class="mt-0.5 w-5 h-5 rounded-md border-slate-200 text-primary focus:ring-primary">
                    <span class="text-xs font-bold text-slate-600">I have read and agree to the Telehealth Informed Consent.</span>
                </label>
                <button id="telehealth-modal-continue" disabled
                    class="w-full mt-6 bg-slate-200 text-slate-400 py-4 rounded-2xl font-black uppercase tracking-widest text-xs transition-all">
                    Continue to Booking Review
                </button>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('telehealth-modal');
                const modalCheckbox = document.getElementById('telehealth-modal-checkbox');
                const continueBtn = document.getElementById('telehealth-modal-continue');
                const inlineCheckbox = document.getElementById('ack_telehealth_consent');
                const hiddenField = document.getElementById('ack_telehealth_consent_hidden');

                modalCheckbox.addEventListener('change', function () {
                    if (this.checked) {
                        continueBtn.disabled = false;
                        continueBtn.classList.remove('bg-slate-200', 'text-slate-400');
                        continueBtn.classList.add('bg-primary', 'text-slate-900', 'hover:scale-[1.02]');
                    } else {
                        continueBtn.disabled = true;
                        continueBtn.classList.add('bg-slate-200', 'text-slate-400');
                        continueBtn.classList.remove('bg-primary', 'text-slate-900', 'hover:scale-[1.02]');
                    }
                });

                continueBtn.addEventListener('click', function () {
                    if (inlineCheckbox) {
                        inlineCheckbox.checked = true;
                    }
                    hiddenField.value = '1';
                    modal.remove();
                });
            });
        </script>
    @endif
</x-app-layout>