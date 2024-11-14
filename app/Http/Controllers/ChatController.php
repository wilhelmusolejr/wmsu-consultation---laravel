<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    function index($appointmentId)
    {
        $chats = Chat::where('appointment_id', $appointmentId)->orderBy('created_at', 'asc')->get();

        return response()->json($chats, 200);
    }

    // Store a new chat message
    public function store(Request $request)
    {
        $chat = Chat::create([
            'appointment_id' => $request['appointment_id'],
            'sender_id' => $request['sender_id'],
            'recipient_id' => $request['recipient_id'],
            'message_content' => $request['message_content'],
        ]);

        return response()->json($chat, 201);
    }
}