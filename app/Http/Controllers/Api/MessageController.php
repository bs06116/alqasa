<?php

namespace App\Http\Controllers\Api;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Models\Message as Message;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use Symfony\Component\HttpKernel\Exception\HttpException;
    use \Exception;
    use App\Traits\ResponsesTrait;
    use App\Traits\FileUploadTrait;

class MessageController extends Controller
{
    use ResponsesTrait;

    public function add(Request $request)
    {
        try{
            //validation
            $validator = Validator::make($request->all(), [
                'message' => ['required'],
                'name' => ['required'],
                'email' => ['required'],
            ]);
            if($validator->fails()){
                return $this->failed($validator->errors()->first(), 'result');
            }

            $client = Auth::user();
            $result = Message::create([
                'name' => $request->name,
                'email' => $request->email,
                'details' => $request->message
            ]);
            $message = __('add-message-error');
            return $this->success($message, 'message');
        }catch(\Exception $e){
            return $this->failed($e->getMessage(), 'result');
        }
    }

}
