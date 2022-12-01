@extends('layouts.provider.panel')
 
@section('title', 'Serviços')
 
@section('content')
    <div class="d-flex justify-content-end w-100 mb-3">
        <form class="container__search" action="{{ route('provider.services') }}" method="GET">
            @csrf

            <input type="text" placeholder="buscar serviço..." name="search" value="{{ $search ?? '' }}" autofocus/>
        
            <button class="container__search__btn btn">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <hr>

    <form action="{{ route('provider.services.store') }}" method="POST">
        @csrf

        <div class="d-flex justify-content-around my-5 flex-wrap">
            <div>
                <h6>Todos serviços</h6>
        
                @if ($services->count())
                    <div class="mt-3">
                        @foreach ($services as $service)
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->id }}">
                                <label class="form-check-label" for="flexSwitchCheckDefault">{{ $service->description }}</label>
                            </div>
                        @endforeach
                    </div>
                @else   
                    <div class="text-center">
                        Nenhum serviço disponível
                    </div>
                @endif
            </div>
            
            <div>
                <h6>Seus serviços</h6>
                
                @if ($currentServices->count())
                <div class="mt-3">
                    @foreach ($currentServices as $service)
                        <p class="m-1">{{ $service->description }}</p>
                    @endforeach
                </div>
                @else   
                <div class="text-center alert">
                    Você ainda não adicionou nenhum serviço
                </div>
                @endif
            </div>
        </div>

        <hr>

        <div class="w-100 d-flex justify-content-center align-items-center">
            <input type="submit" name="submit_button" class="btn btn-danger m-2" value="remover" />
            <input type="submit" name="submit_button" class="btn btn-primary m-2" value="adicionar" />
        </div>
    </form>
@endsection