<?php

namespace Database\Seeders;

use App\Models\Glossary;
use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GlossarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::all()->each(
            function($lesson){
                $lesson->glossary()->saveMany(
                    Glossary::factory(5)->make(['lesson_id'=>$lesson->id])
                );
            }
        );
    }
}
