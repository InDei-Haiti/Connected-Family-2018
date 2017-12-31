@extends('layouts.master')
@section('title')
  {{ $title }}
@stop
@section('container')
  @include('vendor.clear')
  <div class="row justify-content-center">
    <div class="col-12 text-center">
      <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-block clear-card">
          {!! $msg !!}
          <br>
          <a href="/">Go back to Home</a>
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop