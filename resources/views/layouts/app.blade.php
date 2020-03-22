<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PizzaPrices</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Herr+Von+Muellerhoff&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>


@if (!(\Request::is('/')))
    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.jpg')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top static-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/pizzapop.png') }}"  alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Kezdőlap
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pizzakategóriák</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pizza Builder</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kapcsolatok</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
@endif



        @yield('content')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(window).scroll(function () {
            $('nav').toggleClass('scrolled',$(this).scrollTop()>660)
        });
    </script>
</body>
</html>
