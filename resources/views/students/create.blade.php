@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Adding child</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{route('student.store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('student_firstname') ? ' has-error' : '' }}">
                            <label for="student_firstname" class="col-md-4 control-label">First name</label>

                            <div class="col-md-6">
                                <input id="student_firstname" type="text" class="form-control" name="student_firstname"  value="{{ old('student_firstname') }}" required autofocus>

                                @if ($errors->has('student_firstname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('student_firstname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('student_lastname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Last name</label>

                            <div class="col-md-6">
                                <input id="student_lastname" type="text" class="form-control" name="student_lastname"  value="{{ old('student_lastname') }}" required autofocus>

                                @if ($errors->has('student_lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('student_lastname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('student_nickname') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nick name</label>

                            <div class="col-md-6">
                                <input id="student_nickname" type="text" class="form-control" name="student_nickname"  value="{{ old('student_nickname') }}" required autofocus>

                                @if ($errors->has('student_nickname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('student_nickname') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

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
                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}"  maxlength=10>

                                @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('emergency_tel') ? ' has-error' : '' }}">
                            <label for="emergency_tel" class="col-md-4 control-label">Emergercy Contact</label>

                            <div class="col-md-6">
                                <input id="emergency_tel" type="emergency_tel" class="form-control" name="emergency_tel" value="{{ old('emergency_tel') }}" required maxlength=10>

                                @if ($errors->has('emergency_tel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('emergency_tel') }}</strong>
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
                        <input name="parent_id" type="hidden" value="{{Auth::guard('sbparent')->user()->parent_id}}">
                        <div class="form-group{{ $errors->has('school_id') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">School Name</label>
                            <div class="col-md-6">
                                <select class="form-control" name="school_id" id="school_id" data-parsley-required="true">
                                  @foreach($schools as $key => $school)
                                  {
                                  <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
                              }
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="row">
                     <div class="col-md-offset-5 col-md-2" >
                        <img src="http://placehold.it/100x100" id="showphoto" class="img-input" />
                    </div>
                </div>
                <div class="row linespace">
                   <div class="col-md-offset-5 col-md-2" >
                       <input name="photo" type="file" id="inputphoto">

                       <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   </div>
                   @if($errors->has('photo'))
                   <div class="col-md-6 col-md-offset-4 text-center">
                     <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                 </div>
                 @endif
                 <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary pull-right form-control linespace">
                                Register
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection
