<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instructors = User::where('role','instructor')->get();

        $instructors->each(
            function($instructor){
            $instructor->module()->saveMany(
                Module::factory(5)->make(['owner_id'=>$instructor->id])
            );
        });

    }
}
