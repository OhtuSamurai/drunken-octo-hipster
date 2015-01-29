<!doctype html>
<html>
<head>
  <title>oona</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{HTML::style('bootstrap-3.3.2-dist/css/bootstrap.min.css')}}
  {{HTML::style('bootstrap-3.3.2-dist/css/bootstrap-theme.min.css')}}
  {{HTML::style('main.css')}}
  {{HTML::script('bootstrap-3.3.2-dist/js/bootstrap.min.js')}}
  <style>
    body{
      padding-top: 70px;
      }
  </style>
</head>
<body>
<div class="container-fluid">
  @yield('content')
</div>
</body>
</html>
