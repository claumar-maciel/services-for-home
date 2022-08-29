@extends('layouts.auth')
 
@section('title', 'bem-vindo')
 
@section('content')
    <nav>
        <div class="container__nav__btn d-flex justify-content-center align-items-center flex-column">
            <a href="{{ route('provider.login') }}">sou prestador</a>

            <div class="mt-2 text-white">
                <i class="bi bi-wrench-adjustable-circle"></i> instalações e manutenções
            </div>

            <div class="mt-2 text-white">
                <i class="bi bi-truck"></i> mudanças
            </div>

            <div class="mt-2 text-white">
                <i class="bi bi-pc-display-horizontal"></i> serviços de informática
            </div>
        </div>

        <div class="container__nav__btn d-flex justify-content-center align-items-center flex-column">
            <a href="{{ route('client.login') }}">sou cliente</a>

            <div class="mt-2 text-white">
                <i class="bi bi-pin-map-fill"></i> preciso de um serviço
            </div>
        </div>
        
        <div class="container__nav__btn d-flex justify-content-center align-items-center flex-column">
            <a class="nav__btn__sm" href="{{ route('admin.login') }}">sou administrador</a>
        </div>
    </nav>

    <h1 class="text-white">Mão na Roda</h1>

    <footer class="text-white">a melhor plataforma para encontrar profissionais</footer>
@endsection