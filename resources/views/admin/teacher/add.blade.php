@extends('layouts.app')

@section('content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Teacher</h1>
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
              <form method="post"  action="" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label>First Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name')}}" required placeholder="First Name">
                    <div style="color: red">{{ $errors->first('name')}} </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Last Name <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name')}}" required placeholder="Last Name">
                    <div style="color: red">{{ $errors->first('last_name')}} </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Email<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="email" value="{{ old('email')}}" required placeholder="Email">
                    <div style="color: red"> {{ $errors->first('email')}} </div>
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label>Gender<span style="color: red;">*</span></label>
                    <select class="form-control" required name="gender">
                      <option value="">Select Gender</option>
                      <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                      <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                      <option {{ (old('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                    </select>
                    <div style="color: red"> {{ $errors->first('gender')}} </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Mobile Number<span style="color: red;"></span></label>
                    <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number')}}" placeholder="Mobile Number">
                    <div style="color: red"> {{ $errors->first('mobile_number')}} </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Marital Status<span style="color: red;">*</span></label>
                    <select class="form-control" required name="marital_status">
                      <option value="">Select Marital Status</option>
                      <option {{ (old('marital_status') == 'Married') ? 'selected' : '' }} value="Married">Married</option>
                      <option {{ (old('marital_status') == 'Single') ? 'selected' : '' }} value="Single">Single</option>
                      <option {{ (old('marital_status') == 'Other') ? 'selected' : '' }} value="Other">Other</option>
                    </select>
                    <div style="color: red"> {{ $errors->first('marital_status') }} </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Date Of Birth<span style="color: red;">*</span></label>
                    <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth')}}" required placeholder="Date Of Birth">
                    <div style="color: red"> {{ $errors->first('date_of_birth')}} </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Date Of Joining<span style="color: red;">*</span></label>
                    <input type="date" class="form-control" name="date_of_joining" value="{{ old('date_of_joining')}}" required placeholder="Date Of Birth">
                    <div style="color: red"> {{ $errors->first('date_of_joining')}} </div>
                  </div>

                  
                  <div class="form-group col-md-6">
                    <label>profile_pic<span style="color: red;"></span></label>
                    <input type="file" class="form-control" name="profile_pic">
                    <div style="color: red"> {{ $errors->first('profile_pic')}} </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Current Address<span style="color: red;"></span></label>
                    <input type="text" class="form-control" name="address" placeholder="address">
                    <div style="color: red"> {{ $errors->first('address')}} </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Permanent Address<span style="color: red;"></span></label>
                    <input type="text" class="form-control" name="permanent_address"value="{{ old('permanent_address')}}"  placeholder="Permanent Address">
                    <div style="color: red"> {{ $errors->first('permanent_address')}} </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Qualification<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="qualification"value="{{ old('qualification')}}"  placeholder="Permanent Address">
                    <div style="color: red"> {{ $errors->first('qualification')}} </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Work Experience<span style="color: red;"></span></label>
                    <input type="text" class="form-control" name="work_experience"value="{{ old('work_experience')}}"  placeholder="Permanent Address">
                    <div style="color: red"> {{ $errors->first('work_experience')}} </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Note<span style="color: red;"></span></label>
                    <input type="text" class="form-control" name="note"value="{{ old('note')}}"  placeholder="Note">
                    <div style="color: red"> {{ $errors->first('note')}} </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Status<span style="color: red;">*</span></label>
                    <select name="" class="form-control" required name="status">
                      <option value="">Select Status</option>
                      <option  {{ (old('status') == 0) ? 'selected' : '' }}  value="0">Active</option>
                      <option  {{ (old('status') == 1) ? 'selected' : '' }}  value="1">Inactive</option>
                    </select>
                    <div style="color: red"> {{ $errors->first('status')}} </div>
                  </div>

                  </div>
                  
                  <div class="form-group">
                    <label>Password<span style="color: red;">*</span></label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
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