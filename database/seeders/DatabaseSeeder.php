<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Admin User
        User::factory()->admin()->create([
            'first_name' => 'MedVroom',
            'last_name' => 'Admin',
            'name' => 'MedVroom Admin',
            'email' => 'admin@medvroom.com',
            'password' => Hash::make('password'),
        ]);

        // Platform Data
        $this->call([
            SpecialtySeeder::class,
            LicenseTypeSeeder::class,
            InsuranceProviderSeeder::class,
            InsurancePlanSeeder::class,
            DoctorSeeder::class,
            HelpDeskSeeder::class,
            BlogSeeder::class,
        ]);
    }
}