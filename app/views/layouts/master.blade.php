<!doctype html>
<html>
<head>
  <title>oona</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{HTML::style('bootstrap-3.3.2-dist/css/bootstrap.min.css')}}
  {{HTML::style('bootstrap-3.3.2-dist/css/bootstrap-theme.min.css')}}
  {{HTML::style('main.css')}}
  {{HTML::script('bootstrap-3.3.2-dist/js/bootstrap.min.js')}}
  {{HTML::script('javascript/jquery-1.11.2.min.js')}}
  @yield('pagehead')
</head>
<body>
@include('layouts.navigation')
<div class="container-fluid">
  @yield('content')
</div>
</body>
</html>
