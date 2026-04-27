<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DoctorProfile;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class BookingController extends Controller
{
    public function review(Request $request)
    {
        $doctorId = $request->query('doctor_id');
        $date = $request->query('date');
        $time = $request->query('time');
        $specialtyId = $request->query('specialty_id');

        $doctor = DoctorProfile::with('user', 'specialties')->findOrFail($doctorId);

        $amount = $doctor->consultation_fee;
        $split = Payment::calculateSplit($amount);

        return view('booking.review', [
            'doctor' => $doctor,
            'date' => $date,
            'time' => $time,
            'specialty_id' => $specialtyId,
            'amount' => $amount,
            'platform_fee' => $split['platform_fee'],
            'provider_payout' => $split['provider_payout'],
        ]);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctor_profiles,id',
            'date' => 'required|date',
            'time' => 'required',
            'specialty_id' => 'required',
        ]);

        $doctor = DoctorProfile::findOrFail($request->doctor_id);

        /** @var User $user */
        $user = auth()->user();

        // Create a Cashier Checkout Session for a one-off charge
        return $user->checkoutCharge($doctor->consultation_fee * 100, 'Consultation with Dr. '.$doctor->user->name, 1, [
            'success_url' => route('booking.success').'?session_id={CHECKOUT_SESSION_ID}&doctor_id='.$doctor->id.'&date='.$request->date.'&time='.$request->time.'&specialty_id='.$request->specialty_id,
            'cancel_url' => route('booking.review').'?doctor_id='.$doctor->id.'&date='.$request->date.'&time='.$request->time.'&specialty_id='.$request->specialty_id,
            'metadata' => [
                'doctor_id' => $doctor->id,
                'date' => $request->date,
                'time' => $request->time,
                'specialty_id' => $request->specialty_id,
                'patient_id' => $user->patientProfile->id,
            ],
        ]);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');

        if (! $sessionId) {
            return redirect()->route('patient.dashboard');
        }

        /** @var User $user */
        $user = auth()->user();
        $checkoutSession = $user->stripe()->checkout->sessions->retrieve($sessionId);

        if ($checkoutSession->payment_status !== 'paid') {
            return redirect()->route('search')->with('error', 'Payment failed or was cancelled.');
        }

        // Recuperate data from metadata if parameters are missing or corrupted
        $doctorId = $request->doctor_id ?? $checkoutSession->metadata->doctor_id;
        $date = $request->date ?? $checkoutSession->metadata->date;
        $time = $request->time ?? $checkoutSession->metadata->time;
        $specialtyId = $request->specialty_id ?? $checkoutSession->metadata->specialty_id;

        // Final safety check for "[object Object]" or empty time
        if (! $time || str_contains($time, '[object Object]')) {
            // Check metadata explicitly
            $time = $checkoutSession->metadata->time;
            if (! $time || str_contains($time, '[object Object]')) {
                return redirect()->route('search')->with('error', 'Invalid appointment time selected. Please try again.');
            }
        }

        $doctor = DoctorProfile::findOrFail($doctorId);
        $totalAmount = $doctor->consultation_fee;
        $split = Payment::calculateSplit($totalAmount);

        // Create Appointment
        $appointment = Appointment::create([
            'doctor_profile_id' => $doctor->id,
            'patient_profile_id' => $user->patientProfile->id,
            'appointment_datetime' => "$date $time",
            'notes' => $request->notes ?? 'Booked via Stripe Checkout',
        ]);

        $appointment->transitionStatus('pending', 'Booked and paid via Stripe Checkout, pending doctor approval');

        Payment::create([
            'appointment_id' => $appointment->id,
            'amount' => $totalAmount,
            'platform_fee' => $split['platform_fee'],
            'provider_payout' => $split['provider_payout'],
            'status' => 'paid',
            'transaction_id' => $checkoutSession->payment_intent,
            'payment_intent_id' => $checkoutSession->payment_intent,
            'payout_status' => 'pending',
            'payment_method' => 'card',
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Appointment booked successfully!');
    }
}
