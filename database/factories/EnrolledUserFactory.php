<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EnrolledUser>
 */
class EnrolledUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'classroom_id' => Classroom::inRandomOrder()->first()?->id ?? Classroom::factory(),
        ];
    }
}
