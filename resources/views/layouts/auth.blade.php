<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ env('APP_NAME' )}}</title>

    @vite([
        'resources/css/app.css',
        'resources/scss/app.scss',
        'resources/js/app.js'
    ])
</head>
<body>
    <div class="content">
        @yield('content')
    </div>


    <div class="area" >
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div >
</body>
</html>