<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;

class SessionModel extends Model
{
    use HasFactory;

    protected $table = 'session';

    /**
     * Check if a session already exists by name.
     */
     static public function CheckAlreadySession($name)
        {
            return SessionModel::where('name', '=', $name)
                ->where('is_delete', '=', 0) // respect soft delete if used
                ->first();
        }

    /**
     * Get all active sessions (not deleted).
     */
      static public function getAllSessions()
        {
            return SessionModel::where('is_delete', '=', 0)
                ->orderBy('id', 'desc')
                ->get();
        }

    /**
     * Get a single session by its ID.
     */
    static public function getSingle($id)
        {
            return SessionModel::where('id', '=', $id)
                ->where('is_delete', '=', 0)
                ->first();
        }

    /**
     * Soft delete a session.
     */
    static public function softDelete($id)
        {
            return SessionModel::where('id', '=', $id)
                ->update(['is_delete' => 1]);
        }

 static public function getRecord()
    {
        $return = self::select('session.*', 'users.name as created_name')
                    ->Join('users', 'users.id', '=', 'session.created_by');

        if (!empty(Request::get('name'))) {
            $return = $return->where('session.name', 'like', '%' . Request::get('name') . '%');
        }

        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('session.created_at', '=', Request::get('date'));
        }

        $return = $return->where('session.is_delete', '=', 0)
            ->orderBy('session.id', 'desc')
            ->paginate(50);

        return $return;
    }


}
