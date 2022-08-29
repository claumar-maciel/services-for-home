@extends('layouts.auth')
 
@section('title', 'administrador')
 
@section('content')
    <div class="container__auth">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-dark">Entrar como cliente</h5>
                <p class="card-text">
                    <form class="mt-4" action="{{route('client.login')}}" method="POST">
                        <div class="form-group my-3">
                            <input type="email" class="form-control" placeholder="email">
                        </div>

                        <div class="form-group" class="form-group my-3">
                            <input type="password" class="form-control" placeholder="senha">
                        </div>

                        <div class="d-flex justify-content-end form-group my-3">
                            <a class="btn btn-secondary ms-2" href="{{ route('client.create') }}">ainda não tenho cadastro</a>
                            <button class="btn btn-primary ms-2">entrar</button>
                        </div>
                    </form>
                </p>
            </div>
        </div>
    </div>
@endsection