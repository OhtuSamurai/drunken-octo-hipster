<!doctype html>
<html>
<head>
  <title>oona</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{HTML::style('bootstrap-3.3.2-dist/css/bootstrap.min.css')}}
  {{HTML::style('bootstrap-3.3.2-dist/css/bootstrap-theme.min.css')}}
  {{HTML::style('main.css')}}
  {{HTML::script('javascript/jquery-1.11.2.min.js')}}  
  {{HTML::script('bootstrap-3.3.2-dist/js/bootstrap.min.js')}}
  @yield('pagehead')
</head>
<body>
<div class="container">
@include('layouts.navigation')
@if (!($errors->first()==NULL))
	<div class="alert alert-danger">
		@foreach ($errors->getMessages() as $error)
			 <b>{{$error[0];}}</b>	
		@endforeach
	</div> 
@endif

@if (Session::has('success'))
  <div class="alert alert-success">
       <b>{{Session::get('success')}}</b>  
  </div> 
@endif

@if (Session::has('info'))
	<div class="alert alert-info">
		<p>{{Session::get('info')}}</p>
	</div>
@endif

<div class="container-fluid">
  @yield('content')
</div>
</div>
</body>
</html>
