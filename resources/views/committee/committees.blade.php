@extends('layouts.master')
@section('title')
  Committees
@stop
@section('container')
  <div class="row">
    @foreach($committees as $committee)
      <div class="col-lg-3 col-md-6 col-sm-12 align-self-center text-center">
        <div class="card margin-15 w-100">
          <p class="font-weight-bold">
            <a href="/committee/{{ $committee->short_name }}">
              <span class="fa-stack fa-5x">
                <i class="fa fa-circle fa-stack-2x font-cyan"></i>
                <span class="fa-stack-1x font-28 font-dosis fa-inverse">
                  {{ $committee->short_name }}
                </span>
              </span>
            </a>
          </p>
          <div class="card-block">
            <h5 class="card-title">{{ $committee->name }}</h5>
            <p class="card-text">
              @if($committee->description)
                {{ $committee->description }}
              @else
                No Description Found
              @endif
            </p>
            <a href="/committee/{{ $committee->short_name }}" class="card-link">
              View Committee
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @include('vendor.clear')
@stop

