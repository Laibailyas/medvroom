<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Primary Care',
                'slug' => 'primary-care',
                'icon' => 'stethoscope', // or SVG path
            ],
            [
                'name' => 'Dentist',
                'slug' => 'dentist',
                'icon' => 'tooth',
            ],
            [
                'name' => 'OB-GYN',
                'slug' => 'ob-gyn',
                'icon' => 'female',
            ],
            [
                'name' => 'Dermatologist',
                'slug' => 'dermatologist',
                'icon' => 'sparkles',
            ],
            [
                'name' => 'Psychiatrist',
                'slug' => 'psychiatrist',
                'icon' => 'brain',
            ],
            [
                'name' => 'Eye Doctor',
                'slug' => 'eye-doctor',
                'icon' => 'eye',
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::updateOrCreate(
                ['slug' => $specialty['slug']],
                $specialty
            );
        }
    }
}
