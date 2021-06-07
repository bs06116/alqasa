<?php

namespace App\Models\general;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        'country_id',
        'city_id',
        'area_id',
        'department_id',
        'product_id',
        'name',
        'name_en',
        'from_date',
        'to_date',
        'url_link',
        'picture',
        'visits',
        'special',
        'active'
    ];

    protected $hidden = [
        'country_id',
        'city_id',
        'area_id',
        'department_id',
        'name',
        'name_en',
        'from_date',
        'to_date',
        'picture',
        'visits',
        'special',
        'created_at',
        'updated_at'
    ];

    protected $appends = ['title', 'image'];

    public function getTitleAttribute($value)
    {
        return $this->title = (app()->getLocale() == "en") ? $this->name_en : $this->name;
    }

    public function getImageAttribute($value){
        return $this->image = config('app.url').$this->picture;
    }

    //relations
    public function departments()
    {
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }

    public function cities(){
        return $this->belongsTo('App\Models\general\City', 'city_id');
    }

    public function areas()
    {
        return $this->belongsTo('App\Models\general\City', 'area_id');
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }
}
