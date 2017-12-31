@extends('layouts.master')
@section('title')
  Login
@stop
@section('container')
  @include('vendor.clear')
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">
      <div class="card">
        <div class="card-header text-center">Login</div>
        <div class="card-block">
          @if(Session::has('msg'))
            <div class="alert alert-danger">
              {{ Session::get('msg') }}
            </div>
          @endif
          @include('auth.vendor.login')
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop
