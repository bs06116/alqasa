@extends('back.layouts.menu')
@section('menu_content')
@endsection

@extends('back.layouts.master')
@section('back_content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
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
              <a onclick="printContent('form_print');" class="btn btn-info btn-sm"> طباعة </a>
              <h3 class="box-title">{!! $view_title !!}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="form_print" action="{{ route('client.update',$result_page->id) }}" method="post" enctype="multipart/form-data">
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
                  <select class="form-control" disabled name="page_country_id" id="country_id" required>
                    <option value="0">اختار الدولة</option>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}" {{$result_page->country_id == $country->id ? "selected" : ""}}>{{$country->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-4">
                <label for="exampleInputEmail1">المدينة</label>
                  <select class="form-control" disabled name="page_city_id" id="showcity_data" required>
                    @foreach($cities as $city)
                      <option value="{{$city->id}}" {{$result_page->city_id == $city->id ? "selected" : ""}}>{{$city->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">المنطقة</label>
                  <select class="form-control" disabled name="page_area_id" id="showarea_data" required>
                    @foreach($areas as $area)
                      <option value="{{$area->id}}" {{$result_page->area_id == $area->id ? "selected" : ""}}>{{$area->name}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">المستخدم</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->users->name}}" placeholder="العنوان" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">العنوان</label>
                  <input type="text" class="form-control" disabled name="page_name" value="{{$result_page->users->address}}" placeholder="الاسم" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">موعد الحجز</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->reservation_date}}" placeholder="العنوان" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">توقيت الحجز</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->reservation_time}}" placeholder="العنوان" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">العميل</label>
                  <input type="text" class="form-control" disabled name="page_name" value="{{$result_page->clients->name}}" placeholder="الاسم" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> رقم الهاتف</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" disabled name="phone" value="{{$result_page->clients->phone}}" data-inputmask='"mask": "99999999"' data-mask required>
                </div>
                </div>

                @foreach($result_page_details as $result_page_details_one)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> المنتج</label>
                  <input type="text" class="form-control" disabled value="{{$result_page_details_one->products->name}}" required>
                </div>

                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1"> الشركة</label>
                  <input type="text" class="form-control" disabled value="{{$result_page_details_one->products->departments->name}}" required>
                </div>

                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"> الكمية</label>
                  <input type="text" class="form-control" disabled value="{{$result_page_details_one->count}}" required>
                </div>

                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"> السعة</label>
                  <input type="text" class="form-control" disabled value="{{$result_page_details_one->products->size}}" required>
                </div>

                <div class="form-group col-md-1">
                  <label for="exampleInputEmail1"> السعر</label>
                  <input type="text" class="form-control" disabled value="{{$result_page_details_one->price}}" required>
                </div>

                <div class="form-group col-md-2">
                  <label for="exampleInputEmail1"> الاجمالى</label>
                  <input type="text" class="form-control" disabled value="{{$result_page_details_one->total_price}}" required>
                </div>
                @endforeach


                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1"> السعر</label>
                  <input type="text" class="form-control" disabled value="{{$result_page->price}}" required>
                </div>

                @if($result_page->promo_code_id != null)
                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1"> خصم البرمو كود</label>
                  <input type="text" class="form-control" disabled value="{{$result_page->promoCodes->amount}}" required>
                </div>
                @endif

                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1"> التوصيل</label>
                  <input type="text" class="form-control" disabled value="{{$result_page->delivery}}" required>
                </div>

                <div class="form-group col-md-3">
                  <label for="exampleInputEmail1"> الاجمالى</label>
                  <input type="text" class="form-control" disabled value="{{$result_page->total_price}}" required>
                </div>
                

             



              </div>
              <!-- /.box-body -->

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


