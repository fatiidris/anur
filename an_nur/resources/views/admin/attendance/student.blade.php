@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Student Attendance</h1>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
                  <!-- general form elements -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Search Student Attendance</h3>
              </div>
              <!-- form start -->
              <form method="GET" action="{{ url('admin/attendance/student') }}">
              @csrf
                <div class="card-body">
                  <div class="row">
                  
                  <div class="form-group col-md-3">
                    <label>Class</label>
                    <select name="class_id" id="getClass" class="form-control" required>
                      <option value="">Select</option>
                        @foreach($getClass as $class)
                          <option {{ ( Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id}}">{{ $class->name}}</option>
                        @endforeach
                    </select>
                     </div>

                     <div class="form-group col-md-3">
                    <label>Attendance Date</label>
                    <input type="date" class="form-control" id="getAttendanceDate" value="{{ Request::get('attendance_date')}}" name="attendance_date" required>
                     </div>

                    <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ url('admin/attendance/student')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div>
                   </div>
                  </div>
              </form>
            </div>
           @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
                <div class="card">
                   <div class="card-header">
                          <h3 class="card-title">Student List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0" style="overflow: auto;">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Attendance</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if(!empty($getStudent) && !empty($getStudent->count()))
                            @foreach($getStudent as $value)
                            @php
                              $attendance_type = '';
                              $getAttendance = $value->getAttendance($value->id, Request::get('class_id'), Request::get('attendance_date'));
                              if(!empty($getAttendance->attendance_type))
                              {
                                $attendance_type = $getAttendance->attendance_type;
                              }
                            @endphp
                           <tr>
                             <td>{{ $value->id }}</td>
                             <td>{{ $value->name }} {{ $value->last_name }}</td>
                             <td>
                              <label for="" style="margin-right: 10px;">
                                 <input value="1" type="radio"  id="{{ $value->id }}" {{ ($attendance_type == '1') ? 'checked' : ''}} class="SaveAttendance" name="attendance{{ $value->id }}">Present
                              </label>
                              <label for="" style="margin-right: 10px;">
                                 <input value="2" type="radio" id="{{ $value->id }}" {{ ($attendance_type == '2') ? 'checked' : ''}} class="SaveAttendance" name="attendance{{ $value->id }}">Late
                              </label>
                              <label for="" style="margin-right: 10px;"> 
                                <input value="3" type="radio" id="{{ $value->id }}" {{ ($attendance_type == '3') ? 'checked' : ''}} class="SaveAttendance" name="attendance{{ $value->id }}">Absent
                              </label>
                              <label for="" style="margin-right: 10px;">
                                 <input value="4" type="radio" id="{{ $value->id }}"  {{ ($attendance_type == '4') ? 'checked' : ''}} class="SaveAttendance" name="attendance{{ $value->id }}">Half Day
                              </label>
                             </td>
                           </tr>
                            @endforeach
                        @endif
                        </tbody>  

                      </table>
                   </div>
                </div>
            @endif

         </div>
        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection

  @section('script').
  <script type="text/javascript">

  $('.SaveAttendance').change(function(e){

    var student_id = $(this).attr('id');
    var attendance_type	 = $(this).val();
    var class_id = $('#getClass').val();
    var attendance_date = $('#getAttendanceDate').val();

    $.ajax({
        type: "POST",
        url: "{{ url('admin/attendance/student/save') }}",
        data : {
          "_token": "{{ csrf_token() }}", 
          student_id : student_id,
          attendance_type :attendance_type,
          class_id : class_id,
          attendance_date : attendance_date,
          
        },
        dataType: "json",
        success: function(data) {
          alert(data.message);

        }
    });
  });
    
  </script>

  @endsection