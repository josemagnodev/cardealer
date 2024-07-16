<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['F-150', 'Impala', '300c']),
            'brand' => fake()->randomElement(['Ford', 'GM', 'Chrysler']),
            'year' => fake()->year(),
            'body' => fake()->randomElement(['Coupé', 'Fastback', 'Sedan']),
        ];
    }
}