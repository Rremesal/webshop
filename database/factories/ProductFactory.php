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

        $maxCategoryId = count(Category::all());
        return [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2),
            'category_id' => fake()->numberBetween(1, $maxCategoryId),
        ];
    }
}
