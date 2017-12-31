@extends('layouts.master')

@section('title', $event_name . " Registration")

@section('body')
  @include('vendor.nav')
@stop

@section('container')
  @include('vendor.clear')
  <div class="row noselect">
    <div class="col-md-6 offset-md-3 text-center align-self-center">
      <img class="w-75 h-75" src="data:image/png;base64,{{ Imager::getBase64('adds-on', 'oops.png', '512')}}" style="">
      <h1>Registration Closed</h1>
    </div>
  </div>
@stop

@section('footer')
  @include('vendor.clear')
  @include('vendor.footer')
@stop

