<?php

namespace App\Http\Controllers\Frontend;

use App\Events\MessengerEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserMessengerController extends Controller
{
    function index() {
      $userId = Auth::user()->id;
      $chatUsers = Chat::with('receiverProfile')->select('receiver_id')
                        ->where('sender_id', $userId)
                        ->where('receiver_id', '!=', $userId)
                        ->groupBy('receiver_id')
                        ->get();                
      return view('frontend.dashboard.messenger.index', compact('chatUsers'));
    } 

    function sendMessage(Request $request){
      $request->validate([
       'message' => ['required']
      ]);

      $chat = new Chat();
      $chat->sender_id = Auth::user()->id;
      $chat->receiver_id = $request->receiver_id;
      $chat->message = $request->message;
      $chat->save();
      broadcast(new MessengerEvent($chat->message,$chat->receiver_id, $chat->created_at));
      return response([
        'alert-type' => 'success',
        'message' => 'Message Sent Successfully'
      ]);
    }

    function getMessages(Request $request){
      $senderId = Auth::user()->id;
      $receiverId = $request->receiverId;
      $messages = Chat::whereIn('receiver_id', [$senderId, $receiverId])->whereIn('sender_id', [$senderId, $receiverId])->orderBy('created_at', 'asc')->get();

      return response($messages);
    }
}
