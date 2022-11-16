@extends('layouts.admin.panel')
 
@section('title', 'FAQs')
 
@section('content')
    <div class="w-100 mt-4 d-flex justify-content-center align-items-center flex-wrap">
        <div class="d-flex justify-content-between align-items-center flex-wrap w-100 mb-3">
            <form class="container__search" action="{{ route('admin.faqs') }}" method="GET">
                @csrf

                <input type="text" placeholder="buscar FAQ..." name="search" value="{{ $search ?? '' }}" autofocus/>
            
                <button class="container__search__btn btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary m-2" style="min-width: 100px;">+ criar</a>
        </div>

        @if ($faqs->count())
            @foreach ($faqs as $faq)
                <div class="card mt-1 p-4 w-100">
                    <h5 class="text-primary d-flex justify-content-between align-items-center">
                        <span>{{ $faq->question }}</span>
                        
                        <div class="d-flex">
                            <form action="{{ route('admin.faqs.destroy', ['faq' => $faq->id]) }}" method="post" class="me-1">
                                @csrf
                                @method('delete')
    
                                <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> remover</button>
                            </form>

                            <a href="{{ route('admin.faqs.edit', ['faq' => $faq->id]) }}" class="btn btn-outline-dark btn-sm">Editar</a>
                        </div>
                    </h5>
                    <p class="text-muted m-0">{{ $faq->answer }}</p>
                </div><hr>
            @endforeach
        @else   
            <div class="alert alert-light mt-4">
                Nenhum FAQ encontrado!  
            </div>          
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $faqs->links() !!}
    </div>
@endsection