@extends('layouts.master')
@section('title')
  {{ $committee->short_name }} Committee
@stop
@section('container')
  <div class="row">
    <div class="col align-self-center text-center">
      <div class="card margin-15 w-100">
        <div class="row">
          <div class="col-md-3 col-sm-12 text-center align-self-center">
            <p class="font-weight-bold">
              <span class="fa-stack fa-5x">
                <i class="fa fa-circle fa-stack-2x font-cyan"></i>
                <span class="fa-stack-1x font-28 font-dosis fa-inverse">
                  {{ $committee->short_name }}
                </span>
              </span>
            </p>
          </div>
          <div class="col-md-6 col-sm-12 align-self-center text-left">
            <div class="card-block">
              <h4 class="card-title font-weight-bold">{{ $committee->name }}</h4>
              <p class="card-text">
                @if($committee->description)
                  {{ $committee->description }}
                @else
                  No Description Found
                @endif
              </p>
            </div>
          </div>
          <div class="col-md-3 col-sm-12 align-self-center text-center"
                style="margin: 17px 0px;">
            @if(count($committeeYears) > 1)
              <ul class="list-group" style="width: 128px; margin: 0 auto;">
                @foreach($committeeYears as $committeeYear)
                  <a
                    @if($committeeYear->year != $year)
                      href="/committee/{{ $committee->short_name }}/{{ $committeeYear->year }}"
                    @endif
                    class="
                      @if($committeeYear->year == $year)
                        noselect cursor-not-allowed
                      @endif
                    " style="margin: 0 auto; width: 70px;">
                    <li class="list-group-item
                      @if($committeeYear->year == $year)
                        active
                      @endif
                    ">
                      {{ $committeeYear->year }}
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
      <div class="col-md-4 col-sm-6 align-self-center text-center">
        <div class="row">
          <div class="col">
            <a href="/profile/{{ $member->user->username }}">
              <img class="img-thumbnail" src="data:image/{{ $member->user->getImageMime() }};base64,{{ $member->user->getImageBase64('128') }}" style="
                        position: absolute;
                        width: 75%;
                        max-width: 128px;
                        max-height: 128px;
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
        <div class="card margin-15" style="margin-top: 79px; padding-top: 53px;">
          <div class="card-block">
            <div class="clearfix d-block d-lg-none"><br></div>
            <h5 class="card-title">{{ $member->user->name }}</h5>
            <p class="card-text">
              {{ $member->position->name }}
            </p>
            <a href="/profile/{{ $member->user->username }}" class="card-link">
              View Profile
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  @include('vendor.clear')
@stop

