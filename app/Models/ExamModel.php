<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class ExamModel extends Model
{
    use HasFactory;
    
    protected $table = 'exam';
    protected $fillable = ['name', 'note', 'created_by', 'is_delete'];


    // Get single record (only non-deleted by default)
    static public function getSingle($id)
    {
        return self::find($id);
    }

    // Get paginated records (filtered by name or date)
    static public function getRecord()
    {
        $return = self::select('exam.*', 'users.name as created_name')
                     ->join('users', 'users.id', '=', 'exam.created_by');
                    

                    if(!empty(Request::get('name'))) 
                    {
                        $return = $return->where('exam.name', 'like', '%' .Request::get('name') .'%');
                    }

                    if(!empty(Request::get('date'))) 
                    {
                        $return = $return->whereDate('exam.created_at', '=', Request::get('date'));
                    }

                    $return = $return->where('exam.is_delete', '=',0)
                    ->orderBy('exam.id', 'desc')
                    ->paginate(50);
        return  $return;            
                }

    // Get list of active exams (for dropdowns or selection)
    static public function getExam()
    {
        $return = self::select('exam.*')
                   ->join('users', 'users.id', '=', 'exam.created_by')
                   ->where('exam.is_delete','=', 0)
                   ->orderBy('exam.name', 'asc')
                   ->get();
        return $return;           
    }

    static public function getTotalExam()
    {
        $return = self::select('exam.id')
                   ->join('users', 'users.id', '=', 'exam.created_by')
                   ->where('exam.is_delete','=', 0)
                   ->count();
        return $return;           
    }
}
