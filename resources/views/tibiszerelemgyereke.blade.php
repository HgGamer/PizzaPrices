
@extends('layouts.app')
@section('title')
    PizzaPrices - Főoldal
@endsection
@section('content')
<object id="obj" data="{{ url('/') }}/img/generated_feltetek/5.png" type="image/png">
    <img class="mx-auto d-block feed-tile-img" src="{{ url('/') }}/img/pizzapop.png" alt=""/>
</object>





<script>


    var obj = document.getElementById('obj');


    function loadFallBack(){
        document.getElementById("obj").setAttribute('data', 'https://i.ytimg.com/vi/upEnR4VztOQ/hqdefault.jpg');
    }

    obj.addEventListener(   'error',   loadFallBack());


</script>
@endsection
