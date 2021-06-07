@foreach($result_page as $nursing_department)
<option value="{{$nursing_department->id}}">{{$nursing_department->name}}</option>
@endforeach
                  
