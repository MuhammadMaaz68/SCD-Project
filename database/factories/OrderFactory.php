<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_number' => 'ORD-' . $this->faker->unique()->numerify('#####'),
            'total_price' => $this->faker->randomFloat(2, 20, 500),
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
