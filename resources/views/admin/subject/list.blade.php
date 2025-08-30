@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Subject List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right;">
          <a href="{{url('admin/subject/add')}}" class="btn btn-primary">Add New Subject</a>
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
                <h3 class="card-title">Search Subject</h3>
              </div>

              <!-- form start -->
              <form method="get"  action="" > 
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Name">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Sbject Type</label>
                    <select name="type" class="form-control">
                      <option value="">Select Type</option>
                      <option {{ (Request::get('type') == 'Theory') ? 'selected' : '' }} value="Theory">Theory</option>
                      <option {{ (Request::get('type') == 'Theory') ? 'selected' : '' }} value="practical">practical</option>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}" placeholder="">
                   </div>
                   <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ url('admin/subject/list')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                 </div>
                   </div>
                  </div>
              </form>
            </div>
          <!--/.col (right) -->

          @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Subject List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Subject Name</th>
                      <th>Subject Type</th>
                      <th>Status</th>
                      <th>Created By</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($getRecord as $value)
                    <tr>
                      <td> {{ $value->id }} </td>
                      <td> {{ $value->name }} </td>
                      <td> {{ $value->type }} </td>
                      <td>
                        @if($value->status == 0)
                           Active
                        @else
                           Inactive
                        @endif
                      </td>
                      <td> {{ $value->created_by_name }} </td>
                      <td> {{ date('d-m-Y H:i A', strtotime($value->created_at)) }} </td>
                      <td>
                          <a href="{{ url('admin/subject/edit/'.$value->id) }}" class="btn btn-primary" title="Edit">
                            <i class="fas fa-edit"></i>
                          </a>
                          <a href="{{ url('admin/subject/delete/'.$value->id) }}" class="btn btn-danger" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <div style="padding: 10px; float: right">
                      {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
                <div style="padding: 10px; float: right">      
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