<header class="main-header hidden-print">
  <a class="logo bg-profile" href="/dashboard">
    <span class="font-cookie font-cyan">Connected</span> <span class="font-cookie font-pink">Family</span>
  </a>
  <nav class="navbar navbar-static-top bg-profile">
    {{-- Sidebar toggle button --}}
    <a class="sidebar-toggle font-black" href="#" data-toggle="offcanvas"></a>
    {{-- Navbar Right Menu --}}
    <div class="navbar-custom-menu">
      <ul class="top-nav">
        {{-- Notification Menu --}}
        {{--
        <li class="dropdown notification-menu"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell-o fa-lg font-black"></i></a>
          <ul class="dropdown-menu">
            <li class="not-head">You have 4 new notifications.</li>
            <li><a class="media" href="javascript:;"><span class="media-left media-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                <div class="media-body"><span class="block">Lisa sent you a mail</span><span class="text-muted block">2min ago</span></div></a></li>
            <li><a class="media" href="javascript:;"><span class="media-left media-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                <div class="media-body"><span class="block">Server Not Working</span><span class="text-muted block">2min ago</span></div></a></li>
            <li><a class="media" href="javascript:;"><span class="media-left media-icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                <div class="media-body"><span class="block">Transaction xyz complete</span><span class="text-muted block">2min ago</span></div></a></li>
            <li class="not-footer"><a href="#">See all notifications.</a></li>
          </ul>
        </li>
        --}}
        {{-- User Menu --}}
        <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-lg font-black"></i></a>
          <ul class="dropdown-menu settings-menu">
            <li><a href="/profile/{{ $auth_user->username }}/edit"><i class="fa fa-edit fa-lg"></i> Edit Profile</a></li>
            <li><a href="/profile/{{ $auth_user->username }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
            <form id="logout-form"
                  action="{{ route('logout') }}"
                  method="POST" style="display: none;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
