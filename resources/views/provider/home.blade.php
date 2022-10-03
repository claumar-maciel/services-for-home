@extends('layouts.provider.panel')
 
@section('title', 'Bem-vindo')
 
@section('content')
    <div class="w-100 mt-4">
        <p>Olá <b>{{ auth()->user()->nome }}</b>, você está cadastrado como um prestador de serviços!</p>

        <div class="w-100 d-flex justify-content-center">
            <form action="{{ route('provider.geolocation.store') }}" method="POST" id="geolocation-form">
                @csrf
                
                <input type="hidden" name="latitude" id="geolocation-lat-input">
                <input type="hidden" name="longitude" id="geolocation-long-input">
            </form>

            @if (!auth()->user()->endereco->latitude || !auth()->user()->endereco->longitude)
                <a href="javascript:getLocation()" class="btn btn-outline-dark d-flex align-items-center flex-column my-3" style="max-width: 320px;">
                    <i class="bi bi-geo-fill text-danger" style="font-size: 40px;"></i>
                    <b>atualizar geolocalização para que seus clientes lhe encontrem com mais facilidade</b>
                </a>
            @endif
        </div>
    </div>

    <hr>    
    
    <div class="w-100 mt-2">
        <h5 class="card-title">Chats</h5>

        <div class="px-2">
            @include('shared.chat-list')
        </div>
    </div>
@endsection

@section('footerScripts2')
    <script src="{{ asset('resources/js/geolocation.js') }}" defer></script>
@endsection
