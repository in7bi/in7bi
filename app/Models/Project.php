<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'materi',
        'category',
        'pitch_deck',
        'upload_proposal_file',
        'upload_image_file'
    ];
}
