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
                  <label for="exampleInputEmail1">الاسم</label>
                  <input type="text" class="form-control" disabled name="page_name" value="{{$result_page->name}}" placeholder="الاسم" required>
                </div>

                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> رقم الهاتف</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" disabled name="phone" value="{{$result_page->phone}}" data-inputmask='"mask": "99999999"' data-mask required>
                </div>
                </div>

              <!-- start general departmrnt 4 -->
                @if($result_page->general_department_id == 4)

                @if($result_page->nursing_specialty_user_id != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> القسم الفرعى</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->nursingSpecialtyUsers->name}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->nationality_id != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> الجنسية</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->nationalities->name}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->medicine_from != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> موعد بداية الدواء</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->medicine_from}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->medicine_to != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> موعد انتهاء الدواء</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->medicine_to}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->medicine_period != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> فترة الدواء</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->medicine_period}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->medicine_time != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> توقيت الدواء</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->medicine_time}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->address_from != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">  من العنوان</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->address_from}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->address_to != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">  الى العنوان</label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->address_to}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->notes != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1">  ملاحظات</label>
                  <textarea type="text" class="form-control" disabled name="page_address" placeholder="العنوان" required>{{$result_page->notes}}</textarea>
                </div>
                @endif

                @endif 
              <!-- end general departmrnt 4 -->


              <!-- start offer -->
              @if($result_page->type == 2)
                @if($result_page->offer_department_id != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> القسم الرئيسى للعروض </label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->offerDepartments->name}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->sub_offer_department_id != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> القسم الفرعى للعروض </label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->subOfferDepartments->name}}" placeholder="العنوان" required>
                </div>
                @endif

                @if($result_page->offer_id != null)
                <div class="form-group col-md-4">
                  <label for="exampleInputEmail1"> العرض </label>
                  <input type="text" class="form-control" disabled name="page_address" value="{{$result_page->offers->name}}" placeholder="العنوان" required>
                </div>
                @endif
              @endif 
              <!-- end offer -->



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


