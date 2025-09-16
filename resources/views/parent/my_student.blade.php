@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Student</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
    <div class="container-fluid">
            <!-- general form elements -->
            <div class="row">
            <div class="col-md-12">

          @include('_message')

          
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Student</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>profile_pic</th>
                      <th>Student Name</th>
                      <th>Email</th>
                      <th>Admission Number</th>
                      <th>Roll Number</th>
                      <th>Class</th>
                      <th>Admission Date</th>
                      <th>Blood Group</th>
                      <th>Height</th>
                      <th>Weight</th>
                      <th>Created Date</th>
                      <th>Action</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($getRecord as $value)
                  <tr>
                    <td>
                      @if(!empty($value->getProfile()))
                      <img src="{{ $value->getProfile() }}" style="height: 50px; width: 50px; border-radius: 50px;" alt="">
                      @endif
                    </td>
                    <td>{{ $value->name }} {{ $value->last_name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->admission_number }}</td>
                    <td>{{ $value->roll_number }}</td>
                    <td>{{ $value->class_name }}</td>
                    <td>
                      @if(!empty($value->admission_date))
                      {{ date('d-m-Y', strtotime( $value->admission_date)) }}
                      @endif
                   </td>
                    <td>{{ $value->blood_group }}</td>
                    <td>{{ $value->height }}</td>
                    <td>{{ $value->weight }}</td>
                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                    <td style="min-width: 300px;">
                        <a style="margin-bottom: 10px;" class="btn btn-success btn-sm" href="{{url('parent/my_student/subject/'.$value->id)}}" title="Subject">
                          <i class="fas fa-book"></i>
                        </a>
                        <a style="margin-bottom: 10px;" class="btn btn-primary btn-sm" href="{{url('parent/my_student/exam_timetable/'.$value->id)}}" title="Exam Timetable">
                          <i class="fas fa-calendar-alt"></i>
                        </a>
                    @foreach($students as $student)
    @foreach($exams as $exam)
        <a class="btn btn-primary btn-sm" target="_blank"
           href="{{ url('parent/my_exam_result/print?exam_id='.$exam->id.'&student_id='.$student->id) }}">
            <i class="fas fa-file-alt"></i> Print {{ $student->name }} – {{ $exam->name }}
        </a>
    @endforeach
@endforeach



                        <a style="margin-bottom: 10px;" class="btn btn-warning btn-sm" href="{{url('parent/my_student/calender/'.$value->id)}}" title="Calendar">
                          <i class="fas fa-calendar"></i>
                        </a>
                        <a style="margin-bottom: 10px;" class="btn btn-primary btn-sm" href="{{url('parent/my_student/attendance/'.$value->id)}}" title="Attendance">
                          <i class="fas fa-user-check"></i>
                        </a>
                        <a style="margin-bottom: 10px;" class="btn btn-primary btn-sm" href="{{url('parent/my_student/homework/'.$value->id)}}" title="Homework">
                          <i class="fas fa-tasks"></i>
                        </a>
                        <a style="margin-bottom: 10px;" class="btn btn-primary btn-sm" href="{{url('parent/my_student/submitted_homework/'.$value->id)}}" title="Submitted Homework">
                          <i class="fas fa-check-circle"></i>
                        </a>
                        <a style="margin-bottom: 10px;" class="btn btn-success btn-sm" href="{{url('parent/my_student/fees_collection/'.$value->id)}}" title="Fees Collection">
                          <i class="fas fa-money-bill-wave"></i>
                        </a>
                    </td>
                </tr>
                  @endforeach

                  </tbody>
                </table>
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