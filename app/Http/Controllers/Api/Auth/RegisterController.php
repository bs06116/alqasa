<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\general\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Requests\Api\RegisterRequest;
use \Exception;
use App\Traits\ResponsesTrait;
use App\Traits\SmsTrait;

class RegisterController extends Controller
{
    use ResponsesTrait, SmsTrait;
    public $successStatus = 200;

    public function register(RegisterRequest $request)
    {
        try{
            if (isset($request->validator) && $request->validator->fails()) {
                return $this->failed($request->validator->errors()->first(), 'message');
            }

            $country_id = $request->header('Country-Code');
            $country = Country::findOrFail((int) $country_id);
            $phone_code = (string) rand(100000, 999999);
            $client = Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'login_type' => $request->login_type,
                'google_lat' => $request->google_lat,
                'google_lon' => $request->google_lon,
                'device_id' => $request->device_id,
                'phone_code' => $phone_code,
                'country_id' => $country_id,
                'city_id' => null,
                'area_id' => null
            ]);
            $client['token'] =  $client->createToken('MyApp')-> accessToken;

            //send sms
            $smsPhone = $country->country_code.$request->phone;
            $smsMessage = 'Doctors code is:' . $phone_code;
            $this->sendSMS($smsPhone, $smsMessage);

            return $this->success($client, 'result');
        }catch(\Exception $e){
            $message = __('register-error');
            return $this->failed($message, 'message');
        }
    }

    public function validatePhone(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'exists:clients,phone'],
                'phone_code' => ['required' ,'size:6', 'exists:clients,phone_code']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'message');
            }

            //check code
            $checkCode = Client::where(['phone'=>$request->phone, 'phone_code'=>$request->phone_code, 'validate_phone_code'=>'0'])->firstOrFail();
            if(isset($checkCode)){
                $client = Client::where('id',$checkCode->id)->update([
                    'active' => "1",
                    'validate_phone_code' => "1",
                ]);
                return $this->success($checkCode, 'result');
            }
        }catch(\Exception $e){
            $message = __('general-validate-phone-error');
            return $this->failed($message, 'message');
        }
    }

    public function resentCode(Request $request)
    {
        try{
           //validation
            $validator = Validator::make($request->all(), [
                'phone' => ['required','exists:clients,phone']
            ]);
              
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $checkCode = Client::where(['validate_phone_code'=>"0", 'phone'=>$request->phone])->first();
            if(isset($checkCode)){
                //send sms
                $country_id = $request->header('Country-Code');
                $country = Country::findOrFail((int) $country_id);
                $smsPhone = $country->country_code.$request->phone;
                $smsMessage = 'Doctors code is:' . $checkCode->phone_code;
                $this->sendSMS($smsPhone, $smsMessage);
                return $this->success($checkCode, 'result');
            }else{
                $message = __('general-validate-phone-error');
                return $this->success($message, 'result');
            }
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function registerWithSocial(Request $request)
    {
        try{
            $country_id = $request->header('Country-Code');
            $country = Country::findOrFail((int) $country_id);

            //check social token
            $client = Client::firstOrCreate(
                ['social_token'=>$request->social_token, 'login_type'=>$request->login_type],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'google_lat' => $request->google_lat,
                    'google_lon' => $request->google_lon,
                    'device_id' => $request->device_id,
                    'active' => "1",
                    'country_id' => $country_id,
                    'city_id' => null,
                    'area_id' => null
                ]
            );
            $client['token'] = $client->createToken('MyApp')->accessToken;
            return $this->success($client, 'result');
        }catch(\Exception $e){
            $message = __('register-error');
            return $this->failed($message, 'message');
        }
    }

}
