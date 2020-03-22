@extends('layouts.app')
@section('content')


<style>
    .footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      text-align: center;
    }
    </style>

<div id="cookie-footer" class="footer">
    <div class="container">
        <p class="h6 p-2">
            Sütiket alkalmazunk, hogy megértsük, hogyan használod az oldalt és javítsuk a felhasználói élményt.
            <a href="#" class="btn btn-success btn-sm"  onclick="setCookiePolicyCookie()">Elfogadás</a>
            <a href="#"  class="btn btn-primary btn-sm">Részletek</a>
        </p>
    </div>
</div>

@endsection
