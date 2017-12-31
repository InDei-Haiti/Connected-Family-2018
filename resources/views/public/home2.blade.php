@extends('layouts.master')

@section('title')
  Home2
@stop
@php
        if(!isset($new_event)) $new_event = $event;
      @endphp
@section('container')
  @include('vendor.clear')
  <div class="row">
    <div class="col-lg-7">
      <div class="row align-items-center">
        <div class="col-md-3 text-center">
          <i class="fa fa-users font-cyan" style="font-size: 108px;"></i>
          <div class="d-block d-md-none"><br></div>
        </div>
        <div class="col-md-9">
          <h1 class="font-cookie font-black"><span class="font-cyan font-cookie">Connected</span> <span class="font-pink font-cookie">Family</span> Profiles</h1>
          <p class="font-black">
            Easy and quick registration. Easy to edit your preferences and interview or group discussion dates
            <br>
            <a href="{{ route('terms-and-privacies') }}">
              Read more about profiles, terms, and privacy
            </a>
            <br><br>
            <a href="/auth/register" class="">
              <button class="btn btn-success cursor-pointer"><i class="fa fa-edit" aria-hidden="true"> </i> Register NOW!</button>
            </a>
          </p>
        </div>
      </div>
      <hr>
      {{-- <div class="row">
        <div class="col-md-9">
          <h2>Register with Facebook or Linkedin</h2>
          <p class="font-black">
            Now you can register and login with facebook<br><br>
            <a class="btn btn-sm btn-primary bg-fb" href="{{ route('auth.social', ['provider' => 'facebook', 'wants' => "login"]) }}" role="button">
              <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i>
              Login with Facebook
            </a>&#160;
            <a class="btn btn-sm btn-primary bg-linkedin" href="{{ route('auth.social', ['provider' => 'linkedin', 'wants' => "login"]) }}" role="button">
              <i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i>
              Login with Linkedin
            </a>
          </p>
        </div>
        <div class="col-md-3">
          <i class="fa fa-facebook-square font-fb fa-3x" aria-hidden="true" style=""></i>
          &#160;&#160;
          <i class="fa fa-linkedin-square font-linkedin fa-3x" aria-hidden="true" style=""></i>
        </div>
      </div>
      <hr> --}}
      <div class="row align-items-center">
        <div class="col-md-3 text-center">
          <i class="fa fa-calendar font-pink" style="font-size: 108px;" aria-hidden="true"></i>
          <div class="d-block d-md-none"><br></div>
        </div>
        <div class="col-md-9">
          <h1><span class="font-cookie font-cyan" style="font-size: 48px;">{{ $new_event->name }}'@php echo substr($new_event->year, 2); @endphp</span> Event</h1>
          <p class="font-black" style="
            display: inline-block;
            @if($event->id == 11005 || $event->id == 11006)
              direction: rtl;
            @endif
          "
          >
            @if($new_event->description)
              {{-- @if(strlen($new_event->description) > 100) --}}
                {!! nl2br(substr($new_event->description, 0, 1024)) !!}...
              {{-- @endif --}}
            @else
              No Description Found
            @endif
            <a href="/event/{{ $new_event->name }}-{{ $new_event->year }}">More Info</a><br>
          </p>
          <p>
            {{ $new_event->name }}'@php echo substr($new_event->year, 2); @endphp is
            @if($new_event->isUpcoming())
              <b>Upcoming at {{ Date::format($new_event->started_at, "event") }}</b><br>
            @elseif($new_event->isOpened())
              <b>Opened at {{ Date::format($new_event->started_at, "event") }}</b><br><br>
              <a href="/event/{{ $new_event->name }}-{{ $new_event->year }}/registration"><button class="btn btn-success cursor-pointer">Register now</button></a><br>
            @else
              <b>Closed at {{ Date::format($new_event->ended_at, "event") }}</b><br>
            @endif
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="d-block d-lg-none"><hr></div>
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
      @include('vendor.clear')
    </div>
  </div>
  @include('vendor.clear')
@stop

@section('scripts')

@stop
