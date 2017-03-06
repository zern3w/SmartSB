@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Parent Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/sbparent/register') }}">
                        {{ csrf_field() }}

                         <div class="form-group{{ $errors->has('parent_firstname') ? ' has-error' : '' }}">
                            <label for="parent_firstname" class="col-md-4 control-label">First name</label>

                            <div class="col-md-6">
                                <input id="parent_firstname" type="text" class="form-control" name="parent_firstname"  value="{{ old('parent_firstname') }}" required autofocus>

                                @if ($errors->has('parent_firstname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('parent_firstname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group{{ $errors->has('parent_lastname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Last name</label>

                            <div class="col-md-6">
                                <input id="parent_lastname" type="text" class="form-control" name="parent_lastname"  value="{{ old('parent_lastname') }}" required autofocus>

                                @if ($errors->has('parent_lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('parent_lastname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Mobile  Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required maxlength=10>

                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="sex" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <input name="sex" checked="checked" type="radio" value="1">Male<br>
                                <input name="sex" type="radio" value="0">Female                              
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary form-control">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
