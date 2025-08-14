@extends('layouts.app')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Exam</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @include('_message')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- form start -->
              <form method="post"  action="" >
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Exam Name</label>
                    <input type="name" class="form-control" name="name" value="{{ $getRecord->name }}" required placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label>Note</label>
                    <textarea class="form-control" name="note"  placeholder="Note">{{ $getRecord->note }}</textarea>
                   </div>

                  </div>
                  

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection