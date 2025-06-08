<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorRelation extends Model
{
    use HasFactory;

    protected $fillable = [
        'headline',
        'sub_headline',
        'materi',
    ];
}
