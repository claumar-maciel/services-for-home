@extends('layouts.provider.panel')
 
@section('title', 'Bem-vindo')
 
@section('content')
    <div class="w-100 mt-4">
        Olá <b>{{ auth()->user()->nome }}</b>, você está cadastrado como um prestador de serviços!
    </div>
@endsection