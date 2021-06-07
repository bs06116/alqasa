<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\ReservationProblemDepartment;
use App\Traits\FileUploadTrait;
use Auth;

class ReservationProblemDepartmentController extends Controller
{

  use FileUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$title = " الاقسام الرئيسية لمشاكل الحجز";
		$view_title = "عرض الاقسام الرئيسية لمشاكل الحجز";
		$dpage_id = 7;
		$result = ReservationProblemDepartment::orderBy('id','desc')->get();
		return view('back.reservation_problem_department.index',compact('result','title','view_title','dpage_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$title = " الاقسام الرئيسية لمشاكل الحجز";
		$view_title = "اضافة قسم رئيسى لمشاكل الحجز";
		$dpage_id = 7;
		return view('back.reservation_problem_department.add',compact('title','view_title','dpage_id'));
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
      ]);
      
      $new_data = new ReservationProblemDepartment;
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->active = $request->page_active;
      $new_data->save();
      return redirect(route('reservationProblemDepartment.index'));
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
		$title = " الاقسام الرئيسية لمشاكل الحجز";
		$view_title = "تعديل قسم رئيسى لمشاكل الحجز";
		$dpage_id = 7;
        $result_page = ReservationProblemDepartment::where('id',$id)->first();
		return view('back.reservation_problem_department.edit',compact('result_page','title','view_title','dpage_id'));
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
		  ]);
		
      $new_data = ReservationProblemDepartment::find($id);
      
      $new_data->name = $request->page_name;
      $new_data->name_en = $request->page_name_en;
      $new_data->active = $request->page_active;		
      $new_data->save();
      return redirect(route('reservationProblemDepartment.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $new_data = ReservationProblemDepartment::find($id);
      $new_data->delete();
      return redirect(route('reservationProblemDepartment.index'));
    }
}
