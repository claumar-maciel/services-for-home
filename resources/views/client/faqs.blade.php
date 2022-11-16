@extends('layouts.client.panel')
 
@section('title', 'Perguntas frequentes')
 
@section('content')
    <div class="w-100 mt-4 d-flex justify-content-center align-items-center flex-wrap">
        <div class="d-flex justify-content-end align-items-center flex-wrap w-100 mb-3">
            <form class="container__search" action="{{ route('client.faqs') }}" method="GET">
                @csrf

                <input type="text" placeholder="buscar pergunta..." name="search" value="{{ $search ?? '' }}" autofocus/>
            
                <button class="container__search__btn btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        @if ($faqs->count())
            @foreach ($faqs as $faq)
                <div class="card mt-1 p-4 w-100">
                    <h5 class="text-primary d-flex justify-content-between align-items-center">
                        <span>{{ $faq->question }}</span>
                    </h5>
                    <p class="text-muted m-0">{{ $faq->answer }}</p>
                </div><hr>
            @endforeach
        @else   
            <div class="alert alert-light mt-4">
                Nenhum pergunta relacionada!  
            </div>          
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $faqs->links() !!}
    </div>
@endsection