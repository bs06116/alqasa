<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation as Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Traits\ResponsesTrait;

class DateController extends Controller
{
    use ResponsesTrait;

    public function myReservations(Request $request)
    {
        try{
            //validation
            $validator = Validator::make($request->all(), [
                'deviceId' => ['required', 'exists:clients,device_id']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $clientDetails = Client::where('device_id',$request->deviceId)->firstOrFail();
            $results = Reservation::where(['client_id'=>$clientDetails->id])
                ->with('reservationDetails')
                ->with('reservationDetails.products')
                ->where('active','1')
                ->orderBy('reservation_date','asc')->get();

            return $this->success($results, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }


}
