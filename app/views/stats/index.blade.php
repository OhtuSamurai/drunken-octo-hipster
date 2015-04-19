@extends('layouts.master')
@section('content')

<div class="col-md-7">
<h1> Yleisiä tilastoja</h1>
<h3>Käyttäjät</h3>
	<table class="table table-striped">
		<tr>
			<td>Käyttäjiä</td>
			<td>{{$tilasto->n_users}}</td>
			<td></td>
			<td>Käyttäjiä toimikunnissa</td>
			<td>{{$tilasto->n_komiteoissa}}</td>
		</tr>
		<tr>
			<td>Käyttäjiä poolissa</td>
			<td>{{$tilasto->n_pooli}}</td>
			<td></td>
			<td>Käyttäjiä kyselyissä</td>
			<td>{{$tilasto->n_kyselyissa}}</td>
		</tr>
	</table>
<h3>Toimikunnat ja kyselyt</h3>
	<table class="table table-striped">
		<tr>
			<td>Kyselyjä</td>
			<td>{{$tilasto->n_polls}}</td>
			<td></td>
			<td>Avoimia kyselyjä</td>
			<td>{{$tilasto->n_openpolls}}</td>
		</tr>
		<tr> 
			<td>Toimikuntia</td>
			<td>{{$tilasto->n_committees}}</td>
			<td></td>
			<td>Avoimia toimikuntia</td>
			<td>{{$tilasto->n_opencommittees}}</td>
		</tr>
	</table>

<h3>Liitteet</h3>
	<table class="table table-striped">
		<tr>
			<td>Liitteitä</td>
			<td>{{$tilasto->n_attachments}}</td>
			<td></td>
			<td>Liiitteiden yhteenlaskettu koko</td>
			<td>{{$tilasto->attachmentsize}}</td>
		</tr>
	</table>
</div>
<div class="col-md-7">
<h1>Käyttäjäkohtaisia tilastoja</h1>
@include('user.listwithdate')

@stop
