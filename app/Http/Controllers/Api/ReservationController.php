<?php

namespace App\Http\Controllers\Api;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation as Reservation;
use App\Models\User as User;
use App\Models\Client as Client;
use App\Models\Product as Product;
use App\Models\ReservationDetails as ReservationDetails;
use App\Models\general\PromoCode as PromoCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;
use App\Traits\ResponsesTrait;
use App\Traits\BookyTrait;
use Symfony\Component\Console\Input\Input;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReservationController extends Controller
{
    use ResponsesTrait, BookyTrait;

    public function add(Request $request)
    {
        try{
            //validation
            $validator = Validator::make($request->all(), [
                'userId' => ['required', 'integer', 'exists:users,id'],
                'deviceId' => ['required'],
                'productId' => ['required', 'integer', 'exists:products,id']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            //clients details
            $clientDetails = Client::firstOrCreate(
                ['device_id' => $request->deviceId],
                ['country_id' => 2]
            );

            //product details
            $productDetials = Product::where('id',$request->productId)->first();
            $price = $productDetials->price_after;
            $count = $request->limit;
            $totalPrice = $price * $count;

            //user details
            $userDetials = User::where('id',$request->userId)->first();
            $delivery = $userDetials->delivery_price;

            //add reservation
            $last_bill = Reservation::orderBy('id', 'desc')->first();
            if($last_bill){$bill_number = (int) $last_bill->bill_number + 1;}else{$bill_number = 1500;}
            $time = time();
            $addReservation = Reservation::firstOrCreate(
                ['client_id' => $clientDetails->id, 'active' => '0'],
                [
                //user information
                    'country_id' => $userDetials->country_id,
                    'city_id' => $userDetials->city_id,
                    'area_id' => $userDetials->area_id,
                    'user_id' => $request->userId,
                    'delivery' => $delivery,
                    'bill_number' => $bill_number,
                    'payment_hash_mac' => $time
                ]
            );

            $data = ReservationDetails::where(['reservation_id'=>$addReservation->id, 'product_id'=>$productDetials->id])->first();

            if($data){
                $price = $data->price;
                $count = $request->limit + $data->count;
                $totalPrice = $price * $count;
            }

            $addResevationDetails = ReservationDetails::updateOrCreate(
                ['reservation_id' => $addReservation->id, 'product_id' => $productDetials->id],
                ['price' => $price, 'count' => $count, 'total_price' => $totalPrice]
            );

            $addReservation['reservation_details'] = ReservationDetails::where('reservation_id',$addReservation->id)->get();

            return $this->success($addReservation, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function viewItem(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'deviceId' => ['required', 'exists:clients,device_id']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $deviceId = $request->deviceId;

            $data = Reservation::query()
            ->whereHas('clients', function($query) use($deviceId){
                $query->where('device_id',$deviceId);
            })
            ->where('active','0')
            ->with('reservationDetails')
            ->with('reservationDetails.products')
            ->get();

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function editItem(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'reservationId' => ['required', 'integer', 'exists:reservations,id'],
                'reservationDetailsId' => ['required', 'integer', 'exists:reservation_details,id']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $data = ReservationDetails::where('id', $request->reservationDetailsId)->first();
            $total_price = $data->price * $request->limit;

            $data->update([
                'count' => $request->limit,
                'total_price' => $total_price
            ]);

            $message = __('edit-reservation-error');
            return $this->success($message, 'message');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function deleteItem(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'reservationId' => ['required', 'integer', 'exists:reservations,id'],
                'reservationDetailsId' => ['required', 'integer', 'exists:reservation_details,id']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $data = ReservationDetails::destroy($request->reservationDetailsId);
            $message = __('delete-reservation-error');
            return $this->success($message, 'message');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function delete(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'reservationId' => ['required', 'integer', 'exists:reservations,id']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $data = Reservation::findOrFail($request->reservationId);
            $data->forceDelete();

            $message = __('delete-reservation-error');
            return $this->success($message, 'message');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function check_promocode(Request $request)
    {
        try{
            //validation
            $validator = Validator::make($request->all(), [
                'reservationID' => ['required', 'integer', 'exists:reservations,id'],
                'deviceId' => ['required', 'exists:clients,device_id'],
                'name' => ['required', 'exists:promo_codes,name']
            ]);

            if($request->promoCode){
                //$promoCode = PromoCode::where('name',$request->promoCode)->CheckPromoWithPrice($result->price)->firstOrFail()->id;
                $promoCode = PromoCode::where('name',$request->promoCode)->first();
                if(!$promoCode){$message = __("promo-code-error"); return $this->success($message, 'result');}
            }

            //edit reservation
            $editReservation = Reservation::where('id',$request->reservationID)->update([
                'promo_code_id' => $promoCode->id,
            ]);

            $result = Reservation::where('id',$request->reservationID)->with('reservationDetails')->first();

            return $this->success($result, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function finish(Request $request)
    {
        try{
            //validation
            $validator = Validator::make($request->all(), [
                'reservationID' => ['required', 'integer', 'exists:reservations,id'],
                'deviceId' => ['required', 'exists:clients,device_id'],
                'name' => ['required', 'string'],
                'phone' => ['required'],
                'reservationDate' => ['required', 'date'],
                'paymentMethod' => ['required', 'integer']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            //user details
            $reservationPrayerHour = null;
            $reservationPrayerHourTime = null;
            $reservationTime = null;
            $promoCode = null;
            $notes = null;

            if($request->reservationPrayerHour){
                $reservationPrayerHour = $request->reservationPrayerHour;
            }

            if($request->reservationPrayerHourTime){
                $reservationPrayerHourTime = $request->reservationPrayerHourTime;
            }

            if($request->reservationTime){
                $reservationTime = $request->reservationTime;
            }

            if($request->notes){
                $notes = $request->notes;
            }

            //clients details
            $clientDetails = Client::where('device_id', $request->deviceId)->update([
                'name' => $request->name,
                'phone' => $request->phone
            ]);

            $time = time();
            //edit reservation
            $editReservation = Reservation::where('id',$request->reservationID)->update([
                'reservation_time' => $reservationTime,
                'reservation_date' => $request->reservationDate,
                'reservation_prayer_hour' => $reservationPrayerHour,
                'reservation_prayer_hour_time' => $reservationPrayerHourTime,
                'notes' => $notes,
                'payment_method' => $request->paymentMethod,
                'payment_hash_mac' => $time
                //'payment_active' => 1,
                //'active' => '1'
            ]);

            if($request->paymentMethod == 2 || $request->paymentMethod == 3)
            {
                $result_details = Reservation::where('id',$request->reservationID)->with('reservationDetails')->first();
                
                return $add_payment = $this->addPaymentBooky($request->paymentMethod,$result_details->total_price,$result_details->bill_number,$result_details->payment_hash_mac);
            }else{
                //edit reservation
                $editReservation = Reservation::where('id',$request->reservationID)->update([
                    'active' => '1'
                ]);
                $result = Reservation::where('id',$request->reservationID)->with('reservationDetails')->get();
                return $this->success($result, 'result');
            }

        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }
    
    public function countItem(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'deviceId' => ['required', 'exists:clients,device_id']
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $deviceId = $request->deviceId;

            $result = ReservationDetails::query()
                ->whereHas('reservations', function($query) use($deviceId){
                    $query->where(['active'=>'0']);
                    $query->whereHas('clients', function($query) use($deviceId){
                        $query->where('device_id',$deviceId);
                        });
                })
                ->count();

            return $this->success($result, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function payment_success(Request $request)
    {
        $payment_hash_mac = $request->merchantTxnId;
        $update_payment_active = Reservation::where(['payment_hash_mac' => $payment_hash_mac])->update([
            'payment_active' => '1',
            'active' => '1'
        ]);
        $result = "Thanks, Bayment add done";
        return $this->success($result, 'result');
    }

    public function payment_failure(Request $request)
    {
        $payment_hash_mac = $request->merchantTxnId;
        $update_payment_active = Reservation::where(['payment_hash_mac' => $payment_hash_mac])->update([
            'payment_active' => '2',
            'active' => '1'
        ]);
        $result = "Sorry, Bayment is faild, please try again";
        return $this->success($result, 'result');
    }

    public function test_bayment()
    {
        return $this->getPaymentBooky();
    }

}
