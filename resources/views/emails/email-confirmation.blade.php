@extends('emails.vendor.master')

@section('content')
  
  @include('emails.vendor.start-card')

    <center>
      <h1>
        Email Confirmation
      </h1>
    </center>
    <p>
      Dear, {{ $user->name }}<br>
      You've to confirm your email to be able to participate in our current or future event(s). To confirm your email follow this link: <a href="{{ env('APP_URL') }}/auth/register/{{ $token }}" target="_blank">Confirm my email</a> <sup>[1]</sup><br>
      <br>
      Yours,<br>
      Connected Family<br>
      <br>
      [1] If the above link doesn't work copy this link to your browser: <a href="{{ env('APP_URL') }}/auth/register/{{ $token }}" target="_blank">{{ env('APP_URL') }}/auth/register/{{ $token }}</a>
    </p>

  @include('emails.vendor.end-card')

@endsection