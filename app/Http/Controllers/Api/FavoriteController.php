<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\User as User;
use App\Models\Offer as Offer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use \Exception;
use App\Traits\ResponsesTrait;

class FavoriteController extends Controller
{
    use ResponsesTrait;

    public function doctors(Request $request)
    {
        try{
            $client = Auth::user();
            $results = Favorite::where(['client_id'=>$client->id, 'type'=>'1'])->get();

            $data = [];
            foreach($results as $result){
                $user = User::where(['id'=>$result->my_favorite_id])
                        ->with('specialties')
                        ->with('cities')
                        ->with('areas')
                        ->with('userParents')
                    ->first();
                $user['favorite_id'] = $result->id;
                $user->makeVisible(['general_department_id', 'user_address', 'price', 'rate', 'reviews', 'picture', 'user_profile']);
                array_push($data, $user);
            }

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function offers(Request $request)
    {
        try{
            $client = Auth::user();
            $results = Favorite::where(['client_id'=>$client->id, 'type'=>'2'])->get();

            $data = [];
            foreach($results as $result){
                $offer = Offer::where(['id'=>$result->my_favorite_id])
                    ->with('offerDepartments')
                    ->with('subOfferDepartments')
                    ->with('cities')
                    ->with('areas')
                    ->with('users')
                    ->first();
                $offer['favorite_id'] = $result->id;
                array_push($data, $offer);
            }

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function add(Request $request)
    {
        try{
            $client = Auth::user();
            $validator = Validator::make($request->all(), [
                'myFavoriteId' => ['required', 'integer'],
                'type' => ['required', 'integer', 'min:1', 'max:2']
            ]);

            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'message');
            }

            $result = Favorite::firstOrCreate(
                ['client_id' => $client->id, 'my_favorite_id' => $request->myFavoriteId, 'type' => $request->type]
            );

            if($result->type == 1){
                $data = User::where(['id'=>$result->my_favorite_id])
                    ->with('specialties')
                    ->with('cities')
                    ->with('areas')
                    ->with('userParents')
                    ->first();
                $data->makeVisible(['general_department_id', 'user_address', 'price', 'rate', 'reviews', 'picture', 'user_profile']);
            }else{
                $data = Offer::where(['id'=>$result->my_favorite_id])
                    ->with('offerDepartments')
                    ->with('subOfferDepartments')
                    ->with('cities')
                    ->with('areas')
                    ->with('users')
                    ->first();
            }
            $data['favorite_id'] = $result->id;

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function delete(Request $request)
    {
        try{
            $client = Auth::user();
            $validator = Validator::make($request->all(), [
                //'favoriteId' => ['required', 'integer', 'exists:favorites,id']
                'myFavoriteId' => ['required', 'integer', 'exists:favorites,my_favorite_id']
            ]);

            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'message');
            }

            //$data = Favorite::destroy($request->favoriteId);
            $data = Favorite::where(['my_favorite_id'=>$request->myFavoriteId, 'type'=>$request->type, 'client_id'=>$client->id])->first();
            $data->delete();
            $message = __('delete-favorite-error');
            return $this->success($message, 'message');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }


}