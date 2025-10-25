<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class YearSeeder extends Seeder
{
    public function run(): void
    {
        $years = [1, 2, 3, 4];

        foreach ($years as $yr) {
            Year::firstOrCreate(['year_level' => $yr]);
        }
    }
}
