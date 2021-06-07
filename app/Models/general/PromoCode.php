<?php

namespace App\Models\general;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $fillable = [
        'country_id', 'name', 'amount', 'from_date', 'to_date', 'only_user_count', 'users_count', 'active'
    ];

    public function countries()
    {
        return $this->belongsTo('App\Models\general\Country', 'country_id', 'id');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation', 'promo_code_id', 'id');
    }

    public function scopeCheckPromoWithPrice($query,$price)
    {
        return $query->where('amount','<',$price);
    }
}
