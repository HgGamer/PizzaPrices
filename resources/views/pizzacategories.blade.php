@extends('layouts.app')
@section('content')
    <section class="banner_area" style="background: url('{{ asset('/img/pizza2.jpg')}}') no-repeat fixed; background-position: center;" data-stellar-background-ratio="0.5"></section>

    <div class="container">
        <div class="image-gallery">
            <a href="{{ asset('images/gallery/img-1.jpg') }}" class="img-1">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
            <a href="{{ asset('images/gallery/img-2.jpg') }}" class="img-2">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
            <a href="{{ asset('images/gallery/img-3.jpg') }}" class="img-3">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
            <a href="{{ asset('images/gallery/img-3.jpg') }}" class="img-4">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </div>
    </div>



@endsection
