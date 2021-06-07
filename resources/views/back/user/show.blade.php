<option value="0">لا يوجد المستخدم الرئيسى</option>
@foreach($result_page as $user)
<option value="{{$user->id}}">{{$user->name}}</option>
@endforeach
                  
