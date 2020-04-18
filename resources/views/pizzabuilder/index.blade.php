@extends('layouts.app')
@section('title')
PizzaPrices - Pizza Picker
@endsection
@section('content')

    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.webp')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5">
        <h2>Pizza Picker</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pizza Picker</li>
        </ol>
    </section>

    <div class="container-fluid">
        <h1 class="nincshteg">Pizza Picker</h1>
            <div class="row">
                <div class="col-8">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        @php $j=0 @endphp
                        @foreach($categories as $category)

                            <a class="nav-item nav-link {{ ($j == 0) ? "active" : "" }}" id="nav-{{$j}}-tab" data-toggle="tab" href="#nav-{{$j}}" role="tab" aria-controls="nav-alap" aria-selected="true">{{$category->name}}</a>
                            @php $j++; @endphp
                        @endforeach
                    </div>
                </nav>

                <section class="picker">
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        @php $j=0 @endphp
                            @foreach($categories as $category)
                                <div class="tab-pane  show {{ ($j == 0) ? "active" : "" }} mr-3 ml-3" id="nav-{{$j}}" role="tabpanel" aria-labelledby="nav-{{$j}}-tab">
                                    <div class="row">
                                        @foreach($category['materials'] as $material)
                                            <div class="col-lg-2 alap d-flex mb-3 " onclick="setMaterial({{$material->id}})" id="material-{{$material->id}}">
                                                <a  style="background-image: url('{{ asset('/img/feltetek')}}/{{$material->img}}');">
                                                    <div class="alapname text-center align-self-end p-1">

                                                        <h3>
                                                            {{ $material ? $material->name : ""}}
                                                        </h3>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @php $j++; @endphp
                        @endforeach

                    </div>
                </section>
            </div>
            <div class="col-4">
                <div class="ft-recipe-kicsi">
                    <div class="ft-recipe__thumb text-center d-flex  align-items-center">
                        <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
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
                        <button type="button" onclick="getPizzasByMaterials(materials)" class="btn btn-info">Info</button>
                    </div>
                </div>
            </div>
            </div>


    </div>

    <div class="container">




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
                            <img class="mx-auto d-block feed-tile-img" src="{{ asset('img/pizzapop.png') }}" alt="pizza"/>
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
        var materials = [];

        function getPizzasByMaterials(materials) {
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                url: "{{ url('/api/pizzasByMaterials') }}",
                data: {materials: materials, _token: "{{ csrf_token() }}", _method: "get"},
                method: "get",
                dataType: "json",
                success: function (response) {
                    console.log(response);
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                }
            });

        }

        function setMaterial(materialId) {
            $("#material-"+materialId).toggleClass('kivanvalasztva');


            if(materials.includes(materialId)){

                const index = materials.indexOf(materialId);
                if (index > -1) {
                    materials.splice(index, 1);
                }

            }else {
                materials.push(materialId);
            }

            console.log(materials)



        }



    </script>

@endsection
