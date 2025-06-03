<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvestorRelation>
 */
class InvestorRelationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'headline'      => $this->faker->sentence(),
            'sub_headline'  => $this->faker->sentence(),
            'materi'        => $this->faker->paragraphs(3, true), // 3 paragraphs as a string
        ];
    }
}
