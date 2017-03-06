@extends('layouts.app')

@section('content')
@include('alert')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Service requests</h4></div>
				<div class="panel-body">
         <div class="col-lg-12">
          @if (!$requests->count())
          <p>You have no service request.</p>
          @else
          <table class="table table-striped">
            <thead>
              <th>No.</th>
              <th>Photo</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Tel.</th>
              <th>Student nickname</th>
              <th>School</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php $no=1; ?>
              @foreach($requests as $request)
              <tr>
                <td>{{$no++}}</td>
                <td><img src="/uploads/avatars/{{ $request->student->parent->photo }}" class="img-table"></td>
                <td>{{$request->student->parent->parent_firstname}}</td>
                <td>{{$request->student->parent->parent_lastname}}</td>
                <td>{{$request->student->parent->phone}}</td>
                <td>{{$request->student->student_nickname}}</td>
                <td>{{$request->student->school->school_name}}</td>
                <td>
                  <form action="{{ route('request.delete', ['id'=>$request->id]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a href="{{ route('request.accept', ['id' => $request->id]) }} " class="btn btn-success"><i class="fa fa-bus" aria-hidden="true"></i> Accept</a>
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
</div>
</div>
@endsection

@section('script')
<script src="{{asset('js/script.js')}}"></script>
@endsection
