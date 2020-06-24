<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Controle de séries</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
    <a class="navbar navbar-expand-lg" href="{{ route('lista_series') }}">Home</a>
    @auth
        <a href="/sair" class="text-danger">Sair</a>
    @endauth
    @guest
        <a href="/entrar" class="text ">Entrar</a>
    @endguest
</nav>
<div class="container">
    <div class="jumbotron">
        <h1>@yield('cabecalho')</h1>
    </div>
    @yield('conteudo')
</div>
</body>
</html>
