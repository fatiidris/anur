@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Class Timetable</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
          <a href="{{url('admin/class_timmetable/add')}}" class="btn btn-primary">Add New Class Timetable</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <!-- general form elements -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Search Class Timetable</h3>
              </div>

              <!-- form start -->
              <form method="get"  action="" > 
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-3">
                    <label>Class Name</label>
                    <input type="text" class="form-control" name="class_name" value="{{ Request::get('class_name') }}" placeholder="Class Name">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Subject Name</label>
                    <input type="text" class="form-control" name="subject_name" value="{{ Request::get('subject_name') }}" placeholder="Subject Name">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}" placeholder="">
                   </div>
                   <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ url('admin/assign_subject/list')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                 </div>
                   </div>
                  </div>
              </form>
            </div>
          <!--/.col (right) -->

  @include('_message')

  @extends('layouts.app')

  @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Class Timetable</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <!-- general form elements -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Search Assign Subject</h3>
              </div>

              <!-- form start -->
              <form method="get"  action="" > 
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-3">
                    <label>Class Name</label>
                    <input type="text" class="form-control" name="class_name" value="{{ Request::get('class_name') }}" placeholder="Class Name">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Subject Name</label>
                    <input type="text" class="form-control" name="subject_name" value="{{ Request::get('subject_name') }}" placeholder="Subject Name">
                  </div>
                  
                   <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ url('admin/assign_subject/list')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                 </div>
                   </div>
                  </div>
              </form>
            </div>
          <!--/.col (right) -->

        

                 
                </div>
              </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
              </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection