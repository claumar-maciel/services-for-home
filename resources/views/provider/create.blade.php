@extends('layouts.auth')
 
@section('title', 'criar prestador')

@include('shared.jquery-input-masks')
 
@section('content')
    <div class="container__auth">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-secondary">Criar conta de prestador</h5>
                <p class="card-text">
                    <form class="container__auth__form mt-4" action="{{route('provider.register')}}" method="POST"> 
                        @csrf
                        
                        @include('shared.users.register-fields')

                        <div class="d-flex justify-content-end form-group my-3">
                            <a class="btn btn-secondary ms-2" href="{{ route('provider.login') }}">já tenho conta</a>
                            <button class="btn btn-primary ms-2">criar</button>
                        </div>
                    </form>
                </p>
            </div>
        </div>
    </div>

    <a href="{{ route('welcome') }}" class="welcome__btn">Voltar para a tela inicial</a>
@endsection