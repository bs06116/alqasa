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
            <form role="form" action="{{ route('nursingDepartment.update',$result_page->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="box-body">
				  
                <div class="form-group col-md-12">
                  <label for="exampleInputEmail1">الدولة</label>
                  <select class="form-control" name="page_country_id" required>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}" {{($result_page->country_id == $country->id ? "selected":"")}}>{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">الاسم</label>
                  <input type="text" class="form-control" name="page_name" value="{{$result_page->name}}" placeholder="الاسم" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="page_name_en" value="{{$result_page->name_en}}" placeholder="Name" required>
                </div>
                
                <div class="form-group col-md-12">
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


