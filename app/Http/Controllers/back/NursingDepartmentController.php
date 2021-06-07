<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\NursingDepartment;
use App\Models\general\Country;
use App\Traits\FileUploadTrait;
use Auth;

class NursingDepartmentController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = "اقسام التمريض";
		$view_title = "عرض اقسام التمريض";
		$dpage_id = 8;
		$result = NursingDepartment::orderBy('id','desc')->get();
		return view('back.nursing_department.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = "اقسام التمريض";
		$view_title = "اضافة قسم تمريض ";
        $dpage_id = 8;
        $countries = Country::Active()->get();
		return view('back.nursing_department.add',compact('title','view_title','dpage_id','countries'));
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
      
      $new_data = new NursingDepartment;
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->country_id = $request->page_country_id;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('nursingDepartment.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $result_page = NursingDepartment::Active()->get();
      return view('back.nursing_department.show',compact('result_page')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $title = "اقسام التمريض";
      $view_title = "تعديل قسم تمريض";
      $dpage_id = 8;
      $result_page = NursingDepartment::where('id',$id)->first();
      $countries = Country::Active()->get();
		  return view('back.nursing_department.edit',compact('result_page','title','view_title','dpage_id','countries'));
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

      $new_data = NursingDepartment::find($id);
      
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->country_id = $request->page_country_id;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('nursingDepartment.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = NursingDepartment::find($id);
      $new_data->delete();
      return redirect(route('nursingDepartment.index'));
    }
}
