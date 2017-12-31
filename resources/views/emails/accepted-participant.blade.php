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
      We hope this email finds you well. Thank you for being participant in out new event Recruitment'18. Your preference<?php if(count($preferences) > 1) echo "s"; ?>@if(count($preferences) > 1) were @else was @endif @foreach($preferences as $p){{ $p }}@if($loop->last). @else, @endif @endforeach We are glad to inform you that you are <b>{{ $state }}</b>. Now you're officially a member in our family, Connected Family.<br>Follow this <a href="https://www.facebook.com/groups/connected18/" target="_blank">link to join our facebook group for Connected Family Crew'18.</a> <sup>[1]</sup><br>
      <br>
      Yours,<br>
      Connected Family<br>
      <br>
      [1] If the above link doesn't work copy this link to your browser: <a href="https://www.facebook.com/groups/connected18/" target="_blank">https://www.facebook.com/groups/connected18/</a>
    </p>

  @include('emails.vendor.end-card')

@endsection