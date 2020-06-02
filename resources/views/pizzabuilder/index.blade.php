@extends('layouts.app')
@section('title')
PizzaPrices - Pizza Picker
@endsection
@section('content')
<div class="pickercontainer">
    <script>
        var pizzapickerdata = @json($categories);
    </script>
    <section class="banner_area" data-stellar-background-ratio="0.5">
        <h2>Pizza Picker</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pizza Picker</li>
        </ol>
    </section>

    <div class="container-fluid">
        <h1 class="nincshteg">Pizza Picker</h1>

            <div class="row justify-content-lg-around">
                <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">
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
                    <div class="tab-content py-3 px-3 px-sm-0 bal" id="nav-tabContent">
                        @php $j=0 @endphp
                            @foreach($categories as $category)
                                <div class="tab-pane  show {{ ($j == 0) ? "active" : "" }} mr-3 ml-3 pickerbal" id="nav-{{$j}}" role="tabpanel" aria-labelledby="nav-{{$j}}-tab">
                                    <div class="row">
                                        @foreach($category['materials'] as $material)
                                            <div class="{{$category['name'] =='Pizza Alapok' ? 'feltetalap' : 'alap'}} col-lg-2 col-md-4 col-6  d-flex mb-3 " onclick="setMaterial({{$material->id}},'{{$material->name}}')" id="material-{{$material->id}}">
                                                <a>
                                                    <picture>
                                                        <source srcset="{{ asset('/img/feltetek/thumbnails')}}/{{$material->img}}.webp" type="image/webp">
                                                        <img class="object-fit_cover" src="{{ asset('/img/feltetek/thumbnails')}}/{{$material->img}}.jpg" alt="kategoriak" />
                                                    </picture>
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

            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12">
                <nav class="jobbpicker">
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link" id="" data-toggle="tab"  role="tab" aria-controls="" aria-selected="true">Keresett Pizza</a>
                    </div>
                </nav>
                <div class="ft-recipe-picker pickerjobb">
                    <div class="ft-recipe__thumb text-center d-flex justify-content-center">
                        <canvas id="pizzacanvas" width='1000px' height='1000px' style="width: 256px; height: 256px;"></canvas>
                    </div>
                    <div class="ft-recipe__contento">
                        <header class="content__header">
                            <div class="row-wrapper text-center justify-content-between">
                                <h2 class="recipe-title feed-tile-name"> Keresett Feltétek <span class="h3">(min.&nbsp;1)</span>   </h2>
                                <h2 class="recipe-title feed-tile-name"> <span id="feltet-counter">0</span>/10 </h2>

                            </div>
                            <h5 class="text-danger" id="error-tag" style="display: none;">Ide a hiba visszajelzés</h5>
                        </header>

                        <ul id="feltetList" class="felteteklista">

                        </ul>

                        <footer class="content__footer align-self-end ">
                            <a id="search-button" style="margin-right: 10px" type="button" onclick="startRequestPizzas()">Keresés</a>
                            <a type="button" onclick="unsetMaterials()">Törlés</a>
                        </footer>
                    </div>
                </div>
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
        <div class="justify-content-around nopizza" id="resultContainer">


        </div>

    </div>

    <script>
        var materials = [];
        var URL = "{{ url("/") }}"

        function startRequestPizzas(){
            if (!isValid()) {
                return;
            }
            window.scrollBy({
                top: 100,
                behavior: 'smooth'
            });
            document.getElementById("search-button").disabled = true;
            document.getElementById('picker-loader').style.display = 'inline';
            console.log('Keresett material tomb: ' +  materials)
            document.getElementById('resultContainer').innerHTML = '';
            getPizzasByMaterials(materials)

        }

        function isValid(){
            if (materials.length < 1) {
                document.getElementById('error-tag').innerHTML = 'Legalább 1 feltét kiválasztása szükséges';
                document.getElementById('error-tag').style.display = 'inline';
                return false;
            }

            if (materials.length > 10) {
                document.getElementById('error-tag').innerHTML = 'Legfeljebb 10 feltét kiválasztása lehetséges';
                document.getElementById('error-tag').style.display = 'inline';
                return false;
            }

            document.getElementById('error-tag').style.display = 'none';

            return true;

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


        function getPizzasByMaterials(materials) {
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
                    endRequestSuccess(response);
                },
                error: function (request, status, error) {
                    endRequestError(request, status, error)
                }
            });

        }

        //Kiválaszt egy Materialt
        function setMaterial(materialId, materialName) {

            if(materials.includes(materialId)){
                if (baseMaterialPicked && (materialId == pickedBaseMaterialId)) {
                    pickedBaseMaterialId = -1;
                    baseMaterialPicked = false;
                }

                $("#material-"+materialId).removeClass('kivanvalasztva');

                const index = materials.indexOf(materialId);
                if (index > -1) {
                    materials.splice(index, 1);
                }

                var li = $('#active-material-' + materialId);
                li.remove();

                removeFromCanvas(materialId);

            }else {
                isBaseMaterialAlreadyPicked(materialId);

                 if (materials.length > 9) {
                    document.getElementById('error-tag').innerHTML = 'Legfeljebb 10 feltét kiválasztása lehetséges';
                    document.getElementById('error-tag').style.display = 'inline';
                    return;
                }

                document.getElementById('error-tag').style.display = 'none';

                $("#material-"+materialId).addClass('kivanvalasztva');

                materials.push(materialId);

                var ul = document.getElementById("feltetList");
                var li = document.createElement("li");

                specificId = 'active-material-' + materialId;
                li.setAttribute('id', specificId);
                li.innerHTML = "<span>" + materialName + "</span>" + "<i class='far fa-times-circle picker-delete-button' onclick='setMaterial(" + materialId + ", &apos;" + materialName + "&apos; )'></i>";
                ul.appendChild(li);
                addToCanvas(materialId);
            }

            document.getElementById("feltet-counter").innerHTML = materials.length;

        }

        //Kiválasztott materialok törlése, ez az ürités gomb methodusa
        function unsetMaterials() {

            materials.forEach(materialId => {
                $("#material-" + materialId).toggleClass('kivanvalasztva');
                var li = document.getElementById('active-material-' + materialId);
                li.remove();

            });
            document.getElementById("feltet-counter").innerHTML = 0;

            pickedBaseMaterialId = -1;
            baseMaterialPicked = false;

            materials = [];
            canvasdata.selected = [];
            renderCanvas();
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

        baseMaterialPicked = false;
        pickedBaseMaterialId = -1;
        baseMaterials = @JSON($baseMaterialIds);
        function isBaseMaterialAlreadyPicked(materialId){

            if(baseMaterials.includes(materialId)){

                if(baseMaterialPicked){
                    $("#material-" + pickedBaseMaterialId).toggleClass('kivanvalasztva');
                    var li = document.getElementById('active-material-' + pickedBaseMaterialId);
                    li.remove();
                    removeFromCanvas(pickedBaseMaterialId)
                    const index = materials.indexOf(pickedBaseMaterialId);
                    if (index > -1) {
                        materials.splice(index, 1);
                    }

                    pickedBaseMaterialId = materialId

                    console.log("Alrdy picked")
                }else{
                    console.log("Not yet picked")
                    baseMaterialPicked = true;
                    pickedBaseMaterialId = materialId
                }

            }

        }
        let canvasdata = {};
        function initCanvas(){
            var ctx = document.getElementById("pizzacanvas").getContext('2d');
            pizzapickerdata[7] = pizzapickerdata[1];
            pizzapickerdata[1] = {};
            canvasdata.selected = [];
        }

        function addToCanvas(id){
            //console.log("addToCanvas",id)
            canvasdata.selected.push(id);
            renderCanvas();
        }

        function removeFromCanvas(id){
           // console.log("remove from canvas",id)
            const index = canvasdata.selected.indexOf(id);
            if (index > -1) {
                canvasdata.selected.splice(index, 1);
            }
            renderCanvas();
        }

        function renderCanvas(dontrunagain){

            let canvas = document.getElementById("pizzacanvas");
            let ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < pizzapickerdata.length; i++) {
                if(typeof pizzapickerdata[i].materials != 'undefined'){
                    for (let j = 0; j < pizzapickerdata[i].materials.length; j++) {
                        //console.log(pizzapickerdata[i][j])
                        if(canvasdata.selected.includes(pizzapickerdata[i].materials[j].id)){

                            var img = new Image();
                            img.onload = function() {
                                let canvas = document.getElementById("pizzacanvas");
                                let ctx = canvas.getContext('2d');
                                ctx.drawImage(this, 0, 0, canvas.width, canvas.height);
                                if(!dontrunagain){
                                    renderCanvas(true);
                                }
                            };
                            img.src = "/img/generated_assets/" + pizzapickerdata[i].materials[j].id + ".png";
                        }
                    }
                }

            }
        }

        let pizza = new Pizza('picker-loader')
        initCanvas();
        ;(function update() {
        requestAnimationFrame(update)
        pizza.update()

        }())

    </script>
</div>
@endsection
