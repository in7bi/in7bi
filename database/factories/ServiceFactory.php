<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ServiceCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    public function definition()
    {
        // Ambil random ServiceCategory id, atau buat baru jika belum ada
        $categoryId = ServiceCategory::inRandomOrder()->first()?->id;

        if (! $categoryId) {
            $categoryId = ServiceCategory::factory()->create()->id;
        }

        return [
            'service_name' => $this->faker->words(3, true), // contoh: "Premium Web Hosting"
            'subtitle' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
            'service_category_id' => $categoryId,
        ];
    }
}
