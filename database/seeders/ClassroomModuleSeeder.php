<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\ClassroomModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classroom::all()->each(
            function($classroom){
                $ownerid = $classroom->owner_id;
                $modules = $classroom->User->Module;
                foreach($modules as $module){
                    ClassroomModule::factory(5)->create([
                        'classroom_id'=>$classroom->id,
                        'module_id'=>$module->id,
                        'added_by'=>$ownerid
                    ]);
                }
            }
        );

    }
}
