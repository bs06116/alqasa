<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\City;
use App\Models\general\Country;
use App\Traits\FileUploadTrait;

use Illuminate\Support\Facades\Validator;

use Auth;

class AreaController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = "المناطق";
		$view_title = "عرض المناطق";
		$dpage_id = 5;
		$result = City::where('parent_id', '!=', '')->orderBy('id','desc')->get();
		return view('back.area.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = "المناطق";
		$view_title = "اضافة منطقة ";
        $dpage_id = 5;
        $countries = Country::Active()->get();
        $cities = City::Active()->get();
		return view('back.area.add',compact('title','view_title','dpage_id','countries','cities'));
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
        'page_city_id' => ['required', 'gt:0'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errorMessage', $validator->errors()->first());
        }

        $new_data = new City;
        $new_data->name = $request->page_name;
        $new_data->country_id = $request->page_country_id;
        $new_data->parent_id = $request->page_city_id;
        $new_data->active = $request->page_active;
        $new_data->save();
        return redirect(route('area.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $result_page = City::where(['parent_id'=>$id])->get();
      return view('back.area.show',compact('result_page')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$title = "المناطق";
		$view_title = "تعديل منطقة";
		$dpage_id = 5;
        $result_page = City::where('id',$id)->first();
        $countries = Country::Active()->get();
        $cities = City::Active()->where(['country_id'=>$result_page->country_id, 'parent_id'=>null])->get();
		return view('back.area.edit',compact('result_page','title','view_title','dpage_id','countries','cities'));
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
        'page_city_id' => ['required', 'gt:0'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errorMessage', $validator->errors()->first());
        }

        $new_data = City::find($id);

        $new_data->name = $request->page_name;
        $new_data->country_id = $request->page_country_id;
        $new_data->parent_id = $request->page_city_id;
        $new_data->active = $request->page_active;
        $new_data->save();
        return redirect(route('area.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = City::find($id);
      $new_data->delete();
      return redirect(route('area.index'));
    }
}
