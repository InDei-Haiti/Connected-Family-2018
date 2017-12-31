@extends('layouts.master')
@section('title', $event->name . " Registration")
@section('container')
  @include('vendor.clear')
  <div class="row">
    <div class="col-12">
      <div class="card">
        {{-- Check Participation --}}
        @php
          $isParticipant = $user->isParticipant($event);
        @endphp
        <div class="card-header">
          <h5>
            <i class="fa fa-road" aria-hidden="true"></i> |
            <b>Tracking registration</b>
          </h5>
        </div>
        <div class="card-body clear-card">
          @if($event->id > 11004)
            <ol type="1">
              <li>Selecting Preference(s).
              @if($isParticipant)
                <span class="text-success">Done</span> <i class="fa fa-check-circle text-success" aria-hidden="true"></i><br>
                You can view and update your preferences form here: <b><a href="/event/{{ $event->name }}-{{ $event->year }}/registration">Preferences</a></b>.
              @else
                <span class="text-warning">Not selected</span> <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i><br>
                You can select your preferences form here: <b><a href="/event/{{ $event->name }}-{{ $event->year }}/registration">Preferences</a></b>.
              @endif
              </li>
              <li>Selecting Interview date.
              @if($isParticipant)
                @if($user->participation($event)->participantInterview)
                  <span class="text-success">Done</span> <i class="fa fa-check-circle text-success" aria-hidden="true"></i><br>
                  You can view and update your interview date form here: <b><a href="/event/{{ $event->name }}-{{ $event->year }}/interview">Interview</a></b>.
                @else
                  <span class="text-warning">Not selected</span> <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i><br>
                  You can select your interview date form here: <b><a href="/event/{{ $event->name }}-{{ $event->year }}/interview">Interview</a></b>.
                @endif
              @else
                <span class="text-warning">Not selected</span> <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i><br>
                You can select your interview date form here: <b><a href="/event/{{ $event->name }}-{{ $event->year }}/interview">Interview</a></b>.
              @endif
              </li>
              <li>
                Getting the result.<br>
                You'll get the result in an email after all interviews are end. 
              </li>
            </ol>
          @else
            <center>
              <i class="fa fa-exclamation-circle fa-5x text-warning" aria-hidden="true"></i>
              <h3>Tracking is</h3>
              <h2>NOT AVAILABLE</h2>
              <h3>for {{ $event->name }}'@php echo substr($event->year, 2); @endphp event!</h3>
            </center>
          @endif
        </div>
      </div>
    </div>
  </div>
@stop