<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\GeneralDepartment;
use App\Traits\FileUploadTrait;
use Auth;

class GeneralDepartmentController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = " الاقسام الرئيسية";
		$view_title = "عرض الاقسام الرئيسية";
		$dpage_id = 1;
		$result = GeneralDepartment::orderBy('id','desc')->get();
		return view('back.general_department.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = " الاقسام الرئيسية";
		$view_title = "اضافة قسم رئيسى";
		$dpage_id = 1;
		return view('back.general_department.add',compact('title','view_title','dpage_id'));
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
        'page_type'=>'required',
        'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      $img_name= "";
      if($request->hasFile('page_picture')){
        $img_name = $this->uploadFile($request->file('page_picture'),'GeneralDepartment');
      }
      
      $new_data = new GeneralDepartment;
      $new_data->name = $request->page_name;
      $new_data->type = $request->page_type;
      $new_data->active = $request->page_active;
      $new_data->picture = $img_name;
      $new_data->save();
      return redirect(route('generalDepartment.index'));
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
		$title = " الاقسام الرئيسية";
		$view_title = "تعديل قسم رئيسى";
		$dpage_id = 1;
    $result_page = GeneralDepartment::where('id',$id)->first();
		return view('back.general_department.edit',compact('result_page','title','view_title','dpage_id'));
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
			  'page_type'=>'required',
        'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		  ]);
		
      $new_data = GeneralDepartment::find($id);
      $img_name= $new_data->picture;
      if($request->hasFile('page_picture')){
        $img_name = $this->uploadFile($request->file('page_picture'),'GeneralDepartment');
        $folder_path = public_path($new_data->picture);
        @unlink($folder_path);
      }
      
      $new_data->name = $request->page_name;
      $new_data->type = $request->page_type;
      $new_data->active = $request->page_active;		
      $new_data->picture = $img_name;
      $new_data->save();
      return redirect(route('generalDepartment.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = GeneralDepartment::find($id);
      if($new_data->picture != ""){
        $folder_path = public_path($new_data->picture);
        @unlink($folder_path);
      }
      $new_data->delete();
      return redirect(route('generalDepartment.index'));
    }
}
