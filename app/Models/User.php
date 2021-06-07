<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_en',
        'email',
        'password',
        'phone',
        'address',
        'address_en',
        'google_lat',
        'google_lan',
        'picture',
        'profile',
        'profile_en',
        'tags',
        'tags_en',
        'delivery_price',
        'booking_type',
        'reservation_prayer_hour',
        'special',
        'visits',
        'general_department_id',
        'country_id',
        'city_id',
        'area_id',
        'active',
        'disable'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'name',
        'name_en',
        'email',
        'password',
        'phone',
        'address',
        'address_en',
        //'google_lat',
        //'google_lan',
        'picture',
        'profile',
        'profile_en',
        'tags',
        'tags_en',
        //'delivery_price',
        'booking_type',
        //'reservation_prayer_hour',
        'special',
        'visits',
        'general_department_id',
        'country_id',
        'city_id',
        'area_id',
        'active',
        'disable',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //protected $appends = ['title', 'user_address', 'user_profile', 'user_tags', 'image'];
    protected $appends = ['title', 'user_address', 'image'];

    public function getTitleAttribute($value){
        return $this->title = (app()->getLocale() == "en") ? $this->name_en : $this->name;
    }

    public function getUserAddressAttribute($value){
        return $this->user_address = (app()->getLocale() == "en") ? $this->address_en : $this->address;
    }

    public function getUserProfileAttribute($value){
        return $this->user_profile = (app()->getLocale() == "en") ? $this->profile_en : $this->profile;
    }

    public function getUserTagsAttribute($value){
        return $this->user_tags = (app()->getLocale() == "en") ? $this->tags_en : $this->tags;
    }
    
    public function getImageAttribute($value){
        return $this->image = config('app.url').$this->picture;
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

    public function generalDepartments()
    {
        return $this->belongsTo('App\Models\general\GeneralDepartment','general_department_id');
    }

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
                $filterColumn = 'rate';
                $filterType = "DESC";
                break;

            case 2:
                $filterColumn = 'price';
                $filterType = "ASC";
                break;

            case 3:
                $filterColumn = 'price';
                $filterType = "DESC";
                break;

            default:
                $filterColumn = 'waiting_time';
                $filterType = "ASC";
        }
        return $query->orderBy($filterColumn, $filterType);
    }


    public function returnTodayCount($date)
    {
        $getTomorowName = date('D', strtotime($date));
        switch ($getTomorowName){
            case "Sat":
                $todayName = 1;
                break;
            case "Sun":
                $todayName = 2;
                break;
            case "Mon":
                $todayName = 3;
                break;
            case "Tue":
                $todayName = 4;
                break;
            case "Wed":
                $todayName = 5;
                break;
            case "Thu":
                $todayName = 6;
                break;
            default:
                $todayName = 7;
        }
        return $todayName;
    }

    public function scopeReservationDays($query, $checkDay)
    {
        $reservDay = [];
        if($checkDay == 1){
            array_push($reservDay, $this->returnTodayCount(date('Y-m-d')));
        }elseif($checkDay == 2){
            $today = date('Y-m-d');
            array_push($reservDay, $this->returnTodayCount(date('Y-m-d', strtotime($today. ' + 1 days'))));
        }

        $newQuery = $query;
        if($reservDay != ""){
            $newQuery = $query->whereNotIn('weekend',$reservDay);
        }
        return $newQuery;
    }

}
