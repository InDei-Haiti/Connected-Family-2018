<!DOCTYPE html>
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">
  <head>
    {{-- meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- SEO meta tags --}}
    <meta name="author" content="Ahmed Atef (ArtistS17)"/>
    <meta name="type" content="Organization"/>
    <meta name="description" content="Connected Family is a non profitable team working to help students to execute their ideas which may be technical, social, economical....etc. The idea was generated on 28/3/2011 and founded by 7 founders."/>
    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:description" content="@yield('og_description') Connected Family is a non profitable team working to help students to execute their ideas which may be technical, social, economical....etc. The idea was generated on 28/3/2011 and founded by 7 founders."/>
    <meta property="og:image" content="@yield('og_image', env("APP_URL") . "/connected-family.png")"/>
    <meta property="fb:app_id" content="801909629977308"/>
    {{-- title --}}
    <title>@yield('title') | Connected Family</title>
    {{-- icon --}}
    <link rel="icon" href="data:image/png;base64,{{ Imager::getBase64('logos', 'connected-family-mask.png', '32') }}">
    {{-- Fonts --}}
    <link rel="stylesheet" type="text/css" href="/css/asset/adds-on/fonts-link.css">
    {{-- CSS --}}
    <link rel="stylesheet" type="text/css" href="/css/lib/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/lib/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/asset/master.css">
    @yield('links')
  </head>
  <body>
    @include('vendor.nav')
    <div class="shade"></div>
    <div class="alert-holder">
      <div id="myAlert" class="alert alert-danger alert-dismissible d-none" role="alert">
        <button type="button" class="close" id="alert-close">
          <span aria-hidden="true">&times;</span>
        </button>
        <span class="alert-msg"></span>
      </div>
    </div>
    @yield('body')
    {{-- <div class="container-fluid" id="connected-container-fluid">@yield('container-fluid')</div> --}}
    <div class="container" id="connected-container">
      @if(isset($new_event))
         @if(  !Request::is('/')
            && !Request::is('2')
            && !Request::is('profile/*/edit')
            && !Request::is('event/'. $new_event->name . '-' . $new_event->year)
            && !Request::is('event/'. $new_event->name . '-' . $new_event->year . "/registration")
            && !Request::is('event/'. $new_event->name . '-' . $new_event->year . "/registration/tracking")
            && !Request::is('auth/register')
            && !Request::is('auth/login')

           )
          @include('notifications.new-event-notification')
        @endif
      @endif
      @yield('container')
    </div>
    @include('vendor.footer')
    {{-- JavaScript --}}
    <script type="text/javascript" src="/js/lib/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/js/lib/tether.min.js"></script>
    <script type="text/javascript" src="/js/lib/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/asset/functions.js"></script>
    <script type="text/javascript" src="/js/asset/master.js"></script>
    @yield('scripts')
  </body>
</html>
