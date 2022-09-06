@extends('layouts.admin.panel')
 
@section('title', 'Bem-vindo')
 
@section('content')
    <div class="w-100 mt-4">
        Olá <b>{{ auth()->user()->nome }}</b>, aqui você vai conseguir administrar o sistema!
    </div>
@endsection