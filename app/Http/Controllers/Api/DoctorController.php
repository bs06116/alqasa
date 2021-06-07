<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User as User;
use \Exception;
use App\Traits\ResponsesTrait;
use Symfony\Component\Console\Input\Input;

class DoctorController extends Controller
{
    use ResponsesTrait;

    public function index(Request $request)
    {
        try{
            $specialtyId = $request->specialtyId;
            $insuranceId = $request->insuranceId;
            $data = User::query()->Active()
                ->with('specialties')
                ->with('cities')
                ->with('areas')
                ->with('userParents')
                ->when(request('specialtyId'), function ($query) use($specialtyId){
                    $query->whereHas('specialties', function($query) use($specialtyId){
                        $query->where('specialty_id', $specialtyId);
                    });
                })
                ->when(request('searchName'), function ($query){
                    $query->where('name', 'like', '%'.request('searchName').'%')
                        ->orWhere('name_en', 'like', '%'.request('searchName').'%');
                })
                ->when(request('parentId'), function ($query){
                    $query->where('parent_id', request('parentId'));
                })
                ->when(request('generalDepartmentId'), function ($query){
                    $query->where('general_department_id', request('generalDepartmentId'));
                })
                ->when(request('countryId'), function ($query){
                    $query->where('country_id', request('countryId'));
                })
                ->when(request('cityId'), function ($query){
                    $query->where('city_id', request('cityId'));
                })
                ->when(request('areaId'), function ($query){
                    $query->where('area_id', request('areaId'));
                })
                ->when(request('insuranceId'), function($query) use($insuranceId){
                    $query->whereHas('insuranceUsers', function($query) use($insuranceId){
                        $query->where('insurance_company_id', $insuranceId);
                    });
                })
                ->when(request('usePromoCode'), function ($query){
                    $query->where('promo_code', request('usePromoCode'));
                })
                ->when(request('gender'), function ($query){
                    $query->where('gender', request('gender'));
                })
                ->when(request('userTitle'), function ($query){
                    $query->where('title', request('userTitle'));
                })
                ->when(request('priceFrom') and request('priceTo'), function ($query){
                    $query->whereBetween('price', [request('priceFrom'),request('priceTo')]);
                })
                ->when(request('sortFilter'), function($query){
                    $query->SortFilters(request('sortFilter'));
                })
                ->when(request('reservationDay'), function($query){
                    $query->ReservationDays(request('reservationDay'));
                })
                ->when(request('parentType'), function($query){
                    $query->ParentFilter(request('parentType'));
                })
                ->where(['disable'=>'0', 'country_id'=>(int) $request->header('Country-Code')])
                ->get();

            //view hidden column
            $data->makeVisible(['user_address', 'price', 'rate', 'reviews', 'picture', 'user_profile']);

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function getAll(Request $request)
    {
        try{
            $specialtyId = $request->specialtyId;
            $insuranceId = $request->insuranceId;
            $data = User::query()->Active()
                ->with('specialties')
                ->with('cities')
                ->with('areas')
                ->with('userParents')
                ->when(request('specialtyId'), function ($query) use($specialtyId){
                    $query->whereHas('specialties', function($query) use($specialtyId){
                        $query->where('specialty_id', $specialtyId);
                    });
                })
                ->when(request('searchName'), function ($query){
                    $query->where('name', 'like', '%'.request('searchName').'%')
                        ->orWhere('name_en', 'like', '%'.request('searchName').'%');
                })
                ->when(request('parentId'), function ($query){
                    $query->where('parent_id', request('parentId'));
                })
                ->when(request('generalDepartmentId'), function ($query){
                    $query->where('general_department_id', request('generalDepartmentId'));
                })
                ->when(request('countryId'), function ($query){
                    $query->where('country_id', request('countryId'));
                })
                ->when(request('cityId'), function ($query){
                    $query->where('city_id', request('cityId'));
                })
                ->when(request('areaId'), function ($query){
                    $query->where('area_id', request('areaId'));
                })
                ->when(request('insuranceId'), function($query) use($insuranceId){
                    $query->whereHas('insuranceUsers', function($query) use($insuranceId){
                        $query->where('insurance_company_id', $insuranceId);
                    });
                })
                ->when(request('usePromoCode'), function ($query){
                    $query->where('promo_code', request('usePromoCode'));
                })
                ->when(request('gender'), function ($query){
                    $query->where('gender', request('gender'));
                })
                ->when(request('userTitle'), function ($query){
                    $query->where('title', request('userTitle'));
                })
                ->when(request('priceFrom') and request('priceTo'), function ($query){
                    $query->whereBetween('price', [request('priceFrom'),request('priceTo')]);
                })
                ->when(request('sortFilter'), function($query){
                    $query->SortFilters(request('sortFilter'));
                })

                ->when(request('reservationDay'), function($query){
                    $query->ReservationDays(request('reservationDay'));
                })
                ->when(request('parentType'), function($query){
                    $query->ParentFilter(request('parentType'));
                })
                ->where(['disable'=>'0', 'country_id'=>(int) $request->header('Country-Code')])
                ->paginate($request->pageCount);

                //view hidden column
            $data->makeVisible(['user_address', 'price', 'rate', 'reviews', 'picture', 'user_profile']);

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function show($generalDepartmentId, $id)
    {
        try{
            $data = User::query()
                ->with('specialties')
                ->with('cities')
                ->with('areas')
                ->when($generalDepartmentId == 3, function ($query) {
                    $query->with('userParents');
                })
                ->findOrFail($id);
            //view hidden column
            $data->makeVisible([
                'email',
                'phone',
                'gender',
                'title',
                'address',
                'google_lat',
                'google_lan',
                'picture',
                'profile',
                'tags',
                'weekend',
                'work_from',
                'work_to',
                'work_from2',
                'work_to2',
                'holiday_from',
                'holiday_to',
                'waiting_time',
                'price',
                'booking_type',
                'reservation_hour',
                'special',
                'promo_code',
                'rate',
                'reviews',
                'general_department_id',
                'country_id',
                'city_id',
                'area_id'
            ])->toArray();
            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

}
