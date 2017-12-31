@extends('layouts.master')
@section('title', $user->name)
@section('container')
  @php
    if(!$admin){
      $self = false;
      if(Auth::check() && $user->id == Auth::user()->id)
        $self = true;
      $asPublic = false;
      if($self && isset($_GET['public']))
        $asPublic = true;
    } else {
      $self = true;
      $asPublic = false;
    }
  @endphp
  @include('vendor.clear')
  @if(Auth::check() && $self && !$asPublic)
    @if($user->emailConfirmation && !$user->emailConfirmation->confirmed || (!$user->emailConfirmation))
      @include('notifications.send-email-confirmation')
      @include('vendor.clear')
    @endif
  @endif
  @if($self)
    <div class="row" style="margin-bottom: 15px; margin-top: -15px;">
      <div class="col-12 align-self-center text-right">
        @if($asPublic)
          <a  class="btn btn-sm btn-secondary float-right"
              href="/profile/{{ $user->username }}" target="_self">
            <i class="fa fa-user-secret fa-fw" aria-hidden="true"></i>
            &nbsp; Back to profile
          </a>
        @else
          <a  class="btn btn-sm btn-secondary float-right"
              href="/profile/{{ $user->username }}?public" target="_self">
            <i class="fa fa-user-secret fa-fw" aria-hidden="true"></i>
            &nbsp; View profile as anonymous
          </a>
        @endif
      </div>
    </div>
  @endif
  <div class="row">
    <div class="col-lg-7" style="position: relative;">
      <img class="img-thumbnail" src="data:image/{{ $user->getImageMime() }};base64,{{ $user->getImageBase64('256') }}"
            style=" width: 256px;
                    border-radius: 128px;
                    position: absolute;
                    z-index: 1000;
                    left: 0;
                    right: 0;
                    margin-left: auto;
                    margin-right: auto;
                    ">
    </div>
  </div>
  <div class="row" style="margin-top: 128px;">
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body clear-card" style="padding-top: 128px;">
          <div class="row">
            <div class="col-md-12 align-self-center">
              <div class="row">
                <div class="col-sm-12 text-center"><b><h1>
                  {{ $user->name }}
                  @if($user->additionalInformations
                    && $user->additionalInformations->nickname)
                    ({{ $user->additionalInformations->nickname }})
                  @endif
                </h1></b></div>
              </div>
              <div class="row">
                <div class="col-sm-12 text-center">
                  @if($user->checkPrivacy("email") || ($self && !$asPublic) )
                    <a href="mailto:{{ $user->email }}"><b>{{ $user->email }}</b></a>
                    @if($user->emailConfirmation)
                      @if($user->emailConfirmation->confirmed)
                        <i class="fa fa-check-circle text-info" aria-hidden="true"></i>
                      @endif
                    @endif
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 text-center">
                  @if($user->mobile)
                    @if($user->checkPrivacy("mobile") || ($self && !$asPublic) )
                      <b>{{ $user->mobile->number }}</b>
                    @endif
                  @endif
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 text-center">
                  @if($user->educationalInformation)
                    @if($user->checkPrivacy("education") || ($self && !$asPublic) )
                      <b>{{ $user->educationalInformation->academic_year->name }}
                      @if($user->educationalInformation->department)
                        - {{ $user->educationalInformation->department->name }}
                      @endif
                      <br>
                      {{ $user->educationalInformation->college->name }} -
                      {{ $user->educationalInformation->uni->name }}</b>
                    @endif
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('vendor.clear')
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12 align-self-center">
              <h5>
                <i class="fa fa-universal-access" aria-hidden="true"></i> |
                <b>Additional Information</b>
              </h5>
            </div>
          </div>
        </div>
        <div class="card-body clear-card">
          <div class="row">
            <div class="col-sm-4">
              <i class="fa fa-fire fa-fw" aria-hidden="true"></i> |
              <span class="text-muted text-uppercase">nickname</span>
            </div>
            <div class="col-sm-8">
              @if($user->additionalInformations
                && $user->additionalInformations->nickname)
                <b>{{ $user->additionalInformations->nickname }}</b>
              @else
                <span class="text-muted text-uppercase">not available</span>
              @endif
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-4">
              <i class="fa fa-birthday-cake fa-fw" aria-hidden="true"></i> |
              <span class="text-muted text-uppercase">birthday</span>
            </div>
            <div class="col-sm-8">
              @if($user->birthday)
                @if($user->checkPrivacy("birthday") || ($self && !$asPublic) )
                  <b>{{ $user->birthday->format('long') }}</b>
                @else
                  <span class="text-muted text-uppercase">Hidden</span>
                @endif
              @else
                <span class="text-muted text-uppercase">not available</span>
              @endif
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-4">
              <i class="fa fa-vcard-o fa-fw" aria-hidden="true"></i> |
              <span class="text-muted text-uppercase">bio</span>
            </div>
            <div class="col-sm-8">
              @if($user->additionalInformations
                && $user->additionalInformations->bio)
                <b>{{ $user->additionalInformations->bio }}</b>
              @else
                <span class="text-muted text-uppercase">not available</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      @include('vendor.clear')
    </div>
    <div class="col-lg-5">
      <div class="d-lg-block d-none" style="margin-bottom: -128px;"></div>
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-12 align-self-center">
              <h5>
                <i class="fa fa-link" aria-hidden="true"></i> |
                <b>Social Links</b>
              </h5>
            </div>
          </div>
        </div>
        <div class="card-body clear-card">
          <div class="row">
            <div class="col-sm-4">
              <i class="fa fa-facebook-square" aria-hidden="true"></i> |
              <span class="text-muted text-uppercase">facebook</span>
            </div>
            <div class="col-sm-8">
              @if($user->socialLink("facebook"))
                @if($user->checkPrivacy("facebook") || ($self && !$asPublic) )
                  <b>
                    <i class="fa fa-external-link" aria-hidden="true"></i>
                    <a href="{{ $user->socialLink("facebook") }}" target="_blank">
                      {{ $user->name }} on Facebook
                      @if($user->socialInformation('facebook')->linked)
                        <i class="fa fa-check-circle text-info" aria-hidden="true"></i>
                      @endif
                    </a>
                  </b>
                @else
                  <span class="text-muted text-uppercase">Hidden</span>
                @endif
              @else
                <span class="text-muted text-uppercase">not available</span>
              @endif
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-4">
              <i class="fa fa-linkedin-square" aria-hidden="true"></i> |
              <span class="text-muted text-uppercase">linkedin</span>
            </div>
            <div class="col-sm-8">
              @if($user->socialLink("linkedin"))
                @if($user->checkPrivacy("linkedin") || ($self && !$asPublic) )
                  <b>
                    <i class="fa fa-external-link" aria-hidden="true"></i>
                    <a href="{{ $user->socialLink("linkedin") }}" target="_blank">
                      {{ $user->name }} on Linkedin
                      @if($user->socialInformation('linkedin')->linked)
                        <i class="fa fa-check-circle text-info" aria-hidden="true"></i>
                      @endif
                    </a>
                  </b>
                @else
                  <span class="text-muted text-uppercase">Hidden</span>
                @endif
              @else
                <span class="text-muted text-uppercase">not available</span>
              @endif
            </div>
          </div>
        </div>
      </div>
      @include('vendor.clear')
      <div class="card">
        <div class="card-header">
          <h5>
            <i class="fa fa-history" aria-hidden="true"></i> |
            <b>Membership History</b>
          </h5>
        </div>
        <div class="card-body clear-card">
          @if(count($user->memberHistories) == 0)
            <center>
              <span class="text-muted text-uppercase">no records found</span>
            </center>
          @else
            @foreach($user->memberHistories as $memberHistory)
              <div class="row">
                <div class="col">
                  {{ $memberHistory->year }} -
                  <b><a href="/committee/{{ $memberHistory->committee->short_name }}/{{ $memberHistory->year }}">{{ $memberHistory->committee->short_name }}</a>, {{ $memberHistory->position->name }}</b><br>
                </div>
              </div>
              @if(!$loop->last)<hr>@endif
            @endforeach
          @endif
        </div>
      </div>
      @include('vendor.clear')
      <div class="card">
        <div class="card-header">
          <h5>
            <i class="fa fa-history" aria-hidden="true"></i> |
            <b>Participation History</b>
          </h5>
        </div>
        <div class="card-body clear-card">
          @if(count($user->participations) == 0)
            <center>
              <span class="text-muted text-uppercase">no records found</span>
            </center>
          @else
            @foreach($user->participations as $participation)
              <div class="row">
                <div class="col">
                  {{ $participation->event->year }} - <b><a href="/event/{{ $participation->event->name }}-{{ $participation->event->year }}">{{ $participation->event->name }}</a></b><br>
                  {{--
                    Preferences:
                    @foreach($participation->preferences as $preference)
                      <b>{{ $preference->name }}</b>@if(!$loop->last), @endif
                    @endforeach
                  --}}
                </div>
              </div>
              @if(!$loop->last)<hr>@endif
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop

