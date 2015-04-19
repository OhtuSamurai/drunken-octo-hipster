@extends('layouts.master')

@section('content')
	<div class="row">
  <h1>Meneillään olevat kyselyt</h1>
	</div>
	<div class="row">
	@include('poll.list')
	</div>
	{{ob_start();$polls=$closed;ob_end_clean()}}
	<div class="row">
	<h1>Suljetut kyselyt</h1>
	</div>
	<div class="row">
	@include('poll.list')
	</div>
@stop
