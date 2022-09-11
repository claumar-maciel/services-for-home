<?php

namespace App\Http\Controllers\Provider;

use App\Events\ChatChanged;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function index()
    {
        $chats = auth()->user()->providerChats;

        return view('provider.chats',[
            'chats' => $chats
        ]);
    }

    public function show(Chat $chat)
    {
        return view('provider.chat', [
            'chat' => $chat,
            'messages' => $chat->messages
        ]);
    }

    public function storeMessage(Chat $chat, StoreMessageRequest $request)
    {
        $message = Message::create([
            'content' => $request->content,
            'chat_id' => $chat->id,
            'sender_id' => auth()->user()->id,
        ]);

        if ($message) {
            event(new ChatChanged($chat));
            
            Session::flash('success','mensagem enviada com sucesso!'); 
            return redirect()->route('provider.chats.show', ['chat' => $chat->id]);
        }

        Session::flash('error','Ocorreu um erro ao enviar a mensagem!'); 
        return redirect()->route('provider.chats.show', ['chat' => $chat->id]);
    }
}
