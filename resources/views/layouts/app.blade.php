<!DOCTYPE html>
<html lang="hu">
<head>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161580640-1" rel=preconnect></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
     </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="revisit-after" content="1 days">
    <meta name="description" content="Böngéssze és hasonlítsa össze helyi pizzériák több száz ajánlatát.">
    <meta name="keywords" content="pizza, keresés, kereső, pizzaprices, pizza prices, ár, összehasonlítás, price, szeged">
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if  (env('APP_DEBUG') == false)
        <title>@yield('title')</title>
        <script>console.log = ()=>{}</script>
    @else
    <title>DEBUG:: @yield('title')</title>
    @endif
    <link rel="icon" type="image/png" href="{{ asset('img/favicon-96.png') }}"/>
    <link rel="shortcut icon" href="{{ asset('img/favicon-96.png') }}">

    <!-- Styles-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" media="print" onload="this.media='all'" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <noscript><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"></noscript>

    @if  (env('APP_DEBUG') == false)
    <script>
        let isProd = true;
        let rmsw = false;
        let isWelcomePage = false;
    </script>
    @else
    <script>
        let isProd = false;
        let rmsw = false;
        let isWelcomePage = false;
   </script>
    @endif
    <script src="{{ asset('js/site.js') }}" ></script>
</head>
<body class="home">


<a id="fel"></a>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top static-top">
    <div class="container">
        <a class="navbar-brand navbar-brandd" href="/home">
            <picture>
                <source  srcset="{{ asset('img/2.webp') }}" type="image/webp" alt="logo">
                <img  src="{{ asset('img/2.png') }}" alt="pizza"/>
            </picture>
        </a>
        <a class="navbar-brand kicsimeretlogo" href="/home">
            <picture>
                <source  srcset="{{ asset('img/2.webp') }}" type="image/webp" alt="logo">
                <img  src="{{ asset('img/2.png') }}" alt="pizza"/>
            </picture>
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
                    <a class="nav-link nav-linkk" href="/kategoriak">Pizzakategóriák</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-linkk" href="/pizzapicker">Pizza Picker</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-linkk" href="/pizzafilter">Pizza Szűrő</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-linkk" href="/kapcsolatok#kapcsolatok">Kapcsolatok</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</header>

    @yield('content')

<div class="modal fade bd-example-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nagyra értékeljük a véleményed az oldalról! </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="feedback-modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">A visszajelzés teljesen névtelen, semmilyen módon nem tudjuk visszakövetni a küldőt.</label>
                    <textarea class="form-control" id="feedbackTextArea" rows="4"></textarea>
                    <input type="hidden" name="recaptcha" id="recaptcha">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" onclick="saveFeedback();" class="btn btn-primary" id="feedback-button">Küldés</button>
            </div>
        </div>
    </div>
</div>


<div id="social-icon-bar" class="d-flex icon-bar">
    <div class="social-buttons">
        <a href="https://www.facebook.com/PizzaPrices-103277054748469/" rel="noopener" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/pizzaprices/" rel="noopener" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
        <a data-toggle="modal" href="#myModal" class="feedback"><i class="fas fa-comments"></i></a>
    </div>
    <div class="d-flex align-items-center">
        <span id="social-toggle-button-id" class="social-toggle-button"><i class="fas fa-chevron-right"></i></span>
    </div>
  </div>

@if (env('APP_DEBUG') == false)

<div id="cookie-footer" class="footer">
    <div class="container">
        <p class="h6 p-2">
            Sütiket alkalmazunk, hogy megértsük, hogyan használod az oldalt, és javítsuk a felhasználói élményt. <span class=".d-block .d-md-none d-lg-none d-xl-none"> Az oldal a Google és a reCAPTCHA által védett.</span> <br class=".d-block .d-md-none">
            <a  class="btn btn-success btn-sm"  onclick="setCookiePolicyCookie()">Elfogadás</a>
            <a href="/kapcsolatok#adatvedelmi"  class="btn btn-primary btn-sm">Részletek</a>
        </p>
    </div>
</div>

@endif

<script>

var btn = $('#fel');

btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
});

saveFeedback = function(){
    document.getElementById("feedback-button").disabled = true;
    text = document.getElementById("feedbackTextArea").value;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var recaptchaData = document.getElementById('recaptcha').value;
    $.ajax({
        url: '/feedback',
        type: 'POST',
        data: {_token: CSRF_TOKEN, body: text, recaptcha: recaptchaData},
        dataType: 'JSON',
        success: function (data) {
            document.getElementById("feedback-modal-body").innerHTML = "<h3>Köszönjük a visszajelzésed!</h3>";
            document.getElementById("feedback-button").style.display = "none";
        }
    });
}

</script>

<script src="https://www.google.com/recaptcha/api.js?onload=recaptchaCallback&render={{env('G_RECAPTCHA_SITE_KEY')}}" async defer></script>
<script>
    recaptchaCallback = function(){
        try{
            grecaptcha.execute('{{env('G_RECAPTCHA_SITE_KEY')}}', {action: 'feedback'}).then(function(token) {
            if (token) {
                document.getElementById('recaptcha').value = token;
            }
            });
        }catch(e){

        }


    }

</script>


</body>
</html>
