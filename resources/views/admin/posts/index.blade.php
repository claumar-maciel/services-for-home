@extends('layouts.admin.panel')
 
@section('title', 'posts')
 
@section('content')
    <div class="w-100 mt-4 d-flex justify-content-center align-items-center flex-wrap">
        <div class="d-flex justify-content-between align-items-center flex-wrap w-100 mb-3">
            <form class="container__search" action="{{ route('admin.posts.index') }}" method="GET">
                @csrf

                <input type="text" placeholder="buscar post..." name="search" value="{{ $search ?? '' }}" autofocus/>
            
                <button class="container__search__btn btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary m-2" style="min-width: 100px;">+ criar</a>
        </div>

        @if ($posts->count())
            @foreach ($posts as $post)
                <div class="card mt-1 p-4 w-100">
                    <h5 class="text-primary d-flex justify-content-between align-items-center">
                        <span>{{ $post->title }}</span>
                        <div class="d-flex">
                            <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post" class="me-1">
                                @csrf
                                @method('delete')
    
                                <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> remover</button>
                            </form>
                            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-outline-dark btn-sm">editar</a>
                        </div>
                    </h5>
                    @if ($post->banner)
                        <img src= "{{asset("storage/$post->banner") }}" alt="banner" class="my-1" style="object-fit:contain; height:320px;">
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