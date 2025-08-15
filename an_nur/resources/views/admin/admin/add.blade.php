@extends('layouts.app')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Admin</h1>
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
              <form method="post"  action="" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="name" class="form-control" name="name" value="{{ old('name')}}" required placeholder="Name">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email')}}" required placeholder="Email">
                    <div style="color: red">
                   {{ $errors->first('email')}}
                   </div>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                  </div>
                                    
                  <div class="form-group">
                    <label>profile_pic<span style="color: red;"></span></label>
                    <input type="file" class="form-control" name="profile_pic">
                    <div style="color: red"> {{ $errors->first('profile_pic')}} </div>
                  </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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