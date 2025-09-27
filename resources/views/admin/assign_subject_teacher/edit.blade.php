@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Subject Assignment</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      @include('_message')   {{-- ✅ Flash / validation messages --}}

      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <!-- form start -->
            <form method="post" action="">
              {{ csrf_field() }}
              <div class="card-body">

                {{-- Class --}}
                <div class="form-group">
                    <label>Class Name</label>
                    <select class="form-control" name="class_id" required>
                      <option value="">Select Class</option>
                      @foreach($getClass as $class)
                      <option {{ ($getRecord->class_id == $class->id ) ? 'selected' : ''}} value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label>Subject Name</label>
                    
                      @foreach($getSubject as $subject)
                      @php
                        $checked = "checked";
                      @endphp
                      @foreach($getAssignSubjectID as $subjectAssign)
                        @if($subjectAssign->subject_id == $subject->id)
                      @php
                        $checked = "";
                      @endphp

                        @endif
                      @endforeach
                      <div>
                        <label for="" style="font-weight: normal;">
                          <input {{ $checked }} type="checkbox" value="{{ $subject->id }}" name="subject_id[]">{{ $subject->name }}
                        </label>
                      </div>
                      @endforeach 
                  </div>
                {{-- Teacher(s) --}}
                <div class="form-group">
                    <label>Teacher Name</label>
                    @foreach($getTeacher as $teacher)
                      <div>
                      <label style="font-weight: normal;">
                        @php
                            $checked = '';
                        @endphp
                        @foreach($getAssignTeacherID as $teacherID)
                         @if($teacherID->teacher_id == $teacher->id)
                            @php
                               $checked = 'checked';
                           @endphp
                         @endif
                        @endforeach
                        <input {{$checked}} type="checkbox" value="{{ $teacher->id }}" name="teacher_id[]">{{ $teacher->name }} {{ $teacher->last_name }}
                      </label>
                      </div>
                    @endforeach
                  </div>
                {{-- Status --}}
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                      <option {{ ($getRecord->status == 0 ) ? 'selected' : ''}} value="0">Active</option>
                      <option {{ ($getRecord->status == 1 ) ? 'selected' : ''}} value="1">Inactive</option>
                    </select>
                  </div>

              </div><!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
