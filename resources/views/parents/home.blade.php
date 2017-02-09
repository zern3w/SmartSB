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
     
    </div>
  </div>
</div>

</div>
</div>

@endsection

@section('script')
<script src="{{asset('js/script.js')}}"></script>
@endsection
