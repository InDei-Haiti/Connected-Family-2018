@extends('dashboard.layouts.master')
@section('title', "NOT Found")
@section('container')
  <div class="row noselect">
    <div class="col-md-6 col-md-offset-3 text-center align-self-center">
      <img src="data:image/png;base64,{{ Imager::getBase64('adds-on', 'oops.png', '256')}}" 
            style="width: 50%; height: 50%;">
      <h1 style="font-size: 72px;">404</h1>
      <h3>Your request is</h3>
      <h2 style="font-size: 48px;">NOT Found</h2>
    </div>
  </div>
@stop

