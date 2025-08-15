@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Marks Grade</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
          <a href="{{url('admin/examinations/marks_grade/add')}}" class="btn btn-primary">Add New Marks Grade</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">

            @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Marks Grade List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Grade Name</th>
                      <th>Percent From</th>
                      <th>Percent To</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($getRecord as $value)
                  <tr>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->percent_from }}</td>
                    <td>{{ $value->percent_to }}</td>
                    <td>{{ $value->created_name }}</td>
                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                    <td> 
                      <a href="{{ url ('admin/examinations/marks_grade/edit/'.$value->id)}}" class="btn btn-primary">Edit</a>
                      <a href="{{ url ('admin/examinations/marks_grade/delete/'.$value->id)}}" class="btn btn-danger">Delete</a>    
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                
              </div>


          </div>

        
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection