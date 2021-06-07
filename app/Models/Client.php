<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = "clients";
    protected $fillable = [
        'country_id',
        'city_id',
        'area_id',
        'name',
        'email',
        'password',
        'phone',
        'picture',
        'gender',
        'birthday',
        'login_type',
        'social_token',
        'address',
        'google_lat',
        'google_lon',
        'device_id',
        'phone_code',
        'validate_phone_code',

        'another_phone',
        'another_phone_code',
        'validate_another_phone_code',

        'forget_code',
        'validate_forget_code',
        'active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
        'social_token',
        'login_type',
        'picture',
        'device_id',
        //'phone_code',
        'validate_another_phone_code',
        'validate_phone_code',
        'forget_code',
        'validate_forget_code',
        'active',
    ];

    protected $appends = ['image'];

    public function getImageAttribute($value){
        //return $this->image = config('app.url').'/doctors/'.$this->picture;
        return $this->image = config('app.url').$this->picture;
    }

    public function medicalReports()
    {
        return $this->hasMany('App\Models\MedicalReport','client_id','id');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Models\User','favorites','client_id','my_favorite_id');
    }

    public function countries()
    {
        return $this->belongsTo('App\Models\general\Country','country_id','id');
    }

    public function cities(){
        return $this->belongsTo('App\Models\general\City', 'city_id');
    }

    public function areas()
    {
        return $this->belongsTo('App\Models\general\City', 'area_id');
    }

}
