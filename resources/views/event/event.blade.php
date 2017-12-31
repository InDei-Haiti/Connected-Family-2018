@extends('layouts.master')
@section('title')
  {{ $event->name }}'@php
    echo substr($event->year, 2);
  @endphp
@stop
@section('container')
  <div class="row">
    <div class="col align-self-center text-center">
      <div class="card margin-15 w-100">
        <div class="row">
          <div class="col-lg-3 col-sm-12 text-center align-self-start">
            <p class="font-weight-bold">
              <span class="fa-stack fa-5x">
                <i class="fa fa-circle fa-stack-2x font-cyan"></i>
                <span class="fa-stack-1x font-28 font-dosis fa-inverse">
                  {{ $event->name }}
                </span>
              </span>
            </p>
          </div>
          <div class="col-lg-6 col-sm-12 align-self-center text-left">
            <div class="card-block">
              <h4 class="card-title font-weight-bold text-center">
                {{ $event->name }}'@php
                  echo substr($event->year, 2);
                @endphp
              </h4>
              <p class="card-text text-center"
                @if($event->id == 11005 || $event->id == 11006)
                  style="direction: rtl;"
                @endif
              >
                @if($event->description)
                  {!! nl2br($event->description) !!}
                @else
                  No Description Found
                @endif
              </p>
            </div>
          </div>
          <div class="col-lg-3 col-sm-12 align-self-start text-center"
                style="margin: 17px 0px;">
            <div class="row">
              <div class="col-12 text-lg-left text-center">
                @if($event->isClosed())
                  Registration: <b>Closed</b><br>
                  Started at: <b>{{ Date::format($event->started_at, "event") }}</b><br>
                  Ended at: <b>{{ Date::format($event->ended_at, "event") }}</b><br>
                @endif
                @if($event->isOpened())
                  Registration: <b><a href="/event/{{ $event->name }}-{{ $event->year }}/registration">Opened</a></b><br>
                  Started at: <b>{{ Date::format($event->started_at, "event") }}</b><br>
                  Will end at: <b>{{ Date::format($event->ended_at, "event") }}</b><br>
                @endif
                @if($event->isUpcoming())
                  Registration: <b>Upcoming</b><br>
                  Will start at: <b>{{ Date::format($event->started_at, "event") }}</b><br>
                  Will end at: <b>{{ Date::format($event->ended_at, "event") }}</b><br>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5>
            <i class="fa fa-star" aria-hidden="true"></i> |
            <b>Preferences</b>
          </h5>
        </div>
        <div class="card-body clear-card">
          @forelse($event->preferences as $preference)
            <div class="row">
              <div class="col">
                <h3>{{ $loop->iteration }}. <span class="font-cyan">{{ $preference->name }} {{ $preference->type }}</span></h3>
                <b>Description:</b>
                @if($preference->description)
                  {{ $preference->description }}
                @else
                  No Description Found
                @endif
                <br>
                <b>Available for college(s)</b>:
                @forelse($preference->colleges as $college)
                  {{ $college->name }}@if(!$loop->last),@endif
                @empty
                  ALL Colleges
                @endforelse
                <br>
                <b>Available for year(s)</b>:
                @if($preference->min_academic_year)
                  {{ $preference->min_academic_year->name }} (or greater)
                @else
                  ALL Years
                @endif
                <br>
                <b>Available for department(s)</b>:
                @if(count($preference->departments) > 0)
                  <br>
                  <ul>
                    @foreach($preference->departments as $department)
                      <li>{{ $department->group->name }} - {{ $department->name }}</li>
                    @endforeach
                  </ul>
                @else
                  ALL Departments
                @endif
                @php
                  if($event->id == 11002 && $loop->iteration >= 3) break;
                @endphp
              </div>
            </div>
            @if(!$loop->last)<hr>@endif
          @empty
            <center>
              <span class="text-muted text-uppercase">no preferences found</span>
            </center>
          @endforelse
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop
