<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->admin()->create([
            'name' => 'MedVroom Admin',
            'email' => 'admin@medvroom.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);

        // Platform Data
        $this->call([
            SpecialtySeeder::class,
            InsuranceProviderSeeder::class,
            InsurancePlanSeeder::class,
            DoctorSeeder::class,
        ]);
    }
}
