<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
{
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence() . '?',
            'answer'   => $this->faker->paragraph(),
        ];
    }
}
