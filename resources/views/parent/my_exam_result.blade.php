@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Exam Result<span style="color: blue;">({{ $getStudent->name }} {{ $getStudent->last_name }})</span></h1>
                </div>
            </div>
        </div></section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach($getRecord as $value)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $value['exam_name']}}</h3>
                            <a class="btn btn-primary btn-sm" style="float: right;" target="_blanck" href="{{ url('parent/my_exam_result/print?exam_id='.$value['exam_id'].'&student_id='.$getStudent->id) }}">Print</a>
                        </div>
                        
                        {{-- START of ONE and ONLY card-body for this card --}}
                        <div class="card-body p-0">
                            
                            {{-- ACADEMIC MARKS TABLE --}}
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
                                        $result_validation = 0;
                                    @endphp
                                    @foreach($value['subject'] as $exam)
                                    @php
                                        $total_score = $total_score + $exam['total_score'];
                                        $full_marks = $full_marks + $exam['full_marks'];
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
                                            @if($exam['total_score'] >= $exam['passing_mark'])
                                                <span style="color: green; font-weight: bold;">Pass</span>
                                            @else
                                            @php
                                                $result_validation = 1;
                                            @endphp
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
                                            $Percentage = ($total_score * 100)/ $full_marks;
                                            // Ensure this static method exists on your model
                                            $getGrade = App\Models\MarksGradeModel::getGrade($Percentage);
                                        @endphp
                                            <b>Percentage: {{ round($Percentage, 2) }}%</b>
                                        </td>
                                        <td colspan="2">
                                            <b>Grade: {{ $getGrade }}</b>
                                        </td>
                                        <td colspan="3">
                                            <b>Result: @if($result_validation == 0)
                                                        <span style="color: green;">Pass</span>
                                                    @else
                                                        <span style="color: red;">Fail</span>
                                                    @endif</b>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            {{-- SKILLS AND BEHAVIOUR ASSESSMENT --}}
                            @if(isset($studentRemarks) && $studentRemarks)
                                <div style="padding: 20px 20px 0 20px;">
                                    <h3>Skills and Behaviour Assessment</h3>
                                    <table class="table table-bordered" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Skill Criteria</th>
                                                <th>Skill Rating (1-5)</th>
                                                <th>Behaviour Criteria</th>
                                                <th>Behaviour Rating (1-5)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $skillsList = ['attentiveness', 'perseverance', 'promptness', 'communication', 'handwriting'];
                                                $behaviourList = ['punctuality', 'neatness', 'politeness', 'honesty', 'self_control'];
                                                $maxCount = max(count($skillsList), count($behaviourList));
                                            @endphp
                                            
                                            {{-- Loop a maximum number of times to display all skills and behaviours side-by-side --}}
                                            @for($i = 0; $i < $maxCount; $i++)
                                            <tr>
                                                {{-- Display Skill --}}
                                                @if(isset($skillsList[$i]))
                                                    <td style="text-transform: capitalize;">{{ str_replace('_', ' ', $skillsList[$i]) }}</td>
                                                    <td>{{ $studentRemarks->skills[$skillsList[$i]] ?? 'N/A' }}</td>
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                @endif

                                                {{-- Display Behaviour --}}
                                                @if(isset($behaviourList[$i]))
                                                    <td style="text-transform: capitalize;">{{ str_replace('_', ' ', $behaviourList[$i]) }}</td>
                                                    <td>{{ $studentRemarks->behaviour[$behaviourList[$i]] ?? 'N/A' }}</td>
                                                @else
                                                    <td></td>
                                                    <td></td>
                                                @endif
                                            </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>

                                <div style="margin-top: 20px; padding: 0 20px;">
                                    <h4>Teacher's Comment</h4>
                                    <p>{{ $studentRemarks->teacher_comment ?? 'No comment provided.' }}</p>
                                </div>
                                
                                <div style="margin-top: 10px; padding: 0 20px;">
                                    <h4>Principal's Comment</h4>
                                    <p>{{ $studentRemarks->principal_comment ?? 'No comment provided.' }}</p>
                                </div>

                            @else
                                <p style="padding: 20px;">Skills and Behaviour data not found for this period.</p>
                            @endif
                            
                        </div> {{-- END of <div class="card-body p-0"> --}}
                    </div> {{-- END of <div class="card"> --}}
                </div> {{-- END of <div class="col-md-12"> --}}
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection