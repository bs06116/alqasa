<?php

namespace App\Models\general;

use Illuminate\Database\Eloquent\Model;

class GeneralDepartment extends Model
{
    protected $fillable = [
        'name', 'name_en', 'picture', 'active'
    ];

    protected $hidden = [
        'name', 'name_en', 'picture', 'active', 'created_at', 'updated_at'
    ];

    protected $appends = ['title', 'image'];

    public function getTitleAttribute($value){
        //return $this->title = (Request()->server('HTTP_ACCEPT_LANGUAGE') == "en") ? $this->name_en : $this->name;
        return $this->title = (app()->getLocale() == "en") ? $this->name_en : $this->name;
    }
    
    public function getImageAttribute($value){
        return $this->image = config('app.url').$this->picture;
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->where('active','1');
    }

}
