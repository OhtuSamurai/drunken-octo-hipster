@extends('layouts.master')

@section('content')
<div class="col-md-7">
  <h1>Poolin ulkopuoliset käyttäjät</h1>
  <a href="/user/create" class="btn btn-primary" role="button">Luo uusi käyttäjä</a>
  @include('user._form')
</div>
@stop
