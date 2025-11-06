<?php

namespace Database\Seeders;

use App\Models\EnrolledUser;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIn('role',['instructor','learner'])->get();
        foreach($users as $user){
            $enrollments = $user->EnrolledUser;
            $enrollments->each(
                function($enrollment) {
                    $classroom = $enrollment->classroom;
                    $classroomModule = $classroom->ClassroomModule()->inRandomOrder()->first();
                    $lesson = $classroomModule->Module->Lesson()->inRandomOrder()->first();

                    UserProgress::factory(5)->create([
                        'enrolled_user_id'=>$enrollment->id,
                        'classroom_module_id'=>$classroomModule->id,
                        'lesson_id'=> $lesson->id
                    ]);
                }
            );
        }
    }
}
