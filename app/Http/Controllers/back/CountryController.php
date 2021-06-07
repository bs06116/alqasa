<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\Country;
use App\Models\general\GeneralDepartment;
use App\Traits\FileUploadTrait;
use Auth;

class CountryController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = " الدول";
		$view_title = "عرض الدول";
		$dpage_id = 2;
		$result = Country::orderBy('id','desc')->get();
		return view('back.country.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = " الدول";
		$view_title = "اضافة دولة";
        $dpage_id = 2;
        $generalDepartments = GeneralDepartment::get();
		return view('back.country.add',compact('title','view_title','dpage_id','generalDepartments'));
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
        'page_country_code'=>'required',
        'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      $img_name= "";
      if($request->hasFile('page_picture')){
        $img_name = $this->uploadFile($request->file('page_picture'),'Country');
      }
      
      $new_data = new Country;
      $new_data->name = $request->page_name;
      $new_data->country_code = $request->page_country_code;
      $new_data->active = $request->page_active;
      $new_data->flag = $img_name;
      $new_data->save();
      return redirect(route('country.index'));
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
      $title = " الدول";
      $view_title = "تعديل دولة";
      $dpage_id = 2;
      $result_page = Country::where('id',$id)->first();
      $generalDepartments = GeneralDepartment::get();
		  return view('back.country.edit',compact('result_page','title','view_title','dpage_id','generalDepartments'));
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
        'page_country_code'=>'required',
        'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		  ]);
		
      $new_data = Country::find($id);
      $img_name= $new_data->flag;;
      if($request->hasFile('page_picture')){
        $img_name = $this->uploadFile($request->file('page_picture'),'Country');
        $folder_path = public_path($new_data->flag);
        @unlink($folder_path);
      }
            
      $new_data->name = $request->page_name;
      $new_data->country_code = $request->page_country_code;
      $new_data->active = $request->page_active;
      $new_data->flag = $img_name;
      $new_data->save();
      return redirect(route('country.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = Country::find($id);
      if($new_data->flag != ""){
        $folder_path = public_path($new_data->flag);
        @unlink($folder_path);
      }
      $new_data->delete();
      return redirect(route('country.index'));
    }
}
