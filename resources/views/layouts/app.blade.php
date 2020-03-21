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


@if (!(\Request::is('/')))
    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.jpg')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top static-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="http://placehold.it/150x50?text=Logo" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
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
