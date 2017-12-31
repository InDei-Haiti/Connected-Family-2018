<form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <div class="col">
      <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
  </div>
  <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
    <label for="name" class="col control-label">
      <i class="fa fa-user fa-fw" aria-hidden="true"></i> |
      <span class="text-muted text-uppercase">name</span>
    </label>
    <div class="col">
      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
      @if(count($errors) == 0 && !Request::is('/'))
        autofocus
      @endif
      >
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
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
      @if ($errors->has('email'))
        <span class="help-block">
          {{ $errors->first('email') }}
        </span>
      @endif
    </div>
  </div>
  <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
    <label for="password" class="col control-label">
      <i class="fa fa-key fa-fw" aria-hidden="true"></i> |
      <span class="text-muted text-uppercase">password</span>
    </label>
    <div class="col">
      <input id="password" type="password" class="form-control" name="password" required>
      @if ($errors->has('password'))
        <span class="help-block">
          {{ $errors->first('password') }}
        </span>
      @endif
    </div>
  </div>
  <div class="form-group">
    <label for="password-confirm" class="col control-label">
      <i class="fa fa-key fa-fw" aria-hidden="true"></i> |
      <span class="text-muted text-uppercase">confirm password</span>
    </label>
    <div class="col">
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col">
      <p>By pressing the signup or signup with facebook/linkedin button you're accepting the <a href="{{ route('terms-and-privacies') }}" target="_blank">terms and privacies</a></p>
    </div>
  </div>
  <div class="form-group">
    <div class="col text-right">
      <button type="submit" class="btn btn-primary cursor-pointer">
        <i class="fa fa-edit fa-fw" aria-hidden="true"></i> Register
      </button>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <a class="btn btn-sm btn-primary bg-fb" href="{{ route('auth.social', ['provider' => 'facebook', 'wants' => "login"]) }}" role="button">
        <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i>
        Login with Facebook
      </a>
      <a class="btn btn-sm btn-primary bg-linkedin" href="{{ route('auth.social', ['provider' => 'linkedin', 'wants' => "login"]) }}" role="button">
        <i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i>
        Login with Linkedin
      </a>
    </div>
  </div>
</form>
