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

        <div class="row justify-content-between" id="resultContainer">

        </div>

    </div>

    <script>
        var materials = [];
        var URL = "{{ url("/") }}"
        function getPizzasByMaterials(materials) {
            console.log('Keresett material tomb: ' +  materials)
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                url: "{{ url('/api/pizzasByMaterials') }}",
                data: {materials: materials, _token: "{{ csrf_token() }}", _method: "post"},
                method: "post",
                dataType: "json",
                success: function (response) {
                    addResultPizzas(response)
                    //console.log(response);
                },
                error: function (request, status, error) {
                    switch (request.status) {
                        case 400:
                            alert(request.responseText)
                    }
                    console.log(status)
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

        }


function addResultPizzas(items){
    var resultContainer = document.querySelector("#resultContainer")

    var pizzaList = document.createElement("div");
    pizzaList.setAttribute('class', 'row justify-content-between')

    var isYellow = true;
    for (let i = 0; i < items.length; i++) {
        var item = document.createElement("div");
        item.setAttribute('class', 'col-lg-6 col-md-12 mb-5 feed-tile')
        specificId = 'feed-tile-' + i;
        item.setAttribute('id', specificId)

        item.innerHTML = `
       <div class="ft-recipe">
            <div class="ft-recipe__thumb${ (isYellow) ? "m" : ""} text-center d-flex  align-items-center">
                <img class="mx-auto d-block feed-tile-img" src="${URL}/img/pizzapop.png" alt=""/>
            </div>
            <div class="ft-recipe__content ">
                <header class="content__header">
                    <div class="row-wrapper text-center">
                        <h3 class="recipe-title feed-tile-name text-center">${items[i]['name']}</h3>
                    </div>
                    <ul class="recipe-details">
                        <li class="recipe-details-item ingredients"><i class="fas fa-coins"></i><span class="value">${ items[i]['price'] }</span><span class="title">Ár(HUF)</span></li>
                        <li class="recipe-details-item time"><i class="fas fa-ruler-horizontal"></i></i><span class="value">${items[i]['pizzasize']}</span><span class="title">Méret(cm)</span></li>
                    </ul>
                </header>
                <h4 class="text-center font-weight-bold"> <a href="${ (items[i]['pizzaUrl'] != "") ? items[i]['pizzaUrl'] : items[i]['websiteUrl'] }"> ${items[i]['title']} </a> </h4>
                <h4>Feltétek:</h4>
                <p class="description">
                 ${items[i]['recept'].map(function (feltet, i, arr) {
                     if (i !=arr.length-1) {
                         return `${feltet}, `
                     } else {
                         return `${feltet}`
                     }

                     }).join("")
                    }

                   &#32;
                </p>
                <footer class="content__footer${ (isYellow) ? "m" : ""} align-self-end "><a href="#">Részletek</a></footer>
            </div>
        </div>
        `;

        pizzaList.appendChild(item)
    }

    resultContainer.appendChild(pizzaList)
    console.log('items Added')

}



    </script>

@endsection
