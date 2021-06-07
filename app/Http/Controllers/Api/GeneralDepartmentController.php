<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\general\GeneralDepartment as GeneralDepartment;
use App\Models\general\Advertisement as Advertisement;
use \Exception;
use App\Traits\ResponsesTrait;

class GeneralDepartmentController extends Controller
{
    use ResponsesTrait;

    public function index()
    {
        $data = GeneralDepartment::where('active','1')->get();
        $today = date('Y-m-d');
        $advertisemnets = Advertisement::where(['active'=>'1'])
            ->where('from_date','<=',$today)
            ->where('to_date','>=',$today)
            ->get();
            return response()->json([
                'success' => True,
                'result' => $data,
                'advertisemnets' => $advertisemnets,
            ]);
    }

    public function getAll(Request $request)
    {
        try{
            $data = GeneralDepartment::where('active','1')->paginate((int) $request->pageCount);
            $today = date('Y-m-d');
            $advertisemnets = Advertisement::where(['active'=>'1'])
                ->where('from_date','<=',$today)
                ->where('to_date','>=',$today)
                ->get();
            return response()->json([
                'success' => True,
                'result' => $data,
                'advertisemnets' => $advertisemnets,
            ]);

        }catch(\Exception $e){
            return $this->failed($e->getMessage(),'result');
        }
    }

    public function show($id)
    {
        try{
            $data = GeneralDepartment::findOrFail((int) $id);
            return $this->success($data,'result');
        }
        catch(\Exception $e){
            return $this->failed($e->getMessage(),'result');
        }
    }

}
