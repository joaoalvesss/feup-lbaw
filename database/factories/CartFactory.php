<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::find(fake()->numberBetween(1,20)),
            'product_id' => Product::find(fake()->numberBetween(1,20)),
            'quantity' => fake()->numberBetween(1, 20),
        ];
    }
}
