@extends('layouts.admin.panel')
 
@section('title', 'serviços')
 
@section('content')
    <div class="w-100 mt-4 d-flex justify-content-center align-items-center flex-wrap">
        <div class="d-flex justify-content-between align-items-center w-100 mb-3">
            <form class="container__search" action="{{ route('admin.services') }}" method="GET">
                @csrf

                <input type="text" placeholder="buscar serviço..." name="search" value="{{ $search ?? '' }}" autofocus/>
            
                <button class="container__search__btn btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <a class="btn btn-outline-primary me-2" href="{{ route('admin.services.create') }}">+ adicionar serviço</a> 
        </div>
        
        @if ($services->count())
            @foreach ($services as $service)
                <div class="card p-3 mt-2" style="width: 100%">
                    <a href="{{ route('admin.services.edit', ['service' => $service->id]) }}" class="text-decoration-none text-dark">
                        <b>{{ $service->description }}</b>
                    </a>

                    <div class="w-100 d-flex justify-content-end">
                        <a href="{{ route('admin.services.edit', ['service' => $service->id]) }}" class="btn btn-primary btn-sm me-2">
                            <i class="bi bi-pencil"></i> editar
                        </a>
                        
                        <form action="{{ route('admin.services.destroy', ['service' => $service->id]) }}" method="post">
                            @csrf
                            @method('delete')

                            <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> remover</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else   
            <div class="alert alert-light mt-4">
                Nenhum serviço encontrado!  
            </div>          
        @endif
    </div>

    <div class="d-flex justify-content-center mt-4">
        {!! $services->links() !!}
    </div>
@endsection