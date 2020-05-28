
@extends('layouts.app')
@section('title')
    PizzaPrices - Főoldal
@endsection
@section('content')
<object onload="console.log('loaded missing logo')"
        onerror="console.log('error loading missing logo')" id="obj" data="{{ url('/') }}/img/generated_feltetek/5.png" type="image/png">
    <img onload="console.log('belsoloaded missing logo')"
         onerror="console.log('belsoerror loading missing logo')" class="mx-auto d-block feed-tile-img" src="{{ url('/') }}/img/pizzapop.png" alt=""/>
</object>





<script>

    function logEvt(e) {console.log( e + 'penisz')}
    var obj = document.getElementById('obj');




</script>
@endsection
