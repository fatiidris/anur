<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatModel extends Model
{
    use HasFactory;
    protected $table = 'chat';

    static public function getChat($receiver_id, $sender_id)
    {
        return self::where(function ($query) use ($receiver_id, $sender_id) {
            $query->where('receiver_id', '=', $receiver_id)
                  ->where('sender_id', '=', $sender_id);
        })
        ->orWhere(function ($query) use ($receiver_id, $sender_id) {
            $query->where('receiver_id', '=', $sender_id)
                  ->where('sender_id', '=', $receiver_id);
        })
        ->orderBy('id', 'asc')
        ->get();
    }

    public function getSender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function getReceiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
