<?php

namespace Database\Seeders;

use App\Models\InsurancePlan;
use App\Models\InsuranceProvider;
use Illuminate\Database\Seeder;

class InsurancePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = InsuranceProvider::all();

        foreach ($providers as $provider) {
            $plans = [
                ['name' => 'Choice POS II', 'plan_type' => 'POS'],
                ['name' => 'Select PPO', 'plan_type' => 'PPO'],
                ['name' => 'Open Access HMO', 'plan_type' => 'HMO'],
            ];

            foreach ($plans as $plan) {
                InsurancePlan::updateOrCreate(
                    [
                        'provider_id' => $provider->id,
                        'name' => $plan['name'],
                    ],
                    $plan
                );
            }
        }
    }
}
