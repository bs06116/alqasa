<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client as Client;
use App\Models\general\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Traits\ResponsesTrait;
use App\Traits\FileUploadTrait;
use App\Traits\SmsTrait;

//use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    use ResponsesTrait, FileUploadTrait, SmsTrait;

    public function profile()
    {
        try{
            $client = Auth::user();
            $client['medical_reports'] = $client->medicalReports()->get();
            return $this->success($client, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function editProfile(Request $request)
    {
        try{
            $client = Auth::user();
           //validation
            $validator = Validator::make($request->all(), [
                'name' => ['required'],
                'email' => ['required','unique:clients,email,'.$client->id.',id'],
                //to use it work with -> use Illuminate\Validation\Rule;
                //'email' => ['required',Rule::unique('clients')->ignore($client->id)],
            ]);
              
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            //picture
            $img_name= $client->picture;
            if($request->hasFile('picture')){
                $img_name = $this->uploadFile($request->picture,'Client');
                $folder_path = public_path($client->picture);
                @unlink($folder_path);
            }

            $result = Client::where('id',$client->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'google_lat' => $request->google_lat,
                'google_lon' => $request->google_lon,
                'address' => $request->address,
                'picture' => $img_name
            ]);
            $data = client::where(['id'=>$client->id])->first();
            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function editPass(Request $request)
    {
        try{
            $client = Auth::user();
           //validation
            $validator = Validator::make($request->all(), [
                'password' => ['required','confirmed']
            ]);
              
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $result = Client::where('id',$client->id)->update([
                'password' => Hash::make($request->password),
            ]);
            $data = client::where(['id'=>$client->id])->first();
            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function editPhone(Request $request)
    {
        try{
            $client = Auth::user();
            //validation
            $validator = Validator::make($request->all(), [
                //'phone' => ['required','unique:clients,phone,'.$client->id.',id'],
                'another_phone' => ['required','unique:clients,phone,'.$client->id.',id']
            ]);

            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $country_id = $request->header('Country-Code');
            $country = Country::findOrFail((int) $country_id);
            $phone_code = (string) rand(100000, 999999);

            $result = Client::where('id',$client->id)->update([
                'another_phone' => $request->another_phone,
                'another_phone_code' => $phone_code,
            ]);

            //send sms
            $smsPhone = $country->country_code.$request->another_phone;
            $smsMessage = 'Doctors code is:' . $phone_code;
            $this->sendSMS($smsPhone, $smsMessage);

            $data = client::where(['id'=>$client->id])->first();
            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function validatePhone(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'another_phone' => ['required', 'exists:clients,another_phone'],
                'another_phone_code' => ['required' ,'size:6', 'exists:clients,another_phone_code']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'message');
            }

            //check code
            $checkCode = Client::where(['another_phone'=>$request->another_phone, 'another_phone_code'=>$request->another_phone_code, 'validate_another_phone_code'=>'0'])->firstOrFail();
            if(isset($checkCode)){
                $client = Client::where('id',$checkCode->id)->update([
                    'phone' => $request->another_phone,
                    'validate_another_phone_code' => "1",
                ]);
                $checkCode['phone'] = $request->another_phone;
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
                'another_phone' => ['required','exists:clients,another_phone']
            ]);

            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $checkCode = Client::where(['validate_another_phone_code'=>"0", 'another_phone'=>$request->another_phone])->first();
            if(isset($checkCode)){
                //send sms
                $country_id = $request->header('Country-Code');
                $country = Country::findOrFail((int) $country_id);
                $smsPhone = $country->country_code.$request->another_phone;
                $smsMessage = 'Doctors code is:' . $checkCode->another_phone_code;
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

}
