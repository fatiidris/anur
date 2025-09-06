<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\ChatModel;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $data['header_title'] = "My Chat";

        $sender_id = Auth::user()->id;

        if (!empty($request->receiver_id)) {
            $receiver_id = base64_decode($request->receiver_id); // The id is encoded
            if ($receiver_id == $sender_id) 
            {
                return redirect()->back()->with('error', 'Due to some error please try again');
                exit();
            }
            
            ChatModel::UpdateCount($sender_id, $receiver_id);
            $data['getReceiver'] = User::getSingle($receiver_id);
            $data['getChat'] = ChatModel::getChat($receiver_id, $sender_id);  
        }

        $data['getChatUser'] = ChatModel::getChatUser($sender_id);
        

        return view('chat.list', $data);
    }

public function submit_message(Request $request)
{
    $chat = new ChatModel();
    $chat->sender_id = Auth::id();
    $chat->receiver_id = $request->receiver_id;
    $chat->message = $request->message;
    $chat->created_date = time(); // keep as integer timestamp
    $chat->save();

    $getChat = ChatModel::where('id', '=', $chat->id)->get();

    return response()->json([
        'status'  => true,
        'success' => view('chat._single', [
           "getChat" => $getChat
        ])->render(),
        
    ], 200);
}

    public function get_chat_windows(Request $request)
    {
        $receiver_id = $request->receiver_id;
        $sender_id = Auth::user()->id;

        $data['getChat'] = ChatModel::getChat($receiver_id, $sender_id);
        $data['getReceiver'] = User::getSingle($receiver_id);
        $data['sender_id'] = $sender_id;

        return response()->json([
            "status" => true,
            "success" => view('chat._single', $data)->render(),
        ], 200);
    }
}
