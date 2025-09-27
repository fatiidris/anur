@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subject Teacher List</h1>
        </div>
        <div class="col-sm-6 text-right">
          <a href="{{ url('admin/assign_subject_teacher/add') }}" class="btn btn-primary">
            Add New Subject Teacher
          </a>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('_message')

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body table-responsive p-0">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Class Name</th>
                    <th>Subject Name</th>
                    <th>Teachers Name</th>
                    <th>Created By</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($getRecord as $index => $value)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $value->class_name }}</td>
                      <td> {{ $value->subject_name }} </td>
                       <td> {{ $value->teacher_name }} {{ $value->teacher_last_name }}</td>
                       <td> {{ $value->created_by_name }} </td>
                      <td>
                        @if($value->status == 0)
                          <span class="badge badge-success">Active</span>
                        @else
                          <span class="badge badge-danger">Inactive</span>
                        @endif
                      </td>
                      <td>
                        <a href="{{ url('admin/assign_subject_teacher/edit/'.$value->id) }}"
                           class="btn btn-sm btn-primary">Edit</a>

                        <!-- <a href="{{ url('admin/assign_subject_teacher/edit_single/'.$value->id) }}"
                           class="btn btn-sm btn-warning">Edit Single</a> -->

                        <a href="{{ url('admin/assign_subject_teacher/delete/'.$value->id) }}"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this record?')">
                           Delete
                        </a>
                      </td>
                    </tr>
                  @endforeach

                  @if($getRecord->isEmpty())
                    <tr>
                      <td colspan="6" class="text-center text-muted">
                        No records found
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>

          <!-- Pagination -->
          <div style="padding: 10px; float: right;">
            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
          </div>

        </div>
      </div>
    </div>
  </section>
</div>
@endsection
