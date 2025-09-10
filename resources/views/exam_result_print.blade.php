<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Report Sheet</title>
  <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
  <style>
    /* Minimal inline fallbacks — keep your main styles in style.css */
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
    <h1>{{ $getSetting->school_name }}</h1>
    <p>N0. 7 Brighter Road, Western Bye-pass, Minna, Niger State</p>
    <p>Phone: 07038042711, 09019190684, Email: annureduservices@gmail.com</p>
  </section>

  {{-- HEADER ROW --}}
  @php
    // initialize overall counters
    $subjectStats = [];
    $overallTotal = 0;
    $overallCount = 0;
    $total_score = 0;
    $full_marks = 0;
  @endphp

  {{-- Build subject stats and overall sums safely --}}
  @foreach($getExamMarks as $exam)
    @php
      // ensure keys exist and are numeric where expected
      $subject = $exam['subject_name'] ?? 'Unknown Subject';
      $score = isset($exam['total_score']) ? (float)$exam['total_score'] : 0;
      $fm = isset($exam['full_marks']) ? (float)$exam['full_marks'] : null; // may be null
      // accumulate per-subject
      if (!isset($subjectStats[$subject])) {
          $subjectStats[$subject] = ['scores'=>[], 'total'=>0, 'count'=>0];
      }
      $subjectStats[$subject]['scores'][] = $score;
      $subjectStats[$subject]['total'] += $score;
      $subjectStats[$subject]['count']++;
      // overall sums
      $overallTotal += $score;
      $overallCount++;
      $total_score += $score;
      if ($fm !== null) {
          $full_marks += $fm;
      } else {
          // if full_marks not supplied, assume 100 per subject row
          $full_marks += 100;
      }
    @endphp
  @endforeach

  {{-- finalize per-subject stats --}}
  @php
    foreach ($subjectStats as $k => $s) {
      $subjectStats[$k]['average'] = round($s['count'] > 0 ? ($s['total'] / $s['count']) : 0, 2);
      $subjectStats[$k]['lowest'] = count($s['scores']) ? min($s['scores']) : 0;
      $subjectStats[$k]['highest'] = count($s['scores']) ? max($s['scores']) : 0;
    }

    // safe letter-grade helper (prevent redeclare)
    if (!function_exists('getLetterGrade')) {
        function getLetterGrade($score) {
            if ($score >= 70) return 'A';
            if ($score >= 60) return 'B';
            if ($score >= 50) return 'C';
            if ($score >= 45) return 'D';
            if ($score >= 40) return 'E';
            return 'F';
        }
    }

    // compute overall average and percentage safely
    $overallAverage = $overallCount > 0 ? round($overallTotal / $overallCount, 2) : 0;
    $Percentage = $full_marks > 0 ? ($total_score * 100) / $full_marks : 0;
  @endphp

  <div class="report-header">
    <div class="logo-container">
      <img src="{{ $getSetting->getLogo() }}" alt="Logo" style="width:150px; height:auto; border-radius:6px;">
    </div>

    <div class="term-info">
      END OF THE TERM REPORT<br>
      <small style="font-weight:normal;">Next term begins: 2024-01-08 &nbsp; / &nbsp; Term End: 2024-07-28</small>
    </div>

    <div class="student-info">
      <div><strong>Admission No:</strong> {{ $getStudent->admission_number }}</div>
      <div><strong>Name:</strong> <span style="font-size:18px;">{{ $getStudent->name }} {{ $getStudent->last_name }}</span></div>
      <div><strong>Gender:</strong> {{ $getStudent->gender }}</div>
      <div><strong>Class:</strong> {{ $getClass->class_name }}</div>
    </div>

    <div class="passport-container">
      <img src="{{ $getStudent->getProfileDirect() }}" alt="Passport" style="width:150px; height:150px; border-radius:6px; object-fit:cover;">
    </div>
  </div>

  {{-- SESSION & ATTENDANCE --}}
@php
    // These methods should be defined in your Student model (or relevant model)
    $daysPresent = $getStudent->getDaysPresent($getStudent->id, $getSetting->session_id ?? null);
    $daysAbsent  = $getStudent->getDaysAbsent($getStudent->id, $getSetting->session_id ?? null);
@endphp

<table class="small-table">
    <tr>
        <td>Session: {{ $getExam->session->name ?? 'N/A' }}</td>
        <td>Term: {{ $getExam->term->name ?? 'N/A' }}</td>
        <td>Report Date: {{ \Carbon\Carbon::now()->format('jS F Y') }}</td>
        <td>No. of Days Present: {{ $getStudent->getDaysPresent() }}</td>
        <td>No. of Days Absent: {{ $getStudent->getDaysAbsent() }}</td>
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
        <th>POSITION IN SUBJECTS</th>
        <th>CLASS AVERAGE</th>
        <th>LOWEST IN CLASS</th>
        <th>HIGHEST IN CLASS</th>
      </tr>
    </thead>
    <tbody>
@foreach($getExamMarks as $exam)
    @php
        $subject = $exam['subject_name'];
        $ca1 = $exam['ca1'];
        $ca2 = $exam['ca2'];
        $ca3 = $exam['ca3'];
        $examScore = $exam['exam'];
        $total = $exam['total_score'];
        $stats = $subjectStats[$subject] ?? ['average'=>0,'lowest'=>0,'highest'=>0];
        $grade = getLetterGrade((float)$total);

        // ✅ Fix: Ensure IDs are consistent
        $examId = Request::get('exam_id') ?? ($exam['exam_id'] ?? null);
        $classId = Request::get('class_id') ?? ($getClass->id ?? null);
        $subjectId = $exam['subject_id'];
        $studentId = $getStudent->id;

        $subjectPosition = App\Models\MarksRegisterModel::getSubjectPosition(
            $examId,
            $classId,
            $subjectId,
            $studentId
        );
    @endphp

    <tr>
      <td>{{ $subject }}</td>
      <td>{{ $ca1 }}</td>
      <td>{{ $ca2 }}</td>
      <td>{{ $ca3 }}</td>
      <td>{{ $examScore }}</td>
      <td>{{ $total }}</td>
      <td>{{ $grade }}</td>
      <td>{{ $subjectPosition }}</td>
      <td>{{ $stats['average'] }}</td>
      <td>{{ $stats['lowest'] }}</td>
      <td>{{ $stats['highest'] }}</td>
    </tr>
@endforeach

</tbody>

</table>

{{-- COMMENTS, STATS & RATINGS --}}
@php
    $remark = \App\Models\StudentReportRemark::where('student_id', $getStudent->id)
        ->where('class_id', $getClass->id)
        ->where('term_id', $getExam->term_id ?? null)
        ->where('session_id', $getExam->session_id ?? null)
        ->first();

    // Decode skills and behaviour JSON if exists
    $skills = !empty($remark->skills) ? json_decode($remark->skills, true) : [];
    $behaviours = !empty($remark->behaviour) ? json_decode($remark->behaviour, true) : [];

    // Auto-generate comments if not provided
    $teacherComment = $remark->teacher_comment ?? (
        $Percentage >= 70 ? 'Excellent performance — keep it up.' :
        ($Percentage >= 50 ? 'Good performance — needs improvement in some areas.' :
        'Work harder to improve next term.')
    );

    $principalComment = $remark->principal_comment ?? (
        $Percentage >= 70 ? 'Highly commendable result.' :
        ($Percentage >= 50 ? 'Satisfactory result, but more effort is required.' :
        'Below expectations — encourage greater focus.')
    );
@endphp

 <div class="three-col">
    <table>
        <tr><th>Class Teacher's Comment</th></tr>
        <tr><td>{{ $teacherComment }}</td></tr>
        <tr><th>Principal Comment</th></tr>
        <tr><td>{{ $principalComment }}</td></tr>
        <tr><th>Summary</th></tr>
        <tr><td>Percentage: {{ round($Percentage, 2) }}%</td></tr>
        <tr><td>Overall Average: {{ $overallAverage }}</td></tr>
    </table>

    <table>
    <tr><th colspan="2">Skills and Behaviour</th></tr>
    <tr><td><strong>Skill/Behaviour</strong></td><td><strong>Rating</strong></td></tr>
    @if(!empty($skills) || !empty($behaviours))
        @foreach(array_merge($skills, $behaviours) as $item)
            <tr>
                <td>{{ $item['name'] ?? '-' }}</td>
                <td>{{ $item['rating'] ?? '-' }}</td>
            </tr>
        @endforeach
    @else
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
  <div class="signature-row">
    <div class="sign">
      <div style="height:48px;"></div>
      <div>Principal's Signature</div>
    </div>
 @if(!empty($getStudent))
    @php
         $getFees = \App\Models\StudentAddFeesModel::getTotalAmount($getStudent->id);
         $totalAmount = $getFees->total_amount ?? 0;
         $paid_amount = $getStudent->getPaidAmount($getStudent->id, $getStudent->class_id);
         $RemainingAmount = $totalAmount - $paid_amount;
        $status = $RemainingAmount > 0 ? 'Pending' : 'Paid';
    @endphp

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Total Amount</th>
                <th>Paid Amount</th>
                <th>Balance</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
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
      // window.print();
    </script>
</body>
</html>
