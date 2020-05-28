@extends('layouts.app')
@section('title')
PizzaPrices - {{ ucfirst ($pizza->name) }}
@endsection
@section('content')
    <head>
        <style>



        </style>
    </head>
    <div class="bg">
        <div class="container-fluid">
            <div class="row">
                <div class="szelet">
                    <picture>
                        <source srcset="{{ asset('img/szelet.webp') }}" type="image/webp">
                        <img class=" img-fluid" src="{{ asset('img/szelet.png') }}" alt="pizzaszelet"/>
                    </picture>
                </div>

                <div class="paradicsom">
                    <picture>
                        <source srcset="{{ asset('img/paradicsom.webp') }}" type="image/webp">
                        <img class=" img-fluid" src="{{ asset('img/paradicsom.png') }}" alt="paradicsom"/>
                    </picture>
                </div>

                <div class="salata">
                    <picture>
                        <source srcset="{{ asset('img/salata.webp') }}" type="image/webp">
                        <img class=" img-fluid" src="{{ asset('img/salata.png') }}" alt="saláta"/>
                    </picture>
                </div>

                <div class="salami">
                    <picture>
                        <source srcset="{{ asset('img/salami.webp') }}" type="image/webp">
                        <img class=" img-fluid" src="{{ asset('img/salami.png') }}" alt="salami"/>
                    </picture>
                </div>

                <div class="col-lg-6 col-md-12 justify-content-center d-flex align-items-center">
                    <div class="row">
                        <div class=" col-lg-12 justify-content-center d-flex align-items-center pizzanev">
                            <h1 class="text-center">{{$pizza->name}}</h1>
                        </div>
                        <div class="col-lg-12 justify-content-center d-flex align-items-center pizzakep">
                            <object data="{{ url('/') }}/img/generated_feltetek/{{$pizza['recept_array']}}.png" type="image/png" style="">
                                <img class="mx-auto d-block feed-tile-img" src="{{ url('/') }}/img/pizzapop.png" alt=""/>
                            </object>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="justify-content-center d-flex align-items-center tabla">
                        <picture>
                            <source srcset="{{ asset('img/tablaa.webp') }}" type="image/webp">
                            <img class="img-fluid mx-auto d-block" src="{{ asset('img/tablaa.png') }}" alt="tábla" />
                        </picture>

                        @php
                            $feltetszam = count($pizza['recept']);
                            $feltet = null;

                            switch (true) {
                                case $feltetszam < 7:
                                    $feltet = 'feltetek';
                                    break;
                                case $feltetszam < 8:
                                    $feltet = 'feltetekhet';
                                    break;
                                case $feltetszam < 11:
                                    $feltet = 'feltetekkilenc';
                                    break;
                                case $feltetszam > 10:
                                    $feltet = 'feltetekkilencplusz';
                                    break;
                            }
                        @endphp

                        <ul class="{{$feltet}} position-absolute">
                            @foreach ($pizza['recept'] as $recept)
                             <li>{{ $recept }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container Elfluido">
            <section class="datatable">
                <div class="pizzacim text-center mt-5 mb-3">
                    <h2>
                        Itt szerezheted be a pizzát
                    </h2>
                    <div class="divider-custom">
                        <div class="divider-custom-linee"></div>
                        <div class="divider-custom-icon">
                            <i class="fas fa-pizza-slice"></i>
                        </div>
                        <div class="divider-custom-linee"></div>
                    </div>
                </div>


                <div class="ElScrolllolloo">


                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-3">Pizza Neve</div>
                        <div class="col col-3">Pizzéria Neve</div>
                        <div class="col col-1">Méret</div>
                        <div class="col col-2">Ár</div>
                        <div class="col col-3">Ugrás a Pizzériához</div>
                    </li>
                    @foreach ($datas as $data)
                    <li class="table-row" data-id="{{ $data['id'] }}">
                        <div class="col col-3 text-capitalize" data-label="Pizza Neve">{{$data['pizzaAlias']['name']}}</div>
                        <div class="col col-3" data-label="Pizzéria Neve">{{$data['website']['title']}}</div>
                        <div class="col col-1" data-label="Méret">{{ $data->pizzasize }}</div>
                        <div class="col col-2" data-label="Ár">{{$data->price}} Ft</div>
                        <div class="col col-3" ><footer class="content__footer align-self-end "><a href="{{ ($data['url'] != "") ? $data['url'] : $data['website']['url'] }}" target="_blank">Ugrás a Pizzériához</a></footer></div>
                    </li>
                    @endforeach
                </ul>
                </div>

            </section>

            <section class="datatable">
                <div class="pizzacim text-center mt-5 mb-3">
                    <h2>
                        Hasonló Pizzák
                    </h2>
                    <div class="divider-custom">
                        <div class="divider-custom-linee"></div>
                        <div class="divider-custom-icon">
                            <i class="fas fa-pizza-slice"></i>
                        </div>
                        <div class="divider-custom-linee"></div>
                    </div>
                </div>

                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="col-md-4">
                                <div class="card ft-recipe-kicsii">
                                    <picture>
                                        <source srcset="{{ asset('img/pizzapop.webp') }}" type="image/webp">
                                        <img class="card-img-top hatter" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                                    </picture>
                                    <div class="card-body ft-recipe__contento">
                                        <header class="content__header">
                                            <div class="row-wrapper text-center">
                                                <h3 class="recipe-title feed-tile-name"></h3>
                                                <div class="user-rating"></div>
                                            </div>
                                            <ul class="recipe-details">
                                                <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">28</span></li>
                                                <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                            </ul>
                                        </header>
                                        <h4 class="text-center font-weight-bold"><a href="">Kerekerdő Pizzéria</a></h4>
                                        <h4>Feltétek:</h4>
                                        <p class="description">
                                            asd asd asd asd asd
                                        </p>
                                        <footer class="content__footer align-self-end "><a href="/pizza">Részletek</a></footer>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card ft-recipe-kicsii">
                                    <picture>
                                        <source srcset="{{ asset('img/pizzapop.webp') }}" type="image/webp">
                                        <img class="card-img-top hatter" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                                    </picture>
                                    <div class="card-body ft-recipe__contento">
                                        <header class="content__header">
                                            <div class="row-wrapper text-center">
                                                <h3 class="recipe-title feed-tile-name"></h3>
                                                <div class="user-rating"></div>
                                            </div>
                                            <ul class="recipe-details">
                                                <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">28</span></li>
                                                <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                            </ul>
                                        </header>
                                        <h4 class="text-center font-weight-bold"><a href="">Kerekerdő Pizzéria</a></h4>
                                        <h4>Feltétek:</h4>
                                        <p class="description">
                                            asd asd asd asd asd
                                        </p>
                                        <footer class="content__footer align-self-end "><a href="/pizza">Részletek</a></footer>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card ft-recipe-kicsii">
                                    <picture>
                                        <source srcset="{{ asset('img/pizzapop.webp') }}" type="image/webp">
                                        <img class="card-img-top hatter" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                                    </picture>
                                    <div class="card-body ft-recipe__contento">
                                        <header class="content__header">
                                            <div class="row-wrapper text-center">
                                                <h3 class="recipe-title feed-tile-name"></h3>
                                                <div class="user-rating"></div>
                                            </div>
                                            <ul class="recipe-details">
                                                <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">28</span></li>
                                                <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                            </ul>
                                        </header>
                                        <h4 class="text-center font-weight-bold"><a href="">Kerekerdő Pizzéria</a></h4>
                                        <h4>Feltétek:</h4>
                                        <p class="description">
                                            asd asd asd asd asd
                                        </p>
                                        <footer class="content__footer align-self-end "><a href="/pizza">Részletek</a></footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card ft-recipe-kicsii">
                                    <picture>
                                        <source srcset="{{ asset('img/pizzapop_old.webp') }}" type="image/webp">
                                        <img class="card-img-top hatter" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                                    </picture>
                                    <div class="card-body ft-recipe__contento">
                                        <header class="content__header">
                                            <div class="row-wrapper text-center">
                                                <h3 class="recipe-title feed-tile-name"></h3>
                                                <div class="user-rating"></div>
                                            </div>
                                            <ul class="recipe-details">
                                                <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">28</span></li>
                                                <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                            </ul>
                                        </header>
                                        <h4 class="text-center font-weight-bold"><a href="">Kerekerdő Pizzéria</a></h4>
                                        <h4>Feltétek:</h4>
                                        <p class="description">
                                            asd asd asd asd asd
                                        </p>
                                        <footer class="content__footer align-self-end "><a href="/pizza">Részletek</a></footer>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card ft-recipe-kicsii">
                                    <picture>
                                        <source srcset="{{ asset('img/pizzapop_old.webp') }}" type="image/webp">
                                        <img class="card-img-top hatter" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                                    </picture>
                                    <div class="card-body ft-recipe__contento">
                                        <header class="content__header">
                                            <div class="row-wrapper text-center">
                                                <h3 class="recipe-title feed-tile-name"></h3>
                                                <div class="user-rating"></div>
                                            </div>
                                            <ul class="recipe-details">
                                                <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">28</span></li>
                                                <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                            </ul>
                                        </header>
                                        <h4 class="text-center font-weight-bold"><a href="">Kerekerdő Pizzéria</a></h4>
                                        <h4>Feltétek:</h4>
                                        <p class="description">
                                            asd asd asd asd asd
                                        </p>
                                        <footer class="content__footer align-self-end "><a href="/pizza">Részletek</a></footer>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card ft-recipe-kicsii">
                                    <picture>
                                        <source srcset="{{ asset('img/pizzapop_old.webp') }}" type="image/webp">
                                        <img class="card-img-top hatter" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                                    </picture>
                                    <div class="card-body ft-recipe__contento">
                                        <header class="content__header">
                                            <div class="row-wrapper text-center">
                                                <h3 class="recipe-title feed-tile-name"></h3>
                                                <div class="user-rating"></div>
                                            </div>
                                            <ul class="recipe-details">
                                                <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">28</span></li>
                                                <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                            </ul>
                                        </header>
                                        <h4 class="text-center font-weight-bold"><a href="">Kerekerdő Pizzéria</a></h4>
                                        <h4>Feltétek:</h4>
                                        <p class="description">
                                            asd asd asd asd asd
                                        </p>
                                        <footer class="content__footer align-self-end "><a href="/pizza">Részletek</a></footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="col-md-4">
                                <div class="card ft-recipe-kicsii">
                                    <picture>
                                        <source srcset="{{ asset('img/pizzapop.webp') }}" type="image/webp">
                                        <img class="card-img-top hatter" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                                    </picture>
                                    <div class="card-body ft-recipe__contento">
                                        <header class="content__header">
                                            <div class="row-wrapper text-center">
                                                <h3 class="recipe-title feed-tile-name"></h3>
                                                <div class="user-rating"></div>
                                            </div>
                                            <ul class="recipe-details">
                                                <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">28</span></li>
                                                <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                            </ul>
                                        </header>
                                        <h4 class="text-center font-weight-bold"><a href="">Kerekerdő Pizzéria</a></h4>
                                        <h4>Feltétek:</h4>
                                        <p class="description">
                                            asd asd asd asd asd
                                        </p>
                                        <footer class="content__footer align-self-end "><a href="/pizza">Részletek</a></footer>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card ft-recipe-kicsii">
                                    <picture>
                                        <source srcset="{{ asset('img/pizzapop.webp') }}" type="image/webp">
                                        <img class="card-img-top hatter" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                                    </picture>
                                    <div class="card-body ft-recipe__contento">
                                        <header class="content__header">
                                            <div class="row-wrapper text-center">
                                                <h3 class="recipe-title feed-tile-name"></h3>
                                                <div class="user-rating"></div>
                                            </div>
                                            <ul class="recipe-details">
                                                <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">28</span></li>
                                                <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                            </ul>
                                        </header>
                                        <h4 class="text-center font-weight-bold"><a href="">Kerekerdő Pizzéria</a></h4>
                                        <h4>Feltétek:</h4>
                                        <p class="description">
                                            asd asd asd asd asd
                                        </p>
                                        <footer class="content__footer align-self-end "><a href="/pizza">Részletek</a></footer>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card ft-recipe-kicsii">
                                    <picture>
                                        <source srcset="{{ asset('img/pizzapop.webp') }}" type="image/webp">
                                        <img class="card-img-top hatter" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                                    </picture>
                                    <div class="card-body ft-recipe__contento">
                                        <header class="content__header">
                                            <div class="row-wrapper text-center">
                                                <h3 class="recipe-title feed-tile-name"></h3>
                                                <div class="user-rating"></div>
                                            </div>
                                            <ul class="recipe-details">
                                                <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">28</span></li>
                                                <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">1000</span></li>
                                            </ul>
                                        </header>
                                        <h4 class="text-center font-weight-bold"><a href="">Kerekerdő Pizzéria</a></h4>
                                        <h4>Feltétek:</h4>
                                        <p class="description">
                                            asd asd asd asd asd
                                        </p>
                                        <footer class="content__footer align-self-end "><a href="/pizza">Részletek</a></footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>




            </section>




    </div>


<script>

    $('.carousel').carousel();


</script>

@endsection

