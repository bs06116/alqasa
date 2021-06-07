<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'country_id', 'general_department_id', 'user_id', 'specialty_id','offer_id', 'name', 'name_en', 'details', 'details_en', 'picture', 'active'
    ];
}
