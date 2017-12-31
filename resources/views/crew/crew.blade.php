@extends('layouts.master')
@section('title')
  Crew'@php echo substr($year, 2); @endphp
@stop
@section('container')
  <div class="row">
    <div class="col align-self-center text-center">
      <div class="card margin-15 w-100">
        <div class="row">
          <div class="col-md-6 col-sm-12 text-center align-self-center">
            <p class="font-weight-bold">
              <span class="fa-stack fa-5x">
                <i class="fa fa-circle fa-stack-2x font-cyan"></i>
                <span class="fa-stack-1x font-28 font-dosis fa-inverse">
                  Crew'@php echo substr($year, 2); @endphp
                </span>
              </span>
            </p>
          </div>
          <div class="col-md-6 col-sm-12 align-self-center text-center"
                style="margin: 17px 0px;">
            @if(count($crewYears) > 1)
              <ul class="list-group" style="width: 128px; margin: 0 auto;">
                @foreach($crewYears as $crewYear)
                  <a
                    @if($crewYear->year != $year)
                      href="/crew/{{ $crewYear->year }}"
                    @endif
                    class="
                      @if($crewYear->year == $year)
                        noselect cursor-not-allowed
                      @endif
                    " style="margin: 0 auto; width: 70px;">
                    <li class="list-group-item
                      @if($crewYear->year == $year)
                        active
                      @endif
                    ">
                      {{ $crewYear->year }}
                    </li>
                  </a>
                @endforeach
              </ul>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    @foreach($members as $member)
      <div class="col-md-3 col-sm-4 align-self-center text-center">
        <div class="row">
          <div class="col">
            <a href="/profile/{{ $member->user->username }}">
              <img class="img-thumbnail" src="data:image/{{ $member->user->getImageMime() }};base64,{{ $member->user->getImageBase64('64') }}" style="
                      position: absolute;
                      width: 75%;
                      max-width: 64px;
                      max-height: 64px;
                      border-radius: 50%;
                      z-index: 1000;
                      left: 0;
                      right: 0;
                      margin-left: auto;
                      margin-right: auto;
                      margin-top: 15px;
              ">
            </a>
          </div>
        </div>
        <div class="card margin-15" style="margin-top: 47px; padding-top: 28px;">
          <div class="card-block">
            <div class="clearfix d-block d-lg-none"><br></div>
            <h5 class="card-title">{{ $member->user->name }}</h5>
            <p class="card-text" style="font-size: 14px;">
              {{ $member->committee->name }}, {{ $member->position->name }}
            </p>
            <a href="/profile/{{ $member->user->username }}" class="card-link" style="font-size: 14px;">
              View Profile
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @include('vendor.clear')
@stop
