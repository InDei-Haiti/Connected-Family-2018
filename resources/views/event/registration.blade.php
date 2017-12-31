@extends('layouts.master')
@section('title', $event->name . " Registration")
@section('container')
  @include('vendor.clear')
  <div class="row">
    <div class="col-12">
      <div class="card">
        {{-- Check Participation --}}
        @php
          $participantIsUpdatable = true;
          $isParticipant = $user->isParticipant($event);
          if($isParticipant){
            $participant = $user->participation($event);
            $participation_preferences = $participant->preferences;
            $participation_preferences_count = count($participation_preferences);
            $participantIsUpdatable = $participant->updatable;
          }
        @endphp
        <div class="card-header">
          <h5>
            <i class="fa fa-star" aria-hidden="true"></i> |
            <b>@if($isParticipant) Updating @else Selecting @endif Preferences</b>
          </h5>
        </div>
        <div class="card-body clear-card">
          {{-- isClosed Only! --}}
          @if($event->isClosed() && !$isParticipant)
            <div class="row">
              <div class="col-md-12 text-center">
                <i class="fa fa-times-circle fa-5x text-danger" aria-hidden="true"></i><br>
                <p class="text-danger">
                  <b>Event {{ $event->name }}'@php echo substr($event->year, 2); @endphp Registration closed!</b> <br> You can't select nor update your preferences.
                </p>
              </div>
            </div>
          @else
            {{-- Check Email Confirmation --}}
            @php
              $email_confirmed = true;
              if(!$user->emailConfirmation) $email_confirmed = false;
              else if(!$user->emailConfirmation->confirmed) $email_confirmed = false;
            @endphp
            @if(!$email_confirmed)
              <h4 class="text-center text-primary">
                <i class="fa fa-exclamation-circle fa-3x text-danger" aria-hidden="true"></i><br>
                You must <u class="text-danger">confirm your email address</u>; To be able to complete your registration.
                You can find link to request email confirmation in your profile page, You can access your profile from <a href="{{ route('profile', ['username' => $user->username]) }}" class="font-underline">here</a>
              </h4>
            @else
              {{-- Check Mobile Existance --}}
              @if(!$user->mobile)
                <h4 class="text-center text-primary">
                  <i class="fa fa-exclamation-circle fa-3x text-danger" aria-hidden="true"></i><br>
                  You must <u class="text-danger">add your mobile number</u>; It is a required data in event registration. You can add your mobile number from you profile edit page, You can access your profile edit from <a href="{{ route('edit-profile', ['username' => $user->username]) }}" class="font-underline">here</a>
                  @php Session::flash('scrollTo', 'bi') @endphp
                </h4>
              @else
                {{-- Check Education Existance --}}
                @if(!$user->educationalInformation)
                  <h4 class="text-center text-primary">
                    <i class="fa fa-exclamation-circle fa-3x text-danger" aria-hidden="true"></i><br>
                    You must <u class="text-danger">add your educational information</u>; It is a required data in event registration. You can add your educational information from you profile edit page, You can access your profile edit from <a href="{{ route('edit-profile', ['username' => $user->username]) }}" class="font-underline">here</a>
                    @php Session::flash('scrollTo', 'ei') @endphp
                  </h4>
                @else
                  {{-- Check Updating for Educational Information --}}
                  @if(strtotime($user->educationalInformation->updated_at)
                      < strtotime('01-09-2017'))
                    <h4 class="text-center text-primary">
                      <i class="fa fa-exclamation-circle fa-3x text-danger" aria-hidden="true"></i><br>
                      You must <u class="text-danger">update your educational information</u>; It is a required data in event registration. You can update your educational information from you profile edit page, You can access your profile edit from <a href="{{ route('edit-profile', ['username' => $user->username]) }}" class="font-underline">here</a>
                      @php Session::flash('scrollTo', 'ei') @endphp
                    </h4>
                  @else
                    {{-- Event is 2r2 OR 2r1 --}}
                    @if($event->preferences_type == "2r2" || $event->preferences_type == "2r1")
                      <div class="row">
                        <div class="col-md-6">
                          @if($isParticipant)
                            <div class="row">
                              <div class="col-2 text-right align-self-start">
                                <i class="fa fa-check-circle fa-3x text-success" aria-hidden="true"></i>
                              </div>
                              <div class="col-10 align-self-center">
                                <p>
                                  You have already selected your preference<?php if($participation_preferences_count > 1) echo "s"; ?>. And your preference<?php if($participation_preferences_count > 1) echo "s"; ?>
                                  @if($participation_preferences_count > 1) are @else is @endif
                                  @foreach($user->participation($event)->preferences as $p)
                                    <b>{{ $p->name }}</b>@if($loop->last). @else, @endif
                                  @endforeach
                                  You can select/know your interview date from this link: <b><a href="interview">Select/Know your interview date</a></b>.
                                  You can track your registration from here: <b><a href="/event/{{ $event->name }}-{{ $event->year }}/registration/tracking">Tracking registration</a></b>.
                                  @if($participantIsUpdatable)
                                    You can update your preferences anytime you want according to rules mentioned below.
                                  @endif
                                </p>
                              </div>
                            </div>
                            @if($participantIsUpdatable)
                              <div><hr></div>
                            @endif
                          @endif
                          @if($participantIsUpdatable)
                            <div class="row">
                              <div class="col-2 text-right align-self-start">
                                <i class="fa fa-info-circle fa-3x text-info" aria-hidden="true"></i>
                              </div>
                              <div class="col-10 align-self-center">
                                <p class="text-primary">
                                  <b><u>Please read the following carefully</u></b>.<br>
                                  You <u>can update</u> your preferences <u>anytime</u> you want. Also Interview date and group discussion date - if selection phases include interview or group discussion - could be updated <u>anytime</u>.<br>
                                  <b><u>BUT</u></b> if you, for instance, have interview as a <u>first selection phase</u> and you select the interview so that interview date is <u>tomorrow</u>. You can update your preferences or interview date <u>before today 11:59PM</u>. If the time is <u>already after 11:59PM</u>, you <u>can't update anything</u> in your registration. If your interview date is after tomorrow, you still can edit it until tomorrow 11:59PM and so on.
                                </p>
                              </div>
                            </div>
                          @endif
                        </div>
                        <div class="col-md-6">
                          @if($participantIsUpdatable)
                            <form id="registration2Form">
                              {{ csrf_field() }}
                              <div class="form-group">
                                <label for="stPreference">1<sup>st</sup> Preference</label>
                                <select class="form-control" id="stPreference">
                                  <option
                                    @if(!$isParticipant)
                                      selected=""
                                    @endif
                                    disabled="" value="">Select Preference</option>
                                  @foreach($preferences as $preference)
                                    <option value="{{ $preference->id }}"
                                      @if($isParticipant)
                                        @if($preference == $participation_preferences[0])
                                          selected=""
                                        @endif
                                      @endif
                                    >{{ $preference->name }}</option>
                                  @endforeach
                                </select>
                                <small class="text-danger font-weight-bold" id="errorMsg" data="stPreference"></small>
                              </div>
                              <div class="form-group">
                                <label for="stPreference">2<sup>nd</sup> Preference</label>
                                <select class="form-control" id="ndPreference">
                                  <option
                                    @if(!$isParticipant)
                                      selected=""
                                    @elseif($participation_preferences_count == 1)
                                      selected=""
                                    @endif
                                    disabled="" value="">
                                      Select Preference @if($event->preferences_type == "2r1") (Optional) @endif
                                  </option>
                                  @foreach($preferences as $preference)
                                    <option value="{{ $preference->id }}"
                                      @if($isParticipant)
                                        @if($participation_preferences_count == 2)
                                          @if($preference == $participation_preferences[1])
                                            selected=""
                                          @endif
                                        @endif
                                      @endif
                                    >{{ $preference->name }}</option>
                                  @endforeach
                                </select>
                                <small class="text-danger font-weight-bold" id="errorMsg" data="ndPreference"></small>
                              </div>
                              @if($isParticipant)
                                <div class="row">
                                  <div class="col-2 text-right align-self-start">
                                    <i class="fa fa-exclamation-circle fa-3x text-warning" aria-hidden="true"></i>
                                  </div>
                                  <div class="col-10 align-self-center">
                                    <p class="text-muted">
                                      If you update your preferences now and you have already selected your interview date or group discussion date. This date will be canceled, so you'll need to select the date again. Everything else will remain the same. e.g. PST. -if exists-
                                    </p>
                                  </div>
                                </div>
                              @endif
                              <div class="form-group">
                                <button class="btn btn-warning cursor-pointer float-left" id="registration2Reset"
                                        type="reset">
                                  RESET
                                </button>
                                <button class="btn btn-primary cursor-pointer float-right" id="registration2Btn"
                                        type="submit">
                                  @if($isParticipant) Update Preferences @else Register @endif
                                </button>
                              </div>
                            </form>
                          @else
                            <div class="row">
                              <div class="col-12 text-center">
                                <i class="fa fa-times-circle fa-5x text-danger" aria-hidden="true"></i>
                              </div>
                              <div class="col-12 text-center">
                                <h4 class="text-danger">
                                  You can't change your preferences from now on.
                                </h4>
                              </div>
                            </div>
                          @endif
                        </div>
                      </div>
                    {{-- Event is *r1 --}}
                    @else

                    @endif
                  @endif
                @endif
              @endif
            @endif
          @endif
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop
@section('scripts')
  <script type="text/javascript" src="/js/asset/adds-on/select.preferences.js"></script>
  <script type="text/javascript" src="/js/ajax/registration/submit.js"></script>
@stop
