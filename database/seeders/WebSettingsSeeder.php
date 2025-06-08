<?php

namespace Database\Seeders;

use App\Models\WebSettings;
use Illuminate\Database\Seeder;

class WebSettingsSeeder extends Seeder
{
    public function run(): void
    {
        WebSettings::create([
            'headline' => 'Selamat Datang di Website Kami',
            'sub_headline' => 'Belajar Mudah dan Menyenangkan',
            'sub_materi' => 'Materi disusun secara sistematis dan terstruktur.',
            'siapa_kami' => 'Kami adalah platform edukasi digital yang membantu proses belajar.',
            'visi' => 'Menjadi pusat edukasi online terbaik di Indonesia.',
            'misi' => 'Memberikan akses pembelajaran berkualitas bagi semua orang.',
            'phone' => '+62 812 3456 7890',
            'email' => 'info@webkami.com',
            'address' => 'Jl. Pendidikan No. 123, Jakarta, Indonesia',
        ]);
    }
}
