@extends('layouts.auth')
 
@section('title', 'recuperar senha')
 
@section('content')
    <div class="container__auth">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-dark">Recuperar senha do administrador</h5>
                <p class="card-text">
                    <form class="mt-4" action="{{route('provider.recover-pass')}}" method="POST">
                        @csrf

                        @include('shared.error_success_alert')
                        
                        <div class="form-group my-3">
                            <input type="email" class="form-control" placeholder="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="d-flex justify-content-end form-group my-3">
                            <a class="btn btn-secondary ms-2" href="{{ route('admin.login') }}">voltar</a>
                            <button class="btn btn-primary ms-2">enviar email</button>
                        </div>
                    </form>
                </p>
            </div>
        </div>
    </div>

    <a href="{{ route('welcome') }}" class="welcome__btn">TELA INICIAL</a>
@endsection