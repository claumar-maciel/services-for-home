@extends('layouts.email')

@section('content')
    <p>Olá <span>{{$user_name ?? '-'}}</span>.</p>

    <p>
        Você pode recuperar a sua senha <a target="blank" href="{{$recover_url}}">clicando aqui</a>
    </p>
@endsection

@section('styles')
    <style>
        .card__container__body p{
            line-height: 1.5rem;
            margin: 16px 0px;
            width: 100%;
            text-align: left;
        }
    </style>
@endsection
