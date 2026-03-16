<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(3),
            'budget' => fake()->numberBetween(300, 5000),
            'status' => fake()->randomElement(['open', 'in_progress', 'completed']),
            'is_urgent' => fake()->boolean(20),
            'user_id' => 1,
            'category_id' => 1,
            'city_id' => 1,
        ];
    }
}
