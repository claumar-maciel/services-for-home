@extends('layouts.client.panel')
 
@section('title', 'Prestadores')
 
@section('content')
    <div class="w-100 mt-4 d-flex justify-content-center align-items-stretch flex-wrap">
        <div class="d-flex justify-content-center w-100 mb-3">
            <form class="container__search" action="{{ route('client.providers') }}" method="GET">
                @csrf

                <input type="text" placeholder="buscar serviço..." name="search" value="{{ $search ?? '' }}" autofocus/>
            
                <button class="container__search__btn btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <form action="{{ route('client.geolocation.store') }}" method="POST" id="geolocation-form">
                @csrf
                
                <input type="hidden" name="latitude" id="geolocation-lat-input">
                <input type="hidden" name="longitude" id="geolocation-long-input">
            </form>

            @if (!auth()->user()->endereco->latitude || !auth()->user()->endereco->longitude)
                <a href="javascript:getLocation()" class="btn btn-outline-dark d-flex align-items-center flex-column my-3" style="max-width: 320px;">
                    <i class="bi bi-geo-fill text-danger" style="font-size: 40px;"></i>
                    <b>você ainda não adicionou a sua geolocalização, clique aqui para adicionar!</b>
                </a>
            @endif
        </div>


        @if ($providers->count())
            @foreach ($providers as $provider)
                <div class="card m-3 p-2 d-flex flex-column justify-content-center" style="max-width: 400px; min-width: 300px;">
                    <div class="row g-0 d-flex align-items-center">
                        <div class="col-md-4 d-flex align-items-center">
                            <img src="{{ asset('img/man.png') }}" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{ route('client.providers.show', ['providerId' => $provider->id]) }}" class="text-decoration-none text-dark">
                                    <h5 class="card-title">{{ $provider->nome }}</h5>
                                </a>

                                <h6 class="card-subtitle mb-2 text-muted">{{ $provider->email }}</h6>
                            </div>
                        </div>
                    </div>

                    @if ($provider->services->count())
                        <div class="card p-2 my-2">
                            <h6>Serviços prestados</h6>

                            <div class="d-flex justify-content-center flex-wrap">
                                @foreach ($provider->services as $service)
                                    <span class="btn btn-sm btn-primary m-1">{{$service->description}}</span>        
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="w-100 d-flex justify-content-end align-items-center mt-3">
                        @if (isset($provider->distancia))
                            <span class="card-subtitle me-4 text-muted w-100"><b>Distância: </b> {{ round($provider->distancia, 2) }}km</span>
                        @endif
                        <a href="{{ route('client.chats.store', ['provider' => $provider->id]) }}" class="btn btn-primary btn-sm me-2 w-100">
                            <i class="bi bi-chat"></i> abrir chat
                        </a>
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

@section('footerScripts')
    <script src="{{ asset('resources/js/geolocation.js') }}" defer></script>
@endsection