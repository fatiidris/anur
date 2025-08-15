<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\WeekModel;
use App\Models\ExamScheduleModel;
use App\Models\ClassSubjectTimetableModel;
use App\Models\AssignClassTeacherModel;
use App\Models\User;
use Auth;

// TIMETABLE
class CalenderController extends Controller
{
    public function MyCalender()
    {
        //timetable
        // dd($result);
        $data['getMyTimetable'] = $this->getTimetable(Auth::user()->class_id);
        $data['getExamTimetable'] = $this->getExamTimetable(Auth::user()->class_id);

        $data['header_title'] = "My Calender";
        return view('student.my_calender', $data);
    }

    public function getExamTimetable($class_id)
    {
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

        return $result;
    }

    public function getTimetable($class_id)
    {
        $result = array();
        $getRecord = ClassSubjectModel::MySubject($class_id);
    

        foreach($getRecord as $value)
        {
            $dataS['name'] = $value->subject_name;
            
            $getWeek = WeekModel::getRecord();
            $week = array();
            foreach( $getWeek as $valueW)
            {
                $dataW = array(); 
                $dataW['week_name'] = $valueW->name;
                $dataW['fullcalendar_day'] = $valueW->fullcalendar_day;
                
                $ClassSubject = ClassSubjectTimetableModel::getRecordClassSubject($value->class_id,$value->subject_id,$valueW->id);
               if(!empty($ClassSubject))
               {
                $dataW['start_time'] = $ClassSubject->start_time;
                $dataW['end_time'] = $ClassSubject->end_time;
                $dataW['room_number'] = $ClassSubject->room_number;
                $week[] = $dataW;
            
               }
    
            }
            $dataS['week'] = $week;
            $result[] = $dataS;
            
        }
        return $result;
    }

    //parent side
    public function MyCalenderParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getStudent'] = $getStudent;
        $data['getMyTimetable'] = $this->getTimetable($getStudent->class_id);
    
        $data['getExamTimetable'] = $this->getExamTimetable($getStudent->class_id);
        $data['header_title'] = "Student Calender";
        return view('parent.my_calender', $data);
    }

    //teacher side
    public function MyCalenderTeacher()
    {
        $teacher_id = Auth::user()->id;

        $data['getClassTimetable'] = AssignClassTeacherModel::getCalenderTeacher($teacher_id);

        $data['getExamTimetable'] = ExamScheduleModel::getExamTimetableTeacher($teacher_id);
        // dd($data['getExamTimetable']);
        $data['header_title'] = "Teacher Calender";
        return view('teacher.my_calender', $data);
    }

}
