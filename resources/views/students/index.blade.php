@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3>Student List</h3>
      </div>
      @include('alert')
      <div class="panel-body">
        @if (!($students->count()))
        No data in the database.
        @else
        <table class="table table-striped">
          <thead>
            <th>No.</th>
            <th>Photo</th>
            <th>Nickname</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>School</th>
            <th>Tel.</th>
            <th>Emergency Tel.</th>
            <th>Action</th>
          </thead>
          <tbody>
            <?php $no=1; ?>
            @foreach($students as $student)
            <tr>
              <td>{{$no++}}</td>
              <td><img src="/uploads/avatars/{{ $student->photo }}" class="img-table"></td>
              <td>{{$student->student_nickname}}</td>
              <td>{{$student->student_firstname}}</td>
              <td>{{$student->student_lastname}}</td>
              <td>{{$student->school->school_name}}</td>
              <td>{{$student->phone}}</td>
              <td>{{$student->emergency_tel}}</td>
              <td>
                <form class="" action="{{route('student.destroy',$student->student_id)}}" method="post">
                  <input type="hidden" name="_method" value="delete">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <a href="/report/{{  $student->student_id  }}" class="btn btn-primary"><i class="fa fa-bus" aria-hidden="true"></i> Bus attedndance</a>
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data');">
                    <i class="glyphicon glyphicon-trash"></i> Delete
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
    </div>
  </div>
</div>
@stop
