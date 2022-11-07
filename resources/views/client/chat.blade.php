@extends('layouts.client.panel')
 
@section('title', 'Chat')
 
@section('content')
<div class="container mt-4">
    <div class="container d-flex justify-content-end align-items-center">
        <a href="{{ route('client.schedulings.index') }}" class="btn btn-secondary">
            <i class="bi bi-clock"></i> agendamentos
        </a>
    </div>

    <div class="my-4 px-2" id="chat-content"
        style="
            max-height: 480px; 
            overflow: auto;
        ">
        <livewire:client.chat :chat="$chat"/>
    </div>

    <form class="w-100" action="{{ route('client.chats.storeMessage', ['chat' => $chat->id]) }}" method="POST">
        @csrf
        
        <textarea name="content" id="" class="form-control" style="height: 120px;" placeholder="escreva a sua mensagem aqui"></textarea>
        
        <button class="btn btn-primary btn-block w-100 mt-1"><i class="bi bi-send"></i> Enviar</button>
    </form>
</div>
@endsection

@section('footerScripts')
    <script defer>
        window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('chat-content').scrollTo(0, document.getElementById('chat-content').scrollHeight)
        })
    </script>
@endsection