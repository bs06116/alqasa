<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\Advertisement as Advertisement;
use App\Models\User as User;
use App\Models\Client as Client;
use \Exception;
use App\Traits\ResponsesTrait;
use Symfony\Component\Console\Input\Input;

class AdvertisementController extends Controller
{
    use ResponsesTrait;

    public function index(Request $request)
    {
        try{
            $today = date('Y-m-d');
            $data = Advertisement::query()->Active()
                ->with('cities')
                ->with('areas')
                ->with('departments')
                ->with('products')
                ->when(request('cityId'), function ($query){
                    $query->where('city_id', request('cityId'));
                })
                ->when(request('areaId'), function ($query){
                    $query->where('area_id', request('areaId'));
                })
                ->where(['country_id'=>(int) $request->header('Country-Code')])
                ->where('from_date','<=',$today)
                ->where('to_date','>=',$today)
                ->get();
            //view hidden column
            //$data->makeVisible(['user_address', 'price', 'rate', 'reviews', 'picture', 'user_profile']);

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function getAll(Request $request)
    {
        try{
            $today = date('Y-m-d');
            $data = Advertisement::query()->Active()
                ->with('cities')
                ->with('areas')
                ->with('departments')
                ->with('products')
                ->when(request('cityId'), function ($query){
                    $query->where('city_id', request('cityId'));
                })
                ->when(request('areaId'), function ($query){
                    $query->where('area_id', request('areaId'));
                })
                ->where(['country_id'=>(int) $request->header('Country-Code')])
                ->where('from_date','<=',$today)
                ->where('to_date','>=',$today)
                ->paginate($request->pageCount);
            //view hidden column
            //$data->makeVisible(['user_address', 'price', 'rate', 'reviews', 'picture', 'user_profile']);

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function show(request $request)
    {
        try{
            $data = Advertisement::query()->Active()
                ->with('cities')
                ->with('areas')
                ->with('departments')
                ->with('products')
                ->findOrFail($request->id);

            //add user visit
            $newVisit = $data->visits + 1;
            $addUserVisit = Advertisement::where('id', $request->id)->update(['visits'=>$newVisit]);

            return $this->success($data, 'result');

        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

}
