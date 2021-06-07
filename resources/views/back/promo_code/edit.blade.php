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
            <form role="form" action="{{ route('promoCode.update',$result_page->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
              <div class="box-body">
				  
              @if($errors->any())
                  <div class="alert alert-danger">
                      {{ $errors->first() }}
                  </div>
              @endif

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
                  <label for="exampleInputEmail1">المبلغ</label>
                  <input type="text" class="form-control page_num" name="page_amount" value="{{$result_page->amount}}" placeholder="المبلغ" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">من تاريخ</label>
                  <input type="date" class="form-control" name="page_from_date" value="{{$result_page->from_date}}" placeholder="من تاريخ" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">الى تاريخ</label>
                  <input type="date" class="form-control" name="page_to_date" value="{{$result_page->to_date}}" placeholder="الى تاريخ" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1"> عدد المستخدمين لهذا الكود</label>
                  <input type="text" class="form-control page_num" name="page_users_count" value="{{$result_page->users_count}}" placeholder="عدد المستخدمين لهذا الكود" required>
                </div>

                <div class="form-group col-md-6">
                  <label for="exampleInputEmail1"> عدد مرات استخدام الكود للمستخدم</label>
                  <input type="text" class="form-control page_num" name="page_only_user_count" value="{{$result_page->only_user_count}}" placeholder="عدد مرات استخدام الكود للمستخدم" required>
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


