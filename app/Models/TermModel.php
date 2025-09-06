<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class TermModel extends Model
{
    use HasFactory;

    protected $table = 'term';

     protected $fillable = [
        'session_id',
        'name',
        'created_by',
        'is_delete'
    ];

    // Relations
    public function session()
    {
        return $this->belongsTo(SessionModel::class, 'session_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    /**
     * Check if a term already exists by name.
     */
    static public function CheckAlreadyTerm($name)
    {
        return TermModel::where('name', '=', $name)
            ->where('is_delete', '=', 0)
            ->first();
    }

    /**
     * Get all active terms (not deleted).
     */
    static public function getAllTerms()
    {
        return TermModel::where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Get a single term by its ID.
     */
    static public function getSingle($id)
    {
        return TermModel::where('id', '=', $id)
            ->where('is_delete', '=', 0)
            ->first();
    }

    /**
     * Soft delete a term.
     */
    static public function softDelete($id)
    {
        return TermModel::where('id', '=', $id)
            ->update(['is_delete' => 1]);
    }

    /**
     * Get term records with filtering, including creator's name.
     */
static public function getRecord()
{
    $query = self::select('term.*', 'users.name as created_name', 'session.name as session_name')
        ->join('users', 'users.id', '=', 'term.created_by')
        ->join('session', 'session.id', '=', 'term.session_id')
        ->where('term.is_delete', '=', 0)
        ->orderBy('term.id', 'desc');

    return $query->paginate(50);
  }

}
