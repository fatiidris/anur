<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentReportRemark extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'student_report_remark';

    // Mass assignable fields
    protected $fillable = [
        'student_id',
        'exam_id',
        'class_id',
        'term_id',
        'session_id',
        'skills',
        'behaviour',
        'teachers_comment',
        'principal_comment',
    ];

    /**
     * Cast skills and behaviour to array automatically
     */
    protected $casts = [
        'skills' => 'array',
        'behaviour' => 'array',
    ];

    /**
     * Relationship with student
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Relationship with class
     */
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    /**
     * Relationship with term
     */
    public function term()
    {
        return $this->belongsTo(TermModel::class, 'term_id');
    }

    /**
     * Relationship with session
     */
    public function session()
    {
        return $this->belongsTo(SessionModel::class, 'session_id');
    }

    /**
     * Helper to get teacher comment dynamically
     * based on average performance if not set manually.
     */
    public static function generateTeacherComment($average)
    {
        if ($average >= 70) return "Excellent performance! Keep it up.";
        if ($average >= 60) return "Very good, continue working hard.";
        if ($average >= 50) return "Good effort, but can improve.";
        if ($average >= 40) return "Fair, more focus is needed.";
        return "Needs serious improvement.";
    }

    /**
     * Helper to get principal comment dynamically
     */
    public static function generatePrincipalComment($average)
    {
        if ($average >= 70) return "Commendable result, well done!";
        if ($average >= 60) return "Satisfactory, keep improving.";
        if ($average >= 50) return "Good, but strive for excellence.";
        if ($average >= 40) return "Fair, please work harder next term.";
        return "Below expectations, must improve significantly.";
    }
}
