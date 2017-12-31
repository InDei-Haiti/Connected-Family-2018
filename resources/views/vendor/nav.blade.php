<div id="connected-nav">
  <nav class="navbar navbar-toggleable-sm navbar-light bg-faded fixed-top" id="nav-connected-nav">
    <div class="container">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#connectedNavbar" aria-controls="connectedNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand font-28 noselect" href="/">
        <img src="data:image/png;base64,{{ Imager::getBase64('logos', 'connected-family.png', '32') }}" height="30" alt="" style="padding-right: 10px; margin-right: 5px; border-right: 1px solid #bababa;">
        <span class="font-cyan font-cookie">Connected</span>
        <span class="font-pink font-cookie">Family</span>
      </a>
      <div class="collapse navbar-collapse align-content-end align-items-end" id="connectedNavbar">
        <ul class="navbar-nav ml-auto font-weight-bold">
          <li class="nav-item">
            <a class="noselect nav-link <?php
                if($_SERVER['REQUEST_URI'] == '/') echo 'disabled';
              ?>" href="<?php
                if($_SERVER['REQUEST_URI'] == '/') echo '#';
                else echo '/';
              ?>"><i class="fa fa-home fa-fw fa-lg" aria-hidden="true"></i> | Home</a>
          </li>
          @if($user = Auth::user())
          <li class="nav-item">
              <a class="noselect nav-link <?php
                if(strpos($_SERVER['REQUEST_URI'], 'profile/' . $user->username)
                    && !strpos($_SERVER['REQUEST_URI'], 'edit')) echo 'disabled';
              ?>" href="<?php
                if(strpos($_SERVER['REQUEST_URI'], 'profile/' . $user->username)
                    && !strpos($_SERVER['REQUEST_URI'], 'edit')) echo '#';
                else echo '/profile/' . $user->username;
              ?>"><img class="img-thumbnail" src="data:image/{{ $user->getImageMime() }};base64,{{ $user->getImageBase64('32') }}"" height="28" alt="pp" style="margin-right: 5px; border-radius: 50%; margin-top: -15px;">{{ $user->name }}</a>
          </li>
          @else
          <li class="nav-item">
            <a class="noselect nav-link <?php
                if($_SERVER['REQUEST_URI'] == '/about') echo 'disabled';
              ?>" href="<?php
                if($_SERVER['REQUEST_URI'] == '/about') echo '#';
                else echo '/about';
              ?>"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> | About Us</a>
          </li>
          <li class="nav-item">
            <a class="noselect nav-link <?php
                if($_SERVER['REQUEST_URI'] == '/contact-us') echo 'disabled';
              ?>" href="<?php
                if($_SERVER['REQUEST_URI'] == '/contact-us') echo '#';
                else echo '/contact-us';
              ?>"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i> | Contact Us</a>
          </li>
          @endif
          <li class="nav-item dropdown align-self-md-center">
            <a class="btn btn-sm btn-secondary d-md-block d-none" href="#" id="connectedNavbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-chevron-down fa-fw" aria-hidden="true"></i>
            </a>
            <a class="btn btn-sm btn-secondary btn-block d-block d-md-none" href="#" id="connectedNavbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-chevron-down fa-fw" aria-hidden="true"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="connectedNavbarDropdown">
              @if(Auth::check())
                <a class="noselect dropdown-item <?php
                    if($_SERVER['REQUEST_URI'] == '/about') echo 'disabled';
                  ?>" href="<?php
                    if($_SERVER['REQUEST_URI'] == '/about') echo '#';
                    else echo '/about';
                  ?>"><i class="fa fa-info-circle fa-fw" aria-hidden="true"></i> | About Us</a>
                <a class="noselect dropdown-item <?php
                    if($_SERVER['REQUEST_URI'] == '/contact-us') echo 'disabled';
                  ?>" href="<?php
                    if($_SERVER['REQUEST_URI'] == '/contact-us') echo '#';
                    else echo '/contact-us';
                  ?>"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i> | Contact Us</a>
              @endif
              <a class="noselect dropdown-item <?php
                if($_SERVER['REQUEST_URI'] == '/crew') echo 'disabled';
              ?>" href="<?php
                if($_SERVER['REQUEST_URI'] == '/crew') echo '#';
                else echo '/crew';
              ?>"><i class="fa fa-users fa-fw" aria-hidden="true"></i> | Crew</a>
              <a class="noselect dropdown-item <?php
                if($_SERVER['REQUEST_URI'] == '/committees') echo 'disabled';
              ?>" href="<?php
                if($_SERVER['REQUEST_URI'] == '/committees') echo '#';
                else echo '/committees';
              ?>"><i class="fa fa-user fa-fw" aria-hidden="true"></i> | Committees</a>
              <a class="noselect dropdown-item <?php
                if($_SERVER['REQUEST_URI'] == '/events') echo 'disabled';
              ?>" href="<?php
                if($_SERVER['REQUEST_URI'] == '/events') echo '#';
                else echo '/events';
              ?>"><i class="fa fa-calendar fa-fw" aria-hidden="true"></i> | Events</a>
              <div class="dropdown-divider"></div>
              @if($user = Auth::user())
                @if($user->admin)
                  <a  class="dropdown-item"
                      href="/dashboard" target="_self">
                    <i class="fa fa-dashboard fa-fw" aria-hidden="true"></i> | Dashboard
                  </a>
                  <div class="dropdown-divider"></div>
                @endif
                <a  class="dropdown-item"
                    href="/profile/{{ $user->username }}/edit" target="_self">
                  <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> | Edit Profile
                </a>
                <a  class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i> | Logout
                </a>
                <form id="logout-form"
                      action="{{ route('logout') }}"
                      method="POST" style="display: none;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
              @else
                <a class="noselect dropdown-item <?php
                    if($_SERVER['REQUEST_URI'] == '/auth/register') echo 'disabled';
                  ?>" href="<?php
                    if($_SERVER['REQUEST_URI'] == '/auth/register') echo '#';
                    else echo '/auth/register';
                  ?>"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> | Register</a>
                <a class="noselect dropdown-item <?php
                    if($_SERVER['REQUEST_URI'] == '/auth/login') echo 'disabled';
                  ?>" href="<?php
                    if($_SERVER['REQUEST_URI'] == '/auth/login') echo '#';
                    else echo '/auth/login';
                  ?>"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i> | Login</a>
              @endif
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
<div style="margin-top: 70.4px;"></div>
