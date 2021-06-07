<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product as Product;
use App\Models\User as User;
use App\Models\Client as Client;
use \Exception;
use App\Traits\ResponsesTrait;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    use ResponsesTrait;

    public function index(Request $request)
    {
        try{
            //$generalDepartmentId = $request->generalDepartmentId;
            //$subProductDepartmentId = $request->subProductDepartmentId;

            $data = Product::query()->Active()
                ->with('departments')
                //->with('subProductDepartments')
                ->with('cities')
                ->with('areas')

                ->when(request('productDepartmentId'), function ($query){
                    $query->where('department_id', request('productDepartmentId'));
                })
                /*->when(request('subProductDepartmentId'), function ($query){
                    $query->where('sub_department_id', request('subProductDepartmentId'));
                })*/
                ->when(request('searchName'), function ($query){
                    $query->where('name', 'like', '%'.request('searchName').'%')
                        ->orWhere('name_en', 'like', '%'.request('searchName').'%');
                })
                ->when(request('cityId'), function ($query){
                    $query->where('city_id', request('cityId'));
                })
                ->when(request('areaId'), function ($query){
                    $query->where('area_id', request('areaId'));
                })
                ->when(request('usePromoCode'), function ($query){
                    $query->where('promo_code', request('usePromoCode'));
                })
                ->when(request('priceFrom') and request('priceTo'), function ($query){
                    $query->whereBetween('price_after', [request('priceFrom'),request('priceTo')]);
                })
                ->when(request('discountPercent'), function ($query){
                    $query->where('discount_percent', request('discountPercent'));
                })
                ->when(request('sortFilter'), function($query){
                    $query->SortFilters(request('sortFilter'));
                })
                ->where(['country_id'=>(int) $request->header('Country-Code')])
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
            $data = Product::query()->Active()
                ->with('departments')
                //->with('subProductDepartments')
                ->with('cities')
                ->with('areas')

                ->when(request('productDepartmentId'), function ($query){
                    $query->where('department_id', request('productDepartmentId'));
                })
                /*->when(request('subProductDepartmentId'), function ($query){
                    $query->where('sub_department_id', request('subProductDepartmentId'));
                })*/
                ->when(request('searchName'), function ($query){
                    $query->where('name', 'like', '%'.request('searchName').'%')
                        ->orWhere('name_en', 'like', '%'.request('searchName').'%');
                })
                ->when(request('cityId'), function ($query){
                    $query->where('city_id', request('cityId'));
                })
                ->when(request('areaId'), function ($query){
                    $query->where('area_id', request('areaId'));
                })
                ->when(request('usePromoCode'), function ($query){
                    $query->where('promo_code', request('usePromoCode'));
                })
                ->when(request('priceFrom') and request('priceTo'), function ($query){
                    $query->whereBetween('price_after', [request('priceFrom'),request('priceTo')]);
                })
                ->when(request('discountPercent'), function ($query){
                    $query->where('discount_percent', request('discountPercent'));
                })
                ->when(request('sortFilter'), function($query){
                    $query->SortFilters(request('sortFilter'));
                })
                ->where(['country_id'=>(int) $request->header('Country-Code')])
                ->paginate($request->pageCount);

            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

    public function show(request $request)
    {
        try{
            $data = Product::query()->Active()
                ->with('departments')
                //->with('subProductDepartments')
                ->with('cities')
                ->with('areas')
                ->findOrFail($request->id);
            //view hidden column
            $data->makeVisible([
                'product_details',
                'product_information',
            ])->toArray();

            //favorite
            $data['is_favorite'] = 0;
            $client_id = auth()->guard('api')->id();
            if (isset($client_id)) {
                $userid = $data->id;
                $checkFavorite = Client::query()->whereHas('favorites', function($query) use($userid){
                    $query->where(['my_favorite_id'=>$userid, 'type'=>2]);
                })->where('id', $client_id)->first();
                if(isset($checkFavorite->id)){
                    $data['is_favorite'] = 1;
                }
            }

            //add user visit
            $newVisit = $data->visits + 1;
            $addUserVisit = Product::where('id', $request->id)->update(['visits'=>$newVisit]);

            return $this->success($data, 'result');

        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

}
