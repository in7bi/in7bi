<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(2, true), // contoh: "Digital Camera"
            'description' => $this->faker->sentence(10),
        ];
    }
}
