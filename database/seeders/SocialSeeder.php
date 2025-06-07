<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Social;

class SocialSeeder extends Seeder
{
    public function run(): void
    {
        Social::create([
            'facebook'  => 'https://facebook.com/yourcompany',
            'twitter'   => 'https://twitter.com/yourcompany',
            'linkedin'  => 'https://linkedin.com/company/yourcompany',
            'instagram' => 'https://instagram.com/yourcompany',
        ]);
    }
}
