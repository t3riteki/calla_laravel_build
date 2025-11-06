<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('role','instructor')->get()->each(
            function($instructor){
                $instructor->classroom()->saveMany(
                    Classroom::factory(5)->make(['owner_id'=>$instructor->id])
                );
            }
        );
    }
}
