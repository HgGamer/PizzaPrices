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
           <div class="col-4">
               <div class="card">
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
                   <div class="card-body">

                   </div>
               </div>
           </div>
           <div class="col-4">
               <div class="card">
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
                   <div class="card-body">

                   </div>
               </div>
           </div>
           <div class="col-4">
               <div class="card">
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
                   <div class="card-body">

                   </div>
               </div>
           </div>

       </div>
    </div>

@endsection


