<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\City;
use App\Models\general\Country;
use App\Traits\FileUploadTrait;
use Auth;

class CityController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = "المدن";
		$view_title = "عرض المدن";
		$dpage_id = 4;
		$result = City::orderBy('id','desc')->get();
		return view('back.city.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = "المدن";
		$view_title = "اضافة مدينة ";
        $dpage_id = 4;
        $countries = Country::Active()->get();
		return view('back.city.add',compact('title','view_title','dpage_id','countries'));
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
        'page_country_id' => 'required'
      ]);
      
      $new_data = new City;
      $new_data->name = $request->page_name;
      $new_data->country_id = $request->page_country_id;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('city.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result_page = City::where(['country_id'=>$id, 'parent_id'=>null])->get();
        return view('back.city.show',compact('result_page')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $title = "المدن";
      $view_title = "تعديل مدينة";
      $dpage_id = 4;
      $result_page = City::where('id',$id)->first();
      $countries = Country::Active()->get();
		  return view('back.city.edit',compact('result_page','title','view_title','dpage_id','countries'));
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
        'page_country_id' => 'required'
      ]);

      $new_data = City::find($id);
      
      $new_data->name = $request->page_name;
      $new_data->country_id = $request->page_country_id;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('city.index'));
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
      return redirect(route('city.index'));
    }
}
