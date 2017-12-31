<!DOCTYPE html>
<html lang="en-US">
  <head>
    {{-- meta tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- SEO meta tags --}}
    <meta name="author" content="Ahmed Atef (ArtistS17)"/>
    <meta name="description" content="Connected Family is a non profitable team working to help students to execute their ideas which may be technical, social, economical....etc. The idea was generated on 28/3/2011 and founded by 7 founders."/>
    <meta name="type" content="Organization"/>
    {{-- title --}}
    <title>@yield('title') | Dashboard — Connected Family</title>
    {{-- icon --}}
    <link rel="icon" href="data:image/png;base64,{{ Imager::getBase64('logos', 'connected-family-mask.png', '32') }}">
    {{-- Fonts --}}
    <link rel="stylesheet" type="text/css" href="/css/asset/adds-on/fonts-link.css">
    {{-- CSS --}}
    <link rel="stylesheet" type="text/css" href="/css/dashboard/main.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard/asset/master.css">
    @yield('links')
  </head>
  <body class="sidebar-mini fixed">
    <div class="wrapper">
      @php $auth_user = Auth::user(); @endphp
      @include('dashboard.vendor.nav')
      @include('dashboard.vendor.side-nav')
      <div class="content-wrapper">
        @yield('container')
      </div>
    </div>
    {{-- JavaScript --}}
    <script src="/js/dashboard/jquery-2.1.4.min.js"></script>
    <script src="/js/dashboard/essential-plugins.js"></script>
    <script src="/js/dashboard/bootstrap.min.js"></script>
    <script src="/js/dashboard/plugins/pace.min.js"></script>
    <script src="/js/dashboard/main.js"></script>
    <script src="/js/dashboard/functions.js"></script>
    @yield('scripts')
    <script type="text/javascript">
      $(document).ready(function() {
        $("div.slimScrollBar").remove();
        $("div.slimScrollRail").remove();
        var x = $("div.slimScrollDiv").children();
        $("div.slimScrollDiv").remove();
        $('aside.main-sidebar').prepend(x)
          .css({
            'height': '96%',
            'max-height': '96%',
            'overflow-y': 'auto',
          });
        $('section.sidebar').css({
            'height': '96%',
            'max-height': '96%',
            'overflow-y': 'auto',
          });
      });
    </script>
  </body>
</html>