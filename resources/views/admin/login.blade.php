@extends('layouts.auth')
 
@section('title', 'administrador')
 
@section('content')
    <div class="container__auth">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-dark">Entrar como administrador</h5>
                <p class="card-text">
                    <form class="mt-4" action="{{route('admin.doLogin')}}" method="POST">
                        @csrf

                        @include('shared.error_success_alert')

                        <div class="form-group my-3">
                            <input type="email" class="form-control" placeholder="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group" class="form-group my-3">
                            <input type="password" class="form-control" placeholder="senha" name="senha">
                        </div>

                        <div class="d-flex justify-content-end form-group my-3">
                            <button class="btn btn-primary ms-2">entrar</button>
                        </div>
                    </form>
                </p>
            </div>
        </div>
    </div>

    <a href="{{ route('welcome') }}" class="welcome__btn">Voltar para a tela inicial</a>
@endsection