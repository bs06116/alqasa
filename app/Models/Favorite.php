<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'my_favorite_id', 'client_id', 'type'
    ];

    protected $hidden = [
        'my_favorite_id', 'client_id', 'type', 'created_at', 'updated_at'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'my_favorite_id', 'id');
    }

    public function offers()
    {
        return $this->belongsTo('App\Models\Offer', 'my_favorite_id', 'id');
    }

    public function clients()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id');
    }
}
