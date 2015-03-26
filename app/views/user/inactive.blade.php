@extends('layouts.master')
@section('pagehead')
  {{HTML::script('javascript/inactive.js')}}
@stop
@section('content')
<div class="col-md-7">
  <h1>Poolin ulkopuoliset käyttäjät</h1>
  <a href="/user/create" class="btn btn-primary" role="button">Luo uusi käyttäjä</a>
  @include('user.list')
</div>
@stop
