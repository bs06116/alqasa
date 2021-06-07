<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoCodeClient extends Model
{
    protected $fillable = ['client_id', 'promo_code_id', 'reservation_id'];

    public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id','id');
    }

    public function promoCodes()
    {
        return $this->belongsTo('App\Models\general\PromoCode', 'promo_code_id','id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id','id');
    }
}
