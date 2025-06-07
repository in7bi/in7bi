<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    public function run(): void
    {
        Social::create([
            'facebook' => 'https://facebook.com/yourcompany',
            'twitter' => 'https://twitter.com/yourcompany',
            'linkedin' => 'https://linkedin.com/company/yourcompany',
            'instagram' => 'https://instagram.com/yourcompany',
        ]);
    }
}
