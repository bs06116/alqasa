@extends('back.layouts.menu')
@section('menu_content')
@endsection

@extends('back.layouts.master')
@section('back_content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
jQuery('.page_num').keyup(function () {     
  this.value = this.value.replace(/[^0-9\.]/g,'');
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

$(document).on("change", "#general_department_id", function () {
        var generalDepartmentId = this.value; 
        //show parent
        var map_url = "{{route('user.showAll',['id'])}}";
        map_url = map_url.replace('id', generalDepartmentId);
        $.get(map_url, function(data){
            $("#showparent_data").html(data);
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
            <form role="form" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
			      @csrf
              <div class="box-body">	

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
                  <select class="form-control" name="page_department_id" id="department_id" required>
                    <option value="0">اختار القسم الرئيسى</option>
                    @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">الاسم</label>
                  <input type="text" class="form-control" name="page_name" placeholder="الاسم" required>
                </div>

                <div class="form-group col-md-8">
                  <label for="exampleInputPassword1">التفاصيل</label>
                  <textarea class="textarea" name="page_details" placeholder="التفاصيل" style="width: 100%; height: 85px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">نسبة الخصم</label>
                  <input type="text" class="form-control" name="page_discount_percent" placeholder="نسبة الخصم">
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">السعر قبل الخصم</label>
                  <input type="text" class="form-control page_num" name="page_price_before" placeholder="السعر قبل الخصم" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">السعر بعد الخصم</label>
                  <input type="text" class="form-control page_num" name="page_price_after" placeholder="السعر بعد الخصم" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">الحد الادنى</label>
                  <input type="text" class="form-control page_num" name="page_min_limit" placeholder="الحد الادنى" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">الحجم للزجاجة</label>
                  <input type="text" class="form-control" name="page_size" placeholder="الحجم للزجاجة" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">استخدام كود الخصم</label><br>
                  <label>
                      <input type="radio" name="page_promo_code" value="1">
                      نعم
                    </label>
                    <label>
                      <input type="radio" name="page_promo_code" value="0" checked="">
                      لا
                    </label>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">منتج مميز</label><br>
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

                <div class="form-group col-md-6">
                  <label for="exampleInputFile">الصورة</label><br>
                  <input type="file" name="page_picture" style="float: right">
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


