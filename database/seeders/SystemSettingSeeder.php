<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemSetting::set(
            'platform_commission',
            ['percentage' => 15],
            'financial',
            'The percentage of the consultation fee that the platform takes as commission.'
        );
    }
}
