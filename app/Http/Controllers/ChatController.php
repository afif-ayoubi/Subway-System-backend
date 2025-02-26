<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function addchat(Request $request)
    {
        $validatedData = $this->validateChatRequest($request);

        $chat = new Chat();
        $chat->user_id = $validatedData['user_id'];
        $chat->recipient_id = $validatedData['recipient_id'];
        $chat->message = $validatedData['message'];

        $chat->save();

        return response()->json(['status' => 'success', 'chat' => $chat], 201);
    }

    public function getChats($user_id, $recipient_id)
    {
        $chats = Chat::where(function ($query) use ($user_id, $recipient_id) {
            $query->where('user_id', $user_id)
                ->where('recipient_id', $recipient_id);
        })->orWhere(function ($query) use ($user_id, $recipient_id) {
            $query->where('user_id', $recipient_id)
                ->where('recipient_id', $user_id);
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['status' => 'success', 'chats' => $chats], 200);
    }

    private function validateChatRequest(Request $request)
    {
        return $request->validate([
            'message' => 'required',
            'user_id' => 'required|exists:users,id',
            'recipient_id' => 'required|exists:users,id',
        ]);
    }
}
