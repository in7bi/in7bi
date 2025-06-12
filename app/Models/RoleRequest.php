<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'requested_role', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
