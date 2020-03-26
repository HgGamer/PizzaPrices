@extends('layouts.app')
@section('content')


        <div class="container-fluid bg">
            <div class="row">
                <div class="col-6">
                    <div class="justify-content-center d-flex align-items-center pizzakep">
                        <img class="mx-auto d-block" src="{{ asset('img/pizzapop.png') }}" alt=""/>
                    </div>
                </div>

                <div class="col-6 justify-content-center d-flex align-items-center">
                       <ul class="mx-auto d-block" style=" list-style-type: none; padding-left: 0">
                           <li style="color: white; font-size: 90px; font-family: kreta;">KOLBÁSZ</li>
                       </ul>
                </div>
            </div>
        </div>

@endsection
