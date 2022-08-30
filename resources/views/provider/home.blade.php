@extends('layouts.auth')
 
@section('title', 'prestador')
 
@section('content')
    <div class="d-flex justify-content-center align-items-center flex-wrap my-5 text-white">
        <div class="w-100"> 
            @include('shared.error_success_alert')
        </div>

        <div class="container text-center my-4">
            Olá {{ auth()->user()->nome }}, seja bem-vindo!
        </div>

        <form action="{{ route('client.logout') }}" method="post">
            @csrf

            <button class="btn btn-outline-light">Sair</button>
        </form>
    </div>
@endsection