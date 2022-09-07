@extends('layouts.admin.panel')
 
@section('title', "Editar perfil")

@include('shared.jquery-input-masks')
 
@section('content')
    <div class="w-100 mt-4">
        <form class="container__auth__form mt-4" action="{{route('admin.profile.update')}}" method="POST"> 
            @csrf
            @method('PUT')
            
            <div class="container__auth__form__fields">            
                <div class="mb-4">
                    <h5>Dados pessoais</h5>
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="nome" name="nome" value="{{auth()->user()->nome}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="email" class="form-control" placeholder="email" name="email" value="{{auth()->user()->email}}">
                    </div>
                    
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="usuário" name="username" value="{{auth()->user()->username}}">
                    </div>
            
                    <div class="form-group" class="form-group my-3">
                        <input type="password" class="form-control" placeholder="senha" name="senha">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control cpf-input" placeholder="cpf - ex: 999.999.999-99" name="cpf" value="{{auth()->user()->cpf}}">
                    </div>
                </div>
            
                <div class="mb-4">
                    <h5>Contato</h5>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control celular-input" placeholder="celular - ex: (99)99999-9999" name="celular" value="{{auth()->user()->contato->celular}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control telefone_residencial-input" placeholder="telefone residencial  - ex: (99)9999-9999" name="telefone_residencial" value="{{auth()->user()->contato->telefone_residencial}}">
                    </div>
                </div>
            
                <div class="mb-4">
                    <h5>Endereço</h5>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control cep-input" placeholder="CEP - ex: 99999-999" name="cep" value="{{auth()->user()->endereco->cep}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="rua" name="rua" value="{{auth()->user()->endereco->rua}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="numero" name="numero" value="{{auth()->user()->endereco->numero}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="bairro" name="bairro" value="{{auth()->user()->endereco->bairro}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="cidade" name="cidade" value="{{auth()->user()->endereco->cidade}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="sigla do estado - ex: RS" name="estado" value="{{auth()->user()->endereco->estado}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="ponto de referencia" name="ponto_referencia" value="{{auth()->user()->endereco->ponto_referencia}}">
                    </div>
            
                    <div class="form-group my-3">
                        <input type="text" class="form-control" placeholder="complemento - opcional" name="complemento" value="{{auth()->user()->endereco->complemento}}">
                    </div> 
                </div>
            </div>

            <div class="d-flex justify-content-end form-group my-3">
                <a class="btn btn-secondary ms-2" href="{{ route('admin.home') }}">cancelar</a>
                <button class="btn btn-primary ms-2">salvar</button>
            </div>
        </form>
    </div>
@endsection

