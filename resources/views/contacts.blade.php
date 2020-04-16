@extends('layouts.app')
@section('title')
PizzaPrices - Kapcsolatok
@endsection
@section('content')
    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.jpg')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5">
        <h2>Kapcsolatok</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kapcsolatok</li>
        </ol>
    </section>

    <div class="container">
        <h1 class="nincshteg">Kapcsolatok</h1>
        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-impressum-tab" data-toggle="tab" href="#nav-impressum" role="tab" aria-controls="nav-impressum" aria-selected="true">Impresszum</a>
                <a class="nav-item nav-link" id="nav-adatv-tab" data-toggle="tab" href="#nav-adatv" role="tab" aria-controls="nav-adatv" aria-selected="false">Adatvédelmi Nyilatkozat</a>
                <a class="nav-item nav-link" id="nav-kapcs-tab" data-toggle="tab" href="#nav-kapcs" role="tab" aria-controls="nav-kapcs" aria-selected="false">Kapcsolat</a>
            </div>
        </nav>


        <section>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane  show active" id="nav-impressum" role="tabpanel" aria-labelledby="nav-impressum-tab">
                    <div class="text-center">
                        <h2>A honlap üzemeltetőjének adatait:</h2>
                        <p>
                        Honlap: <br>
                        Üzemeltető neve : <br>
                        Üzemeltető székhelye: <br>
                        </p>
                        <br>
                        <h3>Az üzemeltető elérhetőségeit:(hétfőtől péntekig 9:00-18:00)</h3>
                        <p>
                        Címhelye<br>
                        Telefonszám: <br>
                        Email: <br>
                        Felelős személy: <br>
                        </p>
                        <h3>A weboldal tárhely szolgáltató adatait:</h3>
                        <p>
                        A szolgáltató megnevezése:<br>
                        A szolgáltató levelezési címe: <br>
                        A szolgáltató e-mail címe: <br>
                        A szolgáltató telefonszáma: <br>
                        </p>
                    </div>
                </div>

                <div class="tab-pane" id="nav-adatv" role="tabpanel" aria-labelledby="nav-adatv-tab">
                    <div class="szoveg">
                        <h2>Cookie(Süti):</h2>
                        <p>
                        A www.pizzaprices.hu weboldal cookie-kat (sütiket) használ. A cookie-k olyan adatok, amiket a honlap az Ön böngészőjének küld el azzal a céllal, hogy elmentse bizonyos beállításait, megkönnyítse a honlap használatát, és közreműködik abban, hogy néhány statisztikai információt gyűjtsön a látogatóról. Ezek önmagukban nem használhatók fel a látogató azonosítására. Ezek segítségével pontosabban feltudjuk mérni a honlap használatát pl.: a felhasználó melyik oldalakat látogatja, a leggyakrabban vagy hol kap hiba üzenetet. Az így kapott adatokat a felhasználói élmény javítására használjuk fel.
                        A honlap a Google Analytics-et használja az adatok gyűjtésére.
                        Az adatokat a Google dolgozza fel és az kész statisztikákat bocsájt a honlap készítői számára. <br>
                        <a href="https://policies.google.com/privacy?hl=hu"> Google adatvédelmi irányelvek</a> <br>
                        <a href="https://policies.google.com/terms?hl=hu"> Szolgáltatási feltételek</a>
                        </p>
                        <h3>Milyen adatok kerülnek kezelésre?</h3>
                        <p>
                        Hogy elfogadta-e a felhasználó a cookie policy-t.
                        TODO
                        </p>
                        <h3>
                        Milyen célból történik az adatok kezelése?
                        </h3>
                        <p>
                        Az sütikből kapott adatok célja a honlap látogatása során a szolgáltatások működésének ellenőrzése és statisztikák alapján a honlap felhasználói élményének javítása.
                        </p>
                        <h3>Mi a jogalapja a személyes adatai kezelésének?</h3>
                        <p>Az adatkezelés jogalapja az Ön önkéntes hozzájárulása. A Cookie sávban való elfogadom gombbal való elfogadás.</p>
                        <h3>Ki fér hozzá az adatokhoz?</h3>
                        <p>Az Ön adataihoz a Google fér hozzá. Az ebből kinyert statisztikai adatokhoz pedig a honlap tulajdonosai.</p>
                        <h3>Meddig tart a személyes adatai kezelése?</h3>
                        <p>Az adatok 14 hónapig tarolódnak a Google-nél, ezért a mi statisztikáinkban is addig szerepelnek.</p>
                        <h3>Cookie-k törlése:</h3>
                        <p>Google chrome böngésző: <a href="https://support.google.com/chrome/answer/95647?co=GENIE.Platform%3DDesktop&hl=hu"> Itt </a> <br>
                        Mozilla Firefox: <a href="https://support.mozilla.org/hu/kb/weboldalak-altal-elhelyezett-sutik-torlese-szamito"> Itt </a><br>
                        Internet explorer: <a href="https://support.microsoft.com/hu-hu/help/17442/windows-internet-explorer-delete-manage-cookies"> Itt </a></p>
                    </div>
                </div>

                <div class="tab-pane" id="nav-kapcs" role="tabpanel" aria-labelledby="nav-kapcs-tab">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center align-items-center kapcsolatok">
                            <img class="img-fluid mx-auto d-block" src="{{ asset('img/2.png') }}"  alt="logo">

                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <script>
        function urlcheck() {
            let x = location.href;
            let res = x.split("#");
            var param = res[1];

            if (typeof res[1] !== 'undefined') {

                if (param == 'adatvedelmi') {

                    $("#nav-impressum").removeClass("active");
                    $("#nav-impressum-tab").removeClass("active");
                    $("#nav-adatv").addClass("active");
                    $("#nav-adatv-tab").addClass("active");

                } else if (param == 'kapcsolatok') {

                    $("#nav-impressum").removeClass("active");
                    $("#nav-impressum-tab").removeClass("active");
                    $("#nav-kapcs").addClass("active");
                    $("#nav-kapcs-tab").addClass("active");
                }

            }

            return


        }
        document.addEventListener("DOMContentLoaded", function(event) {

            urlcheck();
        });

    </script>


@endsection
