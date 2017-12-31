@extends('layouts.master')
@section('title')
  About Us
@stop
@section('container')
  <div id="about">
    @include('vendor.clear')
    <div class="row">
      <div class="col">
        <div class="">
          <div class="card-body">
            <div class="col text-center">
              @php
                $file = Storage::get('/public/imgs/256/logos/connected-family.png');
              @endphp
              <img src="data:image/png;base64,{{ base64_encode($file) }}" alt="Connected Family Logo" width="256px" style="margin-top: -64px; margin-bottom: -48px;">
              <p class="font-22">
                <span class="font-cyan font-cookie font-28">Connected</span> <span class="font-pink font-cookie font-28">Family</span> is a non profitable team working to help students to execute their ideas which may be technical, social, economical....etc. The idea was generated on 28/3/2011 and founded by 7 founders.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('vendor.clear')
    <div class="row">
      <div class="col-md-3 d-none d-md-block text-right align-self-center">
        <span class="fa-stack fa-5x">
          <i class="fa fa-circle fa-stack-2x font-cyan"></i>
          <i class="fa fa-globe fa-stack-1x fa-inverse"></i>
        </span>
      </div>
      <div class="col-md-3 d-block d-md-none text-center align-self-center">
        <span class="fa-stack fa-5x">
          <i class="fa fa-circle fa-stack-2x font-cyan"></i>
          <i class="fa fa-globe fa-stack-1x fa-inverse"></i>
        </span>
      </div>
      <div class="col-md-9 align-self-center">
        <div class="">
          <div class="card-body">
            <h4 class="font-bold font-upper-case">
              <span class="font-28 font-cyan font-underline">Our Mission</span>
            </h4>
            <p class="font-22">
              Matching people's ideas by helping them to develop and execute their ideas.<br>
              Increasing the students' creativity in all fields.
            </p>
          </div>
        </div>
      </div>
    </div>
    @include('vendor.clear')
    <div class="row">
      <div class="col-md-3 d-none d-md-block text-right align-self-center">
        <span class="fa-stack fa-5x">
          <i class="fa fa-circle fa-stack-2x font-pink"></i>
          <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
        </span>
      </div>
      <div class="col-md-3 d-block d-md-none text-center align-self-center">
        <span class="fa-stack fa-5x">
          <i class="fa fa-circle fa-stack-2x font-pink"></i>
          <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
        </span>
      </div>
      <div class="col-md-9 align-self-center">
        <div class="">
          <div class="card-body">
            <h4 class="font-bold font-upper-case">
              <span class="font-28 font-pink font-underline">Our Vission</span>
            </h4>
            <p class="font-22">
              To have in our country a global foundation in ideas' care &amp; execution field.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
  @include('vendor.clear')
@stop

