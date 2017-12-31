<aside class="main-sidebar hidden-print">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image"><img class="img-circle" src="data:image/{{ $auth_user->getImageMime() }};base64,{{ $auth_user->getImageBase64('64') }}" alt="User Image"></div>
      <div class="pull-left info">
        <p>{{ $auth_user->name }}</p>
        <p class="designation">@php echo ucwords($auth_user->admin->title); @endphp</p>
      </div>
    </div>
    <!-- Sidebar Menu-->
    <ul class="sidebar-menu">
      <li>
        <a href="{{ route('dashboard') }}">
          <i class="fa fa-dashboard"> </i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-user"> </i> <span>Recruitment</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('dashboard.recruitment.interviews') }}">
              <i class="fa fa-calendar fa-fw"></i>
              Interviews
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.recruitment.participants') }}">
              <i class="fa fa-users fa-fw"></i>
              Participants
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-users"> </i> <span>Users</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('dashboard.users.manage') }}">
              <i class="fa fa-wrench fa-fw"></i>
              View and Manage
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-user"> </i> <span>Members</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('dashboard.members.add') }}">
              <i class="fa fa-plus fa-fw"></i>
              Add
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.members.manage') }}">
              <i class="fa fa-wrench fa-fw"></i>
              View and Manage
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-calendar"> </i> <span>Events</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('dashboard.events.add') }}">
              <i class="fa fa-plus fa-fw"></i>
              Add
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.events.manage') }}">
              <i class="fa fa-wrench fa-fw"></i>
              View and Manage
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-star"> </i> <span>Preferences</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('dashboard.preferences.add') }}">
              <i class="fa fa-plus fa-fw"></i>
              Add
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.preferences.manage') }}">
              <i class="fa fa-wrench fa-fw"></i>
              View and Manage
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-calendar"> </i> <span>Interviews</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('dashboard.interviews.add') }}">
              <i class="fa fa-plus fa-fw"></i>
              Add
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.interviews.manage') }}">
              <i class="fa fa-wrench fa-fw"></i>
              View and Manage
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-calendar"> </i> <span>Group Discussions</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('dashboard.group_discussions.add') }}">
              <i class="fa fa-plus fa-fw"></i>
              Add
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.group_discussions.manage') }}">
              <i class="fa fa-wrench fa-fw"></i>
              View and Manage
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-users"> </i> <span>Participants</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('dashboard.participants.manage') }}">
              <i class="fa fa-wrench fa-fw"></i>
              View and Manage
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-lock"> </i> <span>Admins</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="{{ route('dashboard.admins.add') }}">
              <i class="fa fa-plus fa-fw"></i>
              Add
            </a>
          </li>
          <li>
            <a href="{{ route('dashboard.admins.manage') }}">
              <i class="fa fa-wrench fa-fw"></i>
              View and Manage
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a>
          <i class="fa fa-stack-overflow"> </i> <span>Event Statistics</span>
          <i class="fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          @foreach($shared_events as $shared_event)
            <li>
              <a href="{{ route('dashboard.events.statistics', ['event' => $shared_event->id]) }}">
                <i class="fa fa-search fa-fw"></i>
                {{ $shared_event->name }} ({{ $shared_event->year }})
              </a>
            </li>
          @endforeach
        </ul>
      </li>
    </ul>
  </section>
</aside>