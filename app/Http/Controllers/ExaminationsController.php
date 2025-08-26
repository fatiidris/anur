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
use App\Models\MarksGradeModel;
use App\Models\SettingModel;



class ExaminationsController extends Controller
{
    public function exam_list()
    {
        $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = "Exam List";
        return view('admin.examinations.exam.list', $data);
    }
    public function exam_add()
    {  
        $data['header_title'] = "Add New Exam";
        return view('admin.examinations.exam.add', $data);
    }
    public function exam_insert(Request $request)
    {
        $exam = new ExamModel;
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', "Exam Successfully Created");
    }
    public function exam_edit($id)
    {
        $data['getRecord'] = ExamModel::getSingle($id);
        
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Exam";
            return view('admin.examinations.exam.edit', $data);
        } else {
            abort(404);
        }
    } 
    public function exam_update($id, Request $request)
{
    $exam = ExamModel::getSingle($id);
    
    if ($exam) {
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', "Exam Successfully Updated");
    } else {
        abort(404);
    }
}
    public function exam_delete($id)
    {
        $getRecord = ExamModel::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();
            
            return redirect()->back()->with('success', "Exam Successfully Deleted");
        }
        else
        {

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

        $validation = 0;
    
        if (!empty($request->mark)) {
            foreach ($request->mark as $mark) {
                $getExamSchedule = ExamScheduleModel::getSingle($mark['id']);
                $full_marks = $getExamSchedule->full_marks;
    
                $ca1 = !empty($mark['ca1']) ? $mark['ca1'] : 0;
                $ca2 = !empty($mark['ca2']) ? $mark['ca2'] : 0;
                $ca3 = !empty($mark['ca3']) ? $mark['ca3'] : 0;
                $exam = !empty($mark['exam']) ? $mark['exam'] : 0;
    
                $full_marks = !empty($mark['full_marks']) ? $mark['full_marks'] : 0;
                $passing_mark = !empty($mark['passing_mark']) ? $mark['passing_mark'] : 0;
                
                $total_mark = $ca1 + $ca2 + $ca3 + $exam;
    
                if ($total_mark > $full_marks) {
                    $validation = 1; // Flag validation error
                    continue; // Skip saving if invalid
                }
    
                // Check if mark already exists
                $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id, $request->exam_id, $request->class_id, $mark['subject_id']);
                if ($getMark) {
                    $save = $getMark;
                } else {
                    $save = new MarksRegisterModel;
                    $save->created_by = Auth::user()->id;
                }                
                
                // Save mark data
                $save->student_id = $request->student_id;
                $save->exam_id    = $request->exam_id;
                $save->class_id   = $request->class_id;
                $save->subject_id = $mark['subject_id'];
                $save->ca1 = $ca1;
                $save->ca2  = $ca2;
                $save->ca3  = $ca3;
                $save->exam       = $exam;
                $save->full_marks = $full_marks;
                $save->passing_mark = !empty($mark['passing_mark']) ? $mark['passing_mark'] : 0;
                $save->save();
            }
        }
    
        // Generate response message
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
        $getExam = MarksRegisterModel::getExam($studentId);

        foreach ($getExam as $value) {
            $dataE = [];
            $dataE['exam_name'] = $value->exam_name;
            $dataE['exam_id'] = $value->exam_id;

            // Get all subjects for this exam & student
            $getExamSubject = MarksRegisterModel::getExamSubject($value->exam_id, $studentId);
            $dataSubject = [];

            // Calculate total score for this student (all subjects)
            $studentTotal = 0;

            foreach ($getExamSubject as $exam) {
                $total_score = $exam['ca1'] + $exam['ca2'] + $exam['ca3'] + $exam['exam'];
                $studentTotal += $total_score;

                $dataS = [];
                $dataS['subject_name'] = $exam['subject_name'];
                $dataS['ca1'] = $exam['ca1'];
                $dataS['ca2'] = $exam['ca2'];
                $dataS['ca3'] = $exam['ca3'];
                $dataS['exam'] = $exam['exam'];
                $dataS['total_score'] = $total_score;
                $dataS['full_marks'] = $exam['full_marks'];
                $dataS['passing_mark'] = $exam['passing_mark'];
                $dataSubject[] = $dataS;
            }

            // ===== NEW: Calculate position for this exam =====
            $ranking = MarksRegisterModel::select('student_id', DB::raw('SUM(ca1 + ca2 + ca3 + exam) as total'))
                ->where('exam_id', $value->exam_id)
                ->groupBy('student_id')
                ->orderByDesc('total')
                ->pluck('student_id')
                ->toArray();

            $position = array_search($studentId, $ranking);
            $dataE['position'] = $position !== false ? $position + 1 : '-';
            // ================================================

            $dataE['subject'] = $dataSubject;
            $dataE['student_total'] = $studentTotal; // Optional: Total marks for this student
            $result[] = $dataE;
        }

        $data['getRecord'] = $result;
        $data['header_title'] = "My Exam Result";

        return view('student.my_exam_result', $data);
    }

        public function MyExamResultPrint(Request $request)
        {
            $exam_id = $request->exam_id;
            $student_id = $request->student_id;
            $data['getExam'] = ExamModel::getSingle($exam_id);
            $data['getStudent'] = User::getSingle($student_id);

            $data['getClass'] = MarksRegisterModel::getClass($exam_id, $student_id);
            $data['getSetting'] = SettingModel::getSingle();
            
            $getExamSubject = MarksRegisterModel::getExamSubject($exam_id, $student_id);

                $dataSubject = array();
                foreach($getExamSubject as $exam)
                {
                    $total_score = $exam['ca1'] + $exam['ca2'] + $exam['ca3'] + $exam['exam']; 
                    $dataS = array();
                    $dataS['subject_name'] = $exam['subject_name'];
                    $dataS['ca1'] = $exam['ca1'];
                    $dataS['ca2'] =  $exam['ca2'];
                    $dataS['ca3'] =  $exam['ca3'];
                    $dataS['exam']      =  $exam['exam'];
                    $dataS['total_score']      =  $total_score;
                    $dataS['full_marks'] = $exam['full_marks'];
                    $dataS['passing_mark'] = $exam['passing_mark'];
                    $dataSubject[] = $dataS;
                }
                $data['getExamMarks'] = $dataSubject;
            return view('exam_result_print', $data);
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

    //parent side
    public function ParentMyExamTimetable($student_id)
    {
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

    public function ParentMyExamResult($student_id)
    {

    $data['getStudent'] = User::getSingle($student_id);
    $result = array();
    $getExam = MarksRegisterModel::getExam($student_id);
    foreach($getExam as $value)
    {
        $dataE = array();
        $dataE['exam_id'] = $value->exam_id;
        $dataE['exam_name'] = $value->exam_name;
        $getExamSubject = MarksRegisterModel::getExamSubject($value->exam_id, $student_id);
        $dataSubject = array();
        foreach($getExamSubject as $exam)
        {
            $total_score = $exam['ca1'] + $exam['ca2'] + $exam['ca3'] + $exam['exam']; 
            $dataS = array();
            $dataS['subject_name'] = $exam['subject_name'];
            $dataS['ca1'] = $exam['ca1'];
            $dataS['ca2'] =  $exam['ca2'];
            $dataS['ca3'] =  $exam['ca3'];
            $dataS['exam']      =  $exam['exam'];
            $dataS['total_score']      =  $total_score;
            $dataS['full_marks'] = $exam['full_marks'];
            $dataS['passing_mark'] = $exam['passing_mark'];
            $dataSubject[] = $dataS;
        }
        $dataE['subject'] = $dataSubject;
        $result[] = $dataE;
    }
    $data['getRecord'] = $result;
    $data['header_title'] = "My Exam Result";
    return view('parent.my_exam_result', $data);
    }

}
