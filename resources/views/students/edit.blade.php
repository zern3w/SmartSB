@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Child Profile</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{route('student.update',$student->student_id)}}" method="post" enctype="multipart/form-data">
						<input name="_method" type="hidden" value="PATCH">
						{{csrf_field()}}

						<div class="col-md-4">
							<img src="/uploads/avatars/{{ $student->photo }}" class="img-avatar" id="showphoto">
							

							<input name="photo" type="file" id="inputphoto">
							@if($errors->has('photo'))
							{{ $errors->first('photo') }}
							@endif
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

						</div>
						<div class="col-md-8">
							<div class="form-group{{ $errors->has('student_firstname') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">First name</label>

								<div class="col-md-8">
									<input id="student_firstname" type="text" class="form-control" name="student_firstname"  value="{{ $student->student_firstname }}" required autofocus>

									@if ($errors->has('student_firstname'))
									<span class="help-block">
										<strong>{{ $errors->first('student_firstname') }}</strong>
									</span>
									@endif
								</div>
							</div>


							<div class="form-group{{ $errors->has('student_lastname') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Last name</label>

								<div class="col-md-8">
									<input id="student_lastname" type="text" class="form-control" name="student_lastname"  value="{{ $student->student_lastname}}" required autofocus>

									@if ($errors->has('student_lastname'))
									<span class="help-block">
										<strong>{{ $errors->first('student_lastname') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('student_nickname') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Nick name</label>

								<div class="col-md-8">
									<input id="student_nickname" type="text" class="form-control" name="student_nickname"  value="{{ $student->student_nickname}}" required autofocus>

									@if ($errors->has('student_nickname'))
									<span class="help-block">
										<strong>{{ $errors->first('student_nickname') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-8">
									<input id="email" type="email"  class="form-control" name="email" value="{{ $student->email }}" >

									@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
								<label for="phone" class="col-md-4 control-label">Mobile  Number</label>

								<div class="col-md-8">
									<input id="phone" type="phone" class="form-control" name="phone" value="{{ $student->phone }}"  maxlength=10>

									@if ($errors->has('phone'))
									<span class="help-block">
										<strong>{{ $errors->first('phone') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('emergency_tel') ? ' has-error' : '' }}">
								<label for="emergency_tel" class="col-md-4 control-label">Emergercy Contact</label>

								<div class="col-md-8">
									<input id="emergency_tel" type="emergency_tel" class="form-control" name="emergency_tel" value="{{ $student->emergency_tel }}" required maxlength=10>

									@if ($errors->has('emergency_tel'))
									<span class="help-block">
										<strong>{{ $errors->first('emergency_tel') }}</strong>
									</span>
									@endif
								</div>
							</div>
							
			
							<div class="form-group{{ $errors->has('school_id') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">School Name</label>
								<div class="col-md-8">
									<select class="form-control" name="school_id" id="school_id" data-parsley-required="true">
										@foreach($schools as $key => $school)
										
										@if ( $student->school_id ==  $school->school_id )
										echo '<option selected="selected" value="{{ $school->school_id }}">{{ $school->school_name }}</option>';
										@else
										echo '<option  value="{{ $school->school_id }}">{{ $school->school_name }}</option>';
										@endif
										@endforeach
									</select>


								</div>
							</div>

							<div class="form-group">
								<input type="submit" class="btn btn-primary  form-control" value="Save">
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
		@stop