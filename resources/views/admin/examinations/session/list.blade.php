@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Academic Sessions</h1>
        </div>
        <div class="col-sm-6 text-right">
          <a href="{{ url('admin/examinations/session/add') }}" class="btn btn-primary">Add Session</a>
        </div>
      </div>
    </div>
  </section>
  <!-- general form elements -->
  <div class="card card-primary">
  <div class="card-header">
      <h3 class="card-title">Search Session</h3>
    </div>

  <!-- form start -->
  <form method="get"  action="" > 
    <div class="card-body">
      <div class="row">
      <div class="form-group col-md-3">
        <label>Session Name</label>
        <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="Exam Name">
      </div>                 
        <div class="form-group col-md-3">
        <label>Date</label>
        <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}" placeholder="Date">
        </div>
        <div class="form-group col-md-3">
        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
        <a href="{{ url('admin/examinations/session/list')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
        </div>
        </div>
      </div>
  </form>
</div>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      {{-- Success / Error Message --}}
      @include('_message')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List of Sessions</h3>
        </div>
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>#</th>
                <th>Session Name</th>
                <th>Status</th>
                <th>Created By</th>
                <th>Created Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
          @forelse($getRecord as $value)
              <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>
                  @if($value->is_delete == 0)
                    <span class="badge badge-success">Active</span>
                  @else
                    <span class="badge badge-danger">Deleted</span>
                  @endif
                </td>
                <td>{{ $value->created_name }}</td>
                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                <td>
                  <a href="{{ url('admin/examinations/session/edit/'.$value->id) }}" class="btn btn-sm btn-info">Edit</a>
                  <a href="{{ url('admin/examinations/session/delete/'.$value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this session?')">Delete</a>
                </td>
              </tr>
          @empty
              <tr>
                <td colspan="6" class="text-center">No sessions found</td>
              </tr>
          @endforelse

            </tbody>
          </table>
           <div style="padding: 10px; float: right">
              {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
           </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
