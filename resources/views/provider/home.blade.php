@extends('layouts.provider.panel')
 
@section('title', 'Bem-vindo')
 
@section('content')
    <div class="w-100 mt-4">
        Olá <b>{{ auth()->user()->nome }}</b>, aqui você vai encontrar os melhores prestadores!
    </div>
@endsection