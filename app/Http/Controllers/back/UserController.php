<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\general\Country;
use App\Models\general\City;
use App\Models\general\GeneralDepartment;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
  use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $title = "المستخدمين";
      $view_title = "عرض المستخدمين";
      $dpage_id = 12;
      $result = User::where('id','!=',1)->orderBy('id','desc')->get();
      return view('back.user.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "المستخدمين";
        $view_title = "اضافة مستخدم ";
        $dpage_id = 12;
        $countries = Country::Active()->get();
        $general_departments = GeneralDepartment::Active()->get();        
		    return view('back.user.add',compact('title','view_title','dpage_id','countries','general_departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
      //validation
      $validator = Validator::make($request->all(), [
        'page_name' => ['required'],
        'page_address' => ['required']
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errorMessage', $validator->errors()->first());
        }
      
      $reservation_prayer_hour = implode(',',$request->page_reservation_prayer_hour);
      $new_data = new User;

      $new_data->name = $request->page_name;
      $new_data->address = $request->page_address;
      $new_data->address_en = $request->page_address_en;
      $new_data->google_lat = $request->lat_google;
      $new_data->google_lan = $request->lng_google;
      $new_data->profile = $request->page_profile;
      $new_data->delivery_price = $request->page_delivery_price;
      $new_data->booking_type = $request->page_booking_type;
      $new_data->reservation_prayer_hour = $reservation_prayer_hour;

      $new_data->country_id = $request->page_country_id;
      $new_data->city_id = $request->page_city_id;
      $new_data->area_id = $request->page_area_id;
      $new_data->general_department_id = $request->page_general_department_id;

      $new_data->special = $request->page_special;
      $new_data->active = $request->page_active;
      $new_data->save();

      return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show Parent
        $result_page = array();
        if($id == 3){
            //Parent form admin
            $result_page = User::where('general_department_id',1)->orWhere('general_department_id',2)->get();
            //Parent for hospital and clinic 
            if($this->userGeneralDepartment == 1 || $this->userGeneralDepartment == 2){
                $result_page = User::Active()->where('id', $this->userId)->get();
            }
        }
        return view('back.user.show',compact('result_page')); 
    }

    public function showAll($id)
    {
        $result_page = User::where('general_department_id',$id)->where('parent_id',null)->with('userChilds')->get();
        return view('back.user.showAll',compact('result_page','id')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $title = "المستخدمين";
      $view_title = "تعديل مستخدم";
      $dpage_id = 12;
      $result_page = User::where('id',$id)->first();
      $countries = Country::Active()->get();
      $cities = City::Active()->where('country_id',$result_page->country_id)->where('parent_id',null)->get();
      $areas = City::Active()->where('parent_id',$result_page->city_id)->get();
      $general_departments = GeneralDepartment::Active()->get();
		  return view('back.user.edit',compact('result_page','title','view_title','dpage_id','countries','cities','areas','general_departments'));
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
      //validation
      $validator = Validator::make($request->all(), [
        'page_name' => ['required'],
        'page_address' => ['required']
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errorMessage', $validator->errors()->first());
        }
      
      $reservation_prayer_hour = implode(',',$request->page_reservation_prayer_hour);
      
      $new_data = User::find($id);

      $new_data->name = $request->page_name;
      $new_data->address = $request->page_address;
      $new_data->address_en = $request->page_address_en;
      $new_data->google_lat = $request->lat_google;
      $new_data->google_lan = $request->lng_google;
      $new_data->profile = $request->page_profile;
      $new_data->delivery_price = $request->page_delivery_price;
      $new_data->booking_type = $request->page_booking_type;
      $new_data->reservation_prayer_hour = $reservation_prayer_hour;

      $new_data->country_id = $request->page_country_id;
      $new_data->city_id = $request->page_city_id;
      $new_data->area_id = $request->page_area_id;
      $new_data->general_department_id = $request->page_general_department_id;

      $new_data->special = $request->page_special;
      $new_data->active = $request->page_active;
      $new_data->save();

      return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = User::find($id);
      if($new_data->icon != ""){
        $folder_path = public_path($new_data->icon);
        @unlink($folder_path);
      }
      $new_data->delete();
      return redirect(route('user.index'));
    }
}
