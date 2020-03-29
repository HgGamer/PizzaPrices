@extends('layouts.app')
@section('content')
    <div class="bg">
        <div class="container-fluid">
            <div class="row">
                <div class="szelet">
                    <img class=" img-fluid" src="{{ asset('img/szelet.png') }}" alt=""/>
                </div>

                <div class="paradicsom">
                    <img class=" img-fluid" src="{{ asset('img/paradicsom.png') }}" alt=""/>
                </div>

                <div class="salata">
                    <img class=" img-fluid" src="{{ asset('img/salata.png') }}" alt=""/>
                </div>

                <div class="salami">
                    <img class=" img-fluid" src="{{ asset('img/salami.png') }}" alt=""/>
                </div>

                <div class="col-lg-6 col-md-12 justify-content-center d-flex align-items-center">
                    <div class="row">
                        <div class=" col-lg-12 justify-content-center d-flex align-items-center pizzanev">
                            <h1 class="text-center">XYZ Pizza</h1>
                        </div>
                        <div class="col-lg-12 justify-content-center d-flex align-items-center pizzakep">
                            <img class=" img-fluid mx-auto d-block" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 justify-content-center d-flex align-items-center">
                    <div class="justify-content-center d-flex align-items-center tabla">
                        <img class="img-fluid" src="{{ asset('img/tablaa.png') }}" alt="">
                        <ul class="feltetek position-absolute">
                            <li>PARADICSOMOSALAP</li>
                            <li>KOLBÁSZ</li>
                            <li>SONKA</li>
                            <li>KUKORICA</li>
                            <li>SAJT</li>
                            <li>UBORKA</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
