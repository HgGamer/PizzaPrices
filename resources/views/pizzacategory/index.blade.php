@extends('layouts.app')
@section('title')
PizzaPrices - {{$categoryName}}
@endsection
@section('content')


    <section class="banner_area" data-stellar-background-ratio="0.5">
        <h2>Pizza Fajták</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item"><a href="/kategoriak">Kategoriak</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$categoryName}}</li>
        </ol>
    </section>

    <div class="container">
        <h1 class="nincshteg">{{$categoryName}}</h1>
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
        <div class="row justify-content-around">
            @if (count($pizzas) != 0)

            @php
                $i = 0;
            @endphp
            @foreach ($pizzas as $pizza)
                @if(($i%3==0) && ($i !=0 ))
                    </div>
                @endif
                @if(($i%3==0) && ($i !=0 ))
                    <div class="row justify-content-around">
                @endif
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-5 mb-3">

                        <div class="ft-recipe-kicsi">
                            <div class="ft-recipe__thumb text-center d-flex  align-items-center justify-content-center">
                                @php if(is_file(public_path('/img/generated_feltetek/' . $pizza['recept_array'] . '.png'))){
                                    $url = url('/') . '/img/generated_feltetek/' . $pizza['recept_array'] . '.png';
                                 }else{
                                      $url = url('/') . "/img/pizzapop.png";
                                }
                                @endphp
                                <object data="{{ $url}}" type="image/png" alt="Generalt pizza kép">
                                    <img class="mx-auto d-block feed-tile-img" src="{{ url('/') }}/img/pizzapop.png" alt="Generalt pizza kép"/>
                                </object>
                            </div>
                            <div class="ft-recipe__contento">
                                <header class="content__header">
                                    <div class="row-wrapper text-center">
                                    <h3 class="recipe-title feed-tile-name">{{ $pizza->name }}</h3>
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
