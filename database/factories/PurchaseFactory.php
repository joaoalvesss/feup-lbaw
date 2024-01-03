<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
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
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
            'total' => fake()->numberBetween(50, 400),
            'delivery_progress' => 'Processing',
            'address_id' => fake()->numberBetween(1,20),
        ];
    }
}
