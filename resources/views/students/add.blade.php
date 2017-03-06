       @extends('layouts.app')
       @section('content')
       <div class="container">
        <div class="row">
          <div class="panel panel-default">
            <div class="panel-heading">
            @if ($state)
              @if ($state == 'atd')
              <h3>Bus Attendance</h3>

              @elseif ($state == 'review')
              <h3>Review and Rating</h3>

                @elseif ($state == 'req')
              <h3>Choose your child to use the service</h3>

              @elseif ($state == 'addchild')
              <h3>My Children</h3>
              <a href="{{route('student.create')}}" class="btn-lg btn-success pull-right">Add Child</a><br><br>
              @endif
@endif
            </div>
            <div class="panel-body">

              @include('alert')

              @if($students->isEmpty())
              <div class="alert alert-warning">
                <span class="glyphicon glyphicon-exclamation-sign"></span>
                <em> No data in the database.</em>
              </div>
              @endif

              <div class="row">
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
                        <b>Emergencency Contact:</b> {{$student->emergency_tel}}
                      </p>
@if ($state)
                      @if ($state == 'atd')
                      <a href="/report/{{  $student->student_id  }}" class="btn btn-warning form-control" style="margin-right: 10px"><i class="glyphicon glyphicon-calendar"></i> See the Bus Attendance</a>

                      @elseif ($state == 'review')
                      <a href="{{route('review', ['id'=>$student->driver->driver_id ,'sId'=>$student->student_id ])}}" class="btn btn-success form-control" style="margin-right: 10px"><i class="glyphicon glyphicon-thumbs-up"></i> Review and Rating</a>

                       @elseif ($state == 'req')
                      <a href="{{ route('service.request', ['id' => $student->student_id, 'dId' => $driver_id]) }}" class="btn btn-success form-control" style="margin-right: 10px"><i class="glyphicon glyphicon-check"></i> Select</a>

                      @elseif ($state == 'addchild')
                      <form class="" action="{{route('student.destroy',$student->student_id)}}" method="post">
                        <p>
                          <input type="hidden" name="_method" value="delete">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <a href="{{ route('htmltopdf',['download'=>'pdf']) }}" class="btn btn-warning pull-left"><i class="glyphicon glyphicon-circle-arrow-down"></i> Download QR tag</a>
                          <button type="submit" class="btn btn-danger pull-right" onclick="return confirm('Are you sure to delete this data');">
                            <i class="glyphicon glyphicon-trash"></i> Delete
                          </button>
                          <a href="{{route('student.edit',$student->student_id)}}" class="btn btn-primary pull-right" style="margin-right: 10px"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                        </br>
                      </p>
                    </form>
                    @endif
                     @endif
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection
