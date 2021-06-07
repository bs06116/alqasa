<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\general\Country;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;
use App\Traits\ResponsesTrait;
use App\Traits\SmsTrait;

class LoginController extends Controller
{
    use ResponsesTrait, SmsTrait;
    public $successStatus = 200;

    protected function guard()
    {
        return Auth::guard('client');
    }

    public function login(Request $request)
    {
        if($this->guard()->attempt(['phone' => $request->phone, 'password' => $request->password, 'active' => "1"])){
            $user = $this->guard()->user();

            //edit device id
            $editDevice = Client::where('id', $user->id)->update([
                'device_id' => $request->device_id
            ]);

            $user['token'] =  $user->createToken('MyApp')-> accessToken;
            return $this->success($user,'result');
        }
        else{
            $message = __('auth-error');
            return $this->failed($message, 'message');
        }
    }

    public function forgetPassword(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'exists:clients,phone']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'message');
            }

            //create code
            $country_id = $request->header('Country-Code');
            $country = Country::findOrFail((int) $country_id);
            $forget_code = (string) rand(100000, 999999);

            $client = Client::where(['phone'=>$request->phone, 'active'=>'1'])->firstOrFail();
            if(isset($client)){
                $editCode = Client::where('id', $client->id)->update([
                   'forget_code' => $forget_code
                ]);

                //send sms
                $smsPhone = $country->country_code.$request->phone;
                $smsMessage = 'Doctors code is:' . $forget_code;
                $this->sendSMS($smsPhone, $smsMessage);

                $data = ['phone' => $request->phone, 'forget_code' => $forget_code];
                return $this->success($data, 'result');
            }
        }catch(\Exception $e){
            $message = __('general-validate-phone-error');
            return $this->failed($message, 'message');
        }
    }

    public function validateForget(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'exists:clients,phone'],
                'forget_code' => ['required' ,'size:6', 'exists:clients,forget_code']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'message');
            }

            //check code
            $checkCode = Client::where(['phone'=>$request->phone, 'forget_code'=>$request->forget_code])->firstOrFail();
            if(isset($checkCode)){
                $client = Client::where('id',$checkCode->id)->update([
                    'validate_forget_code' => "1"
                ]);
                return $this->success($checkCode, 'result');
            }
        }catch(\Exception $e){
            $message = __('general-validate-phone-error');
            return $this->failed($message, 'message');
        }
    }

    public function changePassword(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'phone' => ['required', 'exists:clients,phone'],
                'forget_code' => ['required' ,'size:6', 'exists:clients,forget_code'],
                'password' => ['required' , 'confirmed']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'message');
            }

            //check code
            $checkCode = Client::where(['phone'=>$request->phone, 'forget_code'=>$request->forget_code, 'validate_forget_code'=>'1'])->firstOrFail();
            if(isset($checkCode)){
                $client = Client::where('id',$checkCode->id)->update([
                    'password' => Hash::make($request->password)
                ]);
                return $this->success($checkCode, 'result');
            }

        }catch(\Exception $e){
            $message = __('change-password-error');
            return $this->failed($message, 'message');
        }
    }



}
