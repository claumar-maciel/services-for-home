@extends('layouts.admin.panel')
 
@section('title', 'Prestadores')
 
@section('content')
    <div class="w-100 mt-4 d-flex justify-content-center align-items-center flex-wrap">
        <div class="d-flex justify-content-center w-100 mb-3">
            <form class="container__search" action="{{ route('admin.providers') }}" method="GET">
                @csrf

                <input type="text" placeholder="buscar prestador..." name="search" value="{{ $search ?? '' }}" autofocus/>
            
                <button class="container__search__btn btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        @if ($providers->count())
            @foreach ($providers as $provider)
                <div class="card m-3 p-2" style="max-width: 400px; min-width: 300px;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center">
                            <img src="{{ asset('img/man.png') }}" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{ route('admin.providers.edit', ['provider' => $provider->id]) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title">{{ $provider->nome }}</h5>
                                </a>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $provider->email }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <a href="{{ route('admin.providers.edit', ['provider' => $provider->id]) }}" class="btn btn-primary btn-sm me-2">
                            <i class="bi bi-pencil"></i> editar
                        </a>
                        
                        <form action="{{ route('admin.providers.destroy', ['provider' => $provider->id]) }}" method="post">
                            @csrf
                            @method('delete')

                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> remover</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else   
            <div class="alert alert-light mt-4">
                Nenhum prestador encontrado!  
            </div>          
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $providers->links() !!}
    </div>
@endsection