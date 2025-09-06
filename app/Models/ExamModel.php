<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ExamModel extends Model
{
    use HasFactory;
    
    protected $table = 'exam';

    // Allow mass assignment
    protected $fillable = [
        'name',       // Existing exam name field
        'note',
        'created_by',
        'term_id',    // Link to term
        'session_id', // NEW: Direct link to session
        'is_delete'
    ];

    /**
     * Exam belongs to a Term
     */
    public function term()
    {
        return $this->belongsTo(TermModel::class, 'term_id');
    }

    /**
     * Exam belongs to a Session
     */
    public function session()
    {
        return $this->belongsTo(SessionModel::class, 'session_id');
    }

    /**
     * Exam created by a User
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Combine Term and Session dynamically
     */
    public function getFullExamNameAttribute()
    {
        $termName = $this->term->name ?? '';
        $sessionName = $this->session->name ?? '';
        return trim($termName . ', ' . $sessionName);
    }

    /**
     * Get single exam with relationships
     */
    static public function getSingle($id)
    {
        return self::with(['term', 'session', 'creator'])
                   ->where('id', $id)
                   ->where('is_delete', 0)
                   ->first();
    }

    /**
     * Get paginated exam records (with filters)
     */
    static public function getRecord()
    {
        $query = self::select(
                    'exam.*',
                    'users.name as created_name',
                    'term.name as term_name',
                    'session.name as session_name'
                )
                ->leftJoin('users', 'users.id', '=', 'exam.created_by')
                ->leftJoin('term', 'term.id', '=', 'exam.term_id')
                ->leftJoin('session', 'session.id', '=', 'exam.session_id')
                ->where('exam.is_delete', 0)
                ->orderBy('exam.id', 'desc');

        // Search filters
        if (!empty(Request::get('name'))) {
            $query->where('exam.name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('session_id'))) {
            $query->where('exam.session_id', Request::get('session_id'));
        }

        if (!empty(Request::get('term_id'))) {
            $query->where('exam.term_id', Request::get('term_id'));
        }

        if (!empty(Request::get('date'))) {
            $query->whereDate('exam.created_at', '=', Request::get('date'));
        }

        return $query->paginate(50);
    }

    /**
     * Get all active exams (for dropdowns)
     */
    static public function getExam()
    {
        return self::with(['term', 'session'])
                   ->where('is_delete', 0)
                   ->orderBy('name', 'asc')
                   ->get();
    }

    /**
     * Soft delete exam
     */
    static public function softDelete($id)
    {
        return self::where('id', $id)->update(['is_delete' => 1]);
    }

    /**
     * Get total active exams
     */
    static public function getTotalExam()
    {
        return self::where('is_delete', 0)->count();
    }
}
