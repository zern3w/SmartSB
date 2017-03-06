  <li class="dropdown">
    <a href="#" class="dropdown-toggle" class="navbar-brand"  data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">
      <img src="/uploads/avatars/{{ Auth::guard('sbparent')->user()->photo }}"  class="img-navbar">
      {{ Auth::guard('sbparent')->user()->parent_firstname. ' ' . Auth::guard('sbparent')->user()->parent_lastname}} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">

      <li>
        <a href="{{ url('sbparent/review') }}">
          <i class="glyphicon glyphicon-saved"></i>  Write a review
        </a>
      </li>

        <li>
        <a href="/addchild">
          <i class="glyphicon glyphicon-briefcase"></i>  Child Profile
        </a>

        <form  action="{{ url('/sbparent/addchild') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </li>


      <li>
        <a href="{{ url('/sbparent/profile') }}">
          <i class="glyphicon glyphicon-user"></i>  Edit Profile
        </a>

        <form  action="{{ url('/sbparent/profile') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </form>
      </li>
      <li>
        <a href="{{ url('/sbparent/logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="glyphicon glyphicon-log-out"></i>  Logout
      </a>

      <form id="logout-form" action="{{ url('/sbparent/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
    </li>
  </ul>
</li>