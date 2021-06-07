<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\Department as Department;
use \Exception;
use App\Traits\ResponsesTrait;

class DepartmentController extends Controller
{
    use ResponsesTrait;

    public function index(Request $request)
    {
        $data = Department::where(['parent_id'=>null, 'type'=>$request->type, 'active'=>'1'])->get();
        //$data = Department::where(['parent_id'=>null, 'active'=>'1'])->with('subDepartment')->get();
        return $this->success($data, 'result');
    }

    public function getAll(Request $request)
    {
        try{
            $data = Department::where(['parent_id'=>null, 'type'=>$request->type, 'active'=>'1'])->paginate((int) $request->pageCount);
            //$data = Department::where(['parent_id'=>null, 'active'=>'1'])->with('subDepartment')->paginate((int) $request->pageCount);
            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }

    }

    public function show($id)
    {
        try{
            $data = Department::findorfail((int) $id);
            return $this->success($data, 'result');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

}
