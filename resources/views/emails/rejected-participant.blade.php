@extends('emails.vendor.master')

@section('content')
  
  @include('emails.vendor.start-card')

    <center>
      <h1>
        Result of Recruitment'18
      </h1>
    </center>
    <p>
      Dear, <b>{{ $user->name }}</b><br>
      We hope this email finds you well. Thank you for being participant in out new event Recruitment'18. Your preference<?php if(count($preferences) > 1) echo "s"; ?>@if(count($preferences) > 1) were @else was @endif @foreach($preferences as $p){{ $p }}@if($loop->last). @else, @endif @endforeach We are sorry to inform you that you are <b>{{ $state }}</b>. Your criteria didn't match the required criteria to join any committee from your preferences.<br>
      <br>
      Yours,<br>
      Connected Family<br>
    </p>

  @include('emails.vendor.end-card')

@endsection