 <nav class="navbar navbar-default navbar-static-top navbar-inverse" style="margin-bottom: 0;">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }} ">
                <img alt="Brand" src="/img/logo.png" >
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guard("sbparent")->user())
                <li><a href="{{ route('parent.index') }}">Home</a></li>
                <li><a href="{{ url('/bookservice') }}">Find a Service</a></li>
                <li><a href="{{ url('sbparent/childrenList') }}">Bus Attendance</a></li>
                @include('layouts.parent-dropdown')
                @elseif (! Auth::guest())
                <li><a href="{{ url('/home') }}">Home</a></li>
                <li><a href="{{ url('/studentlist') }}">Student list</a></li>
                @include('layouts.driver-dropdown')
                @else (Auth::guest())
                <li><a href="/#feature">Features</a></li>
                <li><a href="/#howitwork">How It Works</a></li>
                <li><a href="{{ url('/bookservice') }}">Find a Service</a></li>
                <li><a href="{{ url('/sbparent/login') }}" class="btn btn-ghost btn-login">Login/Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>