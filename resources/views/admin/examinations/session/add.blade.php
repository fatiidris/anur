@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Academic Session</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form method="post" action="">
                {{ csrf_field() }}

                <div class="card-body">
                  {{-- Success & Error Messages --}}
                  @include('_message')

                  <div class="form-group">
                    <label>Session Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name')}}" required placeholder="e.g. 2024/2025">
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select name="is_delete" class="form-control">
                      <option value="0" selected>Active</option>
                      <option value="1">Deleted</option>
                    </select>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div> 
          </div>
          <!--/.col (right) -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
