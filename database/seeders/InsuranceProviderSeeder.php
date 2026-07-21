<?php

namespace Database\Seeders;

use App\Models\InsuranceProvider;
use App\Models\InsurancePlan;
use Illuminate\Database\Seeder;

class InsuranceProviderSeeder extends Seeder
{
    /**
     * name => category. One card per company. If a company already exists
     * (matched case-insensitively by name) it is left untouched — only
     * missing ones are created, so this is safe to re-run.
     */
    private const MASTER_LIST = [
        // Commercial / Private Insurance
        'Aetna' => 'Commercial',
        'Anthem Blue Cross Blue Shield (BCBS)' => 'Commercial',
        'Blue Cross Blue Shield (BCBS)' => 'Commercial',
        'Cigna Healthcare' => 'Commercial',
        'Humana' => 'Commercial',
        'UnitedHealthcare (UHC)' => 'Commercial',
        'Optum' => 'Commercial',
        'Oscar Health' => 'Commercial',
        'Molina Healthcare' => 'Commercial',
        'Centene' => 'Commercial',
        'Ambetter' => 'Commercial',
        'Elevance Health' => 'Commercial',
        'Kaiser Permanente' => 'Commercial',
        'Highmark Blue Cross Blue Shield' => 'Commercial',
        'Independence Blue Cross' => 'Commercial',
        'CareFirst BlueCross BlueShield' => 'Commercial',
        'Horizon Blue Cross Blue Shield of New Jersey' => 'Commercial',
        'Florida Blue' => 'Commercial',
        'Premera Blue Cross' => 'Commercial',
        'Regence BlueCross BlueShield' => 'Commercial',
        'Wellmark Blue Cross Blue Shield' => 'Commercial',
        'Excellus BlueCross BlueShield' => 'Commercial',
        'EmblemHealth' => 'Commercial',
        'Health Net' => 'Commercial',
        'Tufts Health Plan' => 'Commercial',
        'Harvard Pilgrim Health Care' => 'Commercial',
        'Mass General Brigham Health Plan' => 'Commercial',
        'UPMC Health Plan' => 'Commercial',
        'Geisinger Health Plan' => 'Commercial',
        'Bright Health' => 'Commercial',
        'Friday Health Plans' => 'Commercial',

        // Government Insurance
        'Medicare' => 'Government',
        'Medicare Advantage' => 'Government',
        'Medicaid' => 'Government',
        'Medicaid Managed Care' => 'Government',
        'TRICARE' => 'Government',
        'Veterans Affairs (VA) Community Care' => 'Government',
        'Indian Health Service (IHS)' => 'Government',

        // Medicaid Managed Care Plans
        'Aetna Medicaid' => 'Medicaid Managed Care',
        'Anthem Medicaid' => 'Medicaid Managed Care',
        'UnitedHealthcare Community Plan' => 'Medicaid Managed Care',
        'Molina Medicaid' => 'Medicaid Managed Care',
        'Centene Medicaid Plans' => 'Medicaid Managed Care',
        'WellCare' => 'Medicaid Managed Care',
        'Amerigroup' => 'Medicaid Managed Care',
        'Community Health Choice' => 'Medicaid Managed Care',
        'Healthfirst' => 'Medicaid Managed Care',
        'AmeriHealth Caritas' => 'Medicaid Managed Care',
        'CareSource' => 'Medicaid Managed Care',
        'Buckeye Health Plan' => 'Medicaid Managed Care',
        'Sunshine Health' => 'Medicaid Managed Care',
        'Peach State Health Plan' => 'Medicaid Managed Care',

        // Employer / Network Plans
        'Employer-Sponsored Insurance' => 'Employer / Network',
        'Self-Funded Employer Plans' => 'Employer / Network',
        'PPO Plans' => 'Employer / Network',
        'HMO Plans' => 'Employer / Network',
        'EPO Plans' => 'Employer / Network',
        'POS Plans' => 'Employer / Network',

        // Cash / Self-Pay
        'Self-Pay / Cash Patients Accepted' => 'Self Pay',
        'Sliding Scale Available' => 'Self Pay',
    ];

    public function run(): void
    {
        foreach (self::MASTER_LIST as $name => $category) {
            $provider = InsuranceProvider::firstOrCreate(
                ['name' => $name],
                ['category' => $category, 'is_custom' => false]
            );

            // One plan per provider = the card itself (keeps the existing
            // doctor <-> insurancePlans pivot working unchanged).
            InsurancePlan::firstOrCreate(
                ['provider_id' => $provider->id, 'name' => $name]
            );
        }
    }
}
