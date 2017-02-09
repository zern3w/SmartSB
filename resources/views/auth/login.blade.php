@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                  @if(Session::has('success_msg'))
                  <div class="alert alert-success">
                      <span class="glyphicon glyphicon-ok"></span>
                      <em> {!! session('success_msg') !!}</em>
                  </div>
                  @endif
                  
                  <img src="https://pixady.com/img/2017/01/276094_54211.jpg" style="width: 168px; height: auto; display: block;margin-left: auto; margin-right: auto; margin-bottom: 10px;">        

                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <div class="input-group margin-bottom-sm">
                                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                <input class="form-control" type="email" id="email" name="email" placeholder="Email address" value="{{ old('email') }}" required autofocus>
                            </div>


                            <!-- <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus> -->

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                <input class="form-control" id="password" type="password" placeholder="Password" name="password" required>
                                <!-- <input id="password" type="password" class="form-control" name="password" required> -->
                            </div>
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">

                         <button type="submit" class="btn btn-primary form-control">
                            Login
                        </button>

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">

                     <a class="btn btn-link form-control" href="{{ url('/register') }}">
                        Create an account
                    </a>


                    <a class="btn btn-link form-control" href="{{ url('/password/reset') }}">
                        Forgot Your Password?
                    </a>

                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
@endsection
