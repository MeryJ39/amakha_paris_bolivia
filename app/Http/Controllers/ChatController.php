<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show(Chat $chat)
    {
        // 1. Verifica que el usuario esté autenticado.
        if (!Auth::check()) {
            return redirect('/login');
        }

        $messages = $chat->messages()->with('user')->get();

        return view('chat.show', compact('chat', 'messages'));
    }

    public function store(Request $request, Order $order)
    {
        // 1. Verifica que el usuario esté autenticado.
        if (!Auth::check()) {
            return redirect('/login');
        }

        $chat = $order->chat ?? new Chat(['order_id' => $order->id, 'user_id' => Auth::id()]);
        $chat->save();

        return redirect()->route('chat.show', $chat);
    }
}
