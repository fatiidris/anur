@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Report Remark</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Form -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Search Student</h3>
        </div>
        <form method="GET" action="{{ url('teacher/remarks_report') }}">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                    <label>Class Name</label>
                    <select class="form-control" name="class_id" required>
                      <option value="">Select Class</option>
                      @foreach($getClass as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                      @endforeach
                    </select>
                     </div>
                    <div class="form-group col-md-3">
                        <label>Term</label>
                        <select name="term_id" class="form-control" required>
                            <option value="">Select Term</option>
                            @foreach($getTerms as $term)
                                <option value="{{ $term->id }}" 
                                    {{ Request::get('term_id') == $term->id ? 'selected' : '' }}>
                                    {{ $term->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Session</label>
                        <select name="session_id" class="form-control" required>
                            <option value="">Select</option>
                            @foreach($getSessions as $session)
                                <option value="{{ $session->id }}" 
                                    {{ Request::get('session_id') == $session->id ? 'selected' : '' }}>
                                    {{ $session->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary mr-2">Search</button>
                        <a href="{{ url('teacher/remarks_report') }}" class="btn btn-success">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('_message')

    <!-- Remark Form -->
    @if($students->count() > 0)
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Student Remarks</h3>
        </div>
        <div class="card-body p-0" style="overflow-x:auto;">
            <form method="post" action="{{ url('teacher/remarks_report_save') }}">
                @csrf
                <table class="table table-striped table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Skills (1–5)</th>
                            <th>Behaviour (1–5)</th>
                            <th>Teacher Comment</th>
                            <th>Principal Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($students as $student)
                        @php
                            $remark = $existingRemarks[$student->id] ?? null;
                        @endphp
                        <tr>
                            <td>{{ $student->name }} {{ $student->last_name }}</td>

                            <!-- Hidden fields to send class, term, session -->
                            <input type="hidden" name="remarks[{{ $student->id }}][class_id]" value="{{ Request::get('class_id') }}">
                            <input type="hidden" name="remarks[{{ $student->id }}][term_id]" value="{{ Request::get('term_id') }}">
                            <input type="hidden" name="remarks[{{ $student->id }}][session_id]" value="{{ Request::get('session_id') }}">

                            <td>
                                <strong>Skills</strong><br>
                                @foreach(['attentiveness','perseverance','promptness','communication','handwriting'] as $skill)
                                    <label class="d-block text-capitalize">{{ $skill }}</label>
                                    <input type="number" name="remarks[{{ $student->id }}][skills][{{ $skill }}]" 
                                        class="form-control mb-2" min="1" max="5" 
                                        value="{{ isset($remark->skills[$skill]) ? $remark->skills[$skill] : '' }}">
                                @endforeach
                            </td>

                            <td>
                                <strong>Behaviours</strong><br>
                                @foreach(['punctuality','neatness','politeness','honesty','self_control'] as $behaviour)
                                    <label class="d-block text-capitalize">{{ str_replace('_',' ',$behaviour) }}</label>
                                    <input type="number" name="remarks[{{ $student->id }}][behaviour][{{ $behaviour }}]" 
                                        class="form-control mb-2" min="1" max="5" 
                                        value="{{ isset($remark->behaviour[$behaviour]) ? $remark->behaviour[$behaviour] : '' }}">
                                @endforeach
                            </td>

                            <td>
                                <textarea name="remarks[{{ $student->id }}][teacher_comment]" 
                                    class="form-control auto-comment-teacher" rows="2"
                                    data-student="{{ $student->id }}">{{ $remark->teacher_comment ?? '' }}</textarea>
                            </td>

                            <td>
                                <textarea name="remarks[{{ $student->id }}][principal_comment]" 
                                    class="form-control auto-comment-principal" rows="2"
                                    data-student="{{ $student->id }}">{{ $remark->principal_comment ?? '' }}</textarea>
                            </td>
                        </tr>
                     @endforeach

                    </tbody>

                </table>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Save All</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection

 @section('scripts')
    <script>
    document.addEventListener("input", function(e) {
        if(e.target.matches("input[type='number']")) {
            let row = e.target.closest("tr");
            let studentId = row.querySelector(".auto-comment-teacher").dataset.student;

            // Collect all ratings
            let ratings = Array.from(row.querySelectorAll("input[type='number']"))
                .map(input => parseInt(input.value) || 0)
                .filter(v => v > 0);

            if(ratings.length > 0) {
                let avg = ratings.reduce((a,b) => a+b, 0) / ratings.length;

                let teacherComment = "";
                let principalComment = "";

                if(avg >= 4.5) {
                    teacherComment = "Excellent performance. Keep it up!";
                    principalComment = "Outstanding! Proud of your achievement.";
                } else if(avg >= 3.5) {
                    teacherComment = "Good effort. Aim for even higher.";
                    principalComment = "A commendable performance.";
                } else if(avg >= 2.5) {
                    teacherComment = "Fair. More dedication is needed.";
                    principalComment = "Encourage to work harder for improvement.";
                } else {
                    teacherComment = "Weak performance. Needs serious attention.";
                    principalComment = "Student must improve significantly.";
                }

                // Autofill (but keep editable)
                row.querySelector(".auto-comment-teacher").value = teacherComment;
                row.querySelector(".auto-comment-principal").value = principalComment;
            }
        }
    });
    </script>
 @endsection


