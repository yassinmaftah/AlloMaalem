<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password123'),
            'phone' => fake()->phoneNumber(),
            'role' => fake()->randomElement(['client', 'maalem']),
            'avatar' => null,
            'bio' => fake()->paragraph(),
            'is_verified' => false,
            'is_baned' => false,
        ];
    }
}
