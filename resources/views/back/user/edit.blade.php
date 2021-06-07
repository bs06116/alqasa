@extends('back.layouts.menu')
@section('menu_content')
@endsection

@extends('back.layouts.master')
@section('back_content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAPQJmGZLpDxyjgb4T6XmdMNb9Mh55X6Dw"></script>

<script type="text/javascript">
///////// add map
google.maps.event.addDomListener(window, "load", function() {
// initialize geocoder
var geocoder = new google.maps.Geocoder();
google.maps.event.addDomListener(document.getElementById("map_address"), "change", function(domEvent) {
  if (domEvent.preventDefault){
    domEvent.preventDefault();
  } else {
    domEvent.returnValue = false;
  }
  geocoder.geocode({
    address: document.getElementById("map_address").value
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      var result = results[0];

      document.getElementById("map_address_en").value = result.formatted_address;
      document.getElementById("lat_google").value = result.geometry.location.lat();
      document.getElementById("lng_google").value = result.geometry.location.lng();

      if (result.geometry.viewport) {
        map.fitBounds(result.geometry.viewport);
      }
      else {
        map.setCenter(result.geometry.location);
      }
    } else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
      alert("Sorry, the geocoder failed to locate the specified address.");
    } else {
      alert("Sorry, the geocoder failed with an internal error.");
    }
  });
  });

  });
//////////////end map

$(document).ready(function() {
jQuery('.page_num').keyup(function () {     
  this.value = this.value.replace(/[^0-9\.]/g,'');
});

jQuery('.page_num2').keyup(function () {     
  this.value = this.value.replace(/[^0-9]/g,'');
});

//show city
$(document).on("change", "#country_id", function () {
     var addressid = this.value;
     var map_url = "{{route('city.show',['id'])}}";
     map_url = map_url.replace('id', addressid);
     $.get(map_url, function(data){
        $("#showcity_data").html(data);
     });
});

//show area
$(document).on("change", "#showcity_data", function () {
     var addressid = this.value;
     var map_url = "{{route('area.show',['id'])}}";
     map_url = map_url.replace('id', addressid);
     $.get(map_url, function(data){
        $("#showarea_data").html(data);
     });
});

});
</script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small>{!! $title !!}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> الرئيسية</a></li>
        <li class="active">{!! $view_title !!}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{!! $view_title !!}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('user.update',$result_page->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="box-body">
				  
              @if(session('errorMessage'))
                  <div class="alert alert-danger">
                      {{ session('errorMessage') }}
                  </div>
              @endif

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">الدولة</label>
                  <select class="form-control" name="page_country_id" required>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}" {{($result_page->country_id == $country->id ? "selected":"")}}>{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-4">
                <label for="exampleInputEmail1">المدينة</label>
                  <select class="form-control" name="page_city_id" id="showcity_data" required>
                    @foreach($cities as $city)
                      <option value="{{$city->id}}" {{$result_page->city_id == $city->id ? "selected" : ""}}>{{$city->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">المنطقة</label>
                  <select class="form-control" name="page_area_id" id="showarea_data" required>
                    @foreach($areas as $area)
                      <option value="{{$area->id}}" {{$result_page->area_id == $area->id ? "selected" : ""}}>{{$area->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">القسم الرئيسى</label>
                  <select class="form-control" name="page_general_department_id" id="general_department_id" required>
                    <option value="0">اختار القسم الرئيسى</option>
                    @foreach($general_departments as $general_department)
                    <option value="{{$general_department->id}}" {{($result_page->general_department_id == $general_department->id ? "selected":"")}}>{{$general_department->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">الاسم</label>
                  <input type="text" class="form-control" name="page_name" value="{{$result_page->name}}" placeholder="الاسم" required>
                </div>             

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">العنوان</label>
                  <input type="text" class="form-control" name="page_address" value="{{$result_page->address}}" id="map_address" placeholder="العنوان" required>
                  <input type="hidden" name="lat_google" id="lat_google" value="{{$result_page->google_lat}}" />
                  <input type="hidden" name="lng_google" id="lng_google" value="{{$result_page->google_lan}}" />
                  <input type="hidden" name="page_address_en" id="map_address_en" value="{{$result_page->address_en}}">
                </div>  

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1"> قيمة التوصيل</label>
                  <input type="text" class="form-control page_num" name="page_delivery_price" value="{{$result_page->delivery_price}}" placeholder="قيمة التوصيل" id="page_delivery_price">
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">مواقيت الصلاة المتاحة</label><br>
                    <label>
                      العشاء
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="5" {{(in_array(5,explode(',',$result_page->reservation_prayer_hour)) ? "checked":"")}}>
                    </label>

                    <label>
                      المغرب
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="4" {{(in_array(4,explode(',',$result_page->reservation_prayer_hour)) ? "checked":"")}}>
                    </label>
                    
                    <label>
                      العصر
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="3" {{(in_array(3,explode(',',$result_page->reservation_prayer_hour)) ? "checked":"")}}>
                    </label>

                    <label>
                      الظهر
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="2" {{(in_array(2,explode(',',$result_page->reservation_prayer_hour)) ? "checked":"")}}>
                    </label>

                    <label>
                      الفجر
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="1" {{(in_array(1,explode(',',$result_page->reservation_prayer_hour)) ? "checked":"")}}>
                    </label>
                </div>  

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">عن المستخدم</label>
                  <textarea class="form-control" name="page_profile" placeholder="عن المستخدم" required>{{$result_page->profile}}</textarea>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">طريقة الحجز</label><br>
                  <label>
                      <input type="radio" name="page_booking_type" value="1" {{($result_page->booking_type == 1 ? "checked":"")}}>
                      كى نت
                    </label>
                    <label>
                      <input type="radio" name="page_booking_type" value="2" {{($result_page->booking_type == 2 ? "checked":"")}}>
                      عند الاستلام
                    </label>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">مستخدم مميز</label><br>
                  <label>
                      <input type="radio" name="page_special" value="1" {{($result_page->special == 1 ? "checked":"")}}>
                      نعم
                    </label>
                    <label>
                      <input type="radio" name="page_special" value="0" {{($result_page->special == 0 ? "checked":"")}}>
                      لا
                    </label>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">التفعيل</label><br>
                  <label>
                      <input type="radio" name="page_active" value="1" {{($result_page->active == 1 ? "checked":"")}}>
                      مفعل
                    </label>
                    <label>
                      <input type="radio" name="page_active" value="0" {{($result_page->active == 0 ? "checked":"")}}>
                      غير مفعل
                    </label>
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection


