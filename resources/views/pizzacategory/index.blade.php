@extends('layouts.app')
@section('content')
    <head>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>

    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.jpg')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5"></section>

    <div class="container">
        <div class="pizzacim text-center mt-5 mb-3">
            <h2>
                XY Fajta Pizza
            </h2>
            <div class="divider-custom">
                <div class="divider-custom-linee"></div>
                <div class="divider-custom-icon">
                    <i class="fas fa-pizza-slice"></i>
                </div>
                <div class="divider-custom-linee"></div>
            </div>
        </div>
        <div class="row justify-content-between mb-5">
            <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="ft-recipe">
                        <div class="ft-recipe__thumb text-center d-flex  align-items-center">
                            <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                        </div>
                        <div class="ft-recipe__content ">
                            <header class="content__header">
                                <div class="row-wrapper text-center">
                                    <h2 class="recipe-title feed-tile-name">Lófasz ízű Pizza</h2>
                                    <div class="user-rating"></div>
                                </div>
                                <ul class="recipe-details">
                                    <li class="recipe-details-item time"><i class="fas fa-clock"></i><span class="value">20</span></li>
                                    <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                    <li class="recipe-details-item servings"><i class="fas fa-heart"></i><span class="value">&#8734;</span></li>
                                </ul>
                            </header>
                            <h4 class="text-center font-weight-bold">Kerekerdő Pizzéria</h4>
                            <h4>Feltétek:</h4>
                            <p class="description">
                                asd asd asd asd asd
                            </p>
                            <p class="descriptions">Méret: 20 Cm</p>
                            <footer class="content__footer align-self-end "><a href="#">Részletek</a></footer>
                        </div>
                    </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="ft-recipe">
                    <div class="ft-recipe__thumb text-center d-flex  align-items-center">
                        <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                    </div>
                    <div class="ft-recipe__content ">
                        <header class="content__header">
                            <div class="row-wrapper text-center">
                                <h2 class="recipe-title feed-tile-name">Lófasz ízű Pizza</h2>
                                <div class="user-rating"></div>
                            </div>
                            <ul class="recipe-details">
                                <li class="recipe-details-item time"><i class="fas fa-clock"></i></i><span class="value">20</span></li>
                                <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                <li class="recipe-details-item servings"><i class="fas fa-heart"></i></i><span class="value">&#8734;</span></li>
                            </ul>
                        </header>
                        <h4 class="text-center">Kerekerdő Pizzéria</h4>
                        <h4>Feltétek:</h4>
                        <p class="description">
                            asd asd asd asd asd
                        </p>
                        <p class="descriptions">Méret: 20 Cm</p>
                        <footer class="content__footer align-self-end "><a href="#">Részletek</a></footer>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="ft-recipe">
                    <div class="ft-recipe__thumb text-center d-flex  align-items-center">
                        <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                    </div>
                    <div class="ft-recipe__content ">
                        <header class="content__header">
                            <div class="row-wrapper text-center">
                                <h2 class="recipe-title feed-tile-name">Lófasz ízű Pizza</h2>
                                <div class="user-rating"></div>
                            </div>
                            <ul class="recipe-details">
                                <li class="recipe-details-item time"><i class="fas fa-clock"></i></i><span class="value">20</span></li>
                                <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                <li class="recipe-details-item servings"><i class="fas fa-heart"></i></i><span class="value">&#8734;</span></li>
                            </ul>
                        </header>
                        <h4 class="text-center">Kerekerdő Pizzéria</h4>
                        <h4>Feltétek:</h4>
                        <p class="description">
                            asd asd asd asd asd
                        </p>
                        <p class="descriptions">Méret: 20 Cm</p>
                        <footer class="content__footer align-self-end "><a href="#">Részletek</a></footer>
                    </div>
                </div>
            </div>
        </div>
            <div class="row justify-content-between">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="ft-recipe">
                    <div class="ft-recipe__thumb text-center d-flex  align-items-center">
                        <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                    </div>
                    <div class="ft-recipe__content ">
                        <header class="content__header">
                            <div class="row-wrapper text-center">
                                <h2 class="recipe-title feed-tile-name">Lófasz ízű Pizza</h2>
                                <div class="user-rating"></div>
                            </div>
                            <ul class="recipe-details">
                                <li class="recipe-details-item time"><i class="fas fa-clock"></i></i><span class="value">20</span></li>
                                <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                <li class="recipe-details-item servings"><i class="fas fa-heart"></i></i><span class="value">&#8734;</span></li>
                            </ul>
                        </header>
                        <h4 class="text-center">Kerekerdő Pizzéria</h4>
                        <h4>Feltétek:</h4>
                        <p class="description">
                            asd asd asd asd asd
                        </p>
                        <p class="descriptions">Méret: 20 Cm</p>
                        <footer class="content__footer align-self-end "><a href="#">Részletek</a></footer>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="ft-recipe">
                    <div class="ft-recipe__thumb text-center d-flex  align-items-center">
                        <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                    </div>
                    <div class="ft-recipe__content ">
                        <header class="content__header">
                            <div class="row-wrapper text-center">
                                <h2 class="recipe-title feed-tile-name">Lófasz ízű Pizza</h2>
                                <div class="user-rating"></div>
                            </div>
                            <ul class="recipe-details">
                                <li class="recipe-details-item time"><i class="fas fa-clock"></i></i><span class="value">20</span></li>
                                <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                <li class="recipe-details-item servings"><i class="fas fa-heart"></i></i><span class="value">&#8734;</span></li>
                            </ul>
                        </header>
                        <h4 class="text-center">Kerekerdő Pizzéria</h4>
                        <h4>Feltétek:</h4>
                        <p class="description">
                            asd asd asd asd asd
                        </p>
                        <p class="descriptions">Méret: 20 Cm</p>
                        <footer class="content__footer align-self-end "><a href="#">Részletek</a></footer>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="ft-recipe">
                    <div class="ft-recipe__thumb text-center d-flex  align-items-center">
                        <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                    </div>
                    <div class="ft-recipe__content ">
                        <header class="content__header">
                            <div class="row-wrapper text-center">
                                <h2 class="recipe-title feed-tile-name">Lófasz ízű Pizza</h2>
                                <div class="user-rating"></div>
                            </div>
                            <ul class="recipe-details">
                                <li class="recipe-details-item time"><i class="fas fa-clock"></i></i><span class="value">20</span></li>
                                <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                <li class="recipe-details-item servings"><i class="fas fa-heart"></i></i><span class="value">&#8734;</span></li>
                            </ul>
                        </header>
                        <h4 class="text-center">Kerekerdő Pizzéria</h4>
                        <h4>Feltétek:</h4>
                        <p class="description">
                            asd asd asd asd asd
                        </p>
                        <p class="descriptions">Méret: 20 Cm</p>
                        <footer class="content__footer align-self-end "><a href="#">Részletek</a></footer>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(window).scroll(function () {
            $('nav').toggleClass('scrolled',$(this).scrollTop()>660)
        });
    </script>
@endsection
