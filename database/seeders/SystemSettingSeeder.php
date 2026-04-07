<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SystemSetting::set(
            'platform_commission',
            ['percentage' => 15],
            'financial',
            'The percentage of the consultation fee that the platform takes as commission.'
        );
    }
}
