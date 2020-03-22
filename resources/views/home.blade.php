@extends('layouts.app')
@section('content')


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
            <div class="col-lg-6 col-md-12 picimeret ">
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
            <div class="col-lg-6 col-md-12">
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
<br>
        <br>
        <br>

        <div class="row justify-content-center">
                <div class="col-8 ">
                    <img class="img-fluid" src="{{ asset('img/pizza2.jpg') }}">
                </div>

        </div>
    </div>

@endsection
