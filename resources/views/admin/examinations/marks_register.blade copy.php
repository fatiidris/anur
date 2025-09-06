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
              <form method="GET" action="{{ url('admin/examinations/marks_register') }}">
              @csrf
                <div class="card-body">
                  <div class="row">
                  <div class="form-group col-md-3">
                    <label>Exam</label>
                    <select name="exam_id" class="form-control" required>
                      <option value="">Select</option>
                    @foreach($getExam as $exam)
                          <option {{ ( Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id}}">{{ $exam->name}}</option>

                     @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Class</label>
                    <select name="class_id" class="form-control" required>
                      <option value="">Select</option>
                        @foreach($getClass as $class)
                          <option {{ ( Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id}}">{{ $class->name}}</option>
                        @endforeach
                    </select>
                     </div>
                    <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                    <a href="{{ url('admin/examinations/marks_register')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
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
                                        $totalFullMarks += $subject->full_marks;
                                        $totalPassingMarks += $subject->passing_mark;

                                        $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id);

                                        if (!empty($getMark)) {
                                            $totalMark = ($getMark->ca1 ?? 0) + ($getMark->ca2 ?? 0) + ($getMark->ca3 ?? 0) + ($getMark->exam ?? 0);
                                        }

                                        $totalStudentMark += $totalMark;

                                        // Subject position calculation
                                        $subjectPosition = App\Models\MarksRegisterModel::getSubjectPosition(
                                            Request::get('exam_id'),
                                            Request::get('class_id'),
                                            $subject->subject_id,
                                            $student->id
                                        );
                                    @endphp

                                    <td>
                                        <h5>{{ $subject->subject_name ?? 'Subject' }}</h5>

                                        @foreach(['ca1'=>'CA1','ca2'=>'CA2','ca3'=>'CA3','exam'=>'Exam'] as $key => $label)
                                            <div class="mb-2">
                                                {{ $label }}
                                                <input type="text" class="form-control w-50"
                                                      name="mark[{{ $i }}][{{ $key }}]"
                                                      id="{{ $key }}_{{ $student->id }}{{ $subject->subject_id }}"
                                                      value="{{ $getMark->$key ?? '' }}"
                                                      placeholder="Enter Marks">
                                            </div>
                                        @endforeach

                                        <input type="hidden" name="mark[{{ $i }}][full_marks]" value="{{ $subject->full_marks }}">
                                        <input type="hidden" name="mark[{{ $i }}][passing_mark]" value="{{ $subject->passing_mark }}">
                                        <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $subject->id }}">
                                        <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">

                                        <button type="button" class="btn btn-primary SaveSingleSubject"
                                                data-student="{{ $student->id }}"
                                                data-subject="{{ $subject->subject_id }}"
                                                data-exam="{{ Request::get('exam_id') }}"
                                                data-class="{{ Request::get('class_id') }}"
                                                data-schedule="{{ $subject->id }}">
                                            Save
                                        </button>

                                        @if(!empty($getMark))
                                            <div class="mt-2">
                                                <b>Total:</b> {{ $totalMark }} <br>
                                                <b>Passing:</b> {{ $subject->passing_mark }} <br>
                                                <b>Position:</b> {{ $subjectPosition }} <br>

                                                @php
                                                    $grade = App\Models\MarksGradeModel::getGrade($totalMark);
                                                @endphp
                                                @if($grade)
                                                    <b>Grade:</b> {{ $grade }} <br>
                                                @endif

                                                @if($totalMark >= $subject->passing_mark)
                                                    <span class="text-success fw-bold">Pass</span>
                                                @else
                                                    <span class="text-danger fw-bold">Fail</span>
                                                    @php $pass_fail_vali = 1; @endphp
                                                @endif
                                            </div>
                                        @endif
                                    </td>

                                    @php $i++; @endphp
                                @endforeach

                                <td class="p-3">
                                    <button type="submit" class="btn btn-success mb-2">Save All</button>
                                    <a class="btn btn-primary mb-2"
                                      target="_blank"
                                      href="{{ url('admin/my_exam_result/print?exam_id='.Request::get('exam_id').'&student_id='.$student->id) }}">
                                        Print
                                    </a>

                                    @if(!empty($totalStudentMark))
                                        <div>
                                            <b>Total Subject Marks:</b> {{ $totalFullMarks }} <br>
                                            <b>Total Passing Marks:</b> {{ $totalPassingMarks }} <br>
                                            <b>Total Obtained:</b> {{ $totalStudentMark }} <br>

                                            @php
                                                $percentage = ($totalStudentMark * 100) / $totalFullMarks;
                                                $overallGrade = App\Models\MarksGradeModel::getGrade($percentage);
                                            @endphp

                                            <b>Percentage:</b> {{ round($percentage, 2) }}% <br>
                                            @if($overallGrade)
                                                <b>Overall Grade:</b> {{ $overallGrade }} <br>
                                            @endif

                                            <b>Result:</b>
                                            @if($pass_fail_vali == 0)
                                                <span class="text-success fw-bold">Pass</span>
                                            @else
                                                <span class="text-danger fw-bold">Fail</span>
                                            @endif
                                        </div>
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
        url: "{{ url('admin/examinations/submit_marks_register') }}",
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
        url: "{{ url('admin/examinations/single_submit_marks_register') }}",
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