<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceCategory>
 */
class ServiceCategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true), // contoh: "Web Development"
            'description' => $this->faker->sentence(10), // kalimat deskripsi
        ];
    }
}
