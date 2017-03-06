@extends('layouts.app')

@section('content')

<div class="container">
 <div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="panel panel-default">
        @include('alert')
        <div class="panel-body text-center">

         @if( $hasChild )
         <div class="alert alert-warning">
          <span class="glyphicon glyphicon-exclamation-sign"></span>
          <em> Please add your child information.</em>
          <u><i><a href="/addchild">CLICK</a></i></u>
        </div>
        @endif

        <img src="/uploads/avatars/{{ $parent->photo }}" class="img-avatar">
        <form enctype="multipart/form-data" action="/sbparent/profile" method="POST">

          <h2>{{ $parent->parent_firstname }}'s Profile </h2>
          <!-- <p style="color: #808080; font-size: 1.1em;">{{ $parent->intro }}</p> -->
          <table align="center">
            <tbody>
             <tr>
              <td><b>Tel.:</b></td>
              <td>{{ $parent->phone }}</td>
            </tr>
            <tr>
              <td><b>Email: </b></td>
              <td>{{ $parent->email }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      @if( !$hasChild )
      <hr>
      <h3 style="margin-left: 15px;"><u>My Children Information</u></h3>
      <div class="row" style="padding: 10px;">
        @foreach($students as $student)
        <div class="col-md-4">
          <div class="thumbnail" style="border-radius: 10px;">
            <img src="/uploads/avatars/{{ $student->photo }}" class="img img-rounded" >
            <div class="caption text-center">
              <h2><b>{{$student->student_nickname}}</b></h2>
              <p style="text-align: left;">
                <b>Name:</b> {{$student->student_firstname}} {{$student->student_lastname}} </br>
                <b>School:</b> {{$student->school->school_name}}</br>
                <b>Phone:</b> {{$student->phone}}</br>
                <b>Emergencency Contact:</b> {{$student->emergency_tel}}</br>
              </p>
              @if ($student->driver)
              <div class="thumbnail" style="margin-top: 20px;">
                <a href="{{route('review', ['id'=>$student->driver->driver_id ,'sId'=>$student->student_id ])}}">
                  <div class="row text-center">
                    <h4>Driver information</h4>
                  </div>
                  <p>
                    <div class="row">
                      <div class="col-md-5">
                        <img src="/uploads/avatars/{{ $student->driver->photo }}" class="img-driverInfo">
                      </div>
                      <div class="col-md-7 text-left">
                        <b>Name:</b> {{$student->driver->driver_firstname}}</br>
                        <b>Tel:</b> {{$student->driver->phone}}</br>
                        <b>Plate number:</b> {{$student->driver->platenum}}</br>
                      </p>
                    </div>
                  </div>
                </div>
              </a>
              @endif
            </div>
            
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>

</div>
</div>

@endsection

@section('script')
<script src="{{asset('js/script.js')}}"></script>
@endsection
