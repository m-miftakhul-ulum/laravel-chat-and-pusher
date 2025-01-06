<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['sender', 'receiver'])->get();
        return response()->json($messages);
    }

    // Mengirim pesan baru
    public function store(Request $request)
    {
        

        // event(new MyEvent($request->all()) );

        broadcast(new MyEvent($request->all()) )->toOthers();

        $validated = $request->validate([
            // 'sender_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'receiver_id' => 'required',
        ]);

        $validated['sender_id'] = Auth::user()->id;

        $message = Message::create($validated);
        return response()->json(['message' => 'Message sent successfully!', 'data' => $message]);
    }

    // Menampilkan pesan berdasarkan pengirim atau penerima
    public function show($userId)
    {

        $messages = Message::where(
            fn($q) => $q->where('sender_id', Auth::id())->where('receiver_id', $userId)
        )->orWhere(
            fn($q) => $q->where('sender_id', $userId)->where('receiver_id', Auth::id())
        )->get();

        return response()->json($messages);
    }
}
