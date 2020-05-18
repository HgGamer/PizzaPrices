@extends('layouts.app')
@section('title')
PizzaPrices - {{ ucfirst ($pizza->name) }}
@endsection
@section('content')
    <div class="bg">
        <div class="container-fluid">
            <div class="row">
                <div class="szelet">
                    <img class=" img-fluid" src="{{ asset('img/szelet.webp') }}" alt="pizzaszelet"/>
                </div>

                <div class="paradicsom">
                    <img class=" img-fluid" src="{{ asset('img/paradicsom.webp') }}" alt="paradicsom"/>
                </div>

                <div class="salata">
                    <img class=" img-fluid" src="{{ asset('img/salata.webp') }}" alt="saláta"/>
                </div>

                <div class="salami">
                    <img class=" img-fluid" src="{{ asset('img/salami.webp') }}" alt="salami"/>
                </div>

                <div class="col-lg-6 col-md-12 justify-content-center d-flex align-items-center">
                    <div class="row">
                        <div class=" col-lg-12 justify-content-center d-flex align-items-center pizzanev">
                            <h1 class="text-center">{{$pizza->name}}</h1>
                        </div>
                        <div class="col-lg-12 justify-content-center d-flex align-items-center pizzakep">
                            <img class=" img-fluid mx-auto d-block" src="{{ asset('img/pizzapop.webp') }}" alt="pizza"/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 justify-content-center d-flex align-items-center">
                    <div class="justify-content-center d-flex align-items-center tabla">
                        <img class="img-fluid" src="{{ asset('img/tablaa.webp') }}" alt="táble">
                        <ul class="feltetek position-absolute">
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

                <div class="container text-center my-3">
                    <div class="row mx-auto my-auto">
                        <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                            <div class="carousel-inner w-100" role="listbox">

                                @php $i = 0  @endphp
                                @foreach ($similarPizzas as $similarPizza)
                                <div class="carousel-item {{ $i == 0 ? "active" : ""}}">
                                    <div class="col-md-4">
                                        <div class="card ft-recipe-kicsii">
                                            <img class="card-img-top hatter" src="{{ asset('img/pizzapop.webp') }}" alt="Card image cap">
                                            <div class="card-body ft-recipe__contento">
                                                <header class="content__header">
                                                    <div class="row-wrapper text-center">
                                                        <h3 class="recipe-title feed-tile-name">{{$similarPizza->name}} - {{ $i }}</h3>
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
                                @php $i++; @endphp
                                @endforeach


                            </div>
                            <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>


            </section>

        </div>



    </div>


<script>

    $('#recipeCarousel').carousel({
        interval: 10000
    })

    $('.carousel .carousel-item').each(function(){
        var minPerSlide = 1;
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i=0;i<minPerSlide;i++) {
            next=next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });




</script>




@endsection

