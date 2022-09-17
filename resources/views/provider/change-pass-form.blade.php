@extends('layouts.auth')
 
@section('title', 'prestador')
 
@section('content')
    <div class="container__auth">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-dark">Alterar senha</h5>
                <p class="card-text">
                    <form class="mt-4" action="{{route('provider.change-pass')}}" method="POST">
                        @csrf

                        @include('shared.error_success_alert')

                        <input type="hidden" name="recovery_code" value="{{$recovery_code}}">

                        <div class="form-group" class="form-group my-3">
                            <input type="password" class="form-control" placeholder="senha" name="senha">
                        </div>

                        <div class="d-flex justify-content-end form-group my-3">
                            <button class="btn btn-primary ms-2">alterar senha</button>
                        </div>
                    </form>
                </p>
            </div>
        </div>
    </div>

    <a href="{{ route('welcome') }}" class="welcome__btn">TELA INICIAL</a>
@endsection