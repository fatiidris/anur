@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        My Subject Marks Register : 
                        @if(!empty($getSubject) && $getSubject->count())
                            {{ $getSubject->first()->subject->name }} 
                        @endif
                    </h1>

                </div>
            </div>
        </div>
    </section>

    <!-- Search Form -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Search My Subject Marks Register</h3>
        </div>
        <form method="GET" action="{{ url('teacher/my_subject_marks') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Exam</label>
                        <select name="exam_id" class="form-control" required>
                            <option value="">Select</option>
                            @foreach($getExam as $exam)
                                <option {{ ( Request::get('exam_id') == $exam->exam_id) ? 'selected' : '' }} value="{{ $exam->exam_id}}">
                                    {{ $exam->exam_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Class</label>
                        <select name="class_id" class="form-control" required>
                            <option value="">Select</option>
                            @foreach($getClass as $class)
                                <option value="{{ $class->id }}" {{ Request::get('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <button class="btn btn-primary" type="submit" style="margin-top: 30px;">Search</button>
                        <a href="{{ url('teacher/my_subject_marks')}}" class="btn btn-success" style="margin-top: 30px;">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('_message')

    <!-- Marks Table -->
    <div id="mark-register-status" class="alert d-none mx-3"></div>

    <!-- Marks Entry Table -->
    @if(!empty($getSubject) && !empty($getSubject->count()))
        <div class="card mx-3">
            <div class="card-header">
                <h3 class="card-title">Enter Marks for ({{ $getSubject->first()->subject->name }})</h3>
            </div>
            <div class="card-body p-0" style="overflow-x: auto;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                           <th>STUDENT NAME</th>
                               @foreach($getSubject as $subject)
                                    <th>{{ $getSubject->first()->subject->name}} <br>
                                    ( {{ $subject->subject_type}}: {{ $subject->passing_mark}}/ {{ $subject->full_marks}})
                                    </th>
                               @endforeach
                            <th style="min-width: 200px;">TOTAL SUMMARY</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($getStudent) && $getStudent->count())
                            @foreach($getStudent as $student)
                            <form name="post" class="SubmitForm" action="{{ url('teacher/submit_marks_register') }}" method="POST">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">

                                <tr>
                                    <td class="align-middle"><strong>{{ $student->name }} {{ $student->last_name }}</strong></td>

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

                                            $getMark = \App\Models\MarksRegisterModel::CheckAlreadyMark(
                                                $student->id,
                                                Request::get('exam_id'),
                                                Request::get('class_id'),
                                                $subject->subject_id
                                            );

                                            if (!empty($getMark)) {
                                                $totalMark = ($getMark->ca1 ?? 0) + ($getMark->ca2 ?? 0) + ($getMark->ca3 ?? 0) + ($getMark->exam ?? 0);
                                            } else {
                                                $totalMark = 0;
                                            }

                                            $totalStudentMark += $totalMark;

                                            $subjectPosition = \App\Models\MarksRegisterModel::getSubjectPosition(
                                                Request::get('exam_id'),
                                                Request::get('class_id'),
                                                $subject->subject_id,
                                                $student->id
                                            );
                                        @endphp

                                        <td>
                                            <!-- Hidden inputs -->
                                            <input type="hidden" name="mark[{{ $i }}][full_marks]" value="{{ $subject->full_marks }}">
                                            <input type="hidden" name="mark[{{ $i }}][passing_mark]" value="{{ $subject->passing_mark }}">
                                            <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $getMark->id ?? '' }}">
                                            <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">
                                            <input type="hidden" name="mark[{{ $i }}][subject_schedule_id]" value="{{ $subject->id }}">

                                            <!-- Inputs -->
                                            <div class="form-group mb-2">
                                                <label>CA1</label>
                                                <input type="number" step="0.01" min="0" class="form-control form-control-sm"
                                                    name="mark[{{ $i }}][ca1]"
                                                    id="ca1_{{ $student->id }}_{{ $subject->subject_id }}"
                                                    value="{{ $getMark->ca1 ?? '' }}" placeholder="CA1 Mark">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>CA2</label>
                                                <input type="number" step="0.01" min="0" class="form-control form-control-sm"
                                                    name="mark[{{ $i }}][ca2]"
                                                    id="ca2_{{ $student->id }}_{{ $subject->subject_id }}"
                                                    value="{{ $getMark->ca2 ?? '' }}" placeholder="CA2 Mark">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>CA3</label>
                                                <input type="number" step="0.01" min="0" class="form-control form-control-sm"
                                                    name="mark[{{ $i }}][ca3]"
                                                    id="ca3_{{ $student->id }}_{{ $subject->subject_id }}"
                                                    value="{{ $getMark->ca3 ?? '' }}" placeholder="CA3 Mark">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Exam</label>
                                                <input type="number" step="0.01" min="0" class="form-control form-control-sm"
                                                    name="mark[{{ $i }}][exam]"
                                                    id="exam_{{ $student->id }}_{{ $subject->subject_id }}"
                                                    value="{{ $getMark->exam ?? '' }}" placeholder="Exam Mark">
                                            </div>
                                            
                                            <!-- Save Button -->
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <button type="button" class="btn btn-sm btn-info SaveSingleSubject"
                                                    data-student-id="{{ $student->id }}"
                                                    data-subject-id="{{ $subject->subject_id }}"
                                                    data-exam-id="{{ Request::get('exam_id') }}"
                                                    data-class-id="{{ Request::get('class_id') }}">
                                                    Save This Subject
                                                </button>
                                                <span id="save_status_{{ $student->id }}_{{ $subject->subject_id }}" class="text-xs"></span>
                                            </div>

                                            @if(!empty($getMark))
                                                <div class="mt-2 border-top pt-2">
                                                    <small><strong>Total Mark:</strong> {{ $totalMark }}</small><br>
                                                    <small><strong>Passing Mark:</strong> {{ $subject->passing_mark }}</small><br>
                                                    <small><strong>Position:</strong> {{ $subjectPosition }}</small><br>
                                                    
                                                    @php
                                                        $subject_status = $totalMark >= $subject->passing_mark;
                                                        if (!$subject_status) { $pass_fail_vali = 1; }
                                                        $status_color = $subject_status ? 'text-success' : 'text-danger';
                                                    @endphp
                                                    <small>
                                                        <strong>Status:</strong>
                                                        <span class="{{ $status_color }} font-weight-bold">{{ $subject_status ? 'PASS' : 'FAIL' }}</span>
                                                    </small><br>

                                                    @php
                                                        // subject grade based on percentage in that subject
                                                        $percentageSubject = ($totalMark > 0 && $subject->full_marks > 0) 
                                                            ? ($totalMark * 100) / $subject->full_marks : 0;

                                                        $gradeLabel = '';
                                                        $gradeColor = 'black';
                                                        if ($percentageSubject >= 70) { $gradeLabel = 'A - Distinction'; $gradeColor = 'green'; }
                                                        elseif ($percentageSubject >= 60) { $gradeLabel = 'B - Very Good'; $gradeColor = 'blue'; }
                                                        elseif ($percentageSubject >= 50) { $gradeLabel = 'C - Credit'; $gradeColor = '#006400'; }
                                                        elseif ($percentageSubject >= 45) { $gradeLabel = 'D - Pass'; $gradeColor = '#8B8000'; }
                                                        elseif ($percentageSubject >= 40) { $gradeLabel = 'E - Fair'; $gradeColor = 'orange'; }
                                                        else { $gradeLabel = 'F - Fail'; $gradeColor = 'red'; }
                                                    @endphp
                                                    <small>
                                                        <strong>Grade:</strong>
                                                        <span style="color: {{ $gradeColor }}; font-weight: bold;">{{ $gradeLabel }}</span>
                                                    </small>
                                                </div>
                                            @endif
                                        </td>
                                        @php $i++; @endphp
                                    @endforeach

                                    <!-- Overall Summary -->
                                    <td class="align-middle">
                                        <button type="submit" class="btn btn-sm btn-success mb-2">Save All Marks</button>
                                        @if(!empty($totalStudentMark))
                                            <div class="border-top pt-2">
                                                <small><strong>Total Marks:</strong> {{ $totalStudentMark }} / {{ $totalFullMarks }}</small><br>
                                                <small><strong>Total Passing:</strong> {{ $totalPassingMarks }}</small><br>
                                                @php
                                                    $percentage = ($totalStudentMark > 0 && $totalFullMarks > 0) ? ($totalStudentMark * 100) / $totalFullMarks : 0;
                                                    $overall_result = ($pass_fail_vali == 0) ? 'PASS' : 'FAIL';
                                                    $result_color = ($pass_fail_vali == 0) ? 'text-success' : 'text-danger';

                                                    $overallGradeLabel = '';
                                                    $overallGradeColor = 'black';
                                                    if ($percentage >= 70) { $overallGradeLabel = 'A - Distinction'; $overallGradeColor = 'green'; }
                                                    elseif ($percentage >= 60) { $overallGradeLabel = 'B - Very Good'; $overallGradeColor = 'blue'; }
                                                    elseif ($percentage >= 50) { $overallGradeLabel = 'C - Credit'; $overallGradeColor = '#006400'; }
                                                    elseif ($percentage >= 45) { $overallGradeLabel = 'D - Pass'; $overallGradeColor = '#8B8000'; }
                                                    elseif ($percentage >= 40) { $overallGradeLabel = 'E - Fair'; $overallGradeColor = 'orange'; }
                                                    else { $overallGradeLabel = 'F - Fail'; $overallGradeColor = 'red'; }
                                                @endphp
                                                <small><strong>Overall %:</strong> {{ round($percentage, 2) }}%</small><br>
                                                <small>
                                                    <strong>Overall Grade:</strong>
                                                    <span style="color: {{ $overallGradeColor }}; font-weight: bold;">{{ $overallGradeLabel }}</span>
                                                </small><br>
                                                <small>
                                                    <strong>Final Result:</strong>
                                                    <span class="{{ $result_color }} font-weight-bold">{{ $overall_result }}</span>
                                                </small>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ count($getSubject) + 2 }}" class="text-center">No students found for this class and exam.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @elseif(Request::get('exam_id') && Request::get('class_id'))
        <div class="alert alert-warning mx-3">
            No subjects assigned to you for the selected Exam and Class combination.
        </div>
    @else
        <div class="alert alert-info mx-3">
            Please select an Exam and a Class to view the Marks Register.
        </div>
    @endif
</div>
@endsection

@section('script')
<script type="text/javascript">
    function displayStatus(message, type = 'info', targetId = 'mark-register-status') {
        if (targetId === 'mark-register-status') {
            var statusDiv = $('#' + targetId);
            statusDiv.removeClass().addClass('alert alert-' + type)
                .html('<strong>Status:</strong> ' + message)
                .removeClass('d-none');
            setTimeout(function() { statusDiv.addClass('d-none'); }, 5000);
        } else {
            var statusSpan = $('#' + targetId);
            var colorClass = type === 'success' ? 'text-success' : 'text-danger';
            statusSpan.removeClass().addClass(colorClass).text(message);
            setTimeout(function() { statusSpan.text(''); }, 3000);
        }
    }

    $('.SubmitForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: "POST",
            url: "{{ url('teacher/submit_marks_register') }}",
            data: form.serialize(),
            dataType: "json",
            success: function(data) {
                displayStatus(data.message || 'All marks saved successfully!', 'success');
            },
            error: function(xhr) {
                var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Bulk submission failed.';
                displayStatus(errorMessage, 'danger');
            }
        });
    });

    $('.SaveSingleSubject').click(function(e) {
        var btn = $(this);
        var student_id = btn.data('student-id');
        var subject_id = btn.data('subject-id');
        var exam_id    = btn.data('exam-id');
        var class_id   = btn.data('class-id');
        var ca1  = $('#ca1_' + student_id + '_' + subject_id).val();
        var ca2  = $('#ca2_' + student_id + '_' + subject_id).val();
        var ca3  = $('#ca3_' + student_id + '_' + subject_id).val();
        var exam = $('#exam_' + student_id + '_' + subject_id).val();

        var statusTargetId = 'save_status_' + student_id + '_' + subject_id;
        $('#' + statusTargetId).text('Saving...').removeClass().addClass('text-info');

        $.ajax({
            type: "POST",
            url: "{{ url('teacher/single_submit_marks_register') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                student_id: student_id,
                subject_id: subject_id,
                exam_id: exam_id,
                class_id: class_id,
                ca1: ca1,
                ca2: ca2,
                ca3: ca3,
                exam: exam
            },
            dataType: "json",
            success: function(data) {
                if (data.message && data.message.includes("Unauthorized")) {
                    displayStatus('Unauthorized! You are not assigned to this subject.', 'danger', statusTargetId);
                } else {
                    displayStatus(data.message || 'Mark saved!', 'success', statusTargetId);
                }
            },
            error: function(xhr) {
                var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Save failed.';
                displayStatus('Error: ' + errorMessage, 'danger', statusTargetId);
            }
        });
    });
</script>
@endsection
