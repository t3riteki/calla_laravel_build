<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\Module;
use App\Models\EnrolledUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassroomModule>
 */
class ClassroomModuleFactory extends Factory
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
            'module_id' => Module::inRandomOrder()->first()?->id,
            'added_by' => null,
        ];
    }
}
