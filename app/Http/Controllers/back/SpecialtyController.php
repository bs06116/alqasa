<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\Specialty;
use App\Traits\FileUploadTrait;
use Auth;

class SpecialtyController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = " التخصصات";
		$view_title = "عرض التخصصات";
		$dpage_id = 6;
		$result = Specialty::orderBy('id','desc')->get();
		return view('back.specialty.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = " التخصصات";
		$view_title = "اضافة تخصص";
		$dpage_id = 6;
		return view('back.specialty.add',compact('title','view_title','dpage_id'));
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
        'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      $img_name= "";
      if($request->hasFile('page_picture')){
        $img_name = $this->uploadFile($request->file('page_picture'),'Specialty');
      }
      
      $new_data = new Specialty;
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->active = $request->page_active;
      $new_data->icon = $img_name;
      $new_data->save();
      return redirect(route('specialty.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $result_page = array();
      if($id != 0)
      $result_page = Specialty::Active()->get();
      return view('back.specialty.show',compact('result_page')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$title = " التخصصات";
		$view_title = "تعديل تخصص";
		$dpage_id = 6;
    $result_page = Specialty::where('id',$id)->first();
		return view('back.specialty.edit',compact('result_page','title','view_title','dpage_id'));
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
        'page_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		  ]);
		
      $new_data = Specialty::find($id);
      $img_name= $new_data->picture;
      if($request->hasFile('page_picture')){
        $img_name = $this->uploadFile($request->file('page_picture'),'Specialty');
        $folder_path = public_path($new_data->icon);
        @unlink($folder_path);
      }
      
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->active = $request->page_active;		
      $new_data->icon = $img_name;
      $new_data->save();
      return redirect(route('specialty.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = Specialty::find($id);
      if($new_data->icon != ""){
        $folder_path = public_path($new_data->icon);
        @unlink($folder_path);
      }
      $new_data->delete();
      return redirect(route('specialty.index'));
    }
}
