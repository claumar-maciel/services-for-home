@extends('layouts.admin.panel')
 
@section('title', "Editar serviço")
 
@section('content')
    <div class="w-100 mt-4">
        <form class="container__auth__form mt-4" action="{{route('admin.services.update', ['service' => $service->id])}}" method="POST"> 
            @csrf
            @method('PUT')
            
            <div class="container__auth__form__fields">            
                <textarea type="text" class="form-control" placeholder="descrição" name="description">{{$service->description}}</textarea> 
            </div>

            <div class="d-flex justify-content-end form-group my-3">
                <a class="btn btn-secondary ms-2" href="{{ route('admin.services') }}">cancelar</a>
                <button class="btn btn-primary ms-2">salvar</button>
            </div>
        </form>
    </div>
@endsection