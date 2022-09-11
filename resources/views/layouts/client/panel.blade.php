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
</head>
<body class="panel_layout">
    <div class="content">
        <div class="d-flex justify-content-between align-items-center flex-column h-100 w-100">
            <nav class="navbar navbar-light bg-light w-100 shadow p-3 mb-5 bg-body rounded">
                <div class="container-fluid d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center">
                        <a class="navbar-brand" href="{{ route('client.home') }}">
                            <img src="{{ asset('img/logo.png') }}" width="60px">
                        </a>
    
                        <a class="btn me-2" href="{{ route('client.providers') }}">prestadores</a>
                    </div>
    
                    <div class="d-flex">
                        <a class="btn btn-light" href="{{ route('client.chats.index') }}">
                            <i class="bi bi-chat" style="font-size: 32px;"></i>
                        </a>

                        <div class="dropdown">
                            <button data-bs-toggle="dropdown" class="btn btn-light">
                                <i class="bi bi-person-circle" style="font-size: 32px;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('client.profile') }}">
                                        <i class="bi bi-person-fill"></i> perfil
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('client.logout') }}" method="post">
                                        @csrf
                            
                                        <button class="dropdown-item">
                                            <i class="bi bi-door-open"></i> sair
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

                <div class="card w-100">
                    <div class="card-body py-4 px-3">
                        <h5 class="card-title">@yield('title')</h5>

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('footerScripts')
</body>
</html>