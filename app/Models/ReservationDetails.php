<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationDetails extends Model
{
    protected $fillable = [
        'reservation_id',
        'product_id',
        'price',
        'count',
        'total_price',
        'active'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    //relations
    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id','id');
    }

    public function reservations()
    {
        return $this->belongsTo('App\Models\Reservation', 'reservation_id','id');
    }
}
