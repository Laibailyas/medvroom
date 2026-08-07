<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show the booking review screen. NOTE: as of Phase 2, no payment is
     * collected here. The patient only reviews details and submits a
     * booking REQUEST. Payment (the provider's platform booking fee) is
     * handled separately when the provider accepts (see Phase 3).
     */
    public function review(Request $request)
    {
        $doctorId = $request->query('doctor_id');
        $date = $request->query('date');
        $time = $request->query('time');
        $specialtyId = $request->query('specialty_id');
        $visitType = $request->query('visit_type', 'in_person');
        $patientType = $request->query('patient_type', 'new');

        $doctor = DoctorProfile::with('user', 'specialties')->findOrFail($doctorId);

        if (is_null($doctor->consultation_fee)) {
            return redirect()->route('search')
                ->with('error', 'This provider has not finished setting up their consultation fee yet. Please choose another provider or check back soon.');
        }

        // Telehealth consent is required whenever the visit is virtual.
        $requiresTelehealthConsent = $visitType === 'virtual';

        return view('booking.review', [
            'doctor' => $doctor,
            'date' => $date,
            'time' => $time,
            'specialty_id' => $specialtyId,
            'visit_type' => $visitType,
            'patient_type' => $patientType,
            'amount' => $doctor->consultation_fee,
            'requires_telehealth_consent' => $requiresTelehealthConsent,
        ]);
    }

    /**
     * Submit a booking REQUEST. No payment occurs here. This creates the
     * appointment in a 'pending' state and records exactly what the patient
     * acknowledged and when, per the required consent/disclosure flow.
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctor_profiles,id',
            'date' => 'required|date',
            'time' => 'required',
            'specialty_id' => 'nullable|exists:specialties,id',
            'visit_type' => 'required|in:in_person,virtual,home_visit',
            'patient_type' => 'required|in:new,existing',
            'notes' => 'nullable|string|max:2000',

            // Required booking acknowledgments (8 checkboxes from the client spec)
            'ack_information_accurate' => 'accepted',
            'ack_not_guaranteed' => 'accepted',
            'ack_provider_responsible' => 'accepted',
            'ack_platform_role' => 'accepted',
            'ack_provider_terms_may_change' => 'accepted',
            'ack_authorize_transmission' => 'accepted',
            'ack_no_sensitive_info' => 'accepted',
            'ack_not_emergency' => 'accepted',

            // Required document acknowledgments (5 checkboxes)
            'ack_patient_terms' => 'accepted',
            'ack_privacy_policy' => 'accepted',
            'ack_privacy_practices' => 'accepted',
            // Telehealth consent is conditionally required — validated manually below
            // since Laravel's 'required_if' + 'accepted' combo needs care with checkboxes.
            'ack_cancellation_policy' => 'accepted',

            // Optional, separate from required acknowledgments
            'ack_sms_optin' => 'nullable|boolean',
        ]);

        $doctor = DoctorProfile::findOrFail($validated['doctor_id']);

        if (is_null($doctor->consultation_fee)) {
            return redirect()->route('search')
                ->with('error', 'This provider is no longer available for booking. Please choose another provider.');
        }

        $requiresTelehealthConsent = $validated['visit_type'] === 'virtual';

        if ($requiresTelehealthConsent && ! $request->boolean('ack_telehealth_consent')) {
            return back()->withInput()->with('error', 'You must accept the Telehealth Informed Consent to book a virtual appointment.');
        }

        /** @var User $user */
        $user = auth()->user();

        $appointment = Appointment::create([
            'doctor_profile_id' => $doctor->id,
            'patient_profile_id' => $user->patientProfile->id,
            'specialty_id' => $validated['specialty_id'] ?? null,
            'appointment_datetime' => $validated['date'].' '.$validated['time'],
            'visit_type' => $validated['visit_type'],
            'patient_type' => $validated['patient_type'],
            'notes' => $validated['notes'] ?? null,
            'patient_consent_accepted_at' => now(),
            'patient_consent_ip_address' => $request->ip(),
            'patient_consent_user_agent' => $request->userAgent(),
            'telehealth_consent_accepted' => $requiresTelehealthConsent,
        ]);

        $appointment->transitionStatus('pending', 'Booking request submitted by patient. Awaiting provider acceptance.');

        return redirect()->route('booking.success')->with('appointment_id', $appointment->id);
    }

    /**
     * Confirmation screen shown after a booking request is submitted.
     * No payment has occurred at this point — the appointment is pending
     * provider review.
     */
    public function success(Request $request)
    {
        $appointmentId = session('appointment_id');

        $appointment = $appointmentId
            ? Appointment::with('doctorProfile.user')->find($appointmentId)
            : null;

        return view('booking.confirmation', [
            'appointment' => $appointment,
        ]);
    }
}