<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationDetails;
use App\Models\Client;
use App\Models\general\Country;
use App\Models\general\City;
use App\Models\general\GeneralDepartment;

use App\Traits\FileUploadTrait;
use Auth;

class ReservationController extends Controller
{
  use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $title = "الحجوزات";
      $view_title = "عرض الحجوزات";
      $dpage_id = 15;
      $delete_item = 0;
      //GeneralDepartment for admin
      $result = Reservation::orderBy('id','desc')->get();       
      return view('back.reservation.index',compact('result','title','view_title','dpage_id','delete_item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = "الحجوزات";
		$view_title = "اضافة حجز ";
        $dpage_id = 15;
        $countries = Country::Active()->get();
		return view('back.reservation.add',compact('title','view_title','dpage_id','countries'));
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
        'page_country_id' => 'required'
      ]);
      
      $new_data = new Reservation;
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->country_id = $request->page_country_id;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('reservation.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $title = "الحجوزات";
      $view_title = "عرض حجز";
      $dpage_id = 15;
      $result_page = Reservation::withTrashed()->find($id);
      $result_page_details = ReservationDetails::where('reservation_id',$id)->get();
      $countries = Country::Active()->get();
      $cities = City::Active()->where('country_id',$result_page->country_id)->where('parent_id',null)->get();
      $areas = City::Active()->where('parent_id',$result_page->city_id)->get();
      return view('back.reservation.view',compact('result_page','result_page_details','title','view_title','dpage_id','countries','cities','areas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $title = "الحجوزات";
      $view_title = "تعديل حجز";
      $dpage_id = 15;
      $result_page = Reservation::where('id',$id)->first();
      $countries = Country::Active()->get();
		  return view('back.reservation.edit',compact('result_page','title','view_title','dpage_id','countries'));
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
        'page_country_id' => 'required'
      ]);

      $new_data = Reservation::find($id);
      
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->country_id = $request->page_country_id;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('reservation.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = Reservation::find($id);
      $new_data->delete();
      return redirect(route('reservation.index'));
    }

    public function showDelete()
    {
        $title = "الحجوزات";
        $view_title = "عرض الحجوزات المحذفة";
        $dpage_id = 15;
        $delete_item = 1;
        $result = Reservation::onlyTrashed()->orderBy('id','desc')->get();       
        return view('back.reservation.index',compact('result','title','view_title','dpage_id','delete_item'));
    }

    public function statues($id)
    {
        $new_data = Reservation::find($id);
        $reservationStatue = '1';
        if($new_data->payment_statues == '1'){$reservationStatue = '0';}
        $new_data->payment_statues = $reservationStatue;
        $new_data->save();
        return redirect(route('reservation.index'));
    }
}
