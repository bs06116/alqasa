<?php

namespace App\Models\general;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'name_en', 'flag', 'currency', 'currency_en', 'country_code'
    ];

    protected $hidden = ['name', 'name_en', 'currency', 'currency_en', 'flag', 'active', 'created_at', 'updated_at'];

    protected $appends = ['title', 'country_currency', 'image'];

    public function getTitleAttribute($value){
        //return $this->title = (Request()->server('HTTP_ACCEPT_LANGUAGE') == "en") ? $this->name_en : $this->name;
        return $this->title = (app()->getLocale() == "en") ? $this->name_en : $this->name;
    }

    public function getCountryCurrencyAttribute($value){
        //return $this->country_currency = (Request()->server('HTTP_ACCEPT_LANGUAGE') == "en") ? $this->currency_en : $this->currency;
        return $this->country_currency = (app()->getLocale() == "en") ? $this->currency_en : $this->currency;
    }

    public function getImageAttribute($value){
        //return $this->image = config('app.url').'/doctors/uploads/Country/'.$this->flag;
        return $this->image = config('app.url').$this->flag;
    }

    public function city()
    {
        return $this->hasMany(City::class, 'id');
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->where('active','1');
    }

}
