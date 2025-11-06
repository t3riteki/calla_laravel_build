<?php

namespace Database\Seeders;

use App\Models\EnrolledUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrolledUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('role',['learner','instructor'])->each(
            function($user){
                $user->enrolledUser()->saveMany(
                    EnrolledUser::factory(5)->make(['user_id'=>$user->id])
                );
            }
        );
    }
}
