
@extends('layouts.app')
@section('title')
    PizzaPrices - Főoldal
@endsection
@section('content')

<div class="row">
    <div class="col-6">
        <object class="generated-image" data="{{ url('/') }}/img/generated_feltetek/5.png" type="image/png">
            <img class="mx-auto d-block feed-tile-img" src="{{ url('/') }}/img/pizzapop.png" alt=""  height="400px;" width="400px;"/>
        </object>
    </div>
    <div class="col-6">
        <object class="generated-image" data="{{ url('/') }}/img/generated_feltetek/5.png" type="image/png" >
            <img class="mx-auto d-block feed-tile-img" src="{{ url('/') }}/img/pizzapop.png" alt=""  height="400px;" width="400px;"/>
        </object>
    </div>
</div>



<script>




function loadFallBackImage(element){

    element.setAttribute('data', 'https://i.ytimg.com/vi/upEnR4VztOQ/hqdefault.jpg');
}

let isIOS = (/iPad|iPhone|iPod/.test(navigator.platform) || (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1)) && !window.MSStream
let isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

if (isIOS || isSafari){

    var objectsArray = document.getElementsByClassName('generated-image');
        if(objectsArray.length > 0){
            Array.prototype.forEach.call(objectsArray, function(el) {

                el.addEventListener(   'error',   loadFallBackImage(el));
        });
    }

}else{
        console.log("sad windows noises")
}

</script>
@endsection
