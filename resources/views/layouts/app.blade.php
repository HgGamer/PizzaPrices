<!DOCTYPE html>
<html lang="hu">
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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/site.js') }}" ></script>
</head>
<body class="home">


<a id="fel"></a>

<div class="feedbackform">
    <button class="feedbackBTN" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope" aria-hidden="true"></i> Visszajelzés</button>
</div>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top static-top">
    <div class="container">
        <a class="navbar-brand navbar-brandd" href="/home">
            <img src="{{ asset('img/2.png') }}"  alt="">
        </a>
        <a class="navbar-brand kicsimeretlogo" href="/home">
            <img src="{{ asset('img/2.png') }}"  alt="">
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
                    <label for="exampleFormControlTextarea1">A visszajelzés teljesen névtelen, semmilyen módon nem tudjuk visszakövetni az küldőt.</label>
                    <textarea class="form-control" id="feedbackTextArea" rows="4"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" onclick="saveFeedback();" class="btn btn-primary" id="feedback-button">Küldés</button>
            </div>
        </div>
    </div>
</div>

<div id="cookie-footer" class="footer">
    <div class="container">
        <p class="h6 p-2">
            Sütiket alkalmazunk, hogy megértsük, hogyan használod az oldalt és javítsuk a felhasználói élményt.
            <a  class="btn btn-success btn-sm"  onclick="setCookiePolicyCookie()">Elfogadás</a>
            <a href="#"  class="btn btn-primary btn-sm">Részletek</a>
        </p>
    </div>
</div>

<script>

var btn = $('#fel');

btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
});

$(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
        btn.addClass('show');
    } else {
        btn.removeClass('show');
    }
});

saveFeedback = function(){
    text = document.getElementById("feedbackTextArea").value;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/feedback',
        type: 'POST',
        data: {_token: CSRF_TOKEN, body: text},
        dataType: 'JSON',
        success: function (data) {
            document.getElementById("feedback-modal-body").innerHTML = "<h1>Köszönjük a visszajelzésed!</h1>";
            document.getElementById("feedback-button").style.display = "none";
        }
    });
}

</script>


</body>
</html>
