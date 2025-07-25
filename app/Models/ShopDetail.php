<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'address',
        'phone_number',
        'npwp',
        'user_id',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
