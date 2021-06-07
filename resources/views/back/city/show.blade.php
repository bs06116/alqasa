<option value="0">اختار المدينة</option>
@foreach($result_page as $city)
<option value="{{$city->id}}">{{$city->name}}</option>
@endforeach
                  
