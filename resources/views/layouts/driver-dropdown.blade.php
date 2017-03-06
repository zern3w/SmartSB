<li class="dropdown">
    <a href="#" class="dropdown-toggle" class="navbar-brand"  data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
      <img src="/uploads/avatars/{{ Auth::user()->photo }}" class="img-navbar">
      {{ Auth::user()->driver_firstname. ' ' . Auth::user()->driver_lastname}} <span class="caret"></span>
  </a>

  <ul class="dropdown-menu" role="menu">
    <li>
        <a href="{{ route('service.showrequest') }}">
            <i class="glyphicon glyphicon-send"> </i>  Service Requests
        </a>
    </li>

    
    <li>
        <a href="{{ url('profile') }}">
            <i class="glyphicon glyphicon-user"> </i>  Edit Profile
        </a>

        <form  action="{{ url('/profile') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
    <li>
        <a href="{{ url('/logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="glyphicon glyphicon-log-out"> </i>  Logout
    </a>

    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</li>
</ul>
</li>