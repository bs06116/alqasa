<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\general\Country;
use App\Models\general\City;
use App\Models\User;
use App\Models\Product;
use App\Traits\FileUploadTrait;
use Auth;

class ProductController extends Controller
{

  use FileUploadTrait;

  protected $userGeneralDepartment;
  protected $userId;

  public function __construct()
  {
    $this->middleware(function ($request, $next) {
        $this->userId = Auth::user()->id;
        $this->userGeneralDepartment = Auth::user()->general_department_id;
        return $next($request);
    });
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = "العروض";
		$view_title = "عرض العروض";
		$dpage_id = 13;
		$result = Product::orderBy('id','desc')->get();
		return view('back.product.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = "العروض";
		$view_title = "اضافة عرض ";
        $dpage_id = 13;
        $countries = Country::Active()->get();
        $departments = Department::where('parent_id',null)->Active()->get();
		return view('back.product.add',compact('title','view_title','dpage_id','countries','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
      $validateDate = $request->validate([
        'page_name'=>'required',
        'page_min_limit'=>'required',
        'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //'page_gallery[]' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      
      $img_name= "";
      if($request->hasFile('page_picture')){
        $img_name = $this->uploadFile($request->file('page_picture'),'Product');
      }

      $new_data = new Product;

      $new_data->country_id = $request->page_country_id;
      $new_data->city_id = $request->page_city_id;
      $new_data->area_id = $request->page_area_id;
      $new_data->department_id = $request->page_department_id;
      $new_data->name = $request->page_name;
      $new_data->details = $request->page_details;
      $new_data->picture = $img_name;
      $new_data->discount_percent = $request->page_discount_percent;
      $new_data->price_before = $request->page_price_before;
      $new_data->price_after = $request->page_price_after;
      $new_data->promo_code = $request->page_promo_code;
      $new_data->special = $request->page_special;
      $new_data->min_limit = $request->page_min_limit;
      $new_data->size = $request->page_size;
      $new_data->active = $request->page_active;
      $new_data->save();
      
      return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "العروض";
        $view_title = "تعديل عرض";
        $dpage_id = 13;
        $result_page = Product::where('id',$id)->first();
        $countries = Country::Active()->get();
        $cities = City::Active()->where('country_id',$result_page->country_id)->where('parent_id',null)->get();
        $areas = City::Active()->where('parent_id',$result_page->city_id)->get();
        $departments = Department::where('parent_id',null)->Active()->get();
	    return view('back.product.edit',compact('result_page','title','view_title','dpage_id','countries','cities','areas','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateDate = $request->validate([
            'page_name'=>'required',
            'page_min_limit'=>'required',
            'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //'page_gallery[]' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $img_name= "";
        if($request->hasFile('page_picture')){
            $img_name = $this->uploadFile($request->file('page_picture'),'Product');
        }

        $new_data = Product::find($id);

        $new_data->country_id = $request->page_country_id;
        $new_data->city_id = $request->page_city_id;
        $new_data->area_id = $request->page_area_id;
        $new_data->department_id = $request->page_department_id;
        $new_data->name = $request->page_name;
        $new_data->details = $request->page_details;
        $new_data->picture = $img_name;
        $new_data->discount_percent = $request->page_discount_percent;
        $new_data->price_before = $request->page_price_before;
        $new_data->price_after = $request->page_price_after;
        $new_data->promo_code = $request->page_promo_code;
        $new_data->special = $request->page_special;
        $new_data->min_limit = $request->page_min_limit;
        $new_data->size = $request->page_size;
        $new_data->active = $request->page_active;
        $new_data->save();

        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = Product::find($id);
      //pictures
      if($new_data->picture != ""){
          $folder_path = public_path($new_data->picture);
          @unlink($folder_path);
      }
      $new_data->delete();
      return redirect(route('product.index'));
    }

    public function active($id)
    {
        $new_data = Product::find($id);
        $productActive = '1';
        if($new_data->active == '1'){$productActive = '0';}
        $new_data->active = $productActive;
        $new_data->save();
        return redirect(route('product.index'));
    }
}
