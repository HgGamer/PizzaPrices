@extends('layouts.app')
@section('content')


    <div class="container">
        <div class="row">
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

        <div class="row justify-content-around">
            <div class="col-5">
                <img class="img-fluid" src="{{ asset('img/pizza2.jpg') }}">
            </div>
            <div class="col-5">
                <img class="img-fluid" src="{{ asset('img/pizza2.jpg') }}">
            </div>
        </div>

        <div class="row justify-content-center">

                <div class="col-8 ">
                    <img class="img-fluid" src="{{ asset('img/pizza2.jpg') }}">
                </div>

        </div>


    </div>
@endsection
