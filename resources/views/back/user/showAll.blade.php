@foreach($result_page as $user)
@if($id == 1 || $id == 2)
<optgroup label="{{$user->name}}">
    @foreach($user->userChilds as $child)
    <option value="{{$child->id}}">{{$child->name}}</option>
    @endforeach
</optgroup>
@else
<option value="{{$user->id}}">{{$user->name}}</option> 
@endif
@endforeach


                  
