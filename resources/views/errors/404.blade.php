<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PizzaPrices</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pizzapop.webp') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

<div id="error">
    <div class="error">
        <div class="error-404">
            <h1>4 <span></span> 4</h1>
        </div>
        <h2>Oops! Az oldal nem található!</h2>
        <p>Elnézést az oldal amit keres nem létezik vagy törölték vagy megváltozott a neve!</p>
        <a href="#">Vissza a Főoldalra</a>
    </div>
</div>

</body>
</html>


