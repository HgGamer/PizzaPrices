@extends('layouts.app')
@section('content')
    <div class="bg">
        <div class="container-fluid">
            <div class="row">
                <div class="szelet">
                    <img class=" img-fluid" src="{{ asset('img/szelet.webp') }}" alt=""/>
                </div>

                <div class="paradicsom">
                    <img class=" img-fluid" src="{{ asset('img/paradicsom.webp') }}" alt=""/>
                </div>

                <div class="salata">
                    <img class=" img-fluid" src="{{ asset('img/salata.webp') }}" alt=""/>
                </div>

                <div class="salami">
                    <img class=" img-fluid" src="{{ asset('img/salami.webp') }}" alt=""/>
                </div>

                <div class="col-lg-6 col-md-12 justify-content-center d-flex align-items-center">
                    <div class="row">
                        <div class=" col-lg-12 justify-content-center d-flex align-items-center pizzanev">
                            <h1 class="text-center">XYZ Pizza</h1>
                        </div>
                        <div class="col-lg-12 justify-content-center d-flex align-items-center pizzakep">
                            <img class=" img-fluid mx-auto d-block" src="{{ asset('img/pizzapop.webp') }}" alt=""/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 justify-content-center d-flex align-items-center">
                    <div class="justify-content-center d-flex align-items-center tabla">
                        <img class="img-fluid" src="{{ asset('img/tablaa.webp') }}" alt="">
                        <ul class="feltetek position-absolute">
                            <li>PARADICSOMOSALAP</li>
                            <li>KOLBÁSZ</li>
                            <li>SONKA</li>
                            <li>KUKORICA</li>
                            <li>SAJT</li>
                            <li>UBORKA</li>
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
                    <li class="table-row">
                        <div class="col col-3" data-label="Pizza Neve">Hawaii Pizza</div>
                        <div class="col col-3" data-label="Pizzéria Neve">Kerekerdő Pizéra</div>
                        <div class="col col-1" data-label="Méret">32 Cm</div>
                        <div class="col col-2" data-label="Ár">1500 Ft</div>
                        <div class="col col-3" ><footer class="content__footer align-self-end "><a href="/pizza">Ugrás a Pizzériához</a></footer></div>
                    </li>
                    <li class="table-row">
                        <div class="col col-3" data-label="Pizza Neve">Hawaii Pizza</div>
                        <div class="col col-3" data-label="Pizzéria Neve">Kerekerdő Pizéra</div>
                        <div class="col col-1" data-label="Méret">32 Cm</div>
                        <div class="col col-2" data-label="Ár">1500 Ft</div>
                        <div class="col col-3" data-label="Ugrás a Pizzériához"><footer class="content__footer align-self-end "><a href="/pizza">Ugrás a Pizzériához</a></footer></div>
                    </li>
                    <li class="table-row">
                        <div class="col col-3" data-label="Pizza Neve">Hawaii Pizza</div>
                        <div class="col col-3" data-label="Pizzéria Neve">Kerekerdő Pizéra</div>
                        <div class="col col-1" data-label="Méret">32 Cm</div>
                        <div class="col col-2" data-label="Ár">1500 Ft</div>
                        <div class="col col-3" data-label="Ugrás a Pizzériához"><footer class="content__footer align-self-end "><a href="/pizza">Ugrás a Pizzériához</a></footer></div>
                    </li>
                    <li class="table-row">
                        <div class="col col-3" data-label="Pizza Neve">Hawaii Pizza</div>
                        <div class="col col-3" data-label="Pizzéria Neve">Kerekerdő Pizéra</div>
                        <div class="col col-1" data-label="Méret">32 Cm</div>
                        <div class="col col-2" data-label="Ár">1500 Ft</div>
                        <div class="col col-3" data-label="Ugrás a Pizzériához"><footer class="content__footer align-self-end "><a href="/pizza">Ugrás a Pizzériához</a></footer></div>
                    </li>
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
                                <div class="carousel-item active">
                                    <div class="col-md-4">
                                        <div class="card ft-recipe-kicsii">
                                            <img class="card-img-top hatter" src="{{ asset('img/pizzapop.webp') }}" alt="Card image cap">
                                        <div class="card-body ft-recipe__contento">
                                            <header class="content__header">
                                                <div class="row-wrapper text-center">
                                                    <h2 class="recipe-title feed-tile-name">XYZ Pizza</h2>
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
                                            <img class="card-img-top hatter" src="{{ asset('img/pizzapop.webp') }}" alt="Card image cap">
                                            <div class="card-body ft-recipe__contento">
                                                <header class="content__header">
                                                    <div class="row-wrapper text-center">
                                                        <h2 class="recipe-title feed-tile-name">XYZ Pizza</h2>
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
                                            <img class="card-img-top hatter" src="{{ asset('img/pizzapop.webp') }}" alt="Card image cap">
                                            <div class="card-body ft-recipe__contento">
                                                <header class="content__header">
                                                    <div class="row-wrapper text-center">
                                                        <h2 class="recipe-title feed-tile-name">XYZ Pizza</h2>
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
                                            <img class="card-img-top hatter" src="{{ asset('img/pizzapop.webp') }}" alt="Card image cap">
                                            <div class="card-body ft-recipe__contento">
                                                <header class="content__header">
                                                    <div class="row-wrapper text-center">
                                                        <h2 class="recipe-title feed-tile-name">XYZ Pizza</h2>
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
                                            <img class="card-img-top hatter" src="{{ asset('img/pizzapop.webp') }}" alt="Card image cap">
                                            <div class="card-body ft-recipe__contento">
                                                <header class="content__header">
                                                    <div class="row-wrapper text-center">
                                                        <h2 class="recipe-title feed-tile-name">XYZ Pizza</h2>
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
                                            <img class="card-img-top hatter" src="{{ asset('img/pizzapop.webp') }}" alt="Card image cap">
                                            <div class="card-body ft-recipe__contento">
                                                <header class="content__header">
                                                    <div class="row-wrapper text-center">
                                                        <h2 class="recipe-title feed-tile-name">XYZ Pizza</h2>
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
        var minPerSlide = 3;
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

