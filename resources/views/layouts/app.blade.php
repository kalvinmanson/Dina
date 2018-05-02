<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"  content="@yield('meta-keywords')">
    <meta name="description"  content="@yield('meta-description')" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


</head>
<body>
  <div id="app">
    <header class="bg-dark">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
          <a class="navbar-brand" href="/">MS Dina</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          @if(Auth::check())
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              @if(Auth::user()->carts->count() > 0)
              <li class="nav-item active">
                <a class="btn btn-outline-primary rounded" href="/cart">
                  <i class="fa fa-shopping-cart"></i> Carro <span class="badge badge-pill badge-primary">{{ Auth::user()->carts->count() }} </span>
                </a>
              </li>
              @endif
              <li class="nav-item pl-2">
                <a class="btn btn-outline-primary rounded" href="/orders"><i class="fa fa-exchange"></i> Pedidos</a>
              </li>
              <li class="nav-item">
                <span class="nav-link"> Presupuesto actual: $ {{ number_format(Auth::user()->budget) }} </span>
              </li>
              <li class="nav-item">
                  <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i></a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
              </li>
            </ul>
          </div>
          @endif
        </nav>
      </div>
    </header>
    <div class="container">
        @include('flash::message')
        @include('partials.errors')
    </div>
    <div class="container bg-light py-3">
        @yield('content')
    </div>
    <footer class="bg-dark text-white">
      <div class="container py-2">
          <p>&copy; 2018 By <a href="//droni.co" title="Desarrollo Inteligente">Droni.co</a></p>
      </div>
    </footer>
  </div>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="/js/app.js"></script>
  @yield('scripts')
</body>
</html>
