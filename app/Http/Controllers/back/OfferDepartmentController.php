<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\OfferDepartment;
use App\Models\general\Country;
use App\Traits\FileUploadTrait;
use Auth;

class OfferDepartmentController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = "الاقسام الرئيسية للعروض";
		$view_title = "عرض الاقسام الرئيسية للعروض";
		$dpage_id = 9;
		$result = OfferDepartment::where('parent_id',null)->orderBy('id','desc')->get();
		return view('back.offer_department.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "الاقسام الرئيسية للعروض";
        $view_title = "اضافة قسم رئيسى للعروض ";
        $dpage_id = 9;
		    return view('back.offer_department.add',compact('title','view_title','dpage_id'));
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
        $img_name = $this->uploadFile($request->file('page_picture'),'OfferDepartment');
      }
      
      $new_data = new OfferDepartment;
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->picture = $img_name;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('offerDepartment.index'));
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
      $title = "الاقسام الرئيسية للعروض";
      $view_title = "تعديل قسم رئيسى للعروض";
      $dpage_id = 9;
      $result_page = OfferDepartment::where('id',$id)->first();
		  return view('back.offer_department.edit',compact('result_page','title','view_title','dpage_id'));
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

      $new_data = OfferDepartment::find($id);
      $img_name= $new_data->picture;
      if($request->hasFile('page_picture')){
        $img_name = $this->uploadFile($request->file('page_picture'),'OfferDepartment');
        $folder_path = public_path($new_data->picture);
        @unlink($folder_path);
      }
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->picture = $img_name;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('offerDepartment.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = OfferDepartment::find($id);
      if($new_data->picture != ""){
        $folder_path = public_path($new_data->picture);
        @unlink($folder_path);
      }
      $new_data->delete();
      return redirect(route('offerDepartment.index'));
    }
}
