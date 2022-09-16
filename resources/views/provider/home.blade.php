@extends('layouts.provider.panel')
 
@section('title', 'Bem-vindo')
 
@section('content')
    <div class="w-100 mt-4">
        Olá <b>{{ auth()->user()->nome }}</b>, você está cadastrado como um prestador de serviços!
    </div>

    <hr>    
    
    <div class="w-100 mt-2">
        <h5 class="card-title">Chats</h5>

        <div class="px-2">
            @include('shared.chat-list')
        </div>
    </div>
@endsection