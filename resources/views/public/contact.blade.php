@extends('layouts.master')
@section('title')
  Contact Us
@stop
@section('container')
  @include('vendor.clear')
  <div id="contact">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header text-center">Contact Us</div>
          <div class="card-block">
            @if(Session::has('done'))
              <div class="alert alert-success">
                {{ Session::get('done') }}
              </div>
            @endif
            @if(Session::has('msg'))
              <div class="alert alert-danger">
                {{ Session::get('msg') }}
              </div>
            @endif
            <form class="form-horizontal" role="form" method="POST" action="{{ route('public.contact-us') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <label for="name" class="col control-label">
                  <i class="fa fa-user fa-fw" aria-hidden="true"></i> |
                  <span class="text-muted text-uppercase">name</span>
                </label>
                <div class="col">
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}@if($user = Auth::user()){{ $user->name }}@endif" required @if(!isset($user)) autofocus @endif>
                  @if ($errors->has('name'))
                    <span class="help-block">
                      {{ $errors->first('name') }}
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <label for="email" class="col control-label">
                  <i class="fa fa-envelope fa-fw" aria-hidden="true"></i> |
                  <span class="text-muted text-uppercase">email</span>
                </label>
                <div class="col">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}@if(isset($user)){{ $user->email }}@endif" required>
                  @if ($errors->has('email'))
                    <span class="help-block">
                      {{ $errors->first('email') }}
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group{{ $errors->has('content') ? ' has-danger' : '' }}">
                <label for="content" class="col control-label">
                  <i class="fa fa-comment-o fa-fw" aria-hidden="true"></i> |
                  <span class="text-muted text-uppercase">content</span>
                </label>
                <div class="col">
                  <textarea id="content" class="form-control"  name="content" rows="7" required style="resize: none;"@if(isset($user)) autofocus @endif>{{ old('content') }}</textarea>
                  @if ($errors->has('content'))
                    <span class="help-block">
                      {{ $errors->first('content') }}
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col text-right">
                  <button type="submit" class="btn btn-primary cursor-pointer">
                    <i class="fa fa-send fa-fw" aria-hidden="true"></i> Send
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        @include('vendor.clear')
      </div>
      <div class="col-lg-5 offset-lg-1">
        <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i> |
        <span class="text-muted text-uppercase">Address</span><br>
        <p style="padding-left: 32px;">
          Faculty of Engineering, Ain Shams University<br>
          1 Elsarayat St, Elabasia - Cairo, Egypt
        </p>
        <hr>
        <i class="fa fa-envelope fa-fw" aria-hidden="true"></i> |
        <span class="text-muted text-uppercase">Email</span><br>
        <p style="padding-left: 32px;">
          <a href="mailto:info@connected-family.org">info@connected-family.org</a>
        </p>
        <span class="d-lg-block d-none">
          <hr>
          <i class="fa fa-search fa-fw" aria-hidden="true"></i> |
          <span class="text-muted text-uppercase">Find us on social networks.</span>
          @include('vendor.clear')
          <div class="text-center">
            @include('vendor.social-links')
          </div>
        </span>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop
@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#connected-footer').addClass('d-lg-none').addClass('d-block');
    });
  </script>
@stop
