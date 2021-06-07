<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'country_id',
        'city_id',
        'area_id',
        'general_department_id',
        'client_id',
        'user_id',

        //reservation information
        'price',
        'delivery',
        'reservation_prayer_hour',
        'reservation_prayer_hour_time',
        'reservation_time',
        'reservation_date',
        'notes',
        'promo_code_id',

        //payment
        'bill_number',
        'payment_hash_mac',
        'payment_id',
        'payment_statues',
        'payment_method',
        'payment_active',
        'active'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = ['count', 'total_price'];

    public function countries()
    {
        return $this->belongsTo('App\Models\general\Country', 'country_id');
    }

    public function cities()
    {
        return $this->belongsTo('App\Models\general\City', 'city_id');
    }

    public function areas()
    {
        return $this->belongsTo('App\Models\general\City', 'area_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function clients()
    {
        return $this->belongsTo('App\Models\Client','client_id','id');
    }

    public function reservationDetails()
    {
        return $this->hasMany('App\Models\ReservationDetails','reservation_id','id');
    }

    public function promoCodes()
    {
        return $this->belongsTo('App\Models\general\PromoCode','promo_code_id','id');
    }

    public function getCountAttribute($value)
    {
        return $this->count = $this->reservationDetails->count();
    }

    public function getPriceAttribute($value)
    {
        return $this->price = $this->reservationDetails->sum('total_price');
    }

    public function getTotalPriceAttribute($value)
    {
        $promoCode = ($this->promo_code_id == null) ? 0 : $this->promoCodes->amount;
        $total_price = ($this->price * (100 - $promoCode)) / 100;
        return $this->total_price = $total_price + $this->delivery;
        //return $this->total_price = $this->promoCodes->amonut;
    }
}
