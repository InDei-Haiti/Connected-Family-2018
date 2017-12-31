@extends('layouts.master')
@section('title')
  Terms and Privacy
@stop
@section('container')
  @include('vendor.clear')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5>
            <i class="fa fa-list" aria-hidden="true"></i> | 
            <b>Terms</b>
          </h5>
        </div>
        <div class="card-body clear-card">
          <ul>
            <li>You've to add your mobile and your education to be able to participate in any of our current or future events.</li>
            <li>You've to confirm your email address to be able to complete your registration; As non-confirmed emails can't register in any of our events.</li>
            <li>You can reset your password by sending a password reset email, but you can only send one email per hour -if email is not sent to you you've to wait for the next hour-</li>
            <li>As password reset email the confirmation email is also could be sent once per hour.</li>
            <li>Sometimes we won't be able to send an email, you requested, to be sent to you and we will display a message tells you when to try again.</li>
          </ul>
        </div>
      </div>  
    </div>
  </div>
  @include('vendor.clear')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5>
            <i class="fa fa-user-secret" aria-hidden="true"></i> | 
            <b>Privacy</b>
          </h5>
        </div>
        <div class="card-body clear-card">
          <ul>
            <li>Your name, nickname, and bio are always shown to public.</li>
            <li>
              You can control the visibility of the following:
              <ul>
                <li>Email</li>
                <li>Mobile</li>
                <li>Eduction</li>
                <li>Birthday</li>
                <li>Social links e.g. Facebook, and Linkedin</li>
              </ul>
            </li>
            <li>Your participation history is always shown to public. (Only the event you participate in. We Won't share participations' preferences or results to public)</li>
            <li>Your membership history is always shown to public. (The year, committee, and membership position)</li>
            <li>Your profile picture</li>
              <ul>
                <li>Is public too. We offer little support to protect your picture.</li>
                <li>Could be updated once per month.</li>
                <li>Is prefered to be square picture, but it's okay to upload any dimensions you want; As we'll crop it for you to be centered squared picture.</li>
                <li>Size is allowed to be up to 1MB as maximum size.</li>
              </ul>
          </ul>
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop