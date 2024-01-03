<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'stock' => 40,
            'price' => fake()->randomFloat(2, 30, 50),
            'image' => null,
            'score' => fake()->randomFloat(1, 1, 5),
            'description' => fake()->sentence(),
            'hardware' => false,
            'publication_date' => fake()->dateTimeBetween('-10 year', 'now'),
            'platform_id' => fake()->numberBetween(1, 3),
        ];
    }
}
