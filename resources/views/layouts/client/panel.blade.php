<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png"/>
    <title>@yield('title') - {{ env('APP_NAME' )}}</title>

    @vite([
        'resources/css/app.css',
        'resources/scss/app.scss',
        'resources/scss/panel.scss',
        'resources/js/app.js'
    ])

    @yield('headScripts')
    @livewireStyles
</head>
<body class="panel_layout">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center flex-column h-100 w-100">
            <nav class="navbar navbar-dark bg-dark w-100 shadow p-3 mb-5">
                <div class="container-fluid d-flex justify-content-between container-xxl">
                    <div class="container__nav__buttons">
                        <a class="navbar-brand container__nav__buttons__logo" href="{{ route('client.home') }}">
                            <img src="{{ asset('img/logo.png') }}" width="60px">
                        </a>
    
                        <div class="container__nav__buttons__links">
                            <a class="btn btn-outline-primary me-2" href="{{ route('client.providers') }}">Prestadores</a>
                            <a class="btn btn-outline-primary me-2" href="{{ route('client.schedulings.index') }}">Agendamentos</a>
                        </div>
                    </div>
    
                    <div class="container__nav__profile">
                        <a class="btn btn-outline-primary me-2" href="{{ route('client.chats.index') }}">
                            <i class="bi bi-chat" style="font-size: 32px;"></i>
                        </a>

                        <div class="dropdown">
                            <button data-bs-toggle="dropdown" class="btn btn-outline-primary">
                                <i class="bi bi-person-circle" style="font-size: 32px;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('client.profile') }}">
                                        <i class="bi bi-person-fill"></i> Perfil
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('client.logout') }}" method="post">
                                        @csrf
                            
                                        <button class="dropdown-item">
                                            <i class="bi bi-door-open"></i> Sair
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
    
            <div class="container-xxl pb-5">
                @include('shared.error_success_alert')
                
                <div class="card w-100 d-flex justify-content-center align-items-center p-4 mb-3">
                    <i class="bi bi-newspaper" style="font-size: 48px;"></i>
                    <h5>Divulgue a sua empresa aqui!</h5>
                </div>

                <div class="card w-100">
                    <div class="card-body py-4 px-3">
                        <h5 class="card-title">@yield('title')</h5>

                        @yield('content')
                    </div>
                </div>
            </div>

            <a href="{{ route('client.help-center') }}" class="btn btn-outline-dark mb-5"><i class="bi bi-question-circle"></i> Ajuda</a>
        </div>
    </div>

    @yield('footerScripts')
    @yield('footerScripts2')
    @livewireScripts
</body>
</html>