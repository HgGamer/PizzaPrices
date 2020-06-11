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
                   <div class="card-body checkbox-fontawesome checkbox-success">
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
                   <div class="card-body checkbox-fontawesome checkbox-success row justify-content-center">
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
                <footer class="content__footer align-self-end "><a href="" rel="noopener" target="_blank">Keresés</a></footer>
            </div>
        </div>
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



    </script>


@endsection


