<?php

namespace Database\Seeders;

use App\Models\InsuranceProvider;
use Illuminate\Database\Seeder;

class InsuranceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = [
            [
                'name' => 'Aetna',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cf/Aetna_logo.svg/1280px-Aetna_logo.svg.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Cigna',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Cigna_logo.svg/1200px-Cigna_logo.svg.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Blue Cross Blue Shield',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Blue_Cross_Blue_Shield_Association_logo.svg/1200px-Blue_Cross_Blue_Shield_Association_logo.svg.png',
                'is_featured' => true,
            ],
            [
                'name' => 'UnitedHealthcare',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/UnitedHealthcare_logo.svg/1200px-UnitedHealthcare_logo.svg.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Humana',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/25/Humana_logo.svg/1200px-Humana_logo.svg.png',
                'is_featured' => true,
            ],
            [
                'name' => 'Medicare',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Medicare_Official_CMS_Logo.svg/1200px-Medicare_Official_CMS_Logo.svg.png',
                'is_featured' => true,
            ],
        ];

        foreach ($providers as $provider) {
            InsuranceProvider::updateOrCreate(
                ['name' => $provider['name']],
                $provider
            );
        }
    }
}
