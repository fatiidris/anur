@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Marks Register</h1>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
                  <!-- general form elements -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Search Marks Register</h3>
              </div>
              <!-- form start -->
              <form method="GET" action="{{ url('teacher/marks_register') }}">
              @csrf
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-3">
                    <label>Exam</label>
                    <select name="exam_id" class="form-control" required>
                      <option value="">Select</option>
                    @foreach($getExam as $exam)
                          <option {{ ( Request::get('exam_id') == $exam->exam_id) ? 'selected' : '' }} value="{{ $exam->exam_id}}">{{ $exam->exam_name}}</option>
                     @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Class</label>
                    <select name="class_id" class="form-control" required>
                      <option value="">Select</option>
                        @foreach($getClass as $class)
                          <option {{ ( Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id}}">{{ $class->class_name}}</option>
                        @endforeach
                    </select>
                     </div>
                    <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ url('teacher/marks_register')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div>
                   </div>
                  </div>
              </form>
            </div>
          <!--/.col (right) -->

          @include('_message')

          @if(!empty($getSubject) && !empty($getSubject->count()))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Marks Register</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0" style="overflow: auto;">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>STUDENT NAME</th>
                      @foreach($getSubject as $subject)
                      <th>{{ $subject->subject_name}} <br>
                      ( {{ $subject->subject_type}}: {{ $subject->passing_mark}}/ {{ $subject->full_marks}})

                      </th>
                      @endforeach
                    
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                      @if(!empty($getStudent) && $getStudent->count())
                          @foreach($getStudent as $student)
                          <form name="post" class="SubmitForm" action="{{ url('admin/examinations/submit_marks_register') }}" method="POST">
                              @csrf
                              <input type="hidden" name="student_id" value="{{ $student->id }}">
                              <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                              <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                              
                              <tr>
                                  <td>{{ $student->name }} {{ $student->last_name }}</td>
                                  
                                  @php
                                    $i = 1; 
                                    $totalStudentMark = 0;
                                    $totalFullMarks = 0;
                                    $totalPassingMarks = 0;
                                    $pass_fail_vali = 0;
                                  @endphp
                                  
                                  @foreach($getSubject as $subject)
                                      @php
                                          $totalMark = 0;
                                          $totalFullMarks = $totalFullMarks + $subject->full_marks;
                                          $totalPassingMarks = $totalPassingMarks + $subject->passing_mark;

                                          $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id);
                                          
                                          if (!empty($getMark)) {
                                              $totalMark = $getMark->ca1 + $getMark->ca2 + $getMark->ca3 + $getMark->exam;
                                          }

                                          $totalStudentMark = $totalStudentMark + $totalMark;
                                          
                                           // Subject position calculation
                                           $subjectPosition = App\Models\MarksRegisterModel::getSubjectPosition(
                                              Request::get('exam_id'),
                                              Request::get('class_id'),
                                              $subject->subject_id,
                                              $student->id
                                          );
                                      @endphp
                                      
                                      <td>
                                          <div style="margin-bottom: 10px;">
                                                CA1
                                              <input type="hidden" name="mark[{{ $i }}][full_marks]" value="{{ $subject->full_marks }}">
                                              <input type="hidden" name="mark[{{ $i }}][passing_mark	]" value="{{ $subject->passing_mark	 }}">
                                              <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $subject->id }}">
                                              <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">
                                              <input type="text" style="width: 200px;" name="mark[{{ $i }}][ca1]" id="ca1_{{ $student->id }}{{ $subject->subject_id }}" 
                                                  value="{{ !empty($getMark->ca1) ? $getMark->ca1 : '' }}" 
                                                  placeholder="Enter Marks" class="form-control">
                                          </div>

                                          <div style="margin-bottom: 10px;">
                                              CA2
                                              <input type="text" style="width: 200px;" id="ca2_{{ $student->id }}{{ $subject->subject_id }}" name="mark[{{ $i }}][ca2]" 
                                                  value="{{ !empty($getMark->ca2) ? $getMark->ca2 : '' }}" 
                                                  placeholder="Enter Marks" class="form-control">
                                          </div>

                                          <div style="margin-bottom: 10px;">
                                              CA3
                                              <input type="text" style="width: 200px;" id="ca3_{{ $student->id }}{{ $subject->subject_id }}" name="mark[{{ $i }}][ca3]" 
                                                  value="{{ !empty($getMark->ca3) ? $getMark->ca3 : '' }}" 
                                                  placeholder="Enter Marks" class="form-control">
                                          </div>

                                          <div style="margin-bottom: 10px;">
                                              Exam 
                                              <input type="text" style="width: 200px;" id="exam_{{ $student->id }}{{ $subject->subject_id }}" name="mark[{{ $i }}][exam]" 
                                                  value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" 
                                                  placeholder="Enter Marks" class="form-control">
                                          </div>

                                          <div style="margin-bottom: 10px;">
                                              <button type="button" class="btn btn-primary SaveSingleSubject" id="{{ $student->id }}" 
                                                  data-val="{{ $subject->subject_id }}" 
                                                  data-exam="{{ Request::get('exam_id') }}" 
                                                  data-schedule="{{ $subject->id }}" 
                                                  data-class="{{ Request::get('class_id') }}">
                                                  Save
                                              </button>
                                          </div>
                                           @if(!empty($getMark)) 
                                            <div style="margin-bottom: 10px;">
                                            <b> Total Mark :</b>{{ $totalMark }} <br>
                                            <b> Passing Mark : </b>{{ $subject->passing_mark }} <br>
                                            <b>Position:</b> {{ $subjectPosition }} <br>
                                            @php
                                               $getLoopGrade = App\Models\MarksGradeModel::getGrade($totalMark);
                                            @endphp
                                            @if(!empty($getLoopGrade))
                                               <b> Grade : </b>{{ $getLoopGrade }} <br>
                                            @endif
                                            @if($totalMark >= $subject->passing_mark) 
                                              <span style="color: green;font-weight: bold ">Pass</span>
                                            @else
                                              <span style="color: red; font-weight: bold">Fail</span>
                                              @php
                                              $pass_fail_vali = 1;
                                              @endphp
                                            @endif
                                            </div>
                                          @endif
                                      </td>
                                      
                                      @php $i++;
                                    @endphp
                                  @endforeach


                                  <td style="min-width: 250px;">
                                      <button type="submit" class="btn btn-success">Save</button>
                                      <!-- <a class="btn btn-primary" target="_blanck" href="{{ url('teacher/my_exam_result/print?exam_id='.Request::get('exam_id').'&student_id='.$student->id) }}">Print</a> -->
                                       @if(!empty($totalStudentMark))
                                          <br>
                                          <b>Total Subject Mark : </b>{{ $totalFullMarks }}
                                          <br>
                                          <b>Total Passing Mark :</b>{{ $totalPassingMarks }}
                                          <br>
                                          <b>Total Student Mark : </b> {{ $totalStudentMark }}
                                          <br>
                                          @php
                                            $percentage = ($totalStudentMark * 100)/$totalFullMarks;
                                            $getGrade = App\Models\MarksGradeModel::getGrade($percentage);
                                          @endphp
                                          <br>
                                         <b>Percentage :</b>{{round($percentage, 2) }}%
                                         <br>
                                         @if(!empty($getGrade))
                                         <b>Grade :</b> {{ $getGrade }}
                                         <br>
                                         @endif
                                          @if($pass_fail_vali == 0)
                                            Result :  <span style="color: green;font-weight: bold ">Pass</span>
                                          @else
                                            Result : <span style="color: red; font-weight: bold">Fail</span>
                                          @endif 
                                       @endif  
                                  </td>
                              </tr>
                          </form>
                          @endforeach
                      @endif
                  </tbody>

                </table>
              </div>
          </div>
          @endif
        </div>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection

  @section('script').
  <script type="text/javascript">
    $('.SubmitForm').submit(function(e){
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "{{ url('teacher/submit_marks_register') }}",
        data : $(this).serialize(),
        dataType: "json",
        success: function(data) {
          alert(data.message);

        }
    });
  });

  $('.SaveSingleSubject').click(function(e){
    var student_id = $(this).attr('id');
    var subject_id = $(this).attr('data-val');
    var exam_id = $(this).attr('data-exam');
    var class_id = $(this).attr('data-class');
    var id = $(this).attr('data-schedule');
  
    var ca1 = $('#ca1_'+student_id+subject_id).val();
    var ca2 = $('#ca2_'+student_id+subject_id).val();
    var ca3 = $('#ca3_'+student_id+subject_id).val();
    var exam = $('#exam_'+student_id+subject_id).val();
    
    $.ajax({
        type: "POST",
        url: "{{ url('teacher/single_submit_marks_register') }}",
        data : {
          "_token": "{{ csrf_token() }}", 
          id : id,
          student_id : student_id,
          subject_id : subject_id,
          exam_id : exam_id,
          class_id : class_id,
          ca1 : ca1,
          ca2 : ca2,
          ca3 : ca3,
          exam : exam
        },
        dataType: "json",
        success: function(data) {
          alert(data.message);

        }
    });
  });
  </script>


  @endsection