<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Health & Wellness', 'display_order' => 1],
            ['name' => 'Patient Stories', 'display_order' => 2],
            ['name' => 'Medical News', 'display_order' => 3],
            ['name' => 'Zocdoc Reports', 'display_order' => 4],
            ['name' => 'Life at Zocdoc', 'display_order' => 5],
        ];

        foreach ($categories as $catData) {
            $category = BlogCategory::create([
                'name' => $catData['name'],
                'slug' => Str::slug($catData['name']),
                'display_order' => $catData['display_order'],
            ]);

            // Create some posts for each category
            for ($i = 1; $i <= 3; $i++) {
                $title = 'Sample '.$category->name.' Article '.$i;
                BlogPost::create([
                    'blog_category_id' => $category->id,
                    'title' => $title,
                    'slug' => Str::slug($title),
                    'excerpt' => "This is a short excerpt for the article '".$title."'. It gives readers a quick glimpse into the healthy advice and real talk covered in 'The Paper Gown'.",
                    'content' => '<h2>Expert Insights</h2><p>Getting the right care starts with having the right information. In this article, we dive deep into '.strtolower($category->name)." topics that matter most to you.</p><blockquote>Real talk: Your health journey is unique, and we're here to help you navigate it.</blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><h3>Key Takeaways</h3><ul><li>Always consult with a professional.</li><li>Stay informed with Zocdoc.</li><li>Your wellness matters.</li></ul>",
                    'author_name' => 'The Paper Gown Staff',
                    'is_published' => true,
                    'published_at' => now()->subDays(rand(1, 30)),
                    'views' => rand(100, 5000),
                ]);
            }
        }

        // Add a few drafts
        BlogPost::create([
            'blog_category_id' => BlogCategory::first()->id,
            'title' => 'Upcoming Health Trends 2026',
            'slug' => 'upcoming-health-trends-2026',
            'excerpt' => 'A sneak peek into the future of healthcare.',
            'content' => '<p>Work in progress...</p>',
            'author_name' => 'Future Speculator',
            'is_published' => false,
            'views' => 0,
        ]);
    }
}
