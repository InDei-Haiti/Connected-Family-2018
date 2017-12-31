@extends('emails.vendor.master')

@section('content')
  
  @include('emails.vendor.start-card')

    <center>
      <h1>
        Welcome to our FAMILY!
      </h1>
    </center>
    <p>
      Dear, {{ $user->name }}<br>
      You've completed your registration to our family. We are glad to have you in our family. Next step is to update your educational information and add your mobile number; as these data is a must to complete your registration in any event. To complete this. First <a href="{{ env('APP_URL') }}/auth/login" target="_blank">login</a> <sup>[1]</sup> to your account. Then go to edit profile page. Finally add your missing data.<br>
      Thank you for your understanding to do these processes.<br>
      <br>
      Yours,<br>
      Connected Family<br>
      <br>
      [1] If the above link doesn't work copy this link to your browser: <a href="{{ env('APP_URL') }}/auth/login" target="_blank">{{ env('APP_URL') }}/auth/login</a>
    </p>

  @include('emails.vendor.end-card')

@endsection