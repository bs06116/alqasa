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

$(document).on("change", "#country_id", function () {
     var addressid = this.value;
     var map_url = "{{route('city.show',['id'])}}";
     map_url = map_url.replace('id', addressid);
     $.get(map_url, function(data){
        $("#showcity_data").html(data);
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
            <form role="form" action="{{ route('area.store') }}" method="post" enctype="multipart/form-data">
			      @csrf
              <div class="box-body">	

              @if(session('errorMessage'))
                  <div class="alert alert-danger">
                      {{ session('errorMessage') }}
                  </div>
              @endif

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">الدولة</label>
                  <select class="form-control" name="page_country_id" id="country_id" required>
                    <option value="0">اختار الدولة</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-6">
                <label for="exampleInputEmail1">المدينة</label>
                  <select class="form-control" name="page_city_id" id="showcity_data" required>
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">الاسم</label>
                  <input type="text" class="form-control" name="page_name" placeholder="الاسم" required>
                </div>
                
                <div class="form-group col-md-6">
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


