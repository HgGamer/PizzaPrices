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
           <div class="col-lg-4 col-md-6 col-sm-12">
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
                   <div class="card-body checkbox-fontawesome checkbox-success row justify-content-center align-items-center text-center">
                       <div class="col-12 checkbox">
                           <label for="checkbox-fa1"><input id="checkbox-fa1" type="checkbox"/>26Cm</label>
                       </div>
                       <div class="col-12 checkbox">
                           <label for="checkbox-fa2"><input id="checkbox-fa2" type="checkbox"/>28Cm</label>
                       </div>
                       <div class="col-12 checkbox">
                           <label for="checkbox-fa3"><input id="checkbox-fa3" type="checkbox"/>30Cm</label>
                       </div>
                       <div class="col-12 checkbox">
                           <label for="checkbox-fa4"><input id="checkbox-fa4" type="checkbox"/>32Cm</label>
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
                   <div class="card-body checkbox-fontawesome checkbox-success row justify-content-center align-items-center">
                       <div class="checkbox">
                           <label for="checkbox-fa15"><input id="checkbox-fa15" type="checkbox" checked=""/>1500Ft alatt</label>
                       </div>
                       <div class="checkbox">
                           <label for="checkbox-fa6"><input id="checkbox-fa6" type="checkbox"/>1500-2000Ft</label>
                       </div>
                       <div class="checkbox disabled">
                           <label for="checkbox-fa3"><input id="checkbox-fa7" type="checkbox"/>2000Ft felett</label>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-lg-4 col-md-6 col-sm-12">
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
                       <div class="card-body checkbox-fontawesome  checkbox-success row justify-content-center align-items-center">
                           @foreach()
                           <div class="checkbox">
                               <label for="checkbox-fa1"><input id="checkbox-fa1" type="checkbox" checked=""/>Checkbox 1</label>
                           </div>
                           @endforeach
                           <div class="checkbox">
                               <label for="checkbox-fa2"><input id="checkbox-fa2" type="checkbox"/>Checkbox 2</label>
                           </div>
                           <div class="checkbox disabled">
                               <label for="checkbox-fa3"><input id="checkbox-fa3" type="checkbox"/>Checkbox 3</label>
                           </div>
                           <div class="checkbox">
                               <label for="checkbox-fa1"><input id="checkbox-fa1" type="checkbox" checked=""/>Checkbox 1</label>
                           </div>
                           <div class="checkbox">
                               <label for="checkbox-fa2"><input id="checkbox-fa2" type="checkbox"/>Checkbox 2</label>
                           </div>
                           <div class="checkbox disabled">
                               <label for="checkbox-fa3"><input id="checkbox-fa3" type="checkbox"/>Checkbox 3</label>
                           </div>
                           <div class="checkbox">
                               <label for="checkbox-fa1"><input id="checkbox-fa1" type="checkbox" checked=""/>Checkbox 1</label>
                           </div>
                           <div class="checkbox">
                               <label for="checkbox-fa2"><input id="checkbox-fa2" type="checkbox"/>Checkbox 2</label>
                           </div>
                           <div class="checkbox disabled">
                               <label for="checkbox-fa3"><input id="checkbox-fa3" type="checkbox"/>Checkbox 3</label>
                           </div>
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


@endsection


