<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MarksRegisterModel extends Model
{
    use HasFactory;

    protected $table = 'mark_register';

     protected $fillable = [
        'student_id',
        'subject_id',
        'exam_id',
        'class_id',
        'ca1',
        'ca2',
        'ca3',
        'exam',
        'teacher_id'
    ];

    /** Check if mark already exists */
    public static function CheckAlreadyMark($student_id, $exam_id, $class_id, $subject_id)
    {
        return self::where('student_id', $student_id)
            ->where('exam_id', $exam_id)
            ->where('class_id', $class_id)
            ->where('subject_id', $subject_id)
            ->first();
    }

    /** Get all exams for a student */
    public static function getExam($student_id)
    {
        return self::select('mark_register.*', 'exam.name as exam_name')
            ->join('exam', 'exam.id', '=', 'mark_register.exam_id')
            ->where('mark_register.student_id', $student_id)
            ->groupBy('mark_register.exam_id')
            ->get();
    }

    /** Get all subjects for an exam for a student */
    public static function getExamSubject($exam_id, $student_id)
    {
        return self::select(
                'mark_register.*',
                'exam.name as exam_name',
                'subject.name as subject_name',
                'subject.id as subject_id'
            )
            ->join('exam', 'exam.id', '=', 'mark_register.exam_id')
            ->join('subject', 'subject.id', '=', 'mark_register.subject_id')
            ->where('mark_register.exam_id', $exam_id)
            ->where('mark_register.student_id', $student_id)
            ->get();
    }

    /** Get class name for an exam */
    public static function getClass($exam_id, $student_id)
    {
        return self::select('class.name as class_name')
            ->join('exam', 'exam.id', '=', 'mark_register.exam_id')
            ->join('class', 'class.id', '=', 'mark_register.class_id')
            ->join('subject', 'subject.id', '=', 'mark_register.subject_id')
            ->where('mark_register.exam_id', $exam_id)
            ->where('mark_register.student_id', $student_id)
            ->first();
    }

    /** Get subject position of a student in class */
   public static function getSubjectPosition($exam_id, $class_id, $subject_id, $student_id)
{
    $marks = self::where('exam_id', $exam_id)
        ->where('class_id', $class_id)
        ->where('subject_id', $subject_id)
        ->select(
            'student_id',
            DB::raw('(ca1 + ca2 + ca3 + exam) as total')
        )
        ->orderByDesc('total')
        ->get();

    $rank = 0;
    $position = null;
    $previousMark = null;

    foreach ($marks as $mark) {
        if ($previousMark === null || $mark->total < $previousMark) {
            $rank++;
        }

        if ($mark->student_id == $student_id) {
            $position = $rank;
            break;
        }

        $previousMark = $mark->total;
    }

    return $position ? $position . self::ordinalSuffix($position) : '-';
}

private static function ordinalSuffix($number)
{
    if (!in_array(($number % 100), [11, 12, 13])) {
        switch ($number % 10) {
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

}
