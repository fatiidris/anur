@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add New Subject Assignment</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="card card-primary">
            <!-- form start -->
            <form action="" method="POST">
              @csrf
        
              <div class="card-body">

                {{-- Class --}}
                 <div class="form-group">
                    <label>Class Name</label>
                    <select class="form-control" name="class_id" required>
                      <option value="">Select Class</option>
                      @foreach($getClass as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                    </select>
                  </div>
                 {{-- Subject --}}
                <div class="form-group">
                    <label>Subject Name</label>
                    
                      @foreach($getSubject as $subject)
                      <div>
                        <label for="" style="font-weight: normal;">
                          <input type="checkbox" value="{{ $subject->id }}" name="subject_id[]">{{ $subject->name }}
                        </label>
                      </div>
                      @endforeach 
                  </div>
                {{-- Teacher --}}
                 <div class="form-group">
                    <label>Teacher Name</label>
                    @foreach($getTeacher as $teacher)
                      <div>
                      <label style="font-weight: normal;">
                        <input type="checkbox" value="{{ $teacher->id }}" name="teacher_id[]">{{ $teacher->name }} {{ $teacher->last_name }}
                      </label>
                      </div>
                    @endforeach
                  </div>
                {{-- Status --}}
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
                  </select>
                </div>

              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <!--/.col -->
      </div>
    </div>
  </section>
</div>
@endsection
