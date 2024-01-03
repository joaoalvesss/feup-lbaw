<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = fake()->dateTimeBetween('-1 year', 'now');

        return [
            'type' => 'user',
            'message' => fake()->sentence(),
            'created_at' => $created_at,
            'dismissed_at' => fake()->boolean(20) ? fake()->dateTimeBetween($created_at, 'now') : null,
            'user_id' => User::find(fake()->numberBetween(1,20))
        ];
    }
}
