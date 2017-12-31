@extends('emails.vendor.master')

@section('content')

  @include('emails.vendor.start-card')

    <center>
      <h1>
        Result of AC'18
      </h1>
    </center>
    <p>
      Dear <b>{{ $participant->user->name }}</b>,<br>
      Thank you very much for your interest in joining us to attend @foreach($participant->preferences as $p){{ $p->name }} {{ $p->type }}@if($loop->last). @else, @endif @endforeach<br>
      We are glad to inform you that you are <b>accepted</b> in {{ $participant->participantInterview->preference->name }} {{ $participant->participantInterview->preference->type }}. Join <a href="{{ $participant->participantInterview->preference->link }}">{{ $participant->participantInterview->preference->name }} {{ $participant->participantInterview->preference->type }} Group on Facebook</a><sup>[1]</sup> to keep in touch with the {{ $participant->participantInterview->preference->type }}.<br>
      <br>
      Best regards,<br>
      HR'18 Team<br>
      Connected Family<br>
      <br>
      [1] If the above link doesn't work copy this link to your browser: <a href="{{ $participant->participantInterview->preference->link }}" target="_blank">{{ $participant->participantInterview->preference->link }}</a>
    </p>

  @include('emails.vendor.end-card')

@endsection