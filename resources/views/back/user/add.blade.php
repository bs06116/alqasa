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
            <form role="form" action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
			      @csrf
              <div class="box-body">
                
              @if(session('errorMessage'))
                  <div class="alert alert-danger">
                      {{ session('errorMessage') }}
                  </div>
              @endif

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">الدولة</label>
                  <select class="form-control" name="page_country_id" id="country_id" required>
                    <option value="0">اختار الدولة</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-4">
                <label for="exampleInputEmail1">المدينة</label>
                  <select class="form-control" name="page_city_id" id="showcity_data" required>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">المنطقة</label>
                  <select class="form-control" name="page_area_id" id="showarea_data" required>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">القسم الرئيسى</label>
                  <select class="form-control" name="page_general_department_id" id="general_department_id" required>
                    <option value="0">اختار القسم الرئيسى</option>
                    @foreach($general_departments as $general_department)
                    <option value="{{$general_department->id}}">{{$general_department->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">الاسم</label>
                  <input type="text" class="form-control" name="page_name" placeholder="الاسم" required>
                </div>             

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">العنوان</label>
                  <input type="text" class="form-control" name="page_address" id="map_address" placeholder="العنوان" required>
                  <input type="hidden" name="lat_google" id="lat_google" />
                  <input type="hidden" name="lng_google" id="lng_google" />
                  <input type="hidden" name="page_address_en" id="map_address_en">
                </div>  

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1"> قيمة التوصيل</label>
                  <input type="text" class="form-control page_num" name="page_delivery_price" placeholder="قيمة التوصيل" id="page_delivery_price">
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">مواقيت الصلاة المتاحة</label><br>
                    <label>
                      العشاء
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="5">
                    </label>

                    <label>
                      المغرب
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="4">
                    </label>
                    
                    <label>
                      العصر
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="3">
                    </label>

                    <label>
                      الظهر
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="2">
                    </label>

                    <label>
                      الفجر
                      <input type="checkbox" name="page_reservation_prayer_hour[]" value="1">
                    </label>
                </div>  

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">عن المستخدم</label>
                  <textarea class="form-control" name="page_profile" placeholder="عن المستخدم" required></textarea>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">طريقة الحجز</label><br>
                  <label>
                      <input type="radio" name="page_booking_type" value="1" checked="">
                      كى نت
                    </label>
                    <label>
                      <input type="radio" name="page_booking_type" value="2">
                      عند الاستلام
                    </label>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">مستخدم مميز</label><br>
                  <label>
                      <input type="radio" name="page_special" value="1">
                      نعم
                    </label>
                    <label>
                      <input type="radio" name="page_special" value="0" checked="">
                      لا
                    </label>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">التفعيل</label><br>
                  <label>
                      <input type="radio" name="page_active" value="1" checked="">
                      مفعل
                    </label>
                    <label>
                      <input type="radio" name="page_active" value="0">
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

