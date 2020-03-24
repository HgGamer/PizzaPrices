@extends('layouts.app')
@section('content')

    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.jpg')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5"></section>
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 popularpizza">
                <a href=""><img class="img-fluid" src="{{ asset('img/1.jpg') }}"></a>
                <h2>Hawai Pizzák</h2>
            </div>
            <div class="col-lg-3 col-md-6 popularpizza">
                <a href=""><img class="img-fluid" src="{{ asset('img/1.jpg') }}"></a>
                <h2>Son-Go-Ku Pizzák</h2>
            </div>
            <div class="col-lg-3 col-md-6 popularpizza">
                <a href=""><img class="img-fluid" src="{{ asset('img/1.jpg') }}"></a>
                <h2>Bolognai Pizzák</h2>
            </div>
            <div class="col-lg-3 col-md-6 popularpizza">
                <a href=""><img class="img-fluid" src="{{ asset('img/1.jpg') }}"></a>
                <h2>Húsimádó Pizzák</h2>
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
                        <div class="pizzacardname text-center align-self-end p-2">
                            <h2>
                                Húsimádó Pizza
                            </h2>
                        </div>
                    </div>
                    <div class="back">
                        <div class="back-content">
                            <div class="cardinfo">
                                <h2>Húsimádó Pizza</h2>
                                <br><br>
                                <span>Kerekerdő Pizzéria</span>
                                <h3 style="text-decoration: underline">kerekerdopizzeria.hu</h3>
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
                        <div class="pizzacardname text-center align-self-end p-1">
                            <h2>
                                Húsimádó Pizza
                            </h2>
                        </div>
                    </div>
                    <div class="back">
                        <div class="back-content">
                            <div class="cardinfo">
                                <h2>Húsimádó Pizza</h2>
                                <br><br>
                                <span>Kerekerdő Pizzéria</span>
                                <h3>kerekerdopizzeria.hu</h3>
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

        <div class="pizzacim text-center mt-5">
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


        <ul class="row pizzafeed  feed-list mt-5">
            @php
            $i=0;
            @endphp

                @foreach ($pizzas as $pizza)
                 <div class="col-lg-6 col-md-12 mb-5 feed-tile" id="feed-tile-{{$i}}">
                    <div class="ft-recipe">
                        <div class="ft-recipe__thumb{{ ($i % 4 != 0) ? "m" : ""}} text-center d-flex  align-items-center">
                            <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                        </div>
                        <div class="ft-recipe__content">
                            <header class="content__header">
                                <div class="row-wrapper text-center">
                                    <h2 class="recipe-title feed-tile-name">{{$pizza['pizza']['name']}}</h2>
                                    <div class="user-rating"></div>
                                </div>
                                <ul class="recipe-details">
                                    <li class="recipe-details-item time"><i class="fas fa-clock"></i></i><span class="value">20</span><span class="title">Kiszállítás</span></li>
                                    <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">{{ $pizza['price'] }}</span><span class="title">Ár</span></li>
                                    <li class="recipe-details-item servings"><i class="fas fa-heart"></i></i><span class="value">&#8734;</span><span class="title">Pontszám</span></li>
                                </ul>
                            </header>
                            <h4>Kerekerdő Pizzéria</h4>
                            <h4>Feltétek:</h4>
                            <p class="description">
                                @foreach ($pizza['pizza']['recept'] as $recept)
                                    {{ $recept }},
                                @endforeach
                            </p>
                            <p class="description">Méret: {{ $pizza['pizzasize'] }}</p>
                            <footer class="content__footer{{ ($i % 4 != 0) ? "m" : ""}} "><a href="#">Részletek</a></footer>
                        </div>
                    </div>
                </div>

             @php
                $i++;
            @endphp
            @endforeach
        </ul>


    </div>
    <script>
        $(window).scroll(function () {
            $('nav').toggleClass('scrolled',$(this).scrollTop()>660)
        });
    </script>
@endsection
