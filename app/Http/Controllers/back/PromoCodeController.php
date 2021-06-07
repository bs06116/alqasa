<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\PromoCode;
use App\Models\general\Country;
use App\Traits\FileUploadTrait;

use Illuminate\Support\Facades\Validator;

use Auth;

class PromoCodeController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = "اكواد الخصومات";
		$view_title = "عرض اكواد الخصومات";
		$dpage_id = 11;
		$result = PromoCode::orderBy('id','desc')->get();
		return view('back.promo_code.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = "اكواد الخصومات";
		$view_title = "اضافة كود خصم ";
        $dpage_id = 11;
        $countries = Country::Active()->get();
		return view('back.promo_code.add',compact('title','view_title','dpage_id','countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
      //validator
      $validator = Validator::make($request->all(), [
        'page_from_date' => ['date', 'after:today'],
        'page_to_date' => ['date', 'after:page_from_date']
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }

      $new_data = new PromoCode;
      $new_data->country_id = $request->page_country_id;
      $new_data->name = $request->page_name;
      $new_data->amount = $request->page_amount;
      $new_data->from_date = $request->page_from_date;
      $new_data->to_date = $request->page_to_date;
      $new_data->users_count = $request->page_users_count;
      $new_data->only_user_count = $request->page_only_user_count;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('promoCode.index'));
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
        $result_page = PromoCode::where(['country_id'=>$id, 'parent_id'=>null])->get();
        return view('back.promo_code.show',compact('result_page')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $title = "اكواد الخصومات";
      $view_title = "تعديل كود خصم";
      $dpage_id = 11;
      $result_page = PromoCode::where('id',$id)->first();
      $countries = Country::Active()->get();
		  return view('back.promo_code.edit',compact('result_page','title','view_title','dpage_id','countries'));
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
      //validator
      $validator = Validator::make($request->all(), [
        'page_from_date' => ['date', 'after:today'],
        'page_to_date' => ['date', 'after:page_from_date']
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }

      $new_data = PromoCode::find($id);
      $new_data->country_id = $request->page_country_id;
      $new_data->name = $request->page_name;
      $new_data->amount = $request->page_amount;
      $new_data->from_date = $request->page_from_date;
      $new_data->to_date = $request->page_to_date;
      $new_data->users_count = $request->page_users_count;
      $new_data->only_user_count = $request->page_only_user_count;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('promoCode.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = PromoCode::find($id);
      $new_data->delete();
      return redirect(route('promoCode.index'));
    }
}
