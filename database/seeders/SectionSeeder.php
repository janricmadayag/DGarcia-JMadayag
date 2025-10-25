<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            ['course' => 'BSIT', 'year_level' => 1, 'section' => 'A'],
            ['course' => 'BSIT', 'year_level' => 1, 'section' => 'B'],
            ['course' => 'BSIT', 'year_level' => 2, 'section' => 'A'],
            ['course' => 'BSIT', 'year_level' => 2, 'section' => 'B'],
        ];

        foreach ($sections as $sec) {
            Section::firstOrCreate($sec);
        }
    }
}
