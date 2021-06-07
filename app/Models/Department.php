<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'name_en',
        'details',
        'details_en',
        'picture',
        'type',
        'active',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'parent_id',
        'name',
        'name_en',
        'details',
        'details_en',
        'picture',
        'active',
        'created_at',
        'updated_at'
    ];

    //protected $appends = ['title', 'product_details', 'images'];
    protected $appends = ['title', 'image'];

    public function getTitleAttribute($value)
    {
        return $this->title = (app()->getLocale() == "en") ? $this->name_en : $this->name;
    }

    public function getProductDetailsAttribute($value)
    {
        return $this->product_details = (app()->getLocale() == "en") ? $this->details_en : $this->details;
    }

    public function getProductInformationAttribute($value)
    {
        return $this->offer_information = (app()->getLocale() == "en") ? $this->information_en : $this->information;
    }

    public function getImageAttribute($value){
        return $this->image = config('app.url').$this->picture;
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }
}
