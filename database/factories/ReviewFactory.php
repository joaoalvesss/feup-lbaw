<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,20),
            'product_id' => fake()->numberBetween(1,20),
            'score' => fake()->numberBetween(1,5),
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
            'comment' => fake()->boolean(20) ? fake()->sentence() : null
        ];
    }
}
