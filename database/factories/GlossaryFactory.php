<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Glossary>
 */
class GlossaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::inRandomOrder()->first()?->id ?? Lesson::factory(),
            'term' => ucfirst($this->faker->word()),
            'meaning' => $this->faker->sentence(10),
        ];
    }
}
