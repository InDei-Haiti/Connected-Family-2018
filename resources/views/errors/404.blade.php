@extends('layouts.master')
@section('title', "404")
@section('container')
  @include('vendor.clear')
  <div class="row noselect">
    <div class="col-md-6 offset-md-3 text-center align-self-center">
      <img src="data:image/png;base64,{{ Imager::getBase64('adds-on', 'oops.png', '256')}}" style="width: 248px;">
      <h2 style="font-size: 48px;">404</h2>
      <h4>The requested page is</h4>
      <h2 style="font-size: 48px;">NOT FOUND!</h2>
    </div>
  </div>
@stop

