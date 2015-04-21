@extends('layouts.master')
@section('content')

<h1> Yleisiä tilastoja</h1>
<div class="row">
<div class="col-md-3">
<h3>Käyttäjät</h3>
	<table class="table table-striped">
		<tr>
			<td>Käyttäjiä</td>
			<td>{{$tilasto->n_users}}</td>
		</tr>
		<tr>
			<td>Käyttäjiä toimikunnissa</td>
			<td>{{$tilasto->n_komiteoissa}}</td>
		</tr>
		<tr>
			<td>Käyttäjiä poolissa</td>
			<td>{{$tilasto->n_pooli}}</td>
		</tr>
		<tr>
			<td>Käyttäjiä kyselyissä</td>
			<td>{{$tilasto->n_kyselyissa}}</td>
		</tr>
	</table>
</div>
<div class="col-md-3">
<h3>Toimikunnat ja kyselyt</h3>
	<table class="table table-striped">
		<tr>
			<td>Kyselyjä</td>
			<td>{{$tilasto->n_polls}}</td>
		</tr>
		<tr>
			<td>Avoimia kyselyjä</td>
			<td>{{$tilasto->n_openpolls}}</td>
		</tr>
		<tr> 
			<td>Toimikuntia</td>
			<td>{{$tilasto->n_committees}}</td>
		</tr>
		<tr>
			<td>Avoimia toimikuntia</td>
			<td>{{$tilasto->n_opencommittees}}</td>
		</tr>
	</table>
</div>
<div class="col-md-3">
<h3>Liitteet</h3>
	<table class="table table-striped">
		<tr>
			<td>Liitteitä</td>
			<td>{{$tilasto->n_attachments}}</td>
		</tr>
		<tr>
			<td>Liiitteiden yhteenlaskettu koko (MB)</td>
			<td>{{$tilasto->attachmentsize}}</td>
		</tr>
	</table>
</div>
</div>
<div class="row">
<div class="col-md-9">
<h1>Käyttäjäkohtaisia tilastoja</h1>
@include('user.listwithdate')
</div>
</div>
@stop
