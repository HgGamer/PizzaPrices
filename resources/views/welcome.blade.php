<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div class="bg-img">
    <div class="menudiv">
        <li><a href="">Szeged</a></li>
        <li><a href="">Budapest</a></li>
        <li><a href="">Debrecen</a></li>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center d-flex map align-items-center">
                <img class="mx-auto d-block" src="{{ asset('img/mo.png') }}">
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


