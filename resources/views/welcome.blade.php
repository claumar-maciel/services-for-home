@extends('layouts.auth')
 
@section('title', 'bem-vindo')
 
@section('content')
    <h1 class="text-white mb-5">MÃO NA RODA</h1>

    <div class="mb-5 mt-1">
        <a class="welcome__btn" href="{{ route('client.login') }}">Cliente</a>
        
        <a class="welcome__btn" href="{{ route('provider.login') }}">Prestador</a>
    </div>

    <div class="mb-5 mt-1">
        <img src="{{ asset('img/logo.png') }}">
    </div>

    <footer class="text-white mb-5 mt-1">
        <p class="m-0">A melhor plataforma para encontrar serviços profissionais.</p>
        <p class="m-0">Seja para sua casa, apartamento, ou empresa.</p>
    </footer>

    <div class="mt-1">        
        <a class="welcome__btn" href="{{ route('admin.login') }}">Administrador</a>
    </div>
@endsection