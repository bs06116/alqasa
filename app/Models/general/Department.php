<?php

namespace App\Models\general;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'parent_id', 'name', 'name_en', 'details', 'details_en', 'picture', 'type', 'active'
    ];

    protected $hidden = ['name', 'name_en', 'details', 'details_en', 'parent_id', 'picture', 'active', 'created_at', 'updated_at'];

    protected $appends = ['title', 'description', 'image'];

    public function getTitleAttribute($value)
    {
        return $this->title = (app()->getLocale() == "en") ? $this->name_en : $this->name;
    }

    public function getDescriptionAttribute($value)
    {
        return $this->description = (app()->getLocale() == "en") ? $this->details_en : $this->details;
    }

    public function getImageAttribute($value){
        return $this->image = config('app.url').$this->picture;
    }

    public function subDepartment()
    {
        return $this->hasMany('App\Models\general\Department', 'parent_id', 'id');
    }

    public function allsubDepartments()
    {
        return $this->belongsTo('App\Models\general\Department', 'parent_id', 'id');
    }

    //scopes
    public function scopeActive($query)
    {
        return $query->where('active','1');
    }
}
