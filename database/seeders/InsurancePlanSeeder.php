<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsurancePlanSeeder extends Seeder
{
    /**
     * Populates `insurance_providers` (with category) and creates one
     * default `insurance_plans` row per provider so doctors have something
     * to select. Safe to re-run.
     */
    public function run(): void
    {
        $providers = [
            // Commercial / Private Insurance
            ['name' => 'Aetna', 'category' => 'Commercial'],
            ['name' => 'Anthem Blue Cross Blue Shield (BCBS)', 'category' => 'Commercial'],
            ['name' => 'Blue Cross Blue Shield (BCBS)', 'category' => 'Commercial'],
            ['name' => 'Cigna Healthcare', 'category' => 'Commercial'],
            ['name' => 'Humana', 'category' => 'Commercial'],
            ['name' => 'UnitedHealthcare (UHC)', 'category' => 'Commercial'],
            ['name' => 'Optum', 'category' => 'Commercial'],
            ['name' => 'Oscar Health', 'category' => 'Commercial'],
            ['name' => 'Molina Healthcare', 'category' => 'Commercial'],
            ['name' => 'Centene', 'category' => 'Commercial'],
            ['name' => 'Ambetter', 'category' => 'Commercial'],
            ['name' => 'Elevance Health', 'category' => 'Commercial'],
            ['name' => 'Kaiser Permanente', 'category' => 'Commercial'],
            ['name' => 'Highmark Blue Cross Blue Shield', 'category' => 'Commercial'],
            ['name' => 'Independence Blue Cross', 'category' => 'Commercial'],
            ['name' => 'CareFirst BlueCross BlueShield', 'category' => 'Commercial'],
            ['name' => 'Horizon Blue Cross Blue Shield of New Jersey', 'category' => 'Commercial'],
            ['name' => 'Florida Blue', 'category' => 'Commercial'],
            ['name' => 'Premera Blue Cross', 'category' => 'Commercial'],
            ['name' => 'Regence BlueCross BlueShield', 'category' => 'Commercial'],
            ['name' => 'Wellmark Blue Cross Blue Shield', 'category' => 'Commercial'],
            ['name' => 'Excellus BlueCross BlueShield', 'category' => 'Commercial'],
            ['name' => 'EmblemHealth', 'category' => 'Commercial'],
            ['name' => 'Health Net', 'category' => 'Commercial'],
            ['name' => 'Tufts Health Plan', 'category' => 'Commercial'],
            ['name' => 'Harvard Pilgrim Health Care', 'category' => 'Commercial'],
            ['name' => 'Mass General Brigham Health Plan', 'category' => 'Commercial'],
            ['name' => 'UPMC Health Plan', 'category' => 'Commercial'],
            ['name' => 'Geisinger Health Plan', 'category' => 'Commercial'],
            ['name' => 'Bright Health', 'category' => 'Commercial'],
            ['name' => 'Friday Health Plans', 'category' => 'Commercial'],

            // Government Insurance
            ['name' => 'Medicare', 'category' => 'Government'],
            ['name' => 'Medicare Advantage', 'category' => 'Government'],
            ['name' => 'Medicaid', 'category' => 'Government'],
            ['name' => 'Medicaid Managed Care', 'category' => 'Government'],
            ['name' => 'TRICARE', 'category' => 'Government'],
            ['name' => 'Veterans Affairs (VA) Community Care', 'category' => 'Government'],
            ['name' => 'Indian Health Service (IHS)', 'category' => 'Government'],

            // Medicaid Managed Care Plans
            ['name' => 'Aetna Medicaid', 'category' => 'Medicaid'],
            ['name' => 'Anthem Medicaid', 'category' => 'Medicaid'],
            ['name' => 'UnitedHealthcare Community Plan', 'category' => 'Medicaid'],
            ['name' => 'Molina Medicaid', 'category' => 'Medicaid'],
            ['name' => 'Centene Medicaid Plans', 'category' => 'Medicaid'],
            ['name' => 'WellCare', 'category' => 'Medicaid'],
            ['name' => 'Amerigroup', 'category' => 'Medicaid'],
            ['name' => 'Community Health Choice', 'category' => 'Medicaid'],
            ['name' => 'Healthfirst', 'category' => 'Medicaid'],
            ['name' => 'AmeriHealth Caritas', 'category' => 'Medicaid'],
            ['name' => 'CareSource', 'category' => 'Medicaid'],
            ['name' => 'Buckeye Health Plan', 'category' => 'Medicaid'],
            ['name' => 'Sunshine Health', 'category' => 'Medicaid'],
            ['name' => 'Peach State Health Plan', 'category' => 'Medicaid'],

            // Employer / Network Plans
            ['name' => 'Employer-Sponsored Insurance', 'category' => 'Employer / Network'],
            ['name' => 'Self-Funded Employer Plans', 'category' => 'Employer / Network'],
            ['name' => 'PPO Plans', 'category' => 'Employer / Network'],
            ['name' => 'HMO Plans', 'category' => 'Employer / Network'],
            ['name' => 'EPO Plans', 'category' => 'Employer / Network'],
            ['name' => 'POS Plans', 'category' => 'Employer / Network'],

            // Cash / Self-Pay
            ['name' => 'Self-Pay / Cash Patients Accepted', 'category' => 'Self-Pay'],
            ['name' => 'Sliding Scale Available', 'category' => 'Self-Pay'],

            // Other
            ['name' => 'Other Insurance Plan', 'category' => 'Other'],
            ['name' => 'Not Currently Accepting Insurance', 'category' => 'Other'],
        ];

        foreach ($providers as $p) {
            $providerId = DB::table('insurance_providers')->where('name', $p['name'])->value('id');

            if ($providerId) {
                DB::table('insurance_providers')->where('id', $providerId)->update([
                    'category'   => $p['category'],
                    'updated_at' => now(),
                ]);
            } else {
                $providerId = DB::table('insurance_providers')->insertGetId([
                    'name'        => $p['name'],
                    'category'    => $p['category'],
                    'is_featured' => false,
                    'is_custom'   => false,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }

            // One default plan per provider so doctors have something to select.
            DB::table('insurance_plans')->updateOrInsert(
                ['provider_id' => $providerId, 'name' => $p['name']],
                [
                    'plan_type'  => 'OTHER',
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}