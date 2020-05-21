@extends('layouts.app')
@section('title')
PizzaPrices - Főoldal
@endsection
@section('content')

    <div class="feedbackform">
        <button class="feedbackBTN" data-toggle="modal" data-target="#myModal"><i class="fa fa-envelope" aria-hidden="true"></i><span> Visszajelzés</span></button>
    </div>

    <section class="bannerr_area" data-stellar-background-ratio="0.5">
    </section>
    <div class="container">
        <h1 class="nincshteg">Pizza  Prices főoldal</h1>
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 popularpizza">
                <a href="/kategoriak/hawaii" >
                    <picture>
                        <source srcset="{{ asset('img/glry/hawaii.webp') }}" type="image/wepb">
                        <img class="object-fit_contain" src="{{ asset('img/glry/hawaii.jpg') }}" alt="background">
                    </picture>
                </a>
                <h3>Hawaii Pizzák</h3>
            </div>
            <div class="col-lg-3 col-md-6 popularpizza ">
                <a href="/kategoriak/songoku" >
                    <picture>
                        <source srcset="{{ asset('img/glry/kukoricas.webp') }}" type="image/wepb">
                        <img class="object-fit_contain" src="{{ asset('img/glry/kukoricas.jpg') }}" alt="background">
                    </picture>
                </a>
                <h3>Son-Go-Ku Pizzák</h3>
            </div>
            <div class="col-lg-3 col-md-6 popularpizza">
                <a href="/kategoriak/bolognai" >
                    <picture>
                        <source srcset="{{ asset('img/glry/bolognai.webp') }}" type="image/wepb">
                        <img class="object-fit_contain" src="{{ asset('img/glry/bolognai.jpg') }}" alt="background">
                    </picture>
                </a>
                <h3>Bolognai Pizzák</h3>
            </div>
            <div class="col-lg-3 col-md-6 popularpizza">
                <a href="/kategoriak/husimado" >
                    <picture>
                        <source srcset="{{ asset('img/glry/husimado.webp') }}" type="image/wepb">
                        <img class="object-fit_contain" src="{{ asset('img/glry/husimado.jpg') }}" alt="background">
                    </picture>
                </a>
                <h3>Húsimádó Pizzák</h3>
            </div>
        </div>

        <div class="row justify-content-around mb-5">
            <div class="col-lg-6 col-md-12 mb-5 picimeret ">
                <div class="pizzacim text-center">
                    <h2>
                        A hét Pizzája
                    </h2>
                    <div class="divider-custom">
                        <div class="divider-custom-line"></div>
                        <div class="divider-custom-icon">
                            <i class="fas fa-pizza-slice"></i>
                        </div>
                        <div class="divider-custom-line"></div>
                    </div>
                </div>
                <div class="card carda middle">
                    <div class="front d-flex">
                        <picture>
                            <source srcset="{{ asset('img/poppizza.webp') }}" type="image/wepb">
                            <img class="object-fit_contain" src="{{ asset('img/poppizza.jpg') }}" alt="background">
                        </picture>
                        <div class="pizzacardname text-center align-self-end p-2">
                            <h3>
                                Húsimádó Pizza
                            </h3>
                        </div>
                    </div>
                    <div class="back">
                        <div class="back-content">
                            <div class="cardinfo">
                                <h3>Húsimádó Pizza</h3>
                                <br><br>
                                <span>Kerekerdő Pizzéria</span>
                                <h3 style="text-decoration: underline"><a href="">kerekerdopizzeria.hu</a></h3>
                                <div class="cardinfohozzavalo">
                                    <h4>Hozzávalók:</h4>
                                    <p>paradicsomos alap, sajt, húshegyek, kukorica</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 mb-5">
                <div class="pizzacim text-center">
                    <h2>
                        A hónap Pizzája
                    </h2>
                    <div class="divider-custom">
                        <div class="divider-custom-linee"></div>
                        <div class="divider-custom-icon">
                            <i class="fas fa-pizza-slice"></i>
                        </div>
                        <div class="divider-custom-linee"></div>
                    </div>
                </div>
                <div class="card carda middle">
                    <div class="front d-flex">
                        <picture>
                            <source srcset="{{ asset('img/poppizza.webp') }}" type="image/wepb">
                            <img class="object-fit_contain" src="{{ asset('img/poppizza.jpg') }}" alt="background">
                        </picture>
                        <div class="pizzacardname text-center align-self-end p-1">
                            <h3>
                                Húsimádó Pizza
                            </h3>
                        </div>
                    </div>
                    <div class="back">
                        <div class="back-content">
                            <div class="cardinfo">
                                <h3>Húsimádó Pizza</h3>
                                <br><br>
                                <span>Kerekerdő Pizzéria</span>
                                <h3 style="text-decoration: underline"><a href="">kerekerdopizzeria.hu</a></h3>
                                <div class="cardinfohozzavalo">
                                    <h4>Hozzávalók:</h4>
                                    <p>paradicsomos alap, sajt, húshegyek, kukorica</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pizzacim text-center mt-5 mb-5">
            <h2>
                Pizza Feed
            </h2>
            <div class="divider-custom">
                <div class="divider-custom-linee"></div>
                <div class="divider-custom-icon">
                    <i class="fas fa-pizza-slice"></i>
                </div>
                <div class="divider-custom-linee"></div>
            </div>
        </div>

        <div id="feed-wrap" class="pizzafeed">
        <div class="row feed-list pizzafeed" id="feed-list">
            @php
            $i=0;
            $isYellow = true;
            $counter = 1;
            @endphp
                @foreach ($pizzas as $pizza)
                 <div class="col-lg-6 col-md-12 mb-5 feed-tile" id="feed-tile-{{$i}}">
                    <div class="ft-recipe">
                        <div class="ft-recipe__thumb{{ ($isYellow) ? "m" : ""}} text-center d-flex  align-items-center justify-content-center">
                            <picture>
                                <source class="mx-auto d-block feed-tile-img" srcset="{{asset('img/pizzapop.webp')}}" type="image/webp" alt="pizza">
                                <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                            </picture>
                        </div>
                        <div class="ft-recipe__content ">
                            <header class="content__header">
                                <div class="row-wrapper text-center">
                                    <h3 class="recipe-title feed-tile-name text-center">{{$pizza['pizzaAlias']['name']}}</h3>
                                </div>
                                <ul class="recipe-details">
                                    <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">{{ $pizza['price'] }}</span><span class="title">Ár(HUF)</span></li>
                                    <li class="recipe-details-item time"><i class="fas fa-ruler-horizontal"></i></i><span class="value">{{$pizza['pizzasize']}}</span><span class="title">Méret(cm)</span></li>
                                </ul>
                            </header>
                        <h4 class="text-center font-weight-bold"> <a href="{{ ($pizza['url'] != "") ? $pizza['url'] : $pizza['website']['url'] }}">{{ $pizza['website']['title']  }}</a> </h4>
                            <h4>Feltétek:</h4>
                            <p class="description">
                                @foreach ($pizza['pizzaAlias']['recept'] as $key => $recept)
                                    {{ $recept }}@if ($key != count($pizza['pizzaAlias']['recept'])-1), @endif
                                @endforeach
                            </p>
                            <footer class="content__footer{{ ($isYellow) ? "m" : ""}} align-self-end "><a href="{{ ($pizza['url'] != "") ? $pizza['url'] : $pizza['website']['url'] }}" target="_blank">Részletek</a></footer>
                        </div>
                    </div>
                </div>

             @php
                $i++;
                $counter++;
                if ($counter == 2) {
                    $isYellow = !$isYellow;
                    $counter = 0;
                }
            @endphp
            @endforeach
            </div>
        </div>
        <h3 id="feed-loader" class="text-center" style="font-size: 100px;"><i class="spinner-border"></i></h3>

    </div>
    <script>
        $(window).scroll(function () {
            $('nav').toggleClass('scrolled',$(this).scrollTop()>660)
        });
        document.addEventListener("DOMContentLoaded", function(event) {
            getUrl("{{ url("/") }}")
            start({{ $paginatedBy }} , @json($pizzas));
        });





    </script>
@endsection
