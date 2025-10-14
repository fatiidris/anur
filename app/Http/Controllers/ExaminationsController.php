<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ExamScheduleModel;
use App\Models\MarksRegisterModel;
use App\Models\AssignClassTeacherModel;
use App\Models\AssignSubjectTeacherModel;
use App\Models\MarksGradeModel;
use App\Models\SessionModel;
use App\Models\TermModel;
use App\Models\SettingModel;
use App\Models\StudentReportRemark;




class ExaminationsController extends Controller
{
    public function exam_list()
    {
        $data['sessions']   = SessionModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $data['terms']      = TermModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
        $data['getRecord']  = ExamModel::getRecord();
        $data['header_title'] = "Exam List";

        return view('admin.examinations.exam.list', $data);
    }

    public function exam_add()
    {
        $data['header_title'] = "Add New Exam";
        $data['sessions']     = SessionModel::where('is_delete', 0)->get();
        $data['terms']        = TermModel::where('is_delete', 0)->get();

        return view('admin.examinations.exam.add', $data);
    }

    public function exam_insert(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'session_id'         => 'required|exists:session,id',
            'term_id'            => 'required|exists:term,id',
            // ✅ New validations for the datetime window
            'marks_entry_start'  => 'nullable|date',
            'marks_entry_end'    => 'nullable|date|after_or_equal:marks_entry_start',
        ]);

        $exam              = new ExamModel();
        $exam->name        = trim($request->name);
        $exam->session_id  = $request->session_id;
        $exam->term_id     = $request->term_id;
        $exam->created_by  = Auth::id();
        $exam->is_delete   = $request->is_delete ?? 0;
        // ✅ Save the new fields if provided
        $exam->marks_entry_start = $request->marks_entry_start;
        $exam->marks_entry_end   = $request->marks_entry_end;
        $exam->save();

        return redirect('admin/examinations/exam/list')
            ->with('success', "Exam Successfully Created");
    }

    public function exam_edit($id)
    {
        $data['getRecord'] = ExamModel::getSingle($id);

        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Exam";
            $data['sessions']     = SessionModel::where('is_delete', 0)->orderBy('name', 'asc')->get();
            $data['terms']        = TermModel::where('is_delete', 0)->orderBy('name', 'asc')->get();

            return view('admin.examinations.exam.edit', $data);
        } else {
            abort(404);
        }
    }

    public function exam_update($id, Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'session_id'         => 'required|integer|exists:session,id',
            'term_id'            => 'required|integer|exists:term,id',
            // ✅ New validations for the datetime window
            'marks_entry_start'  => 'nullable|date',
            'marks_entry_end'    => 'nullable|date|after_or_equal:marks_entry_start',
        ]);

        $exam = ExamModel::getSingle($id);

        if ($exam) {
            $exam->name        = trim($request->name);
            $exam->session_id  = $request->session_id;
            $exam->term_id     = $request->term_id;
            $exam->created_by  = Auth::user()->id;
            // ✅ Update the new fields
            $exam->marks_entry_start = $request->marks_entry_start;
            $exam->marks_entry_end   = $request->marks_entry_end;
            $exam->save();

            return redirect('admin/examinations/exam/list')->with('success', "Exam Successfully Updated");
        } else {
            abort(404);
        }
    }

    public function exam_delete($id)
    {
        $getRecord = ExamModel::getSingle($id);

        if (!empty($getRecord)) {
            $getRecord->is_delete = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Exam Successfully Deleted");
        } else {
            abort(404);
        }
    }

     
    public function exam_schedule(Request $request)
    {

        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();

        $result = array();
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')))
        {
            $getSubject = ClassSubjectModel::MySubject($request->get('class_id'));
            foreach($getSubject as $value)
            {
                $dataS = array();
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subject_name'] = $value->subject_name;
                $dataS['subject_type'] = $value->subject_type; 

                $ExamSchedule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id);

                if(!empty($ExamSchedule))
                {
                    $dataS['exam_date'] = $ExamSchedule->exam_date;
                    $dataS['start_time'] = $ExamSchedule->start_time;
                    $dataS['end_time'] = $ExamSchedule->end_time;
                    $dataS['room_number'] = $ExamSchedule->room_number;
                    $dataS['full_marks'] = $ExamSchedule->full_marks;
                    $dataS['passing_mark'] = $ExamSchedule->passing_mark;

                }
                else
                {

                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_marks'] = '';
                    $dataS['passing_mark'] = '';
                    
                    
                }
                $result[] = $dataS;
            }
        }
        $data['getRecord'] = $result;

        $data['header_title'] = "Exam Schedule";
        return view('admin.examinations.exam_schedule', $data);
    }

    public function exam_schedule_insert(Request $request)
    {
        ExamScheduleModel::deleteRecord($request->exam_id, $request->class_id);
        // dd(\DB::connection()->getDatabaseName());
        
        if(!empty($request->schedule))

        {
            foreach($request->schedule as $schedule)
            {
                if(!empty($schedule['subject_id']) && !empty($schedule['exam_date']) && !empty($schedule['start_time']) && !empty($schedule['end_time'])
                 && !empty($schedule['room_number']) && !empty($schedule['full_marks']) && !empty($schedule['passing_mark']))
                {
                    $exam = new ExamScheduleModel;
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->subject_id = $schedule['subject_id'];
                    $exam->exam_date = $schedule['exam_date'];
                    $exam->start_time = $schedule['start_time'];
                    $exam->end_time = $schedule['end_time'];
                    $exam->room_number = $schedule['room_number'];
                    $exam->full_marks = $schedule['full_marks'];
                    $exam->passing_mark = $schedule['passing_mark'];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();

                }
                
            }
        }
        return redirect()->back()->with('success', "Exam Schedule Successfully Saved");
        
    }
    
    public function marks_register(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();
    
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
    
        $data['header_title'] = "Marks Register";
        return view('admin.examinations.marks_register', $data);
    }

    public function marks_register_teacher(Request $request)
    { 
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['getExam'] = ExamScheduleModel::getExamTeacher(Auth::user()->id);
       
    
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));
        }
    
        $data['header_title'] = "Marks Register";
        return view('teacher.marks_register', $data);

    }
    
 public function submit_marks_register(Request $request)
  {
    $student_id = $request->student_id;
    $exam_id = $request->exam_id;
    $class_id = $request->class_id;

    $validation = 0;

    if (!empty($request->mark)) {
        foreach ($request->mark as $mark) {
            $getExamSchedule = ExamScheduleModel::getSingle($mark['id']);
            $full_marks = $getExamSchedule->full_marks;

            $ca1 = $mark['ca1'] ?? 0;
            $ca2 = $mark['ca2'] ?? 0;
            $ca3 = $mark['ca3'] ?? 0;
            $exam = $mark['exam'] ?? 0;

            $total_mark = $ca1 + $ca2 + $ca3 + $exam;

            if ($total_mark > $full_marks) {
                $validation = 1; // Flag validation error
                continue; // Skip saving if invalid
            }

            // Check if mark already exists
            $getMark = MarksRegisterModel::CheckAlreadyMark(
                $student_id,
                $exam_id,
                $class_id,
                $mark['subject_id']
            );

            $save = $getMark ?: new MarksRegisterModel;
            if (!$getMark) {
                $save->created_by = Auth::user()->id;
            }

            $save->student_id = $student_id;
            $save->exam_id    = $exam_id;
            $save->class_id   = $class_id;
            $save->subject_id = $mark['subject_id'];
            $save->ca1 = $ca1;
            $save->ca2 = $ca2;
            $save->ca3 = $ca3;
            $save->exam = $exam;
            $save->full_marks = $full_marks;
            $save->passing_mark = $mark['passing_mark'] ?? 0;
            $save->total_score = $total_mark; // Ensure you have this column
            $save->save();

            // ===== Calculate Position for this subject =====
            $allScores = MarksRegisterModel::where('exam_id', $exam_id)
                ->where('class_id', $class_id)
                ->where('subject_id', $mark['subject_id'])
                ->pluck('total_score')
                ->sortDesc()
                ->values()
                ->toArray();

            $position = array_search($total_mark, $allScores);
            $save->position = $position !== false ? $position + 1 : null;
            $save->save();
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => ($validation == 0)
            ? "Mark Register Successfully Saved"
            : "Mark Register Successfully Saved. However, some marks were not saved because they exceeded full marks."
    ]);
  }

        public function single_submit_marks_register(Request $request)
        {
            $id = $request->id;
            $getExamSchedule = ExamScheduleModel::getSingle($id);
            $full_marks = $getExamSchedule->full_marks;
        
            $ca1 = !empty($request->ca1) ? $request->ca1 : 0;
            $ca2 = !empty($request->ca2) ? $request->ca2 : 0;
            $ca3 = !empty($request->ca3) ? $request->ca3 : 0;
            $exam = !empty($request->exam) ? $request->exam : 0;

        
            $total_mark = $ca1 + $ca2 + $ca3 + $exam;
        
            // **Validation: If total_mark exceeds full_marks, return an error response**
            if ($total_mark > $full_marks) {
                return response()->json(['message' => "Your total Mark is greater than full mark"]);
            }
        
            $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $request->subject_id);
            if(!empty($getMark))
            {
                $save = $getMark;
            }
            else
            {
                $save             = new MarksRegisterModel;
                $save->created_by = Auth::user()->id;
            }
            
            $save->student_id = $request->student_id;
            $save->exam_id    = $request->exam_id;
            $save->class_id   = $request->class_id;
            $save->subject_id = $request->subject_id;
            $save->ca1 = $ca1;
            $save->ca2  = $ca2;
            $save->ca3  = $ca3;
            $save->exam       = $exam;
            $save->full_marks = $getExamSchedule->full_marks;
            $save->passing_mark = $getExamSchedule->passing_mark;
            
            $save->save();

            $json['message'] = "Mark Register Successfully Saved";
            echo json_encode($json);
            
        }



        public function marks_grade()
        {
            $data['getRecord'] = MarksGradeModel::getRecord();
            $data['header_title'] = "Marks Grade";
            return view('admin.examinations.marks_grade.list', $data);
        }

        public function marks_grade_add()
        {
            $data['header_title'] = "Add New Marks Grade";
            return view('admin.examinations.marks_grade.add', $data); 
        }

        public function marks_grade_insert(Request $request)
        {
            // dd($request->all());
            $mark = new MarksGradeModel;
            $mark->name = trim($request->name);
            $mark->percent_from = trim($request->percent_from);
            $mark->percent_to = trim($request->percent_to);
            $mark->created_by = Auth::user()->id;
            $mark->save(); 
            return redirect('admin/examinations/marks_grade')->with('success', "Marks Grade Successfully Created");
        }

        public function marks_grade_edit($id)
        {
            $data['getRecord'] = MarksGradeModel::getSingle($id);

            $data['header_title'] = "Edit Marks Grade";
            return view('admin.examinations.marks_grade.edit', $data);

        }
        public function marks_grade_update($id, Request $request)
        {
            $mark = MarksGradeModel::getSingle($id);
            $mark->name = trim($request->name);
            $mark->percent_from = trim($request->percent_from);
            $mark->percent_to = trim($request->percent_to);
            $mark->save(); 
            return redirect('admin/examinations/marks_grade')->with('success', "Marks Grade Successfully Updated");
        }
        public function marks_grade_delete($id)
        {
            $mark = MarksGradeModel::getSingle($id);
            $mark->delete();
            return redirect('admin/examinations/marks_grade')->with('success', "Marks Grade Successfully Deleted");
        }
     // student side
     public function MyExamTimetable(Request $request)
        {
            $class_id = Auth::user()->class_id;
            $getExam = ExamScheduleModel::getExam($class_id);
            $result = array();
            foreach($getExam as $value)
             {
                $dataE = array();
                $dataE['name'] = $value->exam_name;
                $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
                
                 $resultS = array();
                foreach($getExamTimetable as $valueS)
                {
                    $dataS = array();
                    $dataS['subject_name'] = $valueS->subject_name;
                    $dataS['exam_date'] = $valueS->exam_date;
                    $dataS['start_time'] = $valueS->start_time;
                    $dataS['end_time'] = $valueS->end_time;
                    $dataS['room_number'] = $valueS->room_number;
                    $dataS['full_marks'] = $valueS->full_marks;
                    $dataS['passing_mark'] = $valueS->passing_mark;
                    $resultS[] = $dataS;

                }

                  $dataE['exam'] = $resultS;
                  $result[] = $dataE;
             } 

             $data['getRecord'] = $result;

            $data['header_title'] = "My Exam Timetable";
            return view('student.my_exam_timetable', $data);
        }

public function MyExamResult()
{
    $studentId = Auth::user()->id;
    $result = [];

    // Get all exams for this student
    $getExams = MarksRegisterModel::getExam($studentId);

    foreach ($getExams as $exam) {
        $dataE = [];
        $dataE['exam_name'] = $exam->exam_name;
        $dataE['exam_id']   = $exam->exam_id;

        // Get all subjects for this exam & student
        $getExamSubjects = MarksRegisterModel::getExamSubject($exam->exam_id, $studentId);
        $dataSubjects = [];
        $studentTotal = 0;
        $result_validation = 0;

        foreach ($getExamSubjects as $subj) {
            $total_score = $subj['ca1'] + $subj['ca2'] + $subj['ca3'] + $subj['exam'];

            // Pass if total_score >= 40% of passing mark
            if ($subj['passing_mark'] > 0 && $total_score < 0.4 * $subj['passing_mark']) {
                $result_validation = 1; // fail flag
            }

            $dataSubjects[] = [
                'subject_id'   => $subj['subject_id'],
                'exam_id'      => $subj['exam_id'],
                'subject_name' => $subj['subject_name'],
                'ca1'          => $subj['ca1'],
                'ca2'          => $subj['ca2'],
                'ca3'          => $subj['ca3'],
                'exam'         => $subj['exam'],
                'total_score'  => $total_score,
                'full_marks'   => $subj['full_marks'],
                'passing_mark' => $subj['passing_mark'],
            ];

            $studentTotal += $total_score;
        }

        $dataE['subject'] = $dataSubjects;
        $dataE['student_total'] = $studentTotal;
        $dataE['result_validation'] = $result_validation;

        // Fetch remark for this exam/student
        $remark = StudentReportRemark::where('student_id', $studentId)
            ->where('class_id', Auth::user()->class_id)
            ->where('term_id', $exam->term_id)
            ->where('session_id', $exam->session_id)
            ->first();

        $skills = [];
        $behaviours = [];
        $teachers_comment = '';
        $principal_comment = '';

        if ($remark) {
            $skills = !empty($remark->skills) ? (is_array($remark->skills) ? $remark->skills : json_decode($remark->skills, true)) : [];
            $behaviours = !empty($remark->behaviour) ? (is_array($remark->behaviour) ? $remark->behaviour : json_decode($remark->behaviour, true)) : [];
            $teachers_comment = $remark->teachers_comment ?? '';
            $principal_comment = $remark->principal_comment ?? '';
        }

        // Auto comment if missing
        if (empty($teachers_comment)) {
            $average = count($dataSubjects) ? $studentTotal / count($dataSubjects) : 0;

            if ($average >= 70) {
                $teachers_comment = "Excellent performance. Keep it up!";
                $principal_comment = "Outstanding! Proud of your achievement.";
            } elseif ($average >= 60) {
                $teachers_comment = "Good effort. Aim for even higher.";
                $principal_comment = "A commendable performance.";
            } elseif ($average >= 50) {
                $teachers_comment = "Fair. More dedication is needed.";
                $principal_comment = "Encourage to work harder for improvement.";
            } else {
                $teachers_comment = "Weak performance. Needs serious attention.";
                $principal_comment = "Student must improve significantly.";
            }
        }

        $dataE['skills'] = $skills;
        $dataE['behaviours'] = $behaviours;
        $dataE['teachers_comment'] = $teachers_comment;
        $dataE['principal_comment'] = $principal_comment;

        $result[] = $dataE;
    }

    $data['getRecord'] = $result;
    $data['header_title'] = "My Exam Result";

    return view('student.my_exam_result', $data);
}

/**
 * Convert number to ordinal (1st, 2nd, 3rd...)
 */
public function MyExamResultPrint(Request $request)
{
    $exam_id    = $request->exam_id;
    $student_id = $request->query('student_id');

    if (!$exam_id) {
        return back()->with('error', 'Exam ID is missing.');
    }

    // === Exam & Student Info ===
    $data['getExam']    = ExamModel::getSingle($exam_id);
    if (!$data['getExam']) {
        return back()->with('error', 'Exam not found.');
    }
    $data['getStudent'] = User::getSingle($student_id);
    $data['getClass']   = MarksRegisterModel::getClass($exam_id, $student_id);
    $data['getSetting'] = SettingModel::getSingle();

    // === Exam Marks ===
    $getExamSubject = MarksRegisterModel::getExamSubject($exam_id, $student_id);
    $dataSubject = [];

    foreach ($getExamSubject as $exam) {
        $total_score = ($exam['ca1'] ?? 0) + ($exam['ca2'] ?? 0) + ($exam['ca3'] ?? 0) + ($exam['exam'] ?? 0);

        $dataSubject[] = [
            'subject_id'   => $exam['subject_id'],
            'exam_id'      => $exam['exam_id'],
            'subject_name' => $exam['subject_name'],
            'ca1'          => $exam['ca1'],
            'ca2'          => $exam['ca2'],
            'ca3'          => $exam['ca3'],
            'exam'         => $exam['exam'],
            'total_score'  => $total_score,
            'full_marks'   => $exam['full_marks'] ?? null,
            'passing_mark' => $exam['passing_mark'] ?? null,
        ];
    }

    // <-- IMPORTANT: make sure this is passed to the view
    $data['getExamMarks'] = $dataSubject;

    // === Calculate Overall Average ===
    $average = count($dataSubject) > 0
        ? round(array_sum(array_column($dataSubject, 'total_score')) / count($dataSubject), 2)
        : 0;
    $data['average'] = $average;

    // === Calculate Ranking (Position in Class) ===
    $ranking = MarksRegisterModel::select('student_id', DB::raw('SUM(ca1 + ca2 + ca3 + exam) as total'))
        ->where('exam_id', $exam_id)
        ->groupBy('student_id')
        ->orderByDesc('total')
        ->pluck('student_id')
        ->toArray();

    $position = array_search($student_id, $ranking);
    $data['position'] = ($position !== false) ? $this->ordinal($position + 1) : '-';

    // === Fetch Remarks (with exam_id filter, fallback for old records) ===
    $remark = StudentReportRemark::where('student_id', $student_id)
        ->where('exam_id', $exam_id)
        ->where('class_id', $data['getStudent']->class_id)
        ->where('term_id', $data['getExam']->term_id)
        ->where('session_id', $data['getExam']->session_id)
        ->first();

    if (!$remark) {
        // fallback for older saved records without exam_id
        $remark = StudentReportRemark::where('student_id', $student_id)
            ->where('class_id', $data['getStudent']->class_id)
            ->where('term_id', $data['getExam']->term_id)
            ->where('session_id', $data['getExam']->session_id)
            ->first();
    }

    // === Read remarks safely, assume model casts are set (see note below) ===
    $skills            = $remark->skills ?? [];
    $behaviours        = $remark->behaviour ?? [];
    $teachers_comment  = $remark->teacher_comment ?? '';    // singular: teacher_comment
    $principal_comment = $remark->principal_comment ?? '';

    // Auto-generate only if teacher comment missing
    if (empty($teachers_comment)) {
        if ($average >= 70) {
            $teachers_comment  = "Excellent performance. Keep it up!";
            $principal_comment = "Outstanding! Proud of your achievement.";
        } elseif ($average >= 60) {
            $teachers_comment  = "Good effort. Aim for even higher.";
            $principal_comment = "A commendable performance.";
        } elseif ($average >= 50) {
            $teachers_comment  = "Fair. More dedication is needed.";
            $principal_comment = "Encourage to work harder for improvement.";
        } else {
            $teachers_comment  = "Weak performance. Needs serious attention.";
            $principal_comment = "Student must improve significantly.";
        }
    }


    $data['skills']            = $skills;
    $data['behaviours']        = $behaviours;
    $data['teachers_comment']  = $teachers_comment;
    $data['principal_comment'] = $principal_comment;

    // return view with $data (each key becomes a variable in the Blade)
    return view('exam_result_print', $data);
}

// === Ordinal Helper ===
private function ordinal($number)
{
    if (!is_numeric($number)) {
        return $number;
    }

    $ends = ['th','st','nd','rd','th','th','th','th','th','th'];
    if ((($number % 100) >= 11) && (($number % 100) <= 13)) {
        return $number. 'th';
    } else {
        return $number. $ends[$number % 10];
    }
}


    //Teacher side work
    public function MyExamTimetableTeacher()
    {
        $result = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        
        foreach($getClass as $class)
        {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;

            $getExam = ExamScheduleModel::getExam($class->class_id);
            
            $examArray = array();
            foreach($getExam as $exam)
            {
                $dataE = array();
                $dataE['exam_name'] = $exam->exam_name;

                $getExamTimetable = ExamScheduleModel::getExamTimetable($exam->exam_id, $class->class_id);
                
                $subjectArray = array();
        
                foreach($getExamTimetable as $valueS)
                    {
                        $dataS = array();
                        $dataS['subject_name'] = $valueS->subject_name;
                        $dataS['exam_date'] = $valueS->exam_date;
                        $dataS['start_time'] = $valueS->start_time;
                        $dataS['end_time'] = $valueS->end_time;
                        $dataS['room_number'] = $valueS->room_number;
                        $dataS['full_marks'] = $valueS->full_marks;
                        $dataS['passing_mark'] = $valueS->passing_mark; 
                        $subjectArray[] = $dataS;

                    }
                $dataE['subject'] = $subjectArray;       
                $examArray[] =$dataE;
            }
            $dataC['exam'] = $examArray;

            $result[] = $dataC;
        }
        
        $data['getRecord'] = $result;

        $data['header_title'] = "My Exam Timetable";
        return view('teacher.my_exam_timetable', $data);

    }

public function reportRemark(Request $request)
{
    // Get classes assigned to the logged-in teacher
    $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
    $assignedClassIds = AssignClassTeacherModel::where('teacher_id', Auth::user()->id)
        ->where('status', 0) // Assuming 0 = active, adjust if different
        ->pluck('class_id');

    $data['getClass'] = ClassModel::whereIn('id', $assignedClassIds)
        ->where('is_delete', 0)
        ->get();

    $data['getTerms'] = TermModel::all();
    $data['getSessions'] = SessionModel::all();
    $data['students'] = collect();
    $data['existingRemarks'] = [];

    if ($request->has(['class_id', 'term_id', 'session_id'])) {
        // Ensure the teacher is assigned to the requested class
        if ($assignedClassIds->contains($request->class_id)) {
            $data['students'] = User::where('class_id', $request->class_id)
                ->where('is_delete', 0)
                ->get();

            $remarks = StudentReportRemark::where('class_id', $request->class_id)
                ->where('term_id', $request->term_id)
                ->where('session_id', $request->session_id)
                ->get()
                ->keyBy('student_id');

            $data['existingRemarks'] = $remarks;
        }
    }

    return view('teacher.report_remark', $data);
}
public function saveReportRemark(Request $request)
{
    $request->validate([
        'remarks' => 'required|array',
    ]);

    foreach ($request->remarks as $studentId => $remarkData) {
        if (!isset($remarkData['class_id'], $remarkData['term_id'], $remarkData['session_id'])) {
            continue; // skip incomplete rows
        }

        // Prepare data (names must match your model + DB columns)
        $saveData = [
            'skills'            => $remarkData['skills'] ?? null,        // array (auto-cast to JSON)
            'behaviour'         => $remarkData['behaviour'] ?? null,     // array (auto-cast to JSON)
            'teachers_comment'   => $remarkData['teachers_comment'] ?? null,
            'principal_comment' => $remarkData['principal_comment'] ?? null,
        ];

        // Save or update
        \App\Models\StudentReportRemark::updateOrCreate(
            [
                'student_id' => $studentId,
                'class_id'   => $remarkData['class_id'],
                'term_id'    => $remarkData['term_id'],
                'session_id' => $remarkData['session_id'],
            ],
            $saveData
        );
    }

    return redirect('teacher/remarks_report')->with('success', "All student remarks saved successfully");
}   

public function marksRegisterSubjectTeacher(Request $request)
{
 $teacher_id = Auth::id();

    // ✅ Get all exams (not deleted)
    $data['getExam'] = ExamModel::where('is_delete', 0)
        ->select('id as exam_id', 'name as exam_name')
        ->get();

    // ✅ Get all classes this teacher is assigned to
    $data['getClass'] = AssignSubjectTeacherModel::where('teacher_id', $teacher_id)
        ->where('is_delete', 0)
        ->with('class')
        ->get()
        ->pluck('class')
        ->filter()
        ->unique('id')
        ->values();

    // Empty defaults
    $data['getSubject'] = collect();
    $data['getStudent'] = collect();

    // ✅ Only proceed if teacher selected both exam + class
    if ($request->filled('exam_id') && $request->filled('class_id')) {
        // Fetch all subjects scheduled for that exam & class
        $allSubjects = ExamScheduleModel::getSubject(
            $request->get('exam_id'),
            $request->get('class_id')
        );

        // ✅ Filter only subjects assigned to this teacher
        $data['getSubject'] = $allSubjects->filter(function ($subj) use ($teacher_id) {
            return AssignSubjectTeacherModel::where('teacher_id', $teacher_id)
                ->where('class_id', $subj->class_id)
                ->where('subject_id', $subj->subject_id)
                ->where('is_delete', 0)
                ->exists();
        });

        // ✅ Fetch students of this class
        $data['getStudent'] = User::getStudentClass($request->get('class_id'));
    }

    return view('teacher.mark_register_subject_teacher', $data);
}


public function submitMarksRegister(Request $request)
{
    $teacher_id = Auth::id();
    
    $student_id = $request->student_id;
    $exam_id = $request->exam_id;
    $class_id = $request->class_id;

    foreach($request->mark as $mark) {
        // Ensure teacher can only insert for assigned subjects
        $assigned = AssignSubjectTeacherModel::where([
            ['teacher_id', $teacher_id],
            ['class_id', $class_id],
            ['subject_id', $mark['subject_id']],
            ['is_delete', 0]
        ])->exists();

        if(!$assigned) continue; // skip subjects not assigned to this teacher

        $record = MarksRegisterModel::updateOrCreate(
            [
                'student_id' => $student_id,
                'subject_id' => $mark['subject_id'],
                'exam_id'    => $exam_id,
                'class_id'   => $class_id
            ],
            [
                'ca1' => $mark['ca1'] ?? 0,
                'ca2' => $mark['ca2'] ?? 0,
                'ca3' => $mark['ca3'] ?? 0,
                'exam' => $mark['exam'] ?? 0,
                'teacher_id' => $teacher_id
            ]
        );
    }

    return response()->json(['message' => 'Marks saved successfully']);
}

public function singleSubmitMarksRegister(Request $request)
{
    $teacher_id = Auth::id();

    $assigned = AssignSubjectTeacherModel::where([
        ['teacher_id', $teacher_id],
        ['class_id', $request->class_id],
        ['subject_id', $request->subject_id],
        ['is_delete', 0]
    ])->exists();

    if(!$assigned) {
        return response()->json(['message' => 'Unauthorized!']);
    }

    MarksRegisterModel::updateOrCreate(
        [
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'exam_id'    => $request->exam_id,
            'class_id'   => $request->class_id
        ],
        [
            'ca1' => $request->ca1 ?? 0,
            'ca2' => $request->ca2 ?? 0,
            'ca3' => $request->ca3 ?? 0,
            'exam' => $request->exam ?? 0,
            'teacher_id' => $teacher_id
        ]
    );

    return response()->json(['message' => 'Mark saved successfully']);
}

//parent side
    public function ParentMyExamTimetable($student_id)
    {
     $students = User::where('parent_id', Auth::id())->get();

    $getStudent = User::getSingle($student_id);
    $class_id = $getStudent->class_id;
    $getExam = ExamScheduleModel::getExam($class_id);
    $result = array();
    foreach($getExam as $value)
    {
        $dataE = array();
        $dataE['name'] = $value->exam_name;
        $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
        $resultS = array();
        foreach($getExamTimetable as $valueS)
        {
            $dataS = array();
            $dataS['subject_name'] = $valueS->subject_name;
            $dataS['exam_date'] = $valueS->exam_date;
            $dataS['start_time'] = $valueS->start_time;
            $dataS['end_time'] = $valueS->end_time;
            $dataS['room_number'] = $valueS->room_number;
            $dataS['full_marks'] = $valueS->full_marks;
            $dataS['passing_mark'] = $valueS->passing_mark;
            $resultS[] = $dataS;
        }

            $dataE['exam'] = $resultS;
            $result[] = $dataE;
    }   
    $data['getRecord'] = $result;
    $data['getStudent'] = $getStudent;

    $data['header_title'] = "My Exam Timetable";
    return view('parent.my_exam_timetable', $data);

    }

public function ParentMyExamResult(Request $request, $student_id)
{
    $parentId = Auth::id();

    // All the children for this parent
    $students = User::where('parent_id', $parentId)->get();
    $exams = ExamModel::all(); // or filter

    if (!$request->has('exam_id')) {
        return view('parent.my_exam_result_index', [
            'students' => $students,
            'exams'    => $exams,
        ]);
    }

    $exam_id = $request->query('exam_id');

    if (!$exam_id || !$student_id) {
        return back()->with('error', 'Missing exam_id or student_id.');
    }

    // ===== Basic data =====
    $data['students']   = $students;
    $data['exams']      = $exams;
    $data['getExam']    = ExamModel::getSingle($exam_id);
    $data['getStudent'] = User::getSingle($student_id);
    $data['getClass']   = MarksRegisterModel::getClass($exam_id, $student_id);
    $data['getSetting'] = SettingModel::getSingle();

    // ===== Exam subjects and scores =====
    $getExamSubject = MarksRegisterModel::getExamSubject($exam_id, $student_id);
    $dataSubject = [];
    foreach ($getExamSubject as $exam) {
        $total_score = $exam['ca1'] + $exam['ca2'] + $exam['ca3'] + $exam['exam'];
        $dataSubject[] = [
            'subject_id'   => $exam['subject_id'],
            'exam_id'      => $exam['exam_id'],
            'subject_name' => $exam['subject_name'],
            'ca1'          => $exam['ca1'],
            'ca2'          => $exam['ca2'],
            'ca3'          => $exam['ca3'],
            'exam'         => $exam['exam'],
            'total_score'  => $total_score,
            'full_marks'   => $exam['full_marks'],
            'passing_mark' => $exam['passing_mark'],
        ];
    }

    // ===== Match Blade expectation ($getRecord) =====
    $data['getRecord'] = [
        [
            'exam_id'   => $exam_id,
            'exam_name' => $data['getExam']->name ?? 'Exam',
            'subject'   => $dataSubject,
        ]
    ];

    // ===== Remarks =====
    $remark = StudentReportRemark::where('student_id', $student_id)
        ->where('class_id', $data['getStudent']->class_id)
        ->where('term_id',  $data['getExam']->term_id ?? 0)
        ->where('session_id', $data['getExam']->session_id ?? 0)
        ->first();

    $data['skills']            = $remark?->skills ?? [];
    $data['behaviour']         = $remark?->behaviour ?? [];
    $data['teachers_comment']  = $remark?->teachers_comment ?? '';
    $data['principal_comment'] = $remark?->principal_comment ?? '';

    $data['header_title'] = "My Exam Result";

    
    return view('parent.my_exam_result', $data);
}

}
