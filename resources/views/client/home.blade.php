@extends('layouts.auth')
 
@section('title', 'cliente')
 
@section('content')
    <div class="d-flex justify-content-center align-items-center flex-wrap my-5 text-white">
        <div class="w-100"> 
            @include('shared.error_success_alert')
        </div>


        Homepage protegida do cliente
    </div>
@endsection