<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::all()->each(
            function($module){
                $module->lesson()->saveMany(
                    Lesson::factory(5)->make(['module_id'=>$module->id])
                );
            }
        );
    }
}
