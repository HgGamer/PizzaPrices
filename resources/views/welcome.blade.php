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
        <img class="mx-auto d-block" src="{{ asset('img/2.webp') }}"  alt="logo">
        <h1 class="mx-auto d-block">Pizza Prices</h1>
    </div>
    <div class="kezdumenu align-items-center">
        <div class="menudiv mx-auto d-block ">
            <li><a href="/home">Szeged</a></li>
            <li><a disabled="" data-toggle="tooltip" data-placement="top" title="Hamarosan!">Budapest</a></li>
            <li><a disabled="" data-toggle="tooltip" data-placement="top" title="Hamarosan!">Debrecen</a></li>
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
                    <a class="restaurant bp">
                        <span>Budapest HAMAROSAN</span>
                    </a>
                    <a class="restaurant debrecen">
                        <span>Debrecen HAMAROSAN</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-bottom">
        <div class="card" style="width: 80%;left:10%">
            <div class="card-body">
            <p class="card-text">A pizza adataiban a valóságtól való eltéresekért az oldal készítői nem vállalnak felelősséget. A képek csak illusztrációk. Az oldal nem szállít pizzát csak összehasonlítja különböző pizzériák kinálatát.</p>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>


