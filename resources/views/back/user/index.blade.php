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
        <div class="col-xs-12">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">{!! $view_title !!}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table direction table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%">م</th>
                  <th style="width: 20%">الاسم</th>
                  <th style="width: 10%">المدينة</th>
                  <th style="width: 10%">المنطقة</th>
                  <th style="width: 10%">القسم الرئيسى</th>
                  <th style="width: 30%"></th>
                </tr>
                </thead>
                <tbody>
                
                @foreach($result as $result_page)
                <tr>
                  <td>{{ $result_page->id }}</td>
                  <td>{{ $result_page->name }}</td>
                  <td>{{ $result_page->cities->name }}</td>
                  <td>{{ $result_page->areas->name }}</td>
                  <td>{{ $result_page->generalDepartments->name }}</td>
                  <td>
                <a href="{{ route('user.edit',$result_page->id) }}" class="btn btn-info btn-sm" >تعديل</a>
                <a href="javascript:void(0)" onclick="if(confirm('هل انت متأكد من الحذف؟')){event.preventDefault();document.getElementById('delete-form-{{$result_page->id}}').submit();}else{event.preventDefault();}" class="btn btn-danger btn-sm">حذف</a>
                  
                <form id="delete-form-{{$result_page->id}}" method="post" action="{{ route('user.destroy',$result_page->id) }}">
                @method('DELETE')
                @csrf
                </form>
                </td>
                </tr>
				        @endforeach
         
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection


