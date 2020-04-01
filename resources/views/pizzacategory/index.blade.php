@extends('layouts.app')
@section('content')


    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.jpg')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5">
        <h2>Pizza Fajták</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pizza Fajták</li>
        </ol>
    </section>

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
        <div class="row justify-content-between">
            @for($i=0; $i<22; $i++)
                @if(($i%3==0) && ($i !=0 ))
                    </div>
                @endif
                @if(($i%3==0) && ($i !=0 ))
                    <div class="row justify-content-between">
                @endif
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-5">

                        <div class="ft-recipe-kicsi">
                            <div class="ft-recipe__thumb text-center d-flex  align-items-center">
                                <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                            </div>
                            <div class="ft-recipe__contento">
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
            @endfor
        </div>
    </div>


    <script>
        $(window).scroll(function () {
            $('nav').toggleClass('scrolled',$(this).scrollTop()>660)
        });

    </script>
@endsection
