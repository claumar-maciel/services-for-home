@extends('layouts.admin.panel')
 
@section('title', "Criar FAQ")
 
@section('content')
    <form class="w-100 mt-4" action="{{route('admin.faqs.store')}}" method="POST"> 
        @csrf
        
        <div class="mb-4">
            <div class="form-group my-3">
                <label>Pergunta</label>
                <input type="text" class="form-control" placeholder="pergunta" name="question">
            </div>
    
            <div class="form-group my-3">
                <label>Resposta</label>
                <input type="text" class="form-control" placeholder="resposta" name="answer">
            </div>
        </div>

        <div class="d-flex justify-content-end form-group my-3">
            <a class="btn btn-secondary ms-2" href="{{ route('admin.faqs') }}">cancelar</a>
            <button class="btn btn-primary ms-2">criar</button>
        </div>
    </form>
@endsection