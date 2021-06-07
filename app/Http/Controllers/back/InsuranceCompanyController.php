<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\InsuranceCompany;
use App\Models\general\Country;
use App\Traits\FileUploadTrait;
use Auth;

class InsuranceCompanyController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = "شركات التأمين";
		$view_title = "عرض شركات التأمين";
		$dpage_id = 3;
		$result = InsuranceCompany::orderBy('id','desc')->get();
		return view('back.insurance_company.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = "شركات التأمين";
		$view_title = "اضافة شركة تأمين ";
        $dpage_id = 3;
        $countries = Country::Active()->get();
		return view('back.insurance_company.add',compact('title','view_title','dpage_id','countries'));
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
      
      $new_data = new InsuranceCompany;
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->country_id = $request->page_country_id;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('insuranceCompany.index'));
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
		$title = "شركات التأمين";
		$view_title = "تعديل شركة تأمين";
		$dpage_id = 3;
        $result_page = InsuranceCompany::where('id',$id)->first();
        $countries = Country::Active()->get();
		return view('back.insurance_company.edit',compact('result_page','title','view_title','dpage_id','countries'));
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

      $new_data = InsuranceCompany::find($id);
      
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->country_id = $request->page_country_id;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('insuranceCompany.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = InsuranceCompany::find($id);
      $new_data->delete();
      return redirect(route('insuranceCompany.index'));
    }
}
