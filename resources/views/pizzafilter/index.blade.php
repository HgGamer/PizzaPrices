@extends('layouts.app')
@section('title')
    PizzaPrices - Pizza Szűrő
@endsection
@section('content')
    <section class="banner_area" data-stellar-background-ratio="0.5">
        <h2>Pizza Szűrő</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pizza Szűrő</li>
        </ol>
    </section>

    <div class="container mt-4">
       <div class="row justify-content-between">
           <div class="col-lg-3 col-md-6 col-sm-12">
               <div class="card pizzafilercardkulso mb-5">
                   <div class="card-header pizzafiltercard">
                       <h2>
                           Pizza Méret
                       </h2>
                       <div class="divider-custom">
                           <div class="divider-custom-linee"></div>
                           <div class="divider-custom-icon">
                               <i class="fas fa-pizza-slice"></i>
                           </div>
                           <div class="divider-custom-linee"></div>
                       </div>
                   </div>
                   <div class="card-body checkbox-fontawesome checkbox-success" id="size-checkbox-parent">
                       <div class="col-12 checkbox">
                           <label for="checkbox-size-26"><input id="checkbox-size-26" type="checkbox" onclick="unCheckOthersSize('checkbox-size-26')"/>26Cm</label>
                       </div>
                       <div class="col-12 checkbox">
                           <label for="checkbox-size-28"><input id="checkbox-size-28" type="checkbox" onclick="unCheckOthersSize('checkbox-size-28')"/>28Cm</label>
                       </div>
                       <div class="col-12 checkbox">
                           <label for="checkbox-size-30"><input id="checkbox-size-30" type="checkbox" onclick="unCheckOthersSize('checkbox-size-30')"/>30Cm</label>
                       </div>
                       <div class="col-12 checkbox">
                           <label for="checkbox-size-32"><input id="checkbox-size-32" type="checkbox" onclick="unCheckOthersSize('checkbox-size-32')"/>32Cm</label>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-lg-4 col-md-6 col-sm-12">
               <div class="card pizzafilercardkulso mb-5">
                   <div class="card-header pizzafiltercard">
                       <h2>
                           Pizza Ár
                       </h2>
                       <div class="divider-custom">
                           <div class="divider-custom-linee"></div>
                           <div class="divider-custom-icon">
                               <i class="fas fa-pizza-slice"></i>
                           </div>
                           <div class="divider-custom-linee"></div>
                       </div>
                   </div>
                   <div class="card-body checkbox-fontawesome checkbox-success row justify-content-center" >
                       <div class="checkbox">
                           <label for="checkbox-priceType-1"><input id="checkbox-priceType-1" type="checkbox" onclick="unCheckOthersPrice('checkbox-priceType-1')"/>1500Ft alatt</label>
                       </div>
                       <div class="checkbox">
                           <label for="checkbox-priceType-2"><input id="checkbox-priceType-2" type="checkbox" onclick="unCheckOthersPrice('checkbox-priceType-2')"/>1500-2000Ft</label>
                       </div>
                       <div class="checkbox">
                           <label for="checkbox-priceType-3"><input id="checkbox-priceType-3" type="checkbox" onclick="unCheckOthersPrice('checkbox-priceType-3')"/>2000Ft felett</label>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-lg-5 col-md-6 col-sm-12">
               <div class="card pizzafilercardkulso mb-5">
                   <div class="card-header pizzafiltercard">
                       <h2>
                           Pizzériák
                       </h2>
                       <div class="divider-custom">
                           <div class="divider-custom-linee"></div>
                           <div class="divider-custom-icon">
                               <i class="fas fa-pizza-slice"></i>
                           </div>
                           <div class="divider-custom-linee"></div>
                       </div>
                   </div>
                   <div class="cardscroll">
                       <div class="card-body checkbox-fontawesome  checkbox-success">
                           <div class="checkbox">
                               <label for="checkbox-website-0"><input id="checkbox-website-0" type="checkbox" onclick="toggleCheckboxes()"/>Összes Pizzéria</label>
                           </div>
                           @foreach($websites as $website)
                           <div class="checkbox">
                               <label for="checkbox-website-{{$website->id}}"><input id="checkbox-website-{{$website->id}}" type="checkbox"/>{{$website->title}}</label>
                           </div>
                           @endforeach
                       </div>
                   </div>
               </div>
           </div>
       </div>
        <div class="row justify-content-center align-items-center text-center mt-3">
            <div class="filterbutton col-lg-4 col-md-6 col-sm-12">
                <footer class="content__footer align-self-end "><a id="search-button" rel="noopener" target="_blank" onclick="startRequest()">Keresés</a></footer>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="col-4">
                <!-- Copyright (c) 2020 by Patrick Stillhart (https://codepen.io/arcs/pen/pbPkPL) -->
                <canvas id="picker-loader" style="display: none"></canvas>
            </div>
        </div>
        <div class="justify-content-around nopizza" id="resultContainer"></div>
    </div>



    <script>
        function unCheckOthersSize(checkBoxSizeId){

            if(checkBoxSizeId == 'checkbox-size-26'){
                $('#checkbox-size-28').prop('checked', false);
                $('#checkbox-size-30').prop('checked', false);
                $('#checkbox-size-32').prop('checked', false);

            }
            if(checkBoxSizeId == 'checkbox-size-28'){
                $('#checkbox-size-26').prop('checked', false);
                $('#checkbox-size-30').prop('checked', false);
                $('#checkbox-size-32').prop('checked', false);

            }
            if(checkBoxSizeId == 'checkbox-size-30'){
                $('#checkbox-size-28').prop('checked', false);
                $('#checkbox-size-32').prop('checked', false);
                $('#checkbox-size-26').prop('checked', false);

            }
            if(checkBoxSizeId == 'checkbox-size-32'){
                $('#checkbox-size-26').prop('checked', false);
                $('#checkbox-size-30').prop('checked', false);
                $('#checkbox-size-28').prop('checked', false);

            }
        }

        function unCheckOthersPrice(checkBoxPriceId){

            if(checkBoxPriceId == 'checkbox-priceType-1'){
                $('#checkbox-priceType-2').prop('checked', false);
                $('#checkbox-priceType-3').prop('checked', false);

            }
            if(checkBoxPriceId == 'checkbox-priceType-2'){
                $('#checkbox-priceType-1').prop('checked', false);
                $('#checkbox-priceType-3').prop('checked', false);

            }
            if(checkBoxPriceId == 'checkbox-priceType-3'){
                $('#checkbox-priceType-2').prop('checked', false);
                $('#checkbox-priceType-1').prop('checked', false);

            }
        }

        function toggleCheckboxes() {

            let allWebsiteCheckbox = document.getElementById("checkbox-website-0");

            if (allWebsiteCheckbox.checked){
                checkAll()
            }else {
                uncheckAll()
            }
        }

        function checkAll() {
            @foreach($websites as $website)
                $('#checkbox-website-{{$website->id}}').prop('checked', true);
            @endforeach
        }

        function uncheckAll() {
            @foreach($websites as $website)
                $('#checkbox-website-{{$website->id}}').prop('checked', false);
            @endforeach
        }

        let sizeIdsArray = ['checkbox-size-26','checkbox-size-28','checkbox-size-30','checkbox-size-32'];
        let priceIdsArray = ['checkbox-priceType-1','checkbox-priceType-2','checkbox-priceType-3'];
        let websiteIdsArray =[
            @foreach($websites as $website)
                {{$website->id}},
            @endforeach
        ];

        function startRequest() {
            let selectedSize = 0;
            let selectedPrice = 0;
            let selectedWebsite = [];

            for (let i=0; sizeIdsArray.length > i; i++){
                let actNode = document.getElementById(sizeIdsArray[i]);
                if(actNode.checked){

                    selectedSize = sizeIdsArray[i].slice(-2);

                }
            }

            for (let i=0; priceIdsArray.length > i; i++){
                let actNode = document.getElementById(priceIdsArray[i]);
                if(actNode.checked){

                    selectedPrice = priceIdsArray[i].slice(-1);

                }
            }

            for (let i=0; websiteIdsArray.length > i; i++){
                let actNode = document.getElementById('checkbox-website-' + websiteIdsArray[i]);
                if(actNode.checked){

                    selectedWebsite.push(websiteIdsArray[i]);

                }
            }

            getPizzasByFillter(selectedSize, selectedPrice, selectedWebsite);

        }

        function getPizzasByFillter(size,priceType, websiteIds) {
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                url: "{{ url('/filter/pizzas') }}",
                data: {pizzaSize: size, pizzaPriceCategory: priceType, websites: websiteIds, _token: "{{ csrf_token() }}", _method: "get"},
                method: "get",
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    endRequestSuccess(response);
                },
                error: function (request, status, error) {
                    console.log(error)
                    endRequestError(request, status, error)
                }
            });

        }

        function endRequestSuccess(response){
            addResultPizzas(response)
            document.getElementById("search-button").disabled = false;
            document.getElementById('picker-loader').style.display = 'none';

        }

        function endRequestError(request, status, error){
            switch (request.status) {
                case 400:
                    alert(request.responseText)
            }
            document.getElementById("search-button").disabled = false;
            document.getElementById('picker-loader').style.display = 'none';
            console.log(status)
            console.log(request.responseText);
        }

        function addResultPizzas(items){
            var resultContainer = document.querySelector("#resultContainer")

            var pizzaList = document.createElement("div");
            pizzaList.setAttribute('class', 'row justify-content-around')

            var isYellow = true;
            for (let i = 0; i < items.length; i++) {
                var item = document.createElement("div");
                item.setAttribute('class', 'col-lg-6 col-md-12 mb-5 feed-tile')
                specificId = 'feed-tile-' + i;
                item.setAttribute('id', specificId)

                item.innerHTML = `
               <div class="ft-recipe">
                    <div class="ft-recipe__thumb${ (isYellow) ? "m" : ""} text-center d-flex justify-content-center align-items-center">
                        <object data="${items[i]['generatedURL'] }" type="image/png" style="" alt="Generalt pizza kép">
                            <img class="mx-auto d-block feed-tile-img" src="${URL}/img/pizzapop.png" alt="Generalt pizza kép"/>
                        </object>
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
                        <h4 class="text-center font-weight-bold"> <a href="${ items[i]['websiteUrl'] }" rel="noopener" target="_blank"> ${items[i]['title']} </a> </h4>
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
                        <footer class="content__footer${ (isYellow) ? "m" : ""} align-self-end "><a href="${ (items[i]['pizzaUrl'] != "") ? items[i]['pizzaUrl'] : items[i]['websiteUrl'] }" rel="noopener" target="_blank">Részletek</a></footer>
                    </div>
                </div>
                `;

                pizzaList.appendChild(item)
            }

            if (items.length == 0) {
                var zeroPizzaFeedback = document.createElement("h2");
                zeroPizzaFeedback.innerHTML = "Sajnos ilyen pizza nem található."
                pizzaList.appendChild(zeroPizzaFeedback)
            }

            resultContainer.appendChild(pizzaList)

            //console.log(items.length + ' pizza added')

        }



    </script>


@endsection


