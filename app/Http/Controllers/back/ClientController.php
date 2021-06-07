<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\Country;
use App\Models\general\City;
use App\Models\User;
use App\Models\Client;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class ClientController extends Controller
{
  use FileUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = "العملاء";
		$view_title = "عرض عميل";
		$dpage_id = 14;
		$result = Client::orderBy('id','desc')->get();
		return view('back.client.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $title = "العملاء";
      $view_title = "اضافة عميل ";
        $dpage_id = 14;
        $countries = Country::Active()->get();       
		  return view('back.client.add',compact('title','view_title','dpage_id','countries'));
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
        'page_phone' => ['required'],
        'page_address' => ['required'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errorMessage', $validator->errors()->first());
        }
      
      $new_data = new Client;
      $new_data->country_id = $request->page_country_id;
      $new_data->city_id = $request->page_city_id;
      $new_data->area_id = $request->page_area_id;
      $new_data->name = $request->page_name;
      $new_data->phone = $request->page_phone;
      $new_data->address = $request->page_address;
      $new_data->active = $request->page_active;
      $new_data->save();

      return redirect(route('client.index'));
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
        $title = "العملاء";
        $view_title = "تعديل عميل";
        $dpage_id = 14;
        $result_page = Client::where('id',$id)->first();
        $countries = Country::Active()->get();
        $cities = City::Active()->where('country_id',$result_page->country_id)->where('parent_id',null)->get();
        $areas = City::Active()->where('parent_id',$result_page->city_id)->get();
	    return view('back.client.edit',compact('result_page','title','view_title','dpage_id','countries','cities','areas'));
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
      $new_data = Client::find($id);
      //validation
      $validator = Validator::make($request->all(), [
        'page_phone' => ['required'],
        'page_address' => ['required'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errorMessage', $validator->errors()->first());
        }
      
      $new_data->country_id = $request->page_country_id;
      $new_data->city_id = $request->page_city_id;
      $new_data->area_id = $request->page_area_id;
      $new_data->name = $request->page_name;
      $new_data->phone = $request->page_phone;
      $new_data->address = $request->page_address;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('client.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = Client::find($id);
      if($new_data->picture != ""){
        $folder_path = public_path($new_data->picture);
        @unlink($folder_path);
      }
      $new_data->delete();
      return redirect(route('client.index'));
    }

    public function active($id)
    {
        $new_data = Client::find($id);
        $ClientActive = '1';
        if($new_data->active == '1'){$ClientActive = '0';}
        $new_data->active = $ClientActive;
        $new_data->save();
        return redirect(route('client.index'));
    }
}
