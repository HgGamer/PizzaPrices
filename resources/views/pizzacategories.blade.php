@extends('layouts.app')
@section('content')
    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.webp')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5">
        <h2>Kategóriák</h2>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/home">Kezdőlap</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kategóriák</li>
        </ol>
    </section>

    <div class="container">
        <div class="kategorialeiras text-center">
            <h1>Ha a kategóriák között nem találod kedvenc pizzáidat akkor csekkold a <span><a style="color: #FFA600" href="">Pizza Buildert</a></span> és állítsd össze te!</h1>
        </div>
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-4 col-md-6 col-sm-12 image-gallery">
                <a href="/kategoriak/{{ $category->link }}" style="background-image: url('{{ asset('/img/glry')}}/{{$category->url}}');">
                    <div class="kategoraibox align-self-end d-flex text-center">
                        <h2 class="align-self-end">
                            {{$category->name}}
                        </h2>
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
