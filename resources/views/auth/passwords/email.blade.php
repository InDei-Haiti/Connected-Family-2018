@extends('layouts.master')
@section('title')
  Reset Password
@stop
@section('container')
  @include('vendor.clear')
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">
      <div class="card">
        <div class="card-header text-center">Reset Password</div>
        <div class="card-block">
          @if(Session::has('msg'))
            <div class="alert alert-{{ Session::get('msg')['type'] }}">
              {{ Session::get('msg')['value'] }}
            </div>
          @endif
          <form class="form-horizontal" role="form" method="POST" action="{{ route('send-reset-password-request') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
              <label for="email" class="col control-label">E-Mail Address</label>
              <div class="col">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                  <span class="help-block">
                    {{ $errors->first('email') }}
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary btn-block cursor-pointer">
                  Send Password Reset Link
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @include('vendor.clear')
@stop
