<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mão na Roda</title>

    @vite(['resources/scss/app.scss'])
</head>
<body>
    <div class="content">
        <nav>
            <a href="{{ route('provider.home') }}">sou prestador</a>
            <a href="{{ route('admin.home') }}">sou administrador</a>
            <a href="{{ route('client.home') }}">sou cliente</a>
        </nav>

        <h1>Mão na Roda</h1>

        <footer>a melhor plataforma para encontrar profissionais</footer>
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