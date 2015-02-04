@extends('layouts.master')

@section('pagehead')
  {{HTML::script('javascript/pooli.js')}}
@stop

@section('content')
  <h1>Opetustaitotoimikuntapooli</h1>

  @include('user._form')
@stop
