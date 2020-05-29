@extends('layouts.app')
@section('title')
PizzaPrices - Kategóriák
@endsection
@section('content')
    <section class="banner_area" data-stellar-background-ratio="0.5">
        <h2>Kategóriák</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kategóriák</li>
        </ol>
    </section>

    <div class="container">
        <h1 class="nincshteg">Pizza  Kategóriák</h1>
        <div class="kategorialeiras text-center">
            <h3>Ha a kategóriák között nem találod kedvenc pizzáidat akkor csekkold a <span><a style="color: #FFA600" href="/pizzapicker">Pizza Pickert</a></span> és állítsd össze te!</h3>
        </div>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-4 col-md-6 col-sm-12 image-gallery">
                <a href="/kategoriak/{{ $category->link }}">
                    <picture>
                        <source srcset="{{ asset('/img/glry')}}/{{$category->url}}.webp" type="image/webp">
                        <img class="object-fit_cover" src="{{ asset('/img/glry')}}/{{$category->url}}.jpg" alt="kategoriak" />
                    </picture>
                    <div class="kategoraibox align-self-end d-flex text-center">
                        <h3 class="align-self-end">
                            {{$category->name}}
                        </h3>
                    </div>
                </a>
            </div>
           @endforeach
        </div>
    </div>


    <script>
        $(window).scroll(function () {
            $('nav').toggleClass('scrolled',$(this).scrollTop()>660)
        });
    </script>
@endsection
