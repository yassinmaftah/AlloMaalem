<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(3),
            'budget' => fake()->numberBetween(100, 5000),
            'city' => fake()->randomElement(['Casablanca', 'Rabat', 'Marrakech']),
            'status' => fake()->randomElement(['open', 'open', 'open', 'in_progress', 'completed']),
            'is_urgent' => fake()->boolean(10),
            'user_id' => 1,
            'category_id' => 1,
        ];
    }
}
