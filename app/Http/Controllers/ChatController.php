<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Valida el mensaje
        $request->validate(['message' => 'required|string']);

        // Envía el mensaje al servidor de Node.js (asumiendo que Node.js está en localhost:3001)
        Http::post('http://localhost:3001/message', [
            'message' => $request->message,
        ]);

        return response()->json(['status' => 'Mensaje enviado!']);
    }

    public function chatView()
    {
        return view('chat');
    }
}
