<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class AssignSubjectTeacherModel extends Model
{
    use HasFactory;

    protected $table = 'assign_subject_teacher';

    // Allow mass assignment for these columns
    protected $fillable = [
        'teacher_id',
        'class_id',
        'subject_id',
        'created_by',
        'is_delete',
    ];

    /**
     * Get a single record by ID.
     */
    static public function getSingle($id)
    {
        return self::find($id);
    }

    /**
     * Retrieves all assigned subject records with class, teacher, subject, and creator details.
     * This is typically used for the Admin list/search page.
     */
    static public function getRecord()
    {
        $return = self::select(
                        'assign_subject_teacher.*', 
                        'class.name as class_name', 
                        'teacher.name as teacher_name', 
                        'teacher.last_name as teacher_last_name', 
                        'users.name as created_by_name', 
                        'subject.name as subject_name', 
                        'subject.type as subject_type' // Keeping subject_type for Admin view
                    )
                    ->join('users as teacher', 'teacher.id', '=', 'assign_subject_teacher.teacher_id')
                    ->join('subject', 'subject.id', '=', 'assign_subject_teacher.subject_id')
                    ->join('class', 'class.id', '=', 'assign_subject_teacher.class_id')
                    ->join('users', 'users.id', '=', 'assign_subject_teacher.created_by')
                    ->where('assign_subject_teacher.is_delete', '=', 0);

        if(!empty(Request::get('class_name')))
        {
            $return = $return->where('class.name', 'like', '%'.Request::get('class_name') .'%');
        }
        
        if(!empty(Request::get('teacher_name')))
        {
            $return = $return->where('teacher.name', 'like', '%'.Request::get('teacher_name') .'%');
        }
        if(!empty(Request::get('subject_name')))
        {
            $return = $return->where('subject.name', 'like', '%'.Request::get('subject_name') .'%');
        }
                    
        $return = $return->orderBy('assign_subject_teacher.id', 'desc')
                        ->paginate(100);
        return $return;
    }

    /**
     * NEW: Get all subjects and classes assigned to a specific teacher.
     * This is essential for the Teacher Dashboard and Score Entry.
     * Only selects IDs and names, avoiding 'subject.type' confusion.
     */
    static public function getTeacherAssignedSubjects($teacherId)
    {
        return self::select(
                        'assign_subject_teacher.*', // Includes class_id and subject_id
                        'class.name as class_name',
                        'subject.name as subject_name'
                    )
                    ->join('class', 'class.id', '=', 'assign_subject_teacher.class_id')
                    ->join('subject', 'subject.id', '=', 'assign_subject_teacher.subject_id')
                    ->where('assign_subject_teacher.teacher_id', '=', $teacherId)
                    ->where('assign_subject_teacher.is_delete', '=', 0)
                    ->where('class.is_delete', '=', 0) // Ensure the class is active
                    ->where('subject.is_delete', '=', 0) // Ensure the subject is active
                    ->orderBy('class.name', 'asc')
                    ->get();
    }


    /**
     * Check if a class-subject combination is already assigned (for uniqueness validation).
     */
    static function getAlreadyFirst($class_id, $subject_id)
    {
        return self::where('class_id', '=', $class_id)->where('subject_id', '=', $subject_id)->first();
    }

    static public function getAssignTeacherID($class_id)
    {
        
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }

    static public function deleteTeacher($class_id)
    {
        return self::where('class_id', '=', $class_id)->delete();
    }

    static function getAssignSubjectID($class_id)
    {
        return self::where('class_id', '=', $class_id)->where('is_delete', '=', 0)->get();
    }

    static public function getClass()
    {
        $return = ClassModel::select('class.*')
                ->join('users', 'users.id', 'class.created_by') 
                ->where('class.is_delete', '=', 0)
                ->where('class.status', '=', 0)
                ->orderBy('class.name', 'asc')
                ->get(); 
        return  $return;
    }


    /* ========= Relationships ========== */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

 public static function getMySubjects($teacher_id, $exam_id, $class_id)
    {
        return self::select(
            'assign_subject_teacher.*',
            'subjects.name as subject_name',
            'subjects.type as subject_type',
            'subjects.full_marks',
            'subjects.passing_mark',
            'class.name as class_name'
        )
        ->join('subjects', 'subjects.id', '=', 'assign_subject_teacher.subject_id')
        ->join('class', 'class.id', '=', 'assign_subject_teacher.class_id')
        ->where('assign_subject_teacher.teacher_id', $teacher_id)
        ->where('assign_subject_teacher.class_id', $class_id)
        ->get();
    }


}
