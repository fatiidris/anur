@extends('layouts.app')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>My Notice Board</h1>
          </div>
         </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Search Notice Board</h3>
              </div>

              <!-- form start -->
              <form method="get"  action="" > 
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-3">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ Request::get('title') }}" placeholder="Title">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Notice Date From</label>
                    <input type="date" class="form-control" name="notice_date_from" value="{{ Request::get('notice_date_from') }}" placeholder="">
                    </div>

                  <div class="form-group col-md-3">
                    <label>Notice Date TO</label>
                    <input type="date" class="form-control" name="notice_date_to" value="{{ Request::get('notice_date_to') }}" placeholder="">
                    </div>
                    <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ url('teacher/my_notice_board')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div>
                   </div>
                  </div>
              </form>
             </div>
            </div>

        @foreach($getRecord as $value)
        <div class="col-md-12">
          <div class="card card-primary card-outline">
           
            <div class="card-body p-0">
              <div class="mailbox-read-info">
                <h5>{{ $value->title }}</h5>
                <h6 style="margin-top: 10px;">
                {{ date('d-m-Y', strtotime($value->notice_date))}}</h6>
              </div>
             
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                    {!! html_entity_decode($value->message) !!}
              </div>
            </div> 
          </div>
        </div>
        @endforeach
        <div class="col-sm-12">
            <div style="padding: 10px; float: right">
                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
      </div>
      </div>
    </section>
   
  </div>
  @endsection