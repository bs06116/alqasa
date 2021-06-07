@foreach($result_page as $specialty)
<option value="{{$specialty->id}}">{{$specialty->name}}</option>
@endforeach
                  
