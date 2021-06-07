@extends('back.layouts.menu')
@section('menu_content')
@endsection

@extends('back.layouts.master')
@section('back_content')

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
            <form role="form" action="{{ route('setting.update',$result_page->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">البريد الالكترونى</label>
                  <input type="email" class="form-control" name="page_email" value="{{$result_page->email}}" placeholder="البريد الالكترونى" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">كلمة المرور</label>
                  <input type="text" class="form-control" name="page_password" placeholder="كلمة المرور" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">اسم الموقع</label>
                  <input type="text" class="form-control" name="page_title" value="{{$result_page->title}}" placeholder="اسم الموقع" required>
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


