<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\InvestorRelation;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\ServiceCategory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Faq::factory()->count(10)->create();
        InvestorRelation::factory()->count(5)->create();
        ServiceCategory::factory()->count(5)->create();
        Service::factory()->count(20)->create();
        ProductCategory::factory()->count(10)->create();
        $this->call([WebSettingsSeeder::class,
            SocialSeeder::class,
        ]);
    }
}
