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


class UserController extends Controller
{
    use ResponsesTrait;

    public function index(Request $request)
    {
        try{
            $data = User::query()->Active()
                ->when(request('generalDepartmentId'), function ($query){
                    $query->where('general_department_id',request('generalDepartmentId'));
                })
                ->when(request('searchName'), function ($query){
                    $query->where('name', 'like', '%'.request('searchName').'%')
                          ->orWhere('name_en', 'like', '%'.request('searchName').'%');
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
                ->where(['country_id'=>(int) $request->header('Country-Code')])
                ->get();

            //view hidden column
            $data->makeVisible(['user_address', 'picture', 'price']);

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function getAll(Request $request)
    {
        try{
            $insuranceId = $request->insuranceId;
            $data = User::query()->Active()
                ->when(request('generalDepartmentId'), function ($query){
                    $query->where('general_department_id',request('generalDepartmentId'));
                })
                ->when(request('searchName'), function ($query){
                    $query->where('name', 'like', '%'.request('searchName').'%')
                        ->orWhere('name_en', 'like', '%'.request('searchName').'%');
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
                ->where(['country_id'=>(int) $request->header('Country-Code')])
                ->paginate($request->pageCount);
            //view hidden column
            $data->makeVisible(['user_address', 'picture', 'price']);

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function show(request $request)
    {
        try{
            //$parentId = $request->parentId;
            $data = User::query()->Active()
                ->with('cities')
                ->with('areas')
                ->with('generalDepartments')
                ->findOrFail($request->id);

            //favorite
            $data['is_favorite'] = 0;
            $client_id = auth()->guard('api')->id();
            if (isset($client_id)) {
                $userid = $data->id;
                $checkFavorite = Client::query()->whereHas('favorites', function($query) use($userid){
                    $query->where(['my_favorite_id'=>$userid, 'type'=>1]);
                })->where('id', $client_id)->first();
                if(isset($checkFavorite->id)){
                    $data['is_favorite'] = 1;
                }
            }

            //view hidden column
            $data->makeVisible([
                'google_lat',
                'google_lan',
                'special',
                'rate',
                'reviews',
                'visits',
                //'reservation_hour',
                'general_department_id',
                'country_id',
                'city_id',
                'area_id'
            ])->toArray();

            //add user visit
            $newVisit = $data->visits + 1;
            $addUserVisit = User::where('id', $request->id)->update(['visits'=>$newVisit]);

            return $this->success($data, 'result');

        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

}
