`@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body text-center">
          @include('alert')
          <img src="/uploads/avatars/{{ $driver->photo }}" class="img-avatar">
          <form enctype="multipart/form-data" action="/profile" method="POST">

            <h2>{{ $driver->driver_firstname }}'s Profile </h2>
            <table align="center">
              <tbody>
               <tr>
                <td><b>Tel.:</b></td>
                <td>{{ $driver->phone }}</td>
              </tr>
              <tr>
                <td><b>Plate Number:</b></td>
                <td>{{ $driver->platenum }}</td>
              </tr>
              <td><b>School Stop:</b></td>
              <td>{{ $driver->schoolOne->school_name or 'PLEAE UPDATE THE PROFILE' }}</td>
              <tr>
                <td></td>
                <td>{{ $driver->schoolTwo->school_name or ''}}</td>
              </tr>
              <tr>
                <td></td>
                <td>{{ $driver->schoolThree->school_name or ''}}</td>
              </tr>
              <tr>
                <td></td>
                <td>{{ $driver->schoolFour->school_name or ''}}</td>
              </tr>
              <tr>
                <td></td>
                <td>{{ $driver->schoolFive->school_name or ''}}</td>
              </tr>
            </tbody>
          </table>

          <div class="row" style="margin-left: 10px; text-align: left;" >
            <label>Update Profile Image</label>
            <input type="file" name="photo">
            @if($errors->has('photo'))
            <strong style="color: red;">{{ $errors->first('photo') }}</strong>
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          </br>
          <input type="submit" class="pull-left btn btn-primary" style="margin-top: -10px; margin-left: 15px; padding: 5px 53px;">
        </div>
        
        @if ($driver->map)
        <h4 style="margin-top: 20px;"><b>Your location: </b></h4>
        <div id="showMap"></div>
        @endif
        <a href="{{route('driver.edit',$driver->driver_id)}}" class="pull-right btn-lg btn-warning" style=""><i class="glyphicon glyphicon-edit"></i> Edit Profile</a>

      </div>

    </div>
  </div>
</div>
</div>
</div>
</div>
@endsection

@section('script')
<script src="{{asset('js/script.js')}}"></script>
@endsection
