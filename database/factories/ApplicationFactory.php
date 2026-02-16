<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'proposed_price' => fake()->numberBetween(100, 4000),
            'message' => fake()->sentence(10),
            'status' => fake()->randomElement(['pending', 'accepted', 'rejected']),
            'job_id' => 1,
            'user_id' => 1,
        ];
    }
}
