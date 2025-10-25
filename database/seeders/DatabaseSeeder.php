<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SectionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Example test user
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            SectionSeeder::class, // ✅ Only seed Sections
        ]);
    }
}
