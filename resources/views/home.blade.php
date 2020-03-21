@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row mb-5">
            <div class="col-3 popularpizza">
                <img class="img-fluid" src="{{ asset('img/1.jpg') }}">
                <h2>Hawai Pizzák</h2>
            </div>
            <div class="col-3 popularpizza">
                <img class="img-fluid" src="{{ asset('img/2.jpg') }}">
                <h2>Son-Go-Ku Pizzák</h2>
            </div>
            <div class="col-3 popularpizza">
                <img class="img-fluid" src="{{ asset('img/3.jpg') }}">
                <h2>Bolognai Pizzák</h2>
            </div>
            <div class="col-3 popularpizza">
                <img class="img-fluid" src="{{ asset('img/poppizza.jpg') }}">
                <h2>Húsimádó Pizzák</h2>
            </div>
        </div>

        <div class="row justify-content-around mb-5">
            <div class="col-6">
                <div class="business-card middle">
                    <div class="front">
                        <h2>Húsimádó</h2>
                        <span>Kerekerdő Pizzéria</span>
                        <ul class="contact-info">
                           <p>feltétek feltétek infok minden is</p>
                        </ul>
                    </div>
                    <div class="back">
                        <span>Baszó Pizza</span>
                    </div>
                </div>

            </div>
            <div class="col-6">
                <img class="img-fluid" src="{{ asset('img/pizza2.jpg') }}">
            </div>
        </div>

        <div class="row justify-content-center">

                <div class="col-8 ">
                    <img class="img-fluid" src="{{ asset('img/pizza2.jpg') }}">
                </div>

        </div>
    </div>
    <script>

        $(".business-card").click(function(){
            $(".business-card").toggleClass("business-card-active");
        });

    </script>
@endsection
