
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

    //

    let isIOS = (/iPad|iPhone|iPod/.test(navigator.platform) || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1)) && !window.MSStream

    if (isIOS){
        console.log("IOS PASZTMEK")
        obj.addEventListener(   'error',   loadFallBack());
    }else{
        console.log("sad windows noises")
    }

</script>
@endsection
