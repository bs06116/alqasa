<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\Country as Country;
use App\Models\general\GeneralDepartment as GeneralDepartment;
use \Exception;
use App\Traits\ResponsesTrait;

class CountryController extends Controller
{
    use ResponsesTrait;

    public function index(Request $request)
    {
        $countries = Country::Active()->get();
        return $this->success($countries, 'result');
    }

    public function show(Request $request)
    {
        try{
            $country = Country::findOrFail((int) $request->id);
            return $this->success($country, 'result');

        }
        catch(\Exception $e){
            return $this->failed($e->getMessage(),'result');
        }
    }

}
