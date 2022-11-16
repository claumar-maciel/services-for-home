@extends('layouts.provider.panel')
 
@section('title', 'Postagens')
 
@section('content')
    <div class="w-100 mt-4 d-flex justify-content-center align-items-center flex-wrap">
        <div class="d-flex justify-content-end align-items-center flex-wrap w-100 mb-3">
            <form class="container__search" action="{{ route('provider.posts') }}" method="GET">
                @csrf

                <input type="text" placeholder="buscar postagem..." name="search" value="{{ $search ?? '' }}" autofocus/>
            
                <button class="container__search__btn btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        @if ($posts->count())
            @foreach ($posts as $post)
                <div class="card mt-2 p-4 w-100">
                    <h5 class="text-primary">
                        {{ $post->title }}
                    </h5>

                    @if ($post->banner)
                        <img src= "{{asset("storage/$post->banner") }}" alt="banner" class="my-1" style="object-fit:cover; width:100%; height:320px;">
                    @endif
                    
                    <p class="text-muted m-0">{{ $post->content }}</p>
                </div><hr>
            @endforeach
        @else   
            <div class="alert alert-light mt-4">
                Nenhum post encontrado!  
            </div>          
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $posts->links() !!}
    </div>
@endsection