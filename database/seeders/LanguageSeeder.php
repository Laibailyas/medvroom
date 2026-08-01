<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['code' => 'en',    'name' => 'English'],
            ['code' => 'es',    'name' => 'Spanish'],
            ['code' => 'zh-cn', 'name' => 'Chinese (Mandarin)'],
            ['code' => 'zh-hk', 'name' => 'Chinese (Cantonese)'],
            ['code' => 'vi',    'name' => 'Vietnamese'],
            ['code' => 'ko',    'name' => 'Korean'],
            ['code' => 'tl',    'name' => 'Tagalog / Filipino'],
            ['code' => 'ar',    'name' => 'Arabic'],
            ['code' => 'fr',    'name' => 'French'],
            ['code' => 'ht',    'name' => 'Haitian Creole'],
            ['code' => 'pt',    'name' => 'Portuguese'],
            ['code' => 'ru',    'name' => 'Russian'],
            ['code' => 'de',    'name' => 'German'],
            ['code' => 'it',    'name' => 'Italian'],
            ['code' => 'ja',    'name' => 'Japanese'],
            ['code' => 'hi',    'name' => 'Hindi'],
            ['code' => 'ur',    'name' => 'Urdu'],
            ['code' => 'bn',    'name' => 'Bengali'],
            ['code' => 'pa',    'name' => 'Punjabi'],
            ['code' => 'gu',    'name' => 'Gujarati'],
            ['code' => 'ta',    'name' => 'Tamil'],
            ['code' => 'te',    'name' => 'Telugu'],
            ['code' => 'mr',    'name' => 'Marathi'],
            ['code' => 'fa',    'name' => 'Persian / Farsi'],
            ['code' => 'tr',    'name' => 'Turkish'],
            ['code' => 'he',    'name' => 'Hebrew'],
            ['code' => 'el',    'name' => 'Greek'],
            ['code' => 'pl',    'name' => 'Polish'],
            ['code' => 'uk',    'name' => 'Ukrainian'],
            ['code' => 'ro',    'name' => 'Romanian'],
            ['code' => 'nl',    'name' => 'Dutch'],
            ['code' => 'sv',    'name' => 'Swedish'],
            ['code' => 'no',    'name' => 'Norwegian'],
            ['code' => 'da',    'name' => 'Danish'],
            ['code' => 'fi',    'name' => 'Finnish'],
            ['code' => 'cs',    'name' => 'Czech'],
            ['code' => 'hu',    'name' => 'Hungarian'],
            ['code' => 'sk',    'name' => 'Slovak'],
            ['code' => 'bg',    'name' => 'Bulgarian'],
            ['code' => 'hr',    'name' => 'Croatian'],
            ['code' => 'sr',    'name' => 'Serbian'],
            ['code' => 'bs',    'name' => 'Bosnian'],
            ['code' => 'sq',    'name' => 'Albanian'],
            ['code' => 'hy',    'name' => 'Armenian'],
            ['code' => 'ka',    'name' => 'Georgian'],
            ['code' => 'other', 'name' => 'Other'],
        ];

        foreach ($languages as $language) {
            Language::updateOrCreate(
                ['code' => $language['code']],
                ['name' => $language['name']]
            );
        }
    }
}