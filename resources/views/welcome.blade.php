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
<div class="bg-img">
    <div class="kezdologo">
        <img class="mx-auto d-block" src="{{ asset('img/2.webp') }}"  alt="">
        <h1 class="mx-auto d-block">Pizza Prices</h1>
    </div>
    <div class="kezdumenu align-items-center">
        <div class="menudiv mx-auto d-block ">
            <li><a href="/home">Szeged</a></li>
            <li><a href="">Budapest</a></li>
            <li><a href="">Debrecen</a></li>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center d-flex map align-items-center">
                <img class="mx-auto d-block" src="{{ asset('img/mo.webp') }}">
                <div class="city-select">
                    <a href="/home" class="restaurant szeged">
                        <span>Szeged</span>
                    </a>
                    <a href="" class="restaurant bp">
                        <span>Budapest HAMAROSAN</span>
                    </a>
                    <a href="" class="restaurant debrecen">
                        <span>Debrecen HAMAROSAN</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>


