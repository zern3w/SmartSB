@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1" style="margin-top: 15px;">
			<div class="panel panel-default">
				<div class="panel-heading">Find a Service</div>
				<div class="panel-body">
					@include('alert')
					<h4>There are two ways to find the school bus service provider</h4>
					<hr>
					
					<li><b>Filling</b> the school bus driver name</li>
				</br>
				<div class="input-group" style="margin-bottom: 20px;">
					<span class="input-group-addon">
						<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
					</span>
					<input type="text" name="search" id="search" class="form-control" placeholder="School bus first name, last name...."></input>
				</div>

				<table class="table table-hover">
				</table>

				<hr>
				<li><b>Filling</b> the address to find the nearby school bus services</li>
			</br>
			
			<div class="input-group" style="margin-bottom: 20px;">
				<span class="input-group-addon">
					<i class="fa fa-search" aria-hidden="true"></i>
					<select name="select" id="select">
						<option value="0">Distance...</option>
						<option value="1">1 Kilometer</option>
						<option value="3">3 Kilometers</option>
						<option value="5">5 Kilometers</option>
						<option value="10">10 Kilometers</option>
					</select>
					<!-- <input type="hidden" name="distance" id="distance"> -->
				</span>
				<input type="text" class="form-control" id="address" name="address" value="" required="" placeholder="Enter a location" autocomplete="off" >
			</div>	

			<div id="map"></div>

			<ul id="geoData" style="display:none;">
				<li>Latitude: <span id="lat"></span></li>
				<li>Longitude: <span id="lon"></span></li>
			</ul>

			<meta name="csrf-token" content="{{ csrf_token() }}" />
		</div>
	</div>
</div>
</div>
</div>
@endsection

@section('script')
<script src="{{asset('js/script.js')}}"></script>
<script type="text/javascript">
	$('#search').on('keyup',function(){
		$value=$(this).val();
		if (!$value == ""){
			$.ajax({
				type : 'get',
				url : '{{ URL::to('search') }}',
				data : {'search':$value},
				success:function(data){
				// console.log(data);
				$('table').html(data);
			}
		});
		}
	})
</script>
@endsection
