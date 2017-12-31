@extends('layouts.master')
@section('title')
  Events
@stop
@section('container')
  @include('vendor.clear')
  <div class="row">
    @php $prevEventYear = 0; @endphp
    @foreach($events as $event)
      @if($prevEventYear != $event->year)
        </div>
        @if($loop->index > 0)<hr>@endif
        <div class="row">
          <div class="col text-center">
            <h2><b>@php echo substr($event->year, 2); @endphp's Events</b></h2>
          </div>
        </div>
        <div class="row">
      @endif
      @php $prevEventYear = $event->year; @endphp
      <div class="col-lg-3 col-md-6 col-sm-12 align-self-center text-center">
        <div class="card margin-15 w-100">
          <br>
          <p class="font-weight-bold">
            <a href="/event/{{ $event->name }}-{{ $event->year }}">
              <span class="fa-stack fa-5x">
                <i class="fa fa-circle fa-stack-2x font-cyan"></i>
                <span class="fa-stack-1x font-28 font-dosis fa-inverse">
                  {{ $event->name }}
                </span>
              </span>
            </a>
          </p>
          <div class="card-block">
            <h4 class="card-title">
              {{ $event->name }}'@php
                echo substr($event->year, 2);
              @endphp
            </h4>
            <p>
              @if($event->isUpcoming())
                <div class="row">
                  <div class="col">
                    Registration: <b> Upcoming </b><br>
                  </div>
                </div>
              @endif
              @if($event->isOpened())
                <div class="row">
                  <div class="col">
                    Registration: <b>
                      <a href="/event/{{ $event->name }}-{{ $event->year }}/registration">Opened</a>
                    </b><br>
                  </div>
                </div>
              @endif
              @if($event->isClosed())
                <div class="row">
                  <div class="col">
                    Registration: <b> Closed </b><br>
                  </div>
                </div>
              @endif
            </p>
            <a href="/event/{{ $event->name }}-{{ $event->year }}" class="card-link">
              More details
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @include('vendor.clear')
@stop


