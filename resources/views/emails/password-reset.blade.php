@extends('emails.vendor.master')

@section('content')
  
  @include('emails.vendor.start-card')

    <center>
      <h1>
        Password reset
      </h1>
    </center>
    <p>
      Dear, {{ $user->name }}<br>
      You've requested that you want to reset your password if so, please follow this link to <a href="{{ env('APP_URL') }}/auth/reset-password/{{ $token }}" target="_blank">reset password</a> <sup>[1]</sup><br>
      If that's was not you just ignore this email.<br>
      <br>
      Yours,<br>
      Connected Family<br>
      <br>
      [1] If the above link doesn't work copy this link to your browser: <a href="{{ env('APP_URL') }}/auth/reset-password/{{ $token }}" target="_blank">{{ env('APP_URL') }}/auth/reset-password/{{ $token }}</a>
    </p>

  @include('emails.vendor.end-card')

@endsection