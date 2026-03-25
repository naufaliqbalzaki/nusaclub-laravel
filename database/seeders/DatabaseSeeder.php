<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            ProgramSeeder::class,
            PackageSeeder::class,
            FaqSeeder::class,
            TestimonialSeeder::class,
            CoachSeeder::class,
            StudentSeeder::class,
        ]);
    }
}