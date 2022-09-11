@extends('layouts.provider.panel')
 
@section('title', 'Chat')
 
@section('content')
<div class="container mt-4">
    <div class="my-4 px-2" id="chat-content"
        style="
            max-height: 480px; 
            overflow: auto;
        ">
        @if (count($messages))
            @foreach ($messages as $message)
                @if (auth()->user()->id != $message->sender->id)
                    <div class="w-100 d-flex justify-content-start mb-2">
                        <div class="card w-75">
                            <div class="card-body">
                                <p class="m-0 text-bold">{{ $message->content }}</p>

                                <div class="d-flex justify-content-end">
                                    <span class="text-muted" style="font-size: 12px;">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="w-100 d-flex justify-content-end mb-2">
                        <div class="card w-75 bg-secondary text-white">
                            <div class="card-body">
                                <p class="m-0 text-bold">{{ $message->content }}</p>
                                
                                <div class="d-flex justify-content-end">
                                    <span class="m-0 text-white" style="font-size: 12px;">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach
        @else
            <div class="alert alert-light">Ainda não foi enviada nenhuma mensagem!</div>
        @endif
    </div>

    <form class="w-100" action="{{ route('provider.chats.storeMessage', ['chat' => $chat->id]) }}" method="POST">
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