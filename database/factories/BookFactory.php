<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'category_id' => Category::factory(),
            'description' => $this->faker->paragraph,
            'cover_image' => null,
            'published_year' => $this->faker->year,
            'quantity' => $this->faker->numberBetween(1, 20),
        ];
    }
}
