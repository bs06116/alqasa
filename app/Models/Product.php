<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'country_id',
        'city_id',
        'area_id',
        'department_id',
        'sub_department_id',
        'name',
        'name_en',
        'details',
        'details_en',
        'information',
        'information_en',
        'picture',
        'min_limit',
        'discount_percent',
        'price_before',
        'price_after',
        'size',
        'promo_code',
        'visits',
        'special',
        'active'
    ];

    protected $hidden = [
        'department_id',
        'sub_department_id',
        'name',
        'name_en',
        'details',
        'details_en',
        'information',
        'information_en',
        'picture',
        /*'min_limit',
        'discount_percent',
        'price_before',
        'price_after',
        'size',*/
        'promo_code',
        'visits',
        'special',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $appends = ['title', 'product_details', 'images'];

    public function getTitleAttribute($value)
    {
        return $this->title = (app()->getLocale() == "en") ? $this->name_en : $this->name;
    }

    public function getProductDetailsAttribute($value)
    {
        return $this->product_details = (app()->getLocale() == "en") ? $this->details_en : $this->details;
    }

    public function getOfferInformationAttribute($value)
    {
        return $this->offer_information = (app()->getLocale() == "en") ? $this->information_en : $this->information;
    }

    public function getImagesAttribute($value){
        return $this->image = config('app.url').$this->picture;
    }

    //relations
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

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function departments()
    {
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }

    public function scopeSortFilters($query, $type)
    {
        $filterColumn = "";
        $filterType = "";
        switch ($type){
            case 1:
                $filterColumn = 'price';
                $filterType = "ASC";
                break;

            default:
                $filterColumn = 'price';
                $filterType = "DESC";
        }
        return $query->orderBy($filterColumn, $filterType);
    }

    /*public function scopeInsuranceFilter($query, $insuranceId)
    {
        return $query->whereHas('users', function($query) use($insuranceId){
            $query->where('id', $insuranceId);
        });
    }*/
}
