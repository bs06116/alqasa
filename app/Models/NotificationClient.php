<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationClient extends Model
{
    protected $fillable = [
        'notification_id', 'client_id'
    ];
}
