<div id="slider-container" class="carousel slide">
  <ol class="carousel-indicators">
    <li data-target="#slider-container" data-slide-to="0"></li>
    <li data-target="#slider-container" data-slide-to="1" class="active"></li>
    <li data-target="#slider-container" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item">
      {{-- 005951 --}}
      <div class="w-100 slider-img"{{--style="background-color: #E9579E"--}}></div>
      <div class="carousel-caption">
        <i class="fa fa-facebook-square font-fb" aria-hidden="true" style="font-size: 108px;"></i>
        &#160;&#160;
        <i class="fa fa-linkedin-square font-linkedin" aria-hidden="true" style="font-size: 108px;"></i>
        <br>
        <h3 class="font-cookie font-black">Register with Facebook or Linkedin</h3>
        <p class="font-black">
          Now you can register and login with facebook<br><br>
          <a class="btn btn-sm btn-primary bg-fb" href="{{ route('auth.social', ['provider' => 'facebook', 'wants' => "login"]) }}" role="button">
            <i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i>
            Login with Facebook
          </a>&#160;
          <a class="btn btn-sm btn-primary bg-linkedin" href="{{ route('auth.social', ['provider' => 'linkedin', 'wants' => "login"]) }}" role="button">
            <i class="fa fa-linkedin-square fa-lg" aria-hidden="true"></i>
            Login with Linkedin
          </a>
        </p>
      </div>
    </div>
    <div class="carousel-item active">
      <div class="w-100 slider-img"></div>
      <div class="carousel-caption">
        <i class="fa fa-users font-black" style="font-size: 72px;"></i>
        <br><br>
        <h3 class="font-cookie font-black"><span class="font-cyan font-cookie">Connected</span> <span class="font-pink font-cookie">Family</span> Profiles</h3>
        <p class="font-black">
          Easy and quick registration. Easy to edit your preferences and interview or group discussion dates
          <br>
          <a href="{{ route('terms-and-privacies') }}">
            Read more about profiles, terms, and privacy
          </a>
          @if(!Auth::check())
            <br><br>
            <a href="/auth/register">
              <button class="btn btn-success cursor-pointer"><i class="fa fa-edit" aria-hidden="true"> </i> Register Now</button>
            </a>
          @endif
        </p>
      </div>
    </div>
    <div class="carousel-item">
      {{-- 3d7a3d --}}
      @php
        if(!isset($new_event)) $new_event = $event;
      @endphp
      <div class="w-100 slider-img"{{--style="background-color: #97B0DA;"--}}></div>
      <div class="carousel-caption" style="text-align: center;">
        <i class="fa fa-calendar font-cyan" style="font-size: 108px;" aria-hidden="true"></i>
        <br><br>
        <h1 class="font-cookie font-black" style="font-size: 48px;">{{ $new_event->name }}'@php echo substr($new_event->year, 2); @endphp</h1>
        <p class="font-black col-md-6" style="
          display: inline-block;
          @if($event->id == 11005 || $event->id == 11006)
            direction: rtl;
          @endif
        "
        >
          @if($new_event->description)
            @if(strlen($new_event->description) > 100)
              @php echo substr($new_event->description, 0, 256); @endphp...
            @else
              {!! nl2br(substr($new_event->description, 0, 256)) !!}...
            @endif
          @else
            No Description Found
          @endif
          <a href="/event/{{ $new_event->name }}-{{ $new_event->year }}">More Info</a><br>
          {{ $new_event->name }}'@php echo substr($new_event->year, 2); @endphp is
          @if($new_event->isUpcoming())
            <b>Upcoming at {{ Date::format($new_event->started_at, "event") }}</b><br>
          @elseif($new_event->isOpened())
            <b>Opened at {{ Date::format($new_event->started_at, "event") }}</b><br><br>
            <a href="/event/{{ $new_event->name }}-{{ $new_event->year }}/registration"><button class="btn btn-success cursor-pointer">Register now</button></a><br>
          @else
            <b>Closed at {{ Date::format($new_event->ended_at, "event") }}</b><br>
          @endif
        </p>
      </div>
    </div>
  </div>
</div>
