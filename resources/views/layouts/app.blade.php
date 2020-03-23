<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161580640-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
     </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PizzaPrices</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pizzapop.png') }}"/>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Herr+Von+Muellerhoff&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.0.1/collection/components/icon/icon.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="{{ asset('js/site.js') }}" ></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top static-top">
    <div class="container">
        <a class="navbar-brand navbar-brandd" href="/home">
            <img src="{{ asset('img/pizzapop.png') }}"  alt="">
        </a>
        <a class="navbar-brand kicsimeretlogo" href="/home">
            <img src="{{ asset('img/pizzapop.png') }}"  alt="">
        </a>
        <button class="navbar-toggler navbar-togglerr" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse navbar-collapsee" id="navbarResponsive">
            <ul class="navbar-nav ml-auto text-center">
                <li class="nav-item active">
                    <a class="nav-link nav-linkk" href="/home">Kezdőlap
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-linkk" href="#">Pizzakategóriák</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-linkk" href="#">Pizza Builder</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-linkk" href="/kapcsolatok">Kapcsolatok</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</header>




        @yield('content')

        <div id="cookie-footer" class="footer">
            <div class="container">
                <p class="h6 p-2">
                    Sütiket alkalmazunk, hogy megértsük, hogyan használod az oldalt és javítsuk a felhasználói élményt.
                    <a href="#" class="btn btn-success btn-sm"  onclick="setCookiePolicyCookie()">Elfogadás</a>
                    <a href="#"  class="btn btn-primary btn-sm">Részletek</a>
                </p>
            </div>
        </div>




</body>
</html>
