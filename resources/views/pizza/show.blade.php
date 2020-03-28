@extends('layouts.app')
@section('content')


        <div class="container-fluid bg">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="justify-content-center d-flex align-items-center pizzakep">
                        <img class="mx-auto d-block" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 justify-content-center d-flex align-items-center">
                    <div class="justify-content-center d-flex align-items-center tabla">
                        <img class="img-fluid" src="{{ asset('img/table.png') }}" alt="">
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

@endsection
