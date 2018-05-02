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
<body onload="window.print()">
  <div id="app">
    <div class="container bg-light py-3">
        @yield('content')
    </div>
    <footer>
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
