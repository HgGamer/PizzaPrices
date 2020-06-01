@extends('layouts.app')
@section('title')
PizzaPrices - {{ ucfirst ($pizza->name) }}
@endsection
@section('content')
    <div class="bg" id="background">
        <div class="container-fluid">
            <div class="row">
                <div class="szelet">
                    <picture>
                        <source srcset="{{ asset('img/szelet.webp') }}" type="image/webp">
                        <img class=" img-fluid" src="{{ asset('img/szelet.png') }}" alt="pizzaszelet"/>
                    </picture>
                </div>

                <div class="paradicsom">
                    <picture>
                        <source srcset="{{ asset('img/paradicsom.webp') }}" type="image/webp">
                        <img class=" img-fluid" src="{{ asset('img/paradicsom.png') }}" alt="paradicsom"/>
                    </picture>
                </div>

                <div class="salata">
                    <picture>
                        <source srcset="{{ asset('img/salata.webp') }}" type="image/webp">
                        <img class=" img-fluid" src="{{ asset('img/salata.png') }}" alt="saláta"/>
                    </picture>
                </div>

                <div class="salami">
                    <picture>
                        <source srcset="{{ asset('img/salami.webp') }}" type="image/webp">
                        <img class=" img-fluid" src="{{ asset('img/salami.png') }}" alt="salami"/>
                    </picture>
                </div>

                <div class="col-lg-6 col-md-12 justify-content-center d-flex align-items-center">
                    <div class="row">
                        <div class=" col-lg-12 justify-content-center d-flex align-items-center pizzanev">
                            <h1 class="text-center">{{$pizza->name}}</h1>
                        </div>
                        <div class="col-lg-12 justify-content-center d-flex align-items-center pizzakep">
                            @php if(is_file(public_path('/img/generated_feltetek_big/' . $pizza['recept_array'] . '.png'))){
                                    $url = url('/') . '/img/generated_feltetek_big/' . $pizza['recept_array'] . '.png';
                                 }else{
                                    $url = url('/') . "/img/pizzapop.png";
                                }
                            @endphp
                            <object class="generated-image" data="{{ $url }}" type="image/png" alt="Generalt pizza kép">
                                <img class="mx-auto d-block feed-tile-img" src="{{ url('/') }}/img/pizzapop.png" alt="Generalt pizza kép"/>
                            </object>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="justify-content-center d-flex align-items-center tabla">
                        <picture>
                            <source srcset="{{ asset('img/tablaa.webp') }}" type="image/webp">
                            <img class="img-fluid mx-auto d-block" src="{{ asset('img/tablaa.png') }}" alt="tábla" />
                        </picture>

                        @php
                            $feltetszam = count($pizza['recept']);
                            $feltet = null;

                            switch (true) {
                                case $feltetszam < 7:
                                    $feltet = 'feltetek';
                                    break;
                                case $feltetszam < 8:
                                    $feltet = 'feltetekhet';
                                    break;
                                case $feltetszam < 11:
                                    $feltet = 'feltetekkilenc';
                                    break;
                                case $feltetszam > 10:
                                    $feltet = 'feltetekkilencplusz';
                                    break;
                            }
                        @endphp

                        <ul class="{{$feltet}} position-absolute">
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


                <div class="table-responsive" id="aszam">
                    <table class="table tablesajat table-borderless" id="items">
                        <thead>
                        <tr class="tableheader justify-content-center">
                            <th scope="col">Pizza Neve</th>
                            <th scope="col">Pizzéria Neve</th>
                            <th scope="col">Méret</th>
                            <th scope="col" onclick="sortByPrice()">Ár <i class="fas fa-sort"></i></th>
                            <th scope="col">Ugrás A Pizzériához</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach ($datas as $data)
                        <tr class="tablerow item" data-id="{{$data['id']}}">
                            <th>{{$data['pizzaAlias']['name']}}</th>
                            <td>{{$data['website']['title']}}</td>
                            <td>{{ $data->pizzasize }} Cm</td>
                            <td class="price">{{$data->price}} Ft</td>

                            <td><footer class="content__footer align-self-end "><a class="changeMe" href="{{ ($data['url'] != "") ? $data['url'] : $data['website']['url'] }}" rel="noopener" target="_blank">Ugrás a Pizzériához</a></footer></td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>





            </section>

            <section class="datatable mb-5">
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
                        <div id="recipeCarousel" class="carousel w-100 " data-ride="carousel">
                            <div class="carousel-inner w-100" role="listbox">

                                @php $i = 0  @endphp
                                @foreach ($similarPizzas as $similarPizza)
                                    <div class="carousel-item {{ $i == 0 ? "active" : ""}}">
                                        <div class="col-md-4">
                                            <div class="card ft-recipe-kicsii">
                                                <div class="ft-recipe__thumb text-center d-flex  align-items-center justify-content-center">
                                                    @php if(is_file(public_path('/img/generated_feltetek/' . $similarPizza->recept_array . '.png'))){
                                                        $url = url('/') . '/img/generated_feltetek/' . $similarPizza->recept_array . '.png';
                                                     }else{
                                                          $url = url('/') . "/img/pizzapop.png";
                                                    }
                                                    @endphp
                                                    <object class="generated-image" data="{{$url}}" type="image/png" alt="Generalt pizza kép">
                                                        <img class="mx-auto d-block feed-tile-img" src="{{ url('/') }}/img/pizzapop.png" alt="Generalt pizza kép"/>
                                                    </object>
                                                </div>
                                                <div class="card-body ft-recipe__contento">
                                                    <header class="content__header">
                                                        <div class="row-wrapper text-center d-flex">
                                                            <div class="justify-content-center recipejustify" style="width: 100%">
                                                                <h3 class="recipe-title feed-tile-name"><span>{{$similarPizza->name}}</span></h3>
                                                            </div>
                                                            <div class="user-rating"></div>
                                                        </div>
                                                        <ul class="recipe-details">
                                                            <li class="recipe-details-item time" data-toggle="tooltip" data-placement="top" title="Cm"><i class="fas fa-ruler-horizontal"></i></i><span class="value">{{$similarPizza->pizzasize}}</span></li>
                                                            <li class="recipe-details-item ingredients" data-toggle="tooltip" data-placement="top" title="HUF"><i class="fas fa-coins"></i><span class="value">{{$similarPizza->price}}</span></li>
                                                        </ul>
                                                    </header>
                                                    <h4 class="text-center font-weight-bold"><a rel="noopener" target="_blank" href="{{$similarPizza->url}}">{{$similarPizza->title}}</a></h4>
                                                    <h4>Feltétek:</h4>
                                                    <p class="description">
                                                        @foreach($similarPizza->recept as $key => $feltet)
                                                            {{ $feltet }}@if ($key != count($similarPizza->recept)-1), @endif
                                                        @endforeach
                                                    </p>
                                                    <footer class="content__footer align-self-end "><a rel="noopener" target="_blank" href="{{ ($similarPizza->pizzaurl != "") ? $similarPizza->pizzaurl : $similarPizza->url }}">Részletek</a></footer>
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
    });

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

    let isIOS = (/iPad|iPhone|iPod/.test(navigator.platform) || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1)) && !window.MSStream;

    if (isIOS){
       $('#background').removeClass('bg');
       $('#background').addClass('iosegypizzaoldala');

    }else{
        console.log("Nem ios")
    }

    var sorted = false;

    function sortByPrice() {
        $('#items').append(
            $('#items').find('tr.item').sort(function (a, b) {
                var td_a = $($(a).find('td.price')[0]);
                var td_b = $($(b).find('td.price')[0]);
                if(sorted){
                    return td_b.html().replace(/\D/g, '') - td_a.html().replace(/\D/g, '');
                }else{
                    return td_a.html().replace(/\D/g, '') - td_b.html().replace(/\D/g, '');
                }
            })
        );
        if(sorted) sorted = false;
        else sorted = true;
    }

    var nodesArray = document.getElementsByClassName("changeMe");

    window.onload =function meretcheck() {
        if(window.innerWidth <= 425){

            for (i=0; i< nodesArray.length; i++){
                nodesArray[i].innerHTML ='<i class="fas fa-angle-right"></i>';
            }
        }
    }

</script>





@endsection

