<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="revisit-after" content="1 days">
    <meta name="description" content="Böngéssze és hasonlítsa össze helyi pizzériák több száz ajánlatát.">
    <meta name="keywords" content="pizza, keresés, kereső, pizzaprices, ár, összehasonlítás">
    <meta name="robots" content="index,follow">
    <title>PizzaPrices</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96.png') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @if  (env('APP_DEBUG') == false)
    <script>
         let isProd = true;
         let isWelcomePage = true;
    </script>
    @else
    <script>
        let isProd = false;
        let isWelcomePage = true;
    </script>
    @endif

</head>

<body>
<div class="bg-img">

    <div class="kezdologo">
        <picture>
            <source srcset="{{ asset('img/2.webp') }}" type="image/wepb">
            <img class="mx-auto d-block" src="{{ asset('img/2.png') }}"  alt="logo"/>
        </picture>
        <h1 class="mx-auto d-block">Pizza Prices</h1>
    </div>
    <div class="kezdumenu align-items-center">
        <div class="menudiv mx-auto d-block ">
            <a href="/home"><li>Szeged</li></a>
            <a disabled="" data-toggle="tooltip" data-placement="top" title="Hamarosan!"><li class="masodikvaros">Budapest</li></a>
            <a disabled="" data-toggle="tooltip" data-placement="top" title="Hamarosan!"><li>Debrecen</li></a>
        </div>
    </div>
    <button type="button" onclick="toggleInformationDiv()" class="btn btn-info infobutton">!</button>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center d-flex map align-items-center">
                <picture>
                    <source srcset="{{ asset('img/mo.png') }}" type="image/png">
                    <img class="mx-auto d-block" src="{{ asset('img/mo.webp') }}" alt="magyarország" />
                </picture>
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
        <div class="card" id="alsokartya">
            <div style="padding-right: 5px">
                <button onclick="toggleInformationDiv()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
            <p class="card-text">A pizza adataiban a valóságtól való eltéresekért az oldal készítői nem vállalnak felelősséget. A képek csak illusztrációk. Az oldal nem szállít pizzát csak összehasonlítja különböző pizzériák kínálatát.</p>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/site.js') }}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script>
    function toggleInformationDiv() {
        var x = document.getElementById("alsokartya");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
</body>
</html>


