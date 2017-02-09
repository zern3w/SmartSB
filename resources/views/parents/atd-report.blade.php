@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Student attendance report</div>
				<div class="panel-body">
					
					<img src="/uploads/avatars/{{ $student->photo }}" class="img-avatar">

					<table align="center">
						<tbody>
							<tr> <h2 align="center">{{ $student->student_nickname }}</h2></tr>
							<tr>
								<td><b>Name:</b></td>
								<td>{{ $student->student_firstname. ' ' .$student->student_lastname }}</td>
							</tr>
							<tr>
								<td><b>Tel.:</b></td>
								<td>{{ $student->phone }}</td>
							</tr>
							<tr>
								<td><b>School:</b></td>
								<td>{{ $student->school->school_name }}</td>
							</tr>
						</tbody>
					</table>

					<table class="table table-striped">
						<thead>
							<th>No.</th>
							<th>Date</th>
							<th>Status</th>
							<th>Time</th>
							<th>Bus Attendant</th>
						</thead>
						<tbody>
							<?php $no=1; ?>
							@foreach($reports as $report)
							<?php
							Carbon::setLocale('th');
							$dt = Carbon::parse($report->created_at);
							$date = $dt->formatLocalized('%A %d %B %Y'); 
							$time = date('H:i', strtotime($report->created_at));
							if ($report->atd_status == 1){
								$atdStatus = 'Got on';}
								else $atdStatus = 'Got off';
								?>
								<tr>
									<td>{{$no++}}</td>
									<td>{{$date}}</td>
									<td>{{$atdStatus}}</td>
									<td>{{$time}}</td>
									<td>{{ $report->user->driver_firstname }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						@if($reports->isEmpty())
						<div class="alert alert-warning">
							<span class="glyphicon glyphicon-exclamation-sign"></span>
							<em> No record in the database.</em>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection
