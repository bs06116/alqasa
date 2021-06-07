<?php

namespace App\Models\general;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name', 'name_en', 'country_id', 'parent_id'
    ];

    protected $hidden = ['name', 'name_en', 'country_id', 'parent_id', 'active', 'created_at', 'updated_at'];

    protected $appends = ['title'];

    public function getTitleAttribute($value)
    {
        //return $this->title = (Request()->server('HTTP_ACCEPT_LANGUAGE') == "en") ? $this->name_en : $this->name;
        return $this->title = (app()->getLocale() == "en") ? $this->name_en : $this->name;
    }

    /*public function area()
    {
        return $this->hasMany(City::class,'parent_id');
    }*/

    public function users()
    {
        return $this->hasMany('App\Models\User', 'id', 'city_id');
    }

    public function usersAreas()
    {
        return $this->hasMany('App\Models\User', 'id', 'area_id');
    }

    public function countries()
    {
        return $this->belongsTo('App\Models\general\Country', 'country_id', 'id');
    }

    public function cities()
    {
        return $this->belongsTo('App\Models\general\City', 'parent_id', 'id');
    }

    
    
    //scopes
    public function scopeActive($query)
    {
        return $query->where('active','1');
    }
}
