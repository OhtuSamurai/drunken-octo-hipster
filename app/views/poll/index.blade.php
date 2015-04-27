@extends('layouts.master')

@section('content')
	<div class="row">
	<div class="col-md-5">
  <h1>Meneillään olevat kyselyt</h1>
	@include('poll.list')
	</div>
	<div class="col-md-1">
	{{ob_start();$polls=$closed;ob_end_clean()}}
	</div>
	<div class="col-md-3">
	<h1>Suljetut kyselyt</h1>
	@include('poll.list')
	</div>
	</div>
@stop
