<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\City as City;
use \Exception;
use App\Traits\ResponsesTrait;

class CityController extends Controller
{
    use ResponsesTrait;

    public function index(Request $request)
    {
        $data = City::where(['parent_id'=>null, 'active'=>'1', 'country_id'=>(int) $request->header('Country-Code')])->get();
        return $this->success($data, 'result');
    }

    public function getAll(Request $request)
    {
        try{
            $data = City::where(['parent_id'=>null, 'active'=>'1', 'country_id'=>(int) $request->header('Country-Code')])->paginate((int) $request->pageCount);
            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }

    }

    public function show($id)
    {
        try{
            $data = City::findorfail((int) $id);
            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

}
