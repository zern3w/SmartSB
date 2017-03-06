@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Profile</div>
				<div class="panel-body">
					<form class="form-horizontal" action="{{route('driver.update',$driver->driver_id)}}" method="post" onkeypress="return event.keyCode != 13;">
						<input name="_method" type="hidden" value="PATCH">
						{{csrf_field()}}

						<div class="col-md-4">
							<img src="/uploads/avatars/{{ $driver->photo }}" class="img-avatar">
						</div>
						<div class="col-md-8">
							<div class="form-group{{ $errors->has('driver_firstname') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">First name</label>

								<div class="col-md-8">
									<input id="driver_firstname" type="text" class="form-control" name="driver_firstname"  value="{{ $driver->driver_firstname }}" required autofocus>

									@if ($errors->has('driver_firstname'))
									<span class="help-block">
										<strong>{{ $errors->first('driver_firstname') }}</strong>
									</span>
									@endif
								</div>
							</div>


							<div class="form-group{{ $errors->has('driver_lastname') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Last name</label>

								<div class="col-md-8">
									<input id="driver_lastname" type="text" class="form-control" name="driver_lastname"  value="{{ $driver->driver_lastname}}" required autofocus>

									@if ($errors->has('driver_lastname'))
									<span class="help-block">
										<strong>{{ $errors->first('driver_lastname') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-8">
									<input id="email" type="email"  class="form-control" name="email" value="{{ $driver->email }}" disabled>

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
									<input id="phone" type="phone" class="form-control" name="phone" value="{{ $driver->phone }}" required maxlength=10>

									@if ($errors->has('phone'))
									<span class="help-block">
										<strong>{{ $errors->first('phone') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('platenum') ? ' has-error' : '' }}">
								<label for="platenum" class="col-md-4 control-label">Plate number</label>

								<div class="col-md-8">
									<input id="platenum" type="platenum" class="form-control" name="platenum" value="{{ $driver->platenum }}" required maxlength=7>

									@if ($errors->has('platenum'))
									<span class="help-block">
										<strong>{{ $errors->first('platenum') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('note') ? ' has-error' : '' }}">
								<label for="note" class="col-md-4 control-label">Note</label>

								<div class="col-md-8">
									<textarea class="form-control" name="note" id="note" rows="3" >{{ $driver->note }}</textarea>

									@if ($errors->has('note'))
									<span class="help-block">
										<strong>{{ $errors->first('note') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<?php $no= 1; ?>
							<div class="form-group">
								<label for="school" class="col-md-4 control-label">School Bus Stop</label>

								<div class="col-md-8">
									<select class="form-control" name="school_stop_one" id="pl1" onchange="check();">
										<option value="0">Select a School #<?php echo $no++;?></option>
										@foreach($schools as $key => $school){
										@if ( $driver->school_stop_one ==  $school->school_id )
										echo '<option selected="selected" value="{{ $driver->school_stop_one }}">{{ $school->school_name }}</option>';
										@else
										echo '<option  value="{{ $school->school_id }}">{{ $school->school_name }}</option>';
										@endif
									}
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="school" class="col-md-4 control-label"></label>

							<div class="col-md-8">
								<select class="form-control" name="school_stop_two" id="pl2" onchange="check();">
									<option value="0">Select a School #<?php echo $no++;?></option>
									@foreach($schools as $key => $school){
									@if ( $driver->school_stop_two ==  $school->school_id )
									echo '<option selected="selected" value="{{ $driver->school_stop_two }}">{{ $school->school_name }}</option>';
									@else
									echo '<option  value="{{ $school->school_id }}">{{ $school->school_name }}</option>';
									@endif
								}
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="school" class="col-md-4 control-label"></label>

						<div class="col-md-8">
							<select class="form-control" name="school_stop_three" id="pl3" onchange="check();">
								<option value="0">Select a School #<?php echo $no++;?></option>
								@foreach($schools as $key => $school){
								@if ( $driver->school_stop_three ==  $school->school_id )
								echo '<option selected="selected" value="{{ $driver->school_stop_three }}">{{ $school->school_name }}</option>';
								@else
								echo '<option  value="{{ $school->school_id }}">{{ $school->school_name }}</option>';
								@endif
							}
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="school" class="col-md-4 control-label"></label>

					<div class="col-md-8">
						<select class="form-control" name="school_stop_four" id="pl4" onchange="check();">
							<option value="0">Select a School #<?php echo $no++;?></option>
							@foreach($schools as $key => $school){
							@if ( $driver->school_stop_four ==  $school->school_id )
							echo '<option selected="selected" value="{{ $driver->school_stop_four }}">{{ $school->school_name }}</option>';
							@else
							echo '<option  value="{{ $school->school_id }}">{{ $school->school_name }}</option>';
							@endif
						}
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="school" class="col-md-4 control-label"></label>

				<div class="col-md-8">
					<select class="form-control" name="school_stop_five" id="pl5" onchange="check();">
						<option value="0">Select a School #<?php echo $no++;?></option>
						@foreach($schools as $key => $school){
						@if ( $driver->school_stop_five ==  $school->school_id )
						echo '<option selected="selected" value="{{ $driver->school_stop_five }}">{{ $school->school_name }}</option>';
						@else
						echo '<option  value="{{ $school->school_id }}">{{ $school->school_name }}</option>';
						@endif
					}
					@endforeach
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="status" class="col-md-4 control-label">Status</label>
			<div class="col-md-8">
				<input type="hidden" name="availability" value="0" />
				@if ( $driver->availability == 1 )  <!-- zero equl to availability -->
				<input type="checkbox" name="availability" value="1" checked style="margin-top: 12px;"> Availability
				@else  <!-- no availability -->
				<input type="checkbox" name="availability" value="1" style="margin-top: 12px;"> Availability
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('fee') ? ' has-error' : '' }}">
			<label for="platenum" class="col-md-4 control-label">Service fee</label>

			<div class="col-md-8">
				<input id="fee" type="number" class="form-control" name="fee" value="{{ $driver->fee }}" required>

				@if ($errors->has('fee'))
				<span class="help-block">
					<strong>{{ $errors->first('fee') }}</strong>
				</span>
				@endif
			</div>
		</div>

	</div>
	<p><strong>Location: </strong></p>
	<li><i>Mark your location, make the user find you easily.</i></li>
	<hr class="featurette-divider">
	<div class="input-group" style="margin-bottom: 20px;">
		<span class="input-group-addon">
			<i class="fa fa-search" aria-hidden="true"></i>
		</span>
		<input type="text" class="form-control" id="address" name="address" value="" placeholder="Enter a location" autocomplete="off">
	</div>
	<div id="driverMap"></div>
	<ul id="geoData" class="email-textbox">
		<input type="hidden" id="lat" name="lat" value="{{ $driver->lat or '0' }}" />
		<input type="hidden" id="lon" name="lng" value="{{ $driver->lng or '0' }}" />
	</ul>

	<div class="form-group">
		<input type="submit" class="btn btn-primary form-control" value="Save">
	</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection

@section('script')
<script src="{{asset('js/script.js')}}"></script>
@endsection
