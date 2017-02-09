@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Parent Profile</div>
				<div class="panel-body">
					@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
					@endif
					<form class="form-horizontal" action="{{route('parent.update',$parent->parent_id)}}" method="post">
						<input name="_method" type="hidden" value="PATCH">
						{{csrf_field()}}


						<div class="col-md-4">
							<img src="/uploads/avatars/{{ $parent->photo }}" class="img-avatar">
						</div>
						<div class="col-md-8">
							<div class="form-group{{ $errors->has('parent_firstname') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">First name</label>

								<div class="col-md-8">
									<input id="parent_firstname" type="text" class="form-control" name="parent_firstname"  value="{{ $parent->parent_firstname }}" required autofocus>

									@if ($errors->has('parent_firstname'))
									<span class="help-block">
										<strong>{{ $errors->first('parent_firstname') }}</strong>
									</span>
									@endif
								</div>
							</div>


							<div class="form-group{{ $errors->has('parent_lastname') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Last name</label>

								<div class="col-md-8">
									<input id="parent_lastname" type="text" class="form-control" name="parent_lastname"  value="{{ $parent->parent_lastname}}" required autofocus>

									@if ($errors->has('parent_lastname'))
									<span class="help-block">
										<strong>{{ $errors->first('parent_lastname') }}</strong>
									</span>
									@endif
								</div>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>

								<div class="col-md-8">
									<input id="email" type="email"  class="form-control" name="email" value="{{ $parent->email }}" disabled>

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
									<input id="phone" type="phone" class="form-control" name="phone" value="{{ $parent->phone }}" required maxlength=10>

									@if ($errors->has('phone'))
									<span class="help-block">
										<strong>{{ $errors->first('phone') }}</strong>
									</span>
									@endif
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