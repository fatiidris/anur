@extends('layouts.app')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Exam Result</h1>
          </div> 
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @foreach($getRecord as $value)
          <div class="col-md-12">
        <div class="card">
        <div class="card-header">
           <h3 class="card-title">{{ $value['exam_name']}}</h3>
           <a class="btn btn-primary btn-sm" style="float: right;" target="_blanck" href="{{ url('student/my_exam_result/print?exam_id='.$value['exam_id'].'&student_id='.Auth::user()->id) }}">Print</a>
        </div>
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>CA1</th>
                      <th>CA2</th>
                      <th>CA3</th>
                      <th>Exam</th>
                      <th>Total Score</th>
                      <th>Passing Mark</th>
                      <th>Full Marks</th>
                      <th>RESULTS</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php
                    $total_score = 0;
                    $full_marks = 0;
                    $result_validation = 0; // 0 = pass, 1 = fail
                    $hasSubjects = isset($value['subject']) && count($value['subject']) > 0;
                  @endphp

                  @foreach($value['subject'] ?? [] as $exam)
                      @php
                        $total_score += $exam['total_score'];
                        $full_marks += $exam['full_marks'];

                        // Pass if student scores >= 40% of the passing mark
                        $subjectPassMarkThreshold = 0.4 * $exam['passing_mark'];
                        if($exam['total_score'] < $subjectPassMarkThreshold) {
                            $result_validation = 1; // mark fail if below threshold
                        }
                      @endphp
                  <tr>
                      <td style="width: 300px;">{{ $exam['subject_name']}}</td>
                      <td>{{ $exam['ca1']}}</td>
                      <td>{{ $exam['ca2']}}</td>
                      <td>{{ $exam['ca3']}}</td>
                      <td>{{ $exam['exam']}}</td>
                      <td>{{ $exam['total_score']}}</td>
                      <td>{{ $exam['passing_mark']}}</td>
                      <td>{{ $exam['full_marks']}}</td>
                      <td>
                          @if($exam['total_score'] >= $subjectPassMarkThreshold)
                              <span style="color: green; font-weight: bold;">Pass</span>
                          @else
                              <span style="color: red; font-weight: bold;">Fail</span>
                          @endif
                      </td>
                  </tr>
                  @endforeach

                  <tr>
                      <td colspan="2">
                          <b>Grand Total: {{ $total_score }}/{{ $full_marks }}</b>
                      </td>
                      <td colspan="2">
                          @php
                            $Percentage = ($full_marks > 0) ? ($total_score * 100) / $full_marks : 0;
                            $getGrade = App\Models\MarksGradeModel::getGrade($Percentage);

                            // Fail automatically if no subjects
                            if (!$hasSubjects) $result_validation = 1;
                          @endphp
                          <b>Percentage: {{ round($Percentage, 2) }}%</b>
                      </td>
                      <td colspan="2">
                          <b>Grade: {{ $getGrade }}</b>
                      </td>
                      <td colspan="3">
                          <b>Result: 
                              @if($result_validation == 0)
                                  <span style="color: green;">Pass</span>
                              @else
                                  <span style="color: red;">Fail</span>
                              @endif
                          </b>
                      </td>
                  </tr>
    
                  </tbody>
                </table>                     
                </div>
              </div>
          </div> 
          @endforeach     
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  @endsection