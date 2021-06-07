<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User as User;
use App\Models\Client as Client;
use App\Models\general\NursingDepartment as NursingDepartment;
use App\Models\InsuranceUser as InsuranceUser;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;
use Symfony\Component\Console\Input\Input;
use App\Traits\ResponsesTrait;


class MapController extends Controller
{
    use ResponsesTrait;

    public function index(Request $request)
    {
        try{
            $specialtyId = $request->specialtyId;
            $latitude = $request->latitude;
            $longitude = $request->longitude;

                $data = User::Active()
                ->selectRaw('*, ( 6367 * acos( cos( radians( ? ) ) * cos( radians( google_lat ) ) * cos( radians( google_lan ) - radians( ? ) ) + sin( radians( ? ) ) * sin( radians( google_lat ) ) ) ) AS distance', [$latitude, $longitude, $latitude])
                ->having('distance', '<', 30)

                ->with('cities')
                ->with('areas')
                ->with('generalDepartments')
                ->when(request('generalDepartmentId'), function ($query){
                    $query->where(['general_department_id'=>request('generalDepartmentId')]);
                })
                ->when(request('cityId'), function ($query){
                    $query->where('city_id', request('cityId'));
                })
                ->when(request('areaId'), function ($query){
                    $query->where('area_id', request('areaId'));
                })
                /*
                ->when(request('insuranceId'), function($query) use($insuranceId){
                    $query->whereHas('insuranceUsers', function($query) use($insuranceId){
                        $query->where('insurance_company_id', $insuranceId);
                    });
                })
                ->when(request('usePromoCode'), function ($query){
                    $query->where('promo_code', request('usePromoCode'));
                })
                */
                ->where(['country_id'=>(int) $request->header('Country-Code')])
                ->orderBy('distance')
                ->get();

            //view hidden column
            $data->makeVisible(['google_lat','google_lan', 'user_address', 'picture', 'price']);

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    
}
