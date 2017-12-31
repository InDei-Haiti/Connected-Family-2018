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
      We are sorry to inform you that we have selected the participants whom we think most closely matches our criteria but, unfortunately you weren't one of them.<br>
      We wish you the best of luck in the next stages till you develop yourself and try joining us as a member or participant again.<br>
      <br>
      Best regards,<br>
      HR'18 Team<br>
      Connected Family<br>
    </p>

  @include('emails.vendor.end-card')

@endsection