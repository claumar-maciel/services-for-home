@extends('layouts.client.panel')
 
@section('title', 'Chats')
 
@section('content')
   <div class="container mt-4">
        @if (count($chats))
            @foreach ($chats as $chat)
                <div class="row mb-2">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h6 class="m-0">{{ $chat->provider->nome }}</h6>

                            <a class="btn btn-primary btn-sm" href="{{ route('client.chats.show', ['chat' => $chat->id]) }}"><i class="bi bi-send"></i> Acessar chat</a>
                        </div>
                    </div>
            </div>
            @endforeach
        @else
            Nenhum chat encontrado
        @endif
   </div>
@endsection