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
    <div class="row" style="margin-bottom: 15px;">
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
    <div class="col-lg-4" style="position: relative;">
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
    <div class="col-lg-4">
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
                  @if($user->additionalInformations
                    && $user->additionalInformations->bio)
                    <b>{{ $user->additionalInformations->bio }}</b>
                  @endif
                </div>
              </div>
              <br>
              @if($user->checkPrivacy("email") || ($self && !$asPublic) )
                <div class="row">
                  <div class="col">
                    <i class="fa fa-envelope fa-fw" aria-hidden="true"></i> |
                    <a href="mailto:{{ $user->email }}"><b>{{ $user->email }}</b></a>
                    @if($user->emailConfirmation)
                      @if($user->emailConfirmation->confirmed)
                        <i class="fa fa-check-circle text-info" aria-hidden="true"></i>
                      @endif
                    @endif
                  </div>
                </div>
              @endif
              @if($user->educationalInformation)
                @if($user->checkPrivacy("education") || ($self && !$asPublic) )
                  <div class="row">
                    <div class="col">
                      <i class="fa fa-graduation-cap fa-fw" aria-hidden="true"></i> |
                      <b>{{ $user->educationalInformation->academic_year->name }}
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      @if($user->educationalInformation->department)
                        {{ $user->educationalInformation->department->name }}
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      @endif
                      {{ $user->educationalInformation->college->name }}
                      <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      {{ $user->educationalInformation->uni->name }}</b>
                    </div>
                  </div>
                @endif
              @endif
              @if($user->mobile)
                @if($user->checkPrivacy("mobile") || ($self && !$asPublic) )
                  <div class="row">
                    <div class="col">
                      <i class="fa fa-mobile fa-fw" aria-hidden="true"></i> |
                      <b>{{ $user->mobile->number }}</b>
                    </div>
                  </div>
                @endif
              @endif
              @if($user->birthday)
                @if($user->checkPrivacy("birthday") || ($self && !$asPublic) )
                  <div class="row">
                    <div class="col">
                      <i class="fa fa-birthday-cake fa-fw" aria-hidden="true"></i> |
                      <b>{{ $user->birthday->format('long') }}</b>
                    </div>
                  </div>
                @endif
              @endif
              @if($user->socialLink("facebook"))
                @if($user->checkPrivacy("facebook") || ($self && !$asPublic) )
                  <div class="row">
                    <div class="col">
                      <i class="fa fa-facebook-square fa-fw" aria-hidden="true"></i> |
                      <b>
                        <a href="{{ $user->socialLink("facebook") }}" target="_blank">
                          {{ $user->name }} on Facebook
                          @if($user->socialInformation('facebook')->linked)
                            <i class="fa fa-check-circle text-info" aria-hidden="true"></i>
                          @endif
                        </a>
                        <i class="fa fa-external-link" aria-hidden="true"></i>
                      </b>
                    </div>
                  </div>
                @endif
              @endif
              @if($user->socialLink("linkedin"))
                @if($user->checkPrivacy("linkedin") || ($self && !$asPublic) )
                  <div class="row">
                    <div class="col">
                      <i class="fa fa-linkedin-square fa-fw" aria-hidden="true"></i> |
                      <b>
                        <a href="{{ $user->socialLink("linkedin") }}" target="_blank">
                          {{ $user->name }} on Linkedin
                          @if($user->socialInformation('linkedin')->linked)
                            <i class="fa fa-check-circle text-info" aria-hidden="true"></i>
                          @endif
                        </a>
                        <i class="fa fa-external-link" aria-hidden="true"></i>
                      </b>
                    </div>
                  </div>
                @endif
              @endif
              @if(count($user->memberHistories)) @foreach($user->memberHistories as $memberHistory)
                <div class="row">
                  <div class="col">
                    <i class="fa fa-briefcase fa-fw" aria-hidden="true"></i> |
                    <b><a href="/committee/{{ $memberHistory->committee->short_name }}/{{ $memberHistory->year }}">{{ $memberHistory->committee->short_name }}'{{ substr($memberHistory->year, 2) }}</a> {{ $memberHistory->position->name }}</b><br>
                  </div>
                </div>
              @endforeach @endif

              @if(count($user->participations))
                <div class="row">
                  <div class="col">
                    <i class="fa fa-calendar fa-fw" aria-hidden="true"></i> |
                    <span class="text-muted text-uppercase">participations</span>
                    @foreach($user->participations as $participation)
                      <b><a href="/event/{{ $participation->event->name }}-{{ $participation->event->year }}">{{ $participation->event->name }}'{{ substr($participation->event->year, 2) }}</a></b>@if(!$loop->last), @endif
                    @endforeach
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="d-none d-lg-block">
        @include('vendor.footer-inside')
      </div>
    </div>
    <div class="col-lg-6">
      <div class="d-lg-block d-none" style="margin-bottom: -128px;"></div>
      <div class="d-lg-none d-block"><hr></div>
      @if($self && !$asPublic)
        @include('vendor.idea.form')
      @endif
      <span id="ideas">
      @forelse($ideas as $idea)
        @include('vendor.clear')
        @include('vendor.idea.card')
      @empty
        @include('vendor.clear')
        @include('vendor.idea.no-idea')
      @endforelse
      @if(count($ideas) > 0)
        @include('vendor.clear')
        @include('vendor.idea.no-more')
      @endif
      </span>
    </div>
    <div class="col-lg-2 text-center">
      <div class="d-lg-block d-none" style="margin-bottom: -128px;"></div>
      <div class="d-lg-none d-block"><hr></div>
      <h3><b>TOP IDEAS</b></h3>
      <div class="d-block d-lg-none">
        @include('vendor.footer-inside')
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop

@section('scripts')
  <script type="text/javascript" src="/js/ajax/profile/share.idea.js"></script>
  <script type="text/javascript">
    function ideaHoverHandle(bla) {
      if(bla.children('i').hasClass('fa-heart-o'))
        bla.children('i').removeClass('fa-heart-o').addClass('fa-heart');
      else bla.children('i').removeClass('fa-heart').addClass('fa-heart-o');
    }
    $(document).ready( function() {
      $('#connected-footer').addClass('d-none');
      $(".idea-vote").hover(function (){
        ideaHoverHandle($(this));
      }, function () {
        ideaHoverHandle($(this));
      });
    });
    $(".idea-text").on("keyup", function(event) {
      lines = $(this).val().split(/\r|\r\n|\n/).length;
      if(lines <= 17) $(this).attr('rows', lines + 1);
      // if(typeof (content = $(this).val()[0]) != 'undefined'){
      //   preg_match = content.match(/[ا-ي]/g);
      //   if(preg_match == null) $(this).css('direction', 'ltr');
      //   else $(this).css('direction', 'rtl');
      // } else $(this).css('direction', 'ltr');
    });
  </script>
  <style type="text/css">
    i[id$=swaper] {
      cursor: pointer;
    }
    .article-date {
      font-size: 13px;
    }
    .idea-vote-heart {
      color: #fb3958;
    }
    body {
      height: auto!important;
    }
    .idea-text, .idea-text:hover {
      padding: 0px;
      outline: none;
      border: none;
      word-wrap: break-word;
    }
    .idea-content {
      word-wrap: break-word;
    }
  </style>
@stop

