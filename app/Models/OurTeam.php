<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'linkedin',
        'upload_photo',
    ];
}
