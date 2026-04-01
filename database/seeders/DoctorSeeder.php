<?php

namespace Database\Seeders;

use App\Models\DoctorProfile;
use App\Models\InsurancePlan;
use App\Models\Review;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = Specialty::all();
        $plans = InsurancePlan::all();

        $doctors = [
            ['name' => 'Dr. Sarah Smith', 'gender' => 'female', 'specialty' => 'Primary Care'],
            ['name' => 'Dr. Michael Chen', 'gender' => 'male', 'specialty' => 'Dentist'],
            ['name' => 'Dr. Elena Rodriguez', 'gender' => 'female', 'specialty' => 'Dermatologist'],
            ['name' => 'Dr. James Wilson', 'gender' => 'male', 'specialty' => 'Psychiatrist'],
            ['name' => 'Dr. Priya Sharma', 'gender' => 'female', 'specialty' => 'Eye Doctor'],
            ['name' => 'Dr. David Miller', 'gender' => 'male', 'specialty' => 'OB-GYN'],
            ['name' => 'Dr. Lisa Thompson', 'gender' => 'female', 'specialty' => 'Primary Care'],
            ['name' => 'Dr. Robert Garcia', 'gender' => 'male', 'specialty' => 'Dentist'],
            ['name' => 'Dr. Anna White', 'gender' => 'female', 'specialty' => 'Dermatologist'],
            ['name' => 'Dr. Steven Brown', 'gender' => 'male', 'specialty' => 'Psychiatrist'],
        ];

        foreach ($doctors as $docData) {
            $user = User::factory()->doctor()->create([
                'name' => $docData['name'],
                'email' => strtolower(str_replace([' ', '.'], ['', ''], $docData['name'])).'@medvroom.com',
            ]);

            $profile = DoctorProfile::create([
                'user_id' => $user->id,
                'bio' => 'Experienced specialist dedicated to providing top-quality care in '.$docData['specialty'].'.',
                'experience_years' => rand(5, 25),
                'consultation_fee' => rand(100, 300),
                'clinic_name' => 'MedVroom '.$docData['specialty'].' Center',
                'clinic_address' => rand(100, 999).' Healthcare Ave, Suite '.rand(10, 99),
                'gender' => $docData['gender'],
                'is_verified' => true,
                'practice_zip_code' => '10001',
            ]);

            // Link to specialty
            $specialty = $specialties->where('name', $docData['specialty'])->first();
            if ($specialty) {
                $profile->specialties()->attach($specialty->id);
            }

            // Link to random insurance plans
            $profile->insurancePlans()->attach(
                $plans->random(rand(2, 5))->pluck('id')->toArray()
            );

            // Add some reviews
            for ($i = 0; $i < rand(3, 8); $i++) {
                Review::create([
                    'doctor_profile_id' => $profile->id,
                    'rating' => rand(4, 5),
                    'comment' => 'Excellent doctor! Very professional and caring.',
                ]);
            }
        }
    }
}
