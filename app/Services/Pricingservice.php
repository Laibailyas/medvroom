<?php

namespace App\Services;

use App\Models\DoctorProfile;
use RuntimeException;

class PricingService
{
    /**
     * The per-booking platform fee currently owed by this provider, based on
     * their active plan. This is the ONLY place this should be calculated —
     * never trust a fee amount passed in from the frontend.
     */
    public function getPerBookingFee(DoctorProfile $doctor): float
    {
        $plan = $doctor->plan;

        if (! $plan) {
            throw new RuntimeException(
                "Provider #{$doctor->id} has no active plan assigned — cannot determine booking fee."
            );
        }

        return (float) $plan->per_booking_fee;
    }

    /**
     * The provider's current plan, for display purposes (name, monthly fee, etc.)
     */
    public function getCurrentPlan(DoctorProfile $doctor)
    {
        return $doctor->plan;
    }
}