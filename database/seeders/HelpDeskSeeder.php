<?php

namespace Database\Seeders;

use App\Models\HelpCategory;
use Illuminate\Database\Seeder;

class HelpDeskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patientCategories = [
            [
                'name' => 'Getting Started',
                'type' => 'patient',
                'description' => 'Everything you need to know to start using MedVroom.',
                'icon' => 'rocket',
                'order' => 1,
                'articles' => [
                    [
                        'title' => 'How to create a patient account',
                        'content' => '<h1>Creating Your Account</h1><p>Welcome to MedVroom! To create an account, click on the "Sign Up" button at the top right of the homepage. You will need to provide your full name, email address, and create a secure password.</p><p>Once registered, you can immediately start searching for doctors and booking appointments.</p>',
                        'is_published' => true,
                    ],
                    [
                        'title' => 'Finding the right doctor for you',
                        'content' => '<h1>Smart Search</h1><p>Use our advanced search bar to find doctors by specialty, location, or insurance plan. You can filter results by gender, language, and patient reviews to ensure you find the perfect match for your healthcare needs.</p>',
                        'is_published' => true,
                    ],
                ],
            ],
            [
                'name' => 'Appointments',
                'type' => 'patient',
                'description' => 'Booking, rescheduling, and managing your visits.',
                'icon' => 'calendar',
                'order' => 2,
                'articles' => [
                    [
                        'title' => 'How to book an appointment',
                        'content' => '<h1>Easy Booking</h1><p>When you find a doctor you like, simply select an available time slot from their profile page. Fill in your insurance details and the reason for your visit, then confirm the booking. You will receive an email confirmation immediately.</p>',
                        'is_published' => true,
                    ],
                    [
                        'title' => 'Canceling or rescheduling a visit',
                        'content' => '<h1>Flexible Scheduling</h1><p>To change an appointment, go to your Patient Dashboard and find the "Upcoming Appointments" section. Click on the three dots next to the appointment you wish to change and select "Reschedule" or "Cancel". Please note the doctor\'s cancellation policy.</p>',
                        'is_published' => true,
                    ],
                ],
            ],
            [
                'name' => 'Insurance & Billing',
                'type' => 'patient',
                'description' => 'Help with coverage, payments, and insurance cards.',
                'icon' => 'credit-card',
                'order' => 3,
                'articles' => [
                    [
                        'title' => 'Adding your insurance card',
                        'content' => '<h1>Manage Insurance</h1><p>You can upload a photo of your insurance card in your account settings. This helps doctors verify your coverage before your visit. To add a card, go to "Settings" -> "Insurance" and click "Add New Card".</p>',
                        'is_published' => true,
                    ],
                ],
            ],
        ];

        $providerCategories = [
            [
                'name' => 'Practice Profile',
                'type' => 'provider',
                'description' => 'Managing your professional presence on MedVroom.',
                'icon' => 'user',
                'order' => 1,
                'articles' => [
                    [
                        'title' => 'Optimizing your profile for patients',
                        'content' => '<h1>Stand Out</h1><p>A complete profile includes a professional headshot, a detailed biography, and an accurate list of specialties. Doctors with photos receive 3x more bookings than those without. Be sure to highlight your unique approach to patient care.</p>',
                        'is_published' => true,
                    ],
                    [
                        'title' => 'Updating office locations',
                        'content' => '<h1>Location Management</h1><p>You can manage multiple office locations from your Provider Dashboard. Go to "Settings" -> "Locations" to add or edit addresses. Patients will be able to see which days you are at each location.</p>',
                        'is_published' => true,
                    ],
                ],
            ],
            [
                'name' => 'Scheduling',
                'type' => 'provider',
                'description' => 'Setting availability and syncing calendars.',
                'icon' => 'clock',
                'order' => 2,
                'articles' => [
                    [
                        'title' => 'How to set your available hours',
                        'content' => '<h1>Custom Schedule</h1><p>Navigate to the "Schedule" tab in your dashboard. You can set repeating weekly hours or specific one-off availability. Remember to leave blocks for lunch and administrative tasks.</p>',
                        'is_published' => true,
                    ],
                    [
                        'title' => 'Integration with external calendars',
                        'content' => '<h1>Sync Everything</h1><p>MedVroom supports synchronization with Google Calendar and Outlook. This prevents double-booking and ensures your personal and professional schedules are always aligned.</p>',
                        'is_published' => true,
                    ],
                ],
            ],
        ];

        // Seed Patient Categories and Articles
        foreach ($patientCategories as $catData) {
            $articles = $catData['articles'];
            unset($catData['articles']);

            $category = HelpCategory::create($catData);

            foreach ($articles as $articleData) {
                $category->articles()->create($articleData);
            }
        }

        // Seed Provider Categories and Articles
        foreach ($providerCategories as $catData) {
            $articles = $catData['articles'];
            unset($catData['articles']);

            $category = HelpCategory::create($catData);

            foreach ($articles as $articleData) {
                $category->articles()->create($articleData);
            }
        }
    }
}
