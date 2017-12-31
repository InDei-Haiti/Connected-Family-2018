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
          <form class="form-horizontal" role="form" method="POST" action="{{ route('reset-password') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
              <label for="password" class="col control-label">Password</label>
              <div class="col">
                <input id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                  <span class="help-block">
                    {{ $errors->first('password') }}
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
              <label for="password-confirm" class="col control-label">Confirm Password</label>
              <div class="col">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                    {{ $errors->first('password_confirmation') }}
                  </span>
                @endif
                @if ($errors->has('token'))
                  <span class="help-block">
                    {{ $errors->first('token') }}
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col">
                <button type="submit" class="btn btn-primary btn-block cursor-pointer">
                  Reset Password
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