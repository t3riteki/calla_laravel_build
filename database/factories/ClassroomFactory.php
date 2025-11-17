<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classroom>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => User::where('role', 'instructor')->inRandomOrder()->first()?->id ?? User::factory()->create(['role' => 'instructor'])->id,
            'name' => 'Class ' . $this->faker->word(),
            'description' => $this->faker->sentence(8),
            'code' => $this->faker->password()
        ];
    }
}
