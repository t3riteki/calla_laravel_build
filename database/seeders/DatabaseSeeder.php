<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
            UserSeeder::class,
            LogSeeder::class,
            ModuleSeeder::class,
            LessonSeeder::class,
            GlossarySeeder::class,
            ClassroomSeeder::class,
            EnrolledUserSeeder::class,
            ClassroomModuleSeeder::class,
            UserProgressSeeder::class,
        ]);
    }
}
