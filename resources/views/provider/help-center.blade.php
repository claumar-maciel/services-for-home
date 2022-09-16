@extends('layouts.provider.panel')
 
@section('title', 'Central de ajuda ao prestador')
 
@section('content')
    <div class="w-100 mt-4">
        Olá <b>{{ auth()->user()->nome }}</b>, você pode solicitar ajuda no email <b>corretorpleno@gmail.com</b>!
    </div>
@endsection