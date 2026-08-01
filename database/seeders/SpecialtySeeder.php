<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SpecialtySeeder extends Seeder
{
    /**
     * Populates the `specialties` table.
     * Uses `name` (not id) as the unique match key — safe to run even if
     * some specialties already exist, and safe to re-run on redeploy.
     *
     * NOTE: assumes a `specialties` table already exists with columns:
     * id, name, category, created_at, updated_at.
     * If it doesn't exist yet, run the companion migration first
     * (create_specialties_table.php).
     */
    public function run(): void
    {
        $specialties = [
            // Primary Care
            ['name' => 'Family Medicine', 'category' => 'Primary Care'],
            ['name' => 'Internal Medicine', 'category' => 'Primary Care'],
            ['name' => 'General Practice', 'category' => 'Primary Care'],
            ['name' => 'Primary Care', 'category' => 'Primary Care'],
            ['name' => 'Preventive Medicine', 'category' => 'Primary Care'],
            ['name' => 'Geriatric Medicine', 'category' => 'Primary Care'],
            ['name' => 'Adolescent Medicine', 'category' => 'Primary Care'],

            // Pediatrics
            ['name' => 'Pediatrics', 'category' => 'Pediatrics'],
            ['name' => 'Pediatric Primary Care', 'category' => 'Pediatrics'],
            ['name' => 'Pediatric Developmental Medicine', 'category' => 'Pediatrics'],
            ['name' => 'Pediatric Behavioral Health', 'category' => 'Pediatrics'],

            // Women's Health
            ['name' => 'Obstetrics & Gynecology (OB/GYN)', 'category' => "Women's Health"],
            ['name' => "Women's Health", 'category' => "Women's Health"],
            ['name' => 'Prenatal Care', 'category' => "Women's Health"],
            ['name' => 'Postpartum Care', 'category' => "Women's Health"],
            ['name' => 'Menopause Management', 'category' => "Women's Health"],
            ['name' => 'Reproductive Health', 'category' => "Women's Health"],
            ['name' => 'Fertility Counseling', 'category' => "Women's Health"],

            // Men's Health
            ['name' => "Men's Health", 'category' => "Men's Health"],
            ['name' => 'Sexual Health', 'category' => "Men's Health"],
            ['name' => 'Testosterone/Hormone Management', 'category' => "Men's Health"],

            // Mental & Behavioral Health
            ['name' => 'Psychiatry', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Child & Adolescent Psychiatry', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Addiction Psychiatry', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Psychology', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Clinical Psychology', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Counseling', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Behavioral Health', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Anxiety Disorders', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Depression Treatment', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Trauma & PTSD', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Substance Abuse Counseling', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Marriage & Family Therapy', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'Grief Counseling', 'category' => 'Mental & Behavioral Health'],
            ['name' => 'ADHD Evaluation & Treatment', 'category' => 'Mental & Behavioral Health'],

            // Cardiology
            ['name' => 'Cardiology', 'category' => 'Cardiology'],
            ['name' => 'Preventive Cardiology', 'category' => 'Cardiology'],
            ['name' => 'Heart Disease Management', 'category' => 'Cardiology'],
            ['name' => 'Hypertension Management', 'category' => 'Cardiology'],

            // Dermatology
            ['name' => 'Dermatology', 'category' => 'Dermatology'],
            ['name' => 'Cosmetic Dermatology', 'category' => 'Dermatology'],
            ['name' => 'Skin Conditions', 'category' => 'Dermatology'],
            ['name' => 'Acne Treatment', 'category' => 'Dermatology'],
            ['name' => 'Hair Loss Treatment', 'category' => 'Dermatology'],

            // Orthopedics & Musculoskeletal
            ['name' => 'Orthopedics', 'category' => 'Orthopedics & Musculoskeletal'],
            ['name' => 'Sports Medicine', 'category' => 'Orthopedics & Musculoskeletal'],
            ['name' => 'Physical Therapy', 'category' => 'Orthopedics & Musculoskeletal'],
            ['name' => 'Occupational Therapy', 'category' => 'Orthopedics & Musculoskeletal'],
            ['name' => 'Chiropractic Care', 'category' => 'Orthopedics & Musculoskeletal'],
            ['name' => 'Joint Pain', 'category' => 'Orthopedics & Musculoskeletal'],
            ['name' => 'Back Pain', 'category' => 'Orthopedics & Musculoskeletal'],
            ['name' => 'Injury Rehabilitation', 'category' => 'Orthopedics & Musculoskeletal'],

            // Neurology
            ['name' => 'Neurology', 'category' => 'Neurology'],
            ['name' => 'Headache Medicine', 'category' => 'Neurology'],
            ['name' => 'Migraine Treatment', 'category' => 'Neurology'],
            ['name' => 'Stroke Care', 'category' => 'Neurology'],
            ['name' => 'Neuromuscular Disorders', 'category' => 'Neurology'],

            // Endocrinology
            ['name' => 'Endocrinology', 'category' => 'Endocrinology'],
            ['name' => 'Diabetes Management', 'category' => 'Endocrinology'],
            ['name' => 'Thyroid Disorders', 'category' => 'Endocrinology'],
            ['name' => 'Hormone Disorders', 'category' => 'Endocrinology'],
            ['name' => 'Weight Management', 'category' => 'Endocrinology'],

            // Gastroenterology
            ['name' => 'Gastroenterology', 'category' => 'Gastroenterology'],
            ['name' => 'Digestive Health', 'category' => 'Gastroenterology'],
            ['name' => 'Nutrition Counseling', 'category' => 'Gastroenterology'],

            // Pulmonology
            ['name' => 'Pulmonology', 'category' => 'Pulmonology'],
            ['name' => 'Respiratory Health', 'category' => 'Pulmonology'],
            ['name' => 'Asthma Management', 'category' => 'Pulmonology'],
            ['name' => 'Sleep Medicine', 'category' => 'Pulmonology'],

            // Allergy & Immunology
            ['name' => 'Allergy Treatment', 'category' => 'Allergy & Immunology'],
            ['name' => 'Immunology', 'category' => 'Allergy & Immunology'],
            ['name' => 'Asthma & Allergy Care', 'category' => 'Allergy & Immunology'],

            // Rheumatology
            ['name' => 'Rheumatology', 'category' => 'Rheumatology'],
            ['name' => 'Arthritis Care', 'category' => 'Rheumatology'],
            ['name' => 'Autoimmune Conditions', 'category' => 'Rheumatology'],

            // Oncology
            ['name' => 'Oncology', 'category' => 'Oncology'],
            ['name' => 'Cancer Supportive Care', 'category' => 'Oncology'],

            // Urology
            ['name' => 'Urology', 'category' => 'Urology'],
            ['name' => "Men's Urologic Health", 'category' => 'Urology'],
            ['name' => 'Urinary Conditions', 'category' => 'Urology'],

            // Kidney Health
            ['name' => 'Nephrology', 'category' => 'Kidney Health'],
            ['name' => 'Kidney Disease Management', 'category' => 'Kidney Health'],

            // Eye Care
            ['name' => 'Optometry', 'category' => 'Eye Care'],
            ['name' => 'Ophthalmology', 'category' => 'Eye Care'],
            ['name' => 'Vision Care', 'category' => 'Eye Care'],
            ['name' => 'Contact Lens Services', 'category' => 'Eye Care'],

            // Dental
            ['name' => 'General Dentistry', 'category' => 'Dental'],
            ['name' => 'Cosmetic Dentistry', 'category' => 'Dental'],
            ['name' => 'Orthodontics', 'category' => 'Dental'],
            ['name' => 'Oral Surgery', 'category' => 'Dental'],
            ['name' => 'Periodontics', 'category' => 'Dental'],
            ['name' => 'Endodontics', 'category' => 'Dental'],
            ['name' => 'Pediatric Dentistry', 'category' => 'Dental'],

            // Foot & Ankle
            ['name' => 'Podiatry', 'category' => 'Foot & Ankle'],
            ['name' => 'Foot Care', 'category' => 'Foot & Ankle'],
            ['name' => 'Diabetic Foot Care', 'category' => 'Foot & Ankle'],

            // Women's / Family Services
            ['name' => 'Midwifery', 'category' => "Women's / Family Services"],
            ['name' => 'Birth Services', 'category' => "Women's / Family Services"],
            ['name' => 'Lactation Support', 'category' => "Women's / Family Services"],

            // Nutrition & Wellness
            ['name' => 'Dietetics', 'category' => 'Nutrition & Wellness'],
            ['name' => 'Diabetes Nutrition', 'category' => 'Nutrition & Wellness'],
            ['name' => 'Sports Nutrition', 'category' => 'Nutrition & Wellness'],

            // Pain Management
            ['name' => 'Pain Management', 'category' => 'Pain Management'],
            ['name' => 'Chronic Pain', 'category' => 'Pain Management'],
            ['name' => 'Musculoskeletal Pain', 'category' => 'Pain Management'],

            // Sleep
            ['name' => 'Sleep Disorders', 'category' => 'Sleep'],

            // Rehabilitation Services
            ['name' => 'Physical Rehabilitation', 'category' => 'Rehabilitation Services'],
            ['name' => 'Occupational Rehabilitation', 'category' => 'Rehabilitation Services'],
            ['name' => 'Speech Therapy', 'category' => 'Rehabilitation Services'],
            ['name' => 'Language Therapy', 'category' => 'Rehabilitation Services'],
            ['name' => 'Swallowing Disorders', 'category' => 'Rehabilitation Services'],

            // Pharmacy Services
            ['name' => 'Medication Management', 'category' => 'Pharmacy Services'],
            ['name' => 'Pharmacotherapy', 'category' => 'Pharmacy Services'],
            ['name' => 'Medication Review', 'category' => 'Pharmacy Services'],

            // Urgent / General Services
            ['name' => 'Urgent Care', 'category' => 'Urgent / General Services'],
            ['name' => 'Same-Day Care', 'category' => 'Urgent / General Services'],
            ['name' => 'Minor Illness', 'category' => 'Urgent / General Services'],
            ['name' => 'Minor Injury Care', 'category' => 'Urgent / General Services'],
            ['name' => 'Travel Medicine', 'category' => 'Urgent / General Services'],
            ['name' => 'Vaccinations', 'category' => 'Urgent / General Services'],
            ['name' => 'Health Screenings', 'category' => 'Urgent / General Services'],

            // Other
            ['name' => 'Other Specialty', 'category' => 'Other'],
        ];

        foreach ($specialties as $s) {
    DB::table('specialties')->updateOrInsert(
        ['name' => $s['name']],
        [
            'slug'       => Str::slug($s['name']),
            'category'   => $s['category'],
            'updated_at' => now(),
            'created_at' => now(),
        ]
    );
}
    }
}