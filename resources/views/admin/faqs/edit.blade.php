@extends('layouts.admin.panel')
 
@section('title', "Editar FAQ")
 
@section('content')
    <form class="w-100 mt-4" action="{{route('admin.faqs.update', ['faq' => $faq->id])}}" method="POST"> 
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <div class="form-group my-3">
                <input type="text" class="form-control" placeholder="pergunta" name="question" value="{{$faq->question}}">
            </div>
    
            <div class="form-group my-3">
                <input type="text" class="form-control" placeholder="resposta" name="answer" value="{{$faq->answer}}">
            </div>
        </div>

        <div class="d-flex justify-content-end form-group my-3">
            <a class="btn btn-secondary ms-2" href="{{ route('admin.faqs') }}">cancelar</a>
            <button class="btn btn-primary ms-2">salvar</button>
        </div>
    </form>
@endsection