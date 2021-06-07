<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCodeUser extends Model
{
    protected $fillable = [
        'user_id', 'promo_code_id'
    ];
}
