<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreMessageRequest;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Perfil;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public function index()
    {
        $chats = auth()->user()->clientChats;

        return view('client.chats',[
            'chats' => $chats
        ]);
    }

    public function store(Usuario $provider)
    {
        if ($provider->perfil_id != Perfil::PRESTADOR) {
            Session::flash('error','Não foi informado um prestador válido!'); 

            return view('client.chats',[
                'chats' => auth()->user()->clientChats
            ]);
        }

        $chat = Chat::where('client_id', auth()->user()->id)->where('provider_id', $provider->id)->first(); 

        if (!$chat) {
            $chat = Chat::create([
                'client_id' => auth()->user()->id,
                'provider_id' => $provider->id,
            ]);
        }
        return view('client.chat', [
            'chat' => $chat,
            'messages' => $chat->messages
        ]);
    }

    public function show(Chat $chat)
    {
        return view('client.chat', [
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
            Session::flash('success','mensagem enviada com sucesso!'); 
            return redirect()->route('client.chats.show', ['chat' => $chat->id]);
        }

        Session::flash('error','Ocorreu um erro ao enviar a mensagem!'); 
        return redirect()->route('client.chats.show', ['chat' => $chat->id]);
    }
}
