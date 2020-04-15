@extends('layouts.app')
@section('content')


    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.webp')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5">
        <h2>Pizza Fajták</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item"><a href="/kategoriak">Kategoriak</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$categoryName}}</li>
        </ol>
    </section>

    <div class="container">
        <div class="pizzacim text-center mt-5 mb-3">
            <h2>
                {{$categoryName}}
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
            @if (count($pizzas) != 0)

            @php
                $i = 0;
            @endphp
            @foreach ($pizzas as $pizza)
                @if(($i%3==0) && ($i !=0 ))
                    </div>
                @endif
                @if(($i%3==0) && ($i !=0 ))
                    <div class="row justify-content-between">
                @endif
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-5 mb-3">

                        <div class="ft-recipe-kicsi">
                            <div class="ft-recipe__thumb text-center d-flex  align-items-center">
                                <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
                            </div>
                            <div class="ft-recipe__contento">
                                <header class="content__header">
                                    <div class="row-wrapper text-center">
                                    <h2 class="recipe-title feed-tile-name">{{ $pizza->name }}</h2>
                                        <div class="user-rating"></div>
                                    </div>
                                </header>
                                <h4>Feltétek:</h4>
                                <p class="description">
                                @foreach ($pizza['recept'] as $key => $recept)
                                    {{ $recept }}@if ($key != count($pizza['recept'])-1), @endif
                                @endforeach
                                </p>
                                <footer class="content__footer align-self-end "><a href="/pizza/{{ $pizza->id }}">Tovább</a></footer>
                            </div>
                        </div>

                    </div>
                    @php
                        $i++;
                    @endphp
            @endforeach
            @else
            <div class="col-12 pizzacim text-center mt-5 mb-3">
                <h2>
                    Sajnos nem található ilyen pizza
                </h2>
            </div>
            @endif
        </div>
    </div>


    <script>
        $(window).scroll(function () {
            $('nav').toggleClass('scrolled',$(this).scrollTop()>660)
        });

    </script>
@endsection
