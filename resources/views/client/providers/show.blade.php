@extends('layouts.client.panel')
 
@section('title', $provider->nome)
 
@section('content')
    <div class="container d-flex justify-content-center align-items-center">
        <img src="{{ asset('img/man.png') }}" class="img-fluid rounded" width="200px">
    </div>

    <span class="text-muted"> <b>E-mail: </b>{{ $provider->email }}</span> <br>
    <span class="text-muted"> <b>Celular: </b>{{ $provider->contato->celular ?? '-' }}</span>

    <div class="card p-2 mt-4">
        <h6>Serviços prestados</h6>

        <div class="d-flex justify-content-center flex-wrap">
            @if ($provider->services->count())
                @foreach ($provider->services as $service)
                    <span class="card px-3 py-2 m-1">{{$service->description}}</span>        
                @endforeach
            @else
                <div class="text-muted py-2">O prestador ainda não informou nenhum serviço prestado!</div>
            @endif
        </div>
    </div>

    <div class="card p-2 mt-4">
        <h6>Avaliações:</h6>
        <div class="text-muted">
            @if ($rating_qtd)
                <b>Média de {{ $rating_qtd }} avaliações:</b> <span class="text-primary">&#9733;</span>{{ intval($rating) }} <br>
            @else
                O prestador ainda não recebeu nenhuma avaliação! <span class="text-primary">&#9733;</span> <br>
            @endif
            
            <div class="mt-2">
                <b>Galeria de imagens:</b>
                <div class="d-flex justify-content-center align-items-center flex-wrap">
                    @if ($scheduling_images->count())     
                        @foreach ($scheduling_images as $schedulingImage)
                            <img src= "{{asset("storage/$schedulingImage->url") }}" alt="imagem" width="320px" class="img-fluid rounded m-2">
                        @endforeach
                    @else
                        <div class="text-center py-2">Ainda não temos nenhuma foto do serviço desse prestador!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection