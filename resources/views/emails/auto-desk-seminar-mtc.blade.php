@extends('emails.vendor.master')

@section('content')

  @include('emails.vendor.start-card')

    <center>
      <h1>
        AUTO DESK Seminar <br> by MTC
      </h1>
    </center>
    <p>
      Greetings, <b>{{ $user->name }}</b><br>
      We are glade to tell you that AUTODESK seminar for engineering students is finally here.<br>
      Here is the event link <a href="https://www.facebook.com/events/207585443118622/207926879751145/">AUTO DESK Seminar by MTC On Facebook</a><sup>[1]</sup> and also the Attendance and certification form link <a href="https://docs.google.com/forms/d/e/1FAIpQLSePR4TWcbySldAUdG1u0kOo8E1EamcNexRF-qdPA5TXgGT4jA/viewform">Form Link</a><sup>[2]</sup>.<br>
      It's <u>Thursday 07/12/2017 04:00PM at 392 Old Building, Faculty Of Engineering, Ain Shams University</u>.<br>
      Hope to see you there.<br>
      <br>
      Yours,<br>
      Connected Family<br>
      <br>
      [1] If the above link doesn't work copy this link to your browser: <a href="https://www.facebook.com/events/207585443118622/207926879751145/" target="_blank">https://www.facebook.com/events/207585443118622/207926879751145/</a><br>
      [2] If the above link doesn't work copy this link to your browser: <a href="https://docs.google.com/forms/d/e/1FAIpQLSePR4TWcbySldAUdG1u0kOo8E1EamcNexRF-qdPA5TXgGT4jA/viewform" target="_blank">https://docs.google.com/forms/d/e/1FAIpQLSePR4TWcbySldAUdG1u0kOo8E1EamcNexRF-qdPA5TXgGT4jA/viewform</a>
    </p>

  @include('emails.vendor.end-card')

@endsection
