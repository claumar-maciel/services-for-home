@extends('layouts.admin.panel')
 
@section('title', "Editar $provider->nome")

@include('shared.jquery-input-masks')
 
@section('content')
    <div class="w-100 mt-4">
        <form class="container__auth__form mt-4" action="{{route('admin.providers.update', ['provider' => $provider->id])}}" method="POST"> 
            @csrf
            @method('PUT')
            
            <div class="container__auth__form__fields">            
                <div class="mb-4">
                    <h5>Dados pessoais</h5>
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="nome" name="nome" value="{{$provider->nome}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="email" class="form-control" placeholder="email" name="email" value="{{$provider->email}}">
                    </div>
                    
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="usuário" name="username" value="{{$provider->username}}">
                    </div>
            
                    <div class="form-group" class="form-group my-3">
                        <input type="password" class="form-control" placeholder="senha" name="senha">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control cpf-input" placeholder="cpf - ex: 999.999.999-99" name="cpf" value="{{$provider->cpf}}">
                    </div>
                </div>
            
                <div class="mb-4">
                    <h5>Contato</h5>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control celular-input" placeholder="celular - ex: (99)99999-9999" name="celular" value="{{$provider->contato->celular}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control telefone_residencial-input" placeholder="telefone residencial  - ex: (99)9999-9999" name="telefone_residencial" value="{{$provider->contato->telefone_residencial}}">
                    </div>
                </div>
            
                <div class="mb-4">
                    <h5>Endereço</h5>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control cep-input" placeholder="CEP - ex: 99999-999" name="cep" value="{{$provider->endereco->cep}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="rua" name="rua" value="{{$provider->endereco->rua}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="numero" name="numero" value="{{$provider->endereco->numero}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="bairro" name="bairro" value="{{$provider->endereco->bairro}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="cidade" name="cidade" value="{{$provider->endereco->cidade}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="sigla do estado - ex: RS" name="estado" value="{{$provider->endereco->estado}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="ponto de referencia" name="ponto_referencia" value="{{$provider->endereco->ponto_referencia}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="complemento - opcional" name="complemento" value="{{$provider->endereco->complemento}}">
                    </div> 
                </div>
            </div>

            <div class="d-flex justify-content-end form-group my-3">
                <a class="btn btn-secondary ms-2" href="{{ route('admin.providers') }}">cancelar</a>
                <button class="btn btn-primary ms-2">salvar</button>
            </div>
        </form>
    </div>
@endsection