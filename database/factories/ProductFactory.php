<?php

namespace Database\Factories;

use App\Models\Category;
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
            'name' => $this->faker->words(3, true),
            'category_id' => Category::factory(), // Automatically create category if not passed
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 5, 200),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'image' => null, // Or use faker logic if we want placeholders
        ];
    }
}
