<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::updateOrCreate(
            ['name' => 'Basic'],
            ['monthly_fee' => 49.00, 'per_booking_fee' => 65.00, 'is_promoted_addon' => false]
        );

        Plan::updateOrCreate(
            ['name' => 'Premium'],
            ['monthly_fee' => 149.00, 'per_booking_fee' => 45.00, 'is_promoted_addon' => false]
        );

        // Promoted is an ADD-ON, not a standalone plan — it stacks on top of Basic or Premium
        // and does not change the per-booking fee (same as the underlying plan).
        // We store it here as a reference row for its monthly add-on cost; actual "is this
        // provider promoted" logic uses doctor_profiles.is_promoted, not this row directly.
        Plan::updateOrCreate(
            ['name' => 'Promoted Add-on'],
            ['monthly_fee' => 99.00, 'per_booking_fee' => 0.00, 'is_promoted_addon' => true]
        );
    }
}