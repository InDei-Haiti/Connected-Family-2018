@extends('emails.vendor.master')

@section('content')
  
  @include('emails.vendor.start-card')

    <center>
      <h1>
        Selection of Interview Date
      </h1>
    </center>
    <p>
      Dear, {{ $user->name }}<br>
      Thank you for being participant in out new event Recruitment'18. You don't select your interview date. This email is to remind you to select it. You can do so from this link: <a href="{{ env('APP_URL') }}/event/Recruitment-2018/interview" target="_blank">Select my Interview date</a> <sup>[1]</sup><br>
      <br>
      Yours,<br>
      Connected Family<br>
      <br>
      [1] If the above link doesn't work copy this link to your browser: <a href="{{ env('APP_URL') }}/event/Recruitment-2018/interview" target="_blank">{{ env('APP_URL') }}/event/Recruitment-2018/interview</a>
    </p>

  @include('emails.vendor.end-card')

@endsection