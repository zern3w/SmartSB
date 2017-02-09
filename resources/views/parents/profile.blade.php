@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body text-center">
        @include('alert')
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
              <td><b>Email:</b></td>
              <td>{{ $parent->email }}</td>
            </tr>
          </tbody>
        </table>

      </div>
      <div class="row " style="margin: 30px">
        <label>Update Profile Image</label>
        <input type="file" name="photo">
        @if($errors->has('photo'))
        <strong style="color: red;">{{ $errors->first('photo') }}</strong>
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
      </br>
      <input type="submit" class="pull-left btn btn-primary">
  <a href={{route('parent.edit',$parent->parent_id)}} class="pull-right btn-lg btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit Profile</a>
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
