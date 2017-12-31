@extends('layouts.master')
@section('title')
  Register
@stop
@section('container')
  @include('vendor.clear')
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">
      <div class="card">
        <div class="card-header text-center">Register</div>
        <div class="card-block">
        @include('auth.vendor.register')
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop
