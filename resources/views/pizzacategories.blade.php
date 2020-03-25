@extends('layouts.app')
@section('content')
    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.jpg')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5"></section>

    <div class="container">
        <div class="kategorialeiras text-center">
            <h1>Ha a kategóriák között nem találod kedvenc pizzáidat akkor csekkold a <span><a style="color: #FFA600" href="">Pizza Buildert</a></span> és állítsd össze te!</h1>
        </div>
        <div class="row">
            @foreach($Category as $category)
            <div class="col-lg-4 col-md-6 col-sm-12 image-gallery">
                <a href="" style="background-image: url('{{ asset('/img/glry')}}/{{$category->url}}');">
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
