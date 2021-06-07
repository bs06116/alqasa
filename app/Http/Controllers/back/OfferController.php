<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\OfferDepartment;
use App\Models\general\Country;
use App\Models\general\City;
use App\Models\general\GeneralDepartment;
use App\Models\User;
use App\Models\Offer;
use App\Models\OfferGallery;
use App\Traits\FileUploadTrait;
use Auth;

class OfferController extends Controller
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
		$result = Offer::orderBy('id','desc')->get();
		return view('back.offer.index',compact('result','title','view_title','dpage_id'));
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
        $offer_departments = OfferDepartment::where('parent_id',null)->Active()->get();
        $general_departments = GeneralDepartment::Active()->get();        
		return view('back.offer.add',compact('title','view_title','dpage_id','countries','offer_departments','general_departments'));
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
        'page_name_en'=>'required',
        //'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'page_gallery[]' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      
      /*$img_name= "";
      if($request->hasFile('page_picture')){
        $img_name = $this->uploadFile($request->file('page_picture'),'Offer');
      }*/

      //add gallery
      $img_name= "";
      if($request->hasFile('page_gallery')){ 
        $gallery = [];
        foreach($request->file('page_gallery') as $pic){
          $img_name = $this->uploadFile($pic,'Offer');
          array_push($gallery,$img_name);
        }
        $img_name = implode(',',$gallery);
      }
      
      $new_data = new Offer;

      $new_data->country_id = $request->page_country_id;
      $new_data->city_id = $request->page_city_id;
      $new_data->area_id = $request->page_area_id;
      $new_data->offer_department_id = $request->page_offer_department_id;
      $new_data->sub_offer_department_id = $request->page_offer_subdepartment_id;
      $new_data->general_department_id = $request->page_general_department_id;
      $new_data->user_id = $request->page_user_id;
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->details = $request->page_details;
      $new_data->details_en = $request->page_details_en;
      $new_data->information = $request->page_information;
      $new_data->information_en = $request->page_information_en;
      $new_data->picture = $img_name;
      $new_data->discount_percent = $request->page_discount_percent;
      $new_data->price_before = $request->page_price_before;
      $new_data->price_after = $request->page_price_after;
      $new_data->promo_code = $request->page_promo_code;
      $new_data->special = $request->page_special;
      $new_data->active = $request->page_active;
      $new_data->save();
      
      return redirect(route('offer.index'));
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
        $result_page = Offer::where('id',$id)->first();
        $countries = Country::Active()->get();
        $cities = City::Active()->where('country_id',$result_page->country_id)->where('parent_id',null)->get();
        $areas = City::Active()->where('parent_id',$result_page->city_id)->get();
        $offer_departments = OfferDepartment::where('parent_id',null)->Active()->get();
        $offer_sub_departments = OfferDepartment::where('parent_id',$result_page->offer_department_id)->Active()->get();
        $general_departments = GeneralDepartment::Active()->get();    
        $users = User::Active()->where('general_department_id',$result_page->general_department_id)->with('userChilds')->get();    
        $gallery = OfferGallery::where('offer_id',$result_page->id)->first();    
	    return view('back.offer.edit',compact('result_page','title','view_title','dpage_id','countries','cities','areas','offer_departments','offer_sub_departments','general_departments','users','gallery'));
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
            'page_name_en'=>'required',
            //'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'page_gallery[]' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
          ]);

      $new_data = Offer::find($id);

      $img_name = $new_data->picture;
      if($request->hasFile('page_gallery')){

        //delete old pictures
        if($img_name != ""){
          $pictures = explode(',',$img_name);
            foreach($pictures as $pic){
                $folder_path = public_path($pic);
                @unlink($folder_path);
            }
        } 

        $gallery = [];
        foreach($request->file('page_gallery') as $pic){
          $img_name = $this->uploadFile($pic,'Offer');
          array_push($gallery,$img_name);
        }
        $img_name = implode(',',$gallery);
      }

      $new_data->country_id = $request->page_country_id;
      $new_data->city_id = $request->page_city_id;
      $new_data->area_id = $request->page_area_id;
      $new_data->offer_department_id = $request->page_offer_department_id;
      $new_data->sub_offer_department_id = $request->page_offer_subdepartment_id;
      $new_data->general_department_id = $request->page_general_department_id;
      $new_data->user_id = $request->page_user_id;
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->details = $request->page_details;
      $new_data->details_en = $request->page_details_en;
      $new_data->information = $request->page_information;
      $new_data->information_en = $request->page_information_en;
      $new_data->picture = $img_name;
      $new_data->discount_percent = $request->page_discount_percent;
      $new_data->price_before = $request->page_price_before;
      $new_data->price_after = $request->page_price_after;
      $new_data->promo_code = $request->page_promo_code;
      $new_data->special = $request->page_special;
      $new_data->active = $request->page_active;
      $new_data->save();

      //add gallery
      /*if($request->hasFile('page_gallery')){
          $gallery = [];
          foreach($request->file('page_gallery') as $pic){
            $img_name = $this->uploadFile($pic,'OfferGallery');
            array_push($gallery,$img_name);
          }

          $offer_gallery = implode(',',$gallery);
          
          $new_gallery = OfferGallery::where('offer_id',$id)->first();
          $new_gallery->user_id = $request->page_user_id;
          $new_gallery->offer_id = $new_data->id;
          $new_gallery->picture = $offer_gallery;
          $new_gallery->save();
      }*/

      return redirect(route('offer.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = Offer::find($id);

      //pictures
      if($new_data->picture != ""){
        $pictures = explode(',',$new_data->picture);
        foreach($pictures as $pic){
              $folder_path = public_path($pic);
              @unlink($folder_path);
          }
      }   

      $new_data->delete();
      return redirect(route('offer.index'));
    }

    public function active($id)
    {
        $new_data = Offer::find($id);
        $offerActive = '1';
        if($new_data->active == '1'){$offerActive = '0';}
        $new_data->active = $offerActive;
        $new_data->save();
        return redirect(route('offer.index'));
    }
}
