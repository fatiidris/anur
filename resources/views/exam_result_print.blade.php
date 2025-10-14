<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Report Sheet</title>
  <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
  <style>
    body { font-family: Arial, sans-serif; color:#111; }
    .report-header { width:100%; display:flex; gap:12px; align-items:center; }
    .logo-container { flex: 0 0 150px; text-align:center; }
    .term-info { flex: 1 1 40%; text-align:center; font-size:18px; font-weight:700; }
    .student-info { flex: 1 1 40%; font-size:16px; line-height:1.6; }
    .passport-container { flex: 0 0 150px; text-align:center; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th, td { border:1px solid #000; padding:6px; text-align:left; }
    th { background:#f3f3f3; }
    .small-table td, .small-table th { font-size:14px; }
    .three-col { display:flex; gap:20px; margin-top:18px; }
    .three-col > table { width:100%; }
    .signature-row { margin-top:20px; display:flex; align-items:center; gap:20px; }
    .sign { width:250px; height:90px; border:1px solid #000; padding:8px; text-align:center; }
    @page { size:A4; }
    @media print { @page { margin-left:20px; margin-right:20px; } }
  </style>
</head>
<body>

  <section>
    <div dir="rtl" style="text-align:center; font-weight:900; font-size:32px; margin-bottom:10px; color:#000; text-shadow:1px 1px 2px #555;">
      مدرسة النور المثالية الإسلامية
    </div>
    <h1>{{ $getSetting->school_name ?? 'SCHOOL NAME' }}</h1>
    <p>N0. 7 Brighter Road, Western Bye-pass, Minna, Niger State</p>
    <p>Phone: 07038042711, 09019190684, Email: annureduservices@gmail.com</p>
  </section>

  {{-- SAFETY: ensure variables exist --}}
  @php
    // Overall accumulators
    $overallTotal = 0;
    $full_marks_total = 0;
    $subjectCount = is_array($getExamMarks) ? count($getExamMarks) : 0;

    // helper for grade (avoid redeclare)
    if (!function_exists('getLetterGrade')) {
        function getLetterGrade($score) {
            $score = floatval($score);
            if ($score >= 70) return 'A';
            if ($score >= 60) return 'B';
            if ($score >= 50) return 'C';
            if ($score >= 45) return 'D';
            if ($score >= 40) return 'E';
            return 'F';
        }
    }

    // resolve class id safely
    $classId = $getClass->id ?? $getClass->class_id ?? $getStudent->class_id ?? request()->get('class_id') ?? null;
    $studentId = $getStudent->id ?? null;
@endphp

  <div class="report-header">
    <div class="logo-container">
      <img src="{{ $getSetting->getLogo() }}" alt="Logo" style="width:150px; height:auto; border-radius:6px;">
    </div>

    <div class="term-info">
      END OF THE TERM REPORT<br>
      <small style="font-weight:normal;">Next term begins: {{ $getSetting->next_term_begin }} &nbsp; / &nbsp; Term End: {{ $getSetting->term_end }}</small>
    </div>

    <div class="student-info">
      <div><strong>Admission No:</strong> {{ $getStudent->admission_number ?? '-' }}</div>
      <div><strong>Name:</strong> <span style="font-size:18px;">{{ ($getStudent->name ?? '') . ' ' . ($getStudent->last_name ?? '') }}</span></div>
      <div><strong>Gender:</strong> {{ $getStudent->gender ?? '-' }}</div>
      <div><strong>Class:</strong> {{ $getClass->class_name ?? '-' }}</div>
    </div>

    <div class="passport-container">
      <img src="{{ $getStudent->getProfileDirect() ?? url('public/images/default-avatar.png') }}" alt="Passport" style="width:150px; height:150px; border-radius:6px; object-fit:cover;">
    </div>
  </div>

  {{-- SESSION & ATTENDANCE --}}
  @php
    // safe attendance calls (some projects implement these helpers differently)
    $daysPresent = method_exists($getStudent, 'getDaysPresent') ? $getStudent->getDaysPresent($studentId, $getSetting->session_id ?? null) : '-';
    $daysAbsent  = method_exists($getStudent, 'getDaysAbsent') ? $getStudent->getDaysAbsent($studentId, $getSetting->session_id ?? null) : '-';
  @endphp

  <table class="small-table">
      <tr>
          <td>Session: {{ $getExam->session->name ?? 'N/A' }}</td>
          <td>Term: {{ $getExam->term->name ?? 'N/A' }}</td>
          <td>Report Date: {{ \Carbon\Carbon::now()->format('jS F Y') }}</td>
          <td>No. of Days Present: {{ $daysPresent }}</td>
          <td>No. of Days Absent: {{ $daysAbsent }}</td>
          <td>No. in Year Group: {{ $getClass->class_size ?? '-' }}</td>
      </tr>
  </table>

  {{-- SUBJECTS TABLE --}}
  <table id="reportTable">
    <thead>
      <tr>
        <th>SUBJECTS</th>
        <th>CA1</th>
        <th>CA2</th>
        <th>CA3</th>
        <th>EXAM</th>
        <th>TOTAL MARKS</th>
        <th>GRADE</th>
        <th>POSITION IN SUBJECT</th>
        <th>CLASS AVERAGE</th>
        <th>LOWEST IN CLASS</th>
        <th>HIGHEST IN CLASS</th>
      </tr>
    </thead>
    <tbody>
@forelse($getExamMarks as $exam)
    @php
        $subjectId = $exam['subject_id'] ?? null;
        $examId = $exam['exam_id'] ?? $getExam->id ?? null;

        $ca1 = isset($exam['ca1']) ? floatval($exam['ca1']) : 0;
        $ca2 = isset($exam['ca2']) ? floatval($exam['ca2']) : 0;
        $ca3 = isset($exam['ca3']) ? floatval($exam['ca3']) : 0;
        $examScore = isset($exam['exam']) ? floatval($exam['exam']) : 0;

        // ✅ no total_score column — calculate manually
        $total = $ca1 + $ca2 + $ca3 + $examScore;
        $fullMarks = isset($exam['full_marks']) ? floatval($exam['full_marks']) : 100;

        $overallTotal += $total;
        $full_marks_total += $fullMarks;

        // ---- Class Scores for Average/Min/Max ----
        $scores = [];
        if ($examId && $classId && $subjectId) {
            $marks = \App\Models\MarksRegisterModel::where('exam_id', $examId)
                ->where('class_id', $classId)
                ->where('subject_id', $subjectId)
                ->get(['ca1','ca2','ca3','exam']);

            foreach ($marks as $m) {
                $scores[] = floatval($m->ca1 ?? 0) + floatval($m->ca2 ?? 0) +
                            floatval($m->ca3 ?? 0) + floatval($m->exam ?? 0);
            }
        }

        $classAverage = !empty($scores) ? round(array_sum($scores) / count($scores), 2) : '-';
        $classLowest = !empty($scores) ? min($scores) : '-';
        $classHighest = !empty($scores) ? max($scores) : '-';

       // ---- Subject Position (consistent with Mark Register) ----
  $subjectPosition = App\Models\MarksRegisterModel::getSubjectPosition(
    $examId,     // make sure you pass same exam_id
    $classId,    // same class_id
    $subjectId,  // current subject
    $studentId   // current student
);

        $grade = getLetterGrade($total);
    @endphp

    <tr>
      <td>{{ $exam['subject_name'] ?? 'Unknown Subject' }}</td>
      <td>{{ $ca1 }}</td>
      <td>{{ $ca2 }}</td>
      <td>{{ $ca3 }}</td>
      <td>{{ $examScore }}</td>
      <td>{{ $total }}</td>
      @php
   $gradeLabel = '';
   $gradeColor = 'black';

   if ($total >= 70) {
       $gradeLabel = 'A - Distinction';
       $gradeColor = 'green';
   } elseif ($total >= 60) {
       $gradeLabel = 'B - Very Good';
       $gradeColor = 'blue';
   } elseif ($total >= 50) {
       $gradeLabel = 'C - Credit';
       $gradeColor = '#006400'; // dark green
   } elseif ($total >= 45) {
       $gradeLabel = 'D - Pass';
       $gradeColor = '#8B8000'; // golden brown
   } elseif ($total >= 40) {
       $gradeLabel = 'E - Fair';
       $gradeColor = 'orange';
   } else {
       $gradeLabel = 'Fail';
       $gradeColor = 'red';
   }
@endphp

<td style="color: {{ $gradeColor }}; font-weight:bold;">
   {{ $gradeLabel }}
</td>

      <td>{{ $subjectPosition }}</td>
      <td>{{ $classAverage }}</td>
      <td>{{ $classLowest }}</td>
      <td>{{ $classHighest }}</td>
    </tr>
@empty
    <tr><td colspan="11" style="text-align:center;">No marks found</td></tr>
@endforelse

  </tbody>
  </table>

  {{-- SUMMARY & COMMENTS --}}
  @php
    // compute overall averages safely
    $subjectCount = max(1, $subjectCount); // avoid division by zero (if no subjects we will show 0 below)
    $overallAverage = isset($overallTotal) && $subjectCount > 0 ? round($overallTotal / $subjectCount, 2) : 0;
    $Percentage = ($full_marks_total > 0) ? round(($overallTotal * 100) / $full_marks_total, 2) : 0;

    // Prefer controller-provided variables; fall back to DB lookup only if missing
    $skills = $skills ?? null;
    $behaviours = $behaviour ?? ($behaviours ?? null); // accept either name
    $teachers_comment = $teachers_comment ?? $teachersComment ?? null;
    $principal_comment = $principal_comment ?? $principalComment ?? null;

    if (($skills === null || $behaviours === null || $teachers_comment === null || $principal_comment === null) && isset($getStudent)) {
        // fallback lookup (safe, only if needed)
        $remark = \App\Models\StudentReportRemark::where('student_id', $getStudent->id)
            ->where('class_id', $classId)
            ->where('term_id', $getExam->term_id ?? null)
            ->where('session_id', $getExam->session_id ?? null)
            ->first();

        if ($skills === null) {
            $skills = !empty($remark->skills) ? (is_array($remark->skills) ? $remark->skills : json_decode($remark->skills, true)) : [];
        }
        if ($behaviours === null) {
            $behaviours = !empty($remark->behaviour) ? (is_array($remark->behaviour) ? $remark->behaviour : json_decode($remark->behaviour, true)) : [];
        }
        $teachers_comment = $teachers_comment ?? $remark->teachers_comment ?? $remark->teacher_comment ?? null;
        $principal_comment = $principal_comment ?? $remark->principal_comment ?? null;
    }

    // final safe defaults
    $skills = is_array($skills) ? $skills : (!empty($skills) ? (is_string($skills) ? json_decode($skills, true) : []) : []);
    $behaviours = is_array($behaviours) ? $behaviours : (!empty($behaviours) ? (is_string($behaviours) ? json_decode($behaviours, true) : []) : []);
    $teacherComment = $teachers_comment ?? ($Percentage >= 70 ? 'Excellent performance — keep it up.' : ($Percentage >= 50 ? 'Good performance — needs improvement in some areas.' : 'Work harder to improve next term.'));
    $principalComment = $principal_comment ?? ($Percentage >= 70 ? 'Highly commendable result.' : ($Percentage >= 50 ? 'Satisfactory result, but more effort is required.' : 'Below expectations — encourage greater focus.'));
  @endphp

 <div class="three-col">
    <table>
        <tr><th>Class Teacher's Comment</th></tr>
        <tr><td>{{ $teacherComment }}</td></tr>
        <tr><th>Principal Comment</th></tr>
        <tr><td>{{ $principalComment }}</td></tr>
        <tr><th>Summary</th></tr>
       <tr><td style="color: font-weight:bold;">Percentage: {{ round($Percentage, 2) }}%</td></tr>
<tr><td style="color: font-weight:bold;">Overall Average: {{ $overallAverage }}</td></tr>

@php
   $finalGradeLabel = '';
   $finalGradeColor = 'black';

   if ($Percentage >= 70) {
       $finalGradeLabel = 'A - Distinction';
       $finalGradeColor = 'green';
   } elseif ($Percentage >= 60) {
       $finalGradeLabel = 'B - Very Good';
       $finalGradeColor = 'blue';
   } elseif ($Percentage >= 50) {
       $finalGradeLabel = 'C - Credit';
       $finalGradeColor = '#006400'; // dark green
   } elseif ($Percentage >= 45) {
       $finalGradeLabel = 'D - Pass';
       $finalGradeColor = '#8B8000'; // golden brown
   } elseif ($Percentage >= 40) {
       $finalGradeLabel = 'E - Fair';
       $finalGradeColor = 'orange';
   } else {
       $finalGradeLabel = 'Fail';
       $finalGradeColor = 'red';
   }
@endphp

<tr>
   <td>
      <b>Result:</b>
      <span style="color: {{ $finalGradeColor }}; font-weight:bold;">
         {{ $finalGradeLabel }}
      </span>
   </td>
</tr>
    </table>

    <table>
    <tr><th colspan="2">Skills and Behaviour</th></tr>
    <tr><td><strong>Skill/Behaviour</strong></td><td><strong>Rating</strong></td></tr>

    {{-- Skills --}}
    @if(!empty($skills))
        @foreach($skills as $skill => $rating)
            <tr>
                <td>{{ ucfirst(str_replace('_',' ', $skill)) }}</td>
                <td>{{ $rating }}</td>
            </tr>
        @endforeach
    @endif

      {{-- Behaviour --}}
    @if(!empty($behaviour) || !empty($behaviours))
        @foreach(($behaviours ?? $behaviour ?? []) as $trait => $rating)
            <tr>
                <td>{{ ucfirst(str_replace('_',' ', $trait)) }}</td>
                <td>{{ $rating }}</td>
            </tr>
        @endforeach
    @endif
    @if(empty($skills) && empty($behaviour))
      <tr><td colspan="2">No ratings available</td></tr>
    @endif
</table>


    <table>
        <tr><th>Keys to Ratings</th></tr>
        <tr><td>5</td><td>Excellent</td></tr>
        <tr><td>4</td><td>Very Good</td></tr>
        <tr><td>3</td><td>Satisfactory</td></tr>
        <tr><td>2</td><td>Fair</td></tr>
        <tr><td>1</td><td>Poor</td></tr>
        <tr><th>Grading System</th></tr>
        <tr><td>70+</td><td>A - Distinction</td></tr>
        <tr><td>60 - 69</td><td>B - Very Good</td></tr>
        <tr><td>50 - 59</td><td>C - Credit</td></tr>
        <tr><td>45 - 49</td><td>D - Pass</td></tr>
        <tr><td>40 - 44</td><td>E - Fair</td></tr>
        <tr><td>0 - 39</td><td>Fail</td></tr>
    </table>
 </div>

{{-- SIGNATURE & PAYMENT STATUS --}}
<div class="signature-row" style="display: flex; gap: 20px; align-items: flex-start; margin-top: 15px;">

    {{-- Signature Table --}}
    <table style="border: 1px solid #000; border-collapse: collapse; width: 200px; text-align: center; margin: 0; height: 100%;">
        <tr>
            <th style="border-bottom: 1px solid #000; padding: 3px; font-size: 12px; background: #f8f8f8;">
                Principal's Signature
            </th>
        </tr>
        <tr>
            <td style="padding: 3px; vertical-align: middle;">
                <img src="{{ $getSetting->getPrincipalSign() }}" 
                     alt="Principal Signature" 
                     style="width:80px; height:auto; border-radius:4px; display:block; margin:0 auto;">
            </td>
        </tr>
    </table>

    {{-- Payment Status Table --}}
    @if(!empty($getStudent))
        @php
            $getFees = \App\Models\StudentAddFeesModel::getTotalAmount($getStudent->id);
            $totalAmount = $getFees->total_amount ?? 0;
            $paid_amount = method_exists($getStudent, 'getPaidAmount') 
                ? $getStudent->getPaidAmount($getStudent->id, $classId) 
                : 0;
            $RemainingAmount = $totalAmount - $paid_amount;

            $status = $totalAmount == 0 
                ? 'No payment record found for this student' 
                : ($RemainingAmount > 0 ? 'Pending' : 'Paid');
        @endphp

        <table border="1" cellpadding="5" cellspacing="0" width="100%" style="font-size:13px; border-collapse: collapse;">
            <thead>
                <tr style="background:#f8f8f8;">
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Balance</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align:center;">
                    <td>₦{{ number_format($totalAmount ?? 0, 2) }}</td>
                    <td>₦{{ number_format($paid_amount, 2) }}</td>
                    <td>₦{{ number_format($RemainingAmount, 2) }}</td>
                    <td>{{ $status }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p>No payment record found for this student.</p>
    @endif
</div>

  <script type="text/javascript">
     window.print();
  </script>
</body>
</html>
