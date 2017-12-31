@extends('dashboard.layouts.master')
@section('title', "Access Forbidden")
@section('container')
  <div class="row noselect">
    <div class="col-md-6 col-md-offset-3 text-center align-self-center">
      <img src="data:image/png;base64,{{ Imager::getBase64('adds-on', 'oops.png', '256')}}" 
            style="width: 50%; height: 50%;">
      <h1 style="font-size: 72px;">401</h1>
      <h3>Your request is</h3>
      <h2 style="font-size: 48px;">Forbidden!</h2>
      <h3>You don't have access rights for this content</h3>
      <h5>You can ask administrator to give you an access to this content.</h5>
    </div>
  </div>
@stop

