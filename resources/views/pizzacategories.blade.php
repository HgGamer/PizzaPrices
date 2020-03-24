@extends('layouts.app')
@section('content')
    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.jpg')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5"></section>

    <div class="container">
        <div class="image-gallery">

            <a href="" class="margareta">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                       Margaréta Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="szalamis">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Szalámis Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="sonkas">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Sonkás Pizza
                    </h2>
                </div>
            </a>
            <a href="" class="gombas">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Gombás Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="hawaii">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Hawaii Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="kukoricas">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Kukoricás Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="baconos">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Baconos Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="husimado">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Húsimádó Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="pepperonis">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Pepperónis Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="bolognai">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Bolongnai Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="magyaros">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Magyaros Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="negyevszak">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        4 Évszak Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="gorog">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Görög Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="vegan">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Vega Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="tengergyumolcse">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Tengergyümölcse Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="bbq">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        BBQ Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="tonhalas">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Tonhalas Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="gyrosos">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Gyrosos Pizzák
                    </h2>
                </div>
            </a>
            <a href="" class="tojasos">
                <div class="kategoraibox align-self-end d-flex text-center">
                    <h2 class="align-self-end">
                        Tojásos Pizzák
                    </h2>
                </div>
            </a>
        </div>
    </div>


    <script>
        $(window).scroll(function () {
            $('nav').toggleClass('scrolled',$(this).scrollTop()>660)
        });
    </script>
@endsection
