<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request) // No necesitas el Chat $chat aquí
{
    // ... (código anterior)

    $request->validate(['message' => 'required']);

    $message = new Message([
        'chat_id' => $request->input('chat_id'), // Obtén chat_id desde la request
        'user_id' => Auth::id(),
        'message' => $request->input('message'),
    ]);

    $message->save();

    return back();
}
}