<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'headline',
        'sub_headline',
        'sub_materi',
        'siapa_kami',
        'visi',
        'misi',
        'phone',
        'email',
        'address',
    ];
}
