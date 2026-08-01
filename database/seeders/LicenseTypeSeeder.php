<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicenseTypeSeeder extends Seeder
{
    public function run(): void
    {
        $licenses = [
            'Medical Doctor (MD)',
            'Doctor of Osteopathic Medicine (DO)',
            'Nurse Practitioner (NP / APRN)',
            'Physician Assistant (PA)',
            'Registered Nurse (RN)',
            'Psychologist (PhD/PsyD)',
            'Licensed Clinical Social Worker (LCSW)',
            'Licensed Professional Counselor (LPC/LPCC/LCPC)',
            'Licensed Mental Health Counselor (LMHC)',
            'Licensed Marriage & Family Therapist (LMFT)',
            'Psychiatric Mental Health Nurse Practitioner (PMHNP)',
            'Certified Nurse Midwife (CNM)',
            'Physical Therapist (PT)',
            'Occupational Therapist (OT)',
            'Speech-Language Pathologist (SLP)',
            'Audiologist (AuD)',
            'Chiropractor (DC)',
            'Podiatrist (DPM)',
            'Optometrist (OD)',
            'Dentist (DDS/DMD)',
            'Registered Dietitian Nutritionist (RDN/RD)',
            'Licensed Clinical Dietitian (where applicable)',
            'Other',
        ];

        foreach ($licenses as $name) {
            DB::table('license_types')->updateOrInsert(
                ['name' => $name],
                ['updated_at' => now(), 'created_at' => now()]
            );
        }
    }
}