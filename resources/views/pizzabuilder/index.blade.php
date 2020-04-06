@extends('layouts.app')
@section('content')


    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.webp')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5">
        <h2>Pizza Picker</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pizza Picker</li>
        </ol>
    </section>

    <div class="container">

        <nav>
            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-alap-tab" data-toggle="tab" href="#nav-alap" role="tab" aria-controls="nav-alap" aria-selected="true">Pizza Alapok</a>
                <a class="nav-item nav-link" id="nav-hus-tab" data-toggle="tab" href="#nav-hus" role="tab" aria-controls="nav-hus" aria-selected="false">Húsfeltétek</a>
                <a class="nav-item nav-link" id="nav-zoldseg-tab" data-toggle="tab" href="#nav-zoldseg" role="tab" aria-controls="nav-zoldseg" aria-selected="false">Zöldség Feltétek</a>
                <a class="nav-item nav-link" id="nav-fuszer-tab" data-toggle="tab" href="#nav-fuszer" role="tab" aria-controls="nav-fuszer" aria-selected="false">Fűszerek</a>
                <a class="nav-item nav-link" id="nav-sajt-tab" data-toggle="tab" href="#nav-sajt" role="tab" aria-controls="nav-sajt" aria-selected="false">Sajtok</a>
            </div>
        </nav>

        <section>
            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                <div class="tab-pane  show active mr-3 ml-3" id="nav-alap" role="tabpanel" aria-labelledby="nav-alap-tab">
                    <div class="row">

                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Paradicsomos
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Csípős Paradicsomos
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                       Tejfölös
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Édes chillis
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Fokhagymás-tejfölös
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Mustáros
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Klasszikus BBQ
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Sajtkrémes
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Tzatzikis
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Bolognai ragu
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Bolognai ragu
                                    </h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 alap d-flex mb-3">
                            <a href="" style="background-image: url('{{ asset('/img/glry/hawaii.webp')}}');">
                                <div class="alapname text-center align-self-end p-1">

                                    <h2>
                                        Bolognai ragu
                                    </h2>
                                </div>
                            </a>
                        </div>

                    </div>

                </div>

                <div class="tab-pane  show" id="nav-hus" role="tabpanel" aria-labelledby="nav-hus-tab">

                </div>

                <div class="tab-pane  show" id="nav-zoldseg" role="tabpanel" aria-labelledby="nav-zoldseg-tab">

                </div>

                <div class="tab-pane  show" id="nav-fuszer" role="tabpanel" aria-labelledby="nav-fuszer-tab">

                </div>

                <div class="tab-pane  show" id="nav-sajt" role="tabpanel" aria-labelledby="nav-sajt-tab">

                </div>
            </div>
        </section>

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

@endsection
