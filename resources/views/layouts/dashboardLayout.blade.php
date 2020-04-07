<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Web Scraper</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{url('dashboard/')}}">Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/home')}}">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('dashboard/links') }}">Scraper</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('dashboard/process') }}">Process</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('dashboard/item-schema') }}">Item schemas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://analytics.google.com/analytics/web" target="_blank">Analytics</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Others
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ url('dashboard/websites') }}">Websites</a>
          <a class="dropdown-item" href="{{ url('dashboard/categories') }}">Categories</a>
          <a class="dropdown-item" href="{{ url('dashboard/logs') }}">Logs</a>
          <a class="dropdown-item" href="{{ url('dashboard/materials') }}">Materials</a>
          <a class="dropdown-item" href="{{ url('dashboard/pizzas') }}">Pizzas</a>
          <a class="dropdown-item" href="{{ url('dashboard/feedbacks') }}">Feedbacks</a>
          <a class="dropdown-item" href="{{ url('dashboard/fusion') }}">Fusion</a>
          <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('dashboard/pizza_categories') }}">Pizza Categories</a>
            <a class="dropdown-item" href="{{ url('dashboard/materials_categories') }}">Materials Categories</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav float-right">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Logged in: {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="">Menu1</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
           </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid my-5">
    <div class="row mx-5">
            @yield('content')
        </div>
    </div>
</div>

    @yield('script')
</body>
</html>
