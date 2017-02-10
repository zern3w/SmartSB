@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body text-center">

          @if( empty($driver->platenum) )
          @if(Session::has('warning_msg'))
          <div class="alert alert-warning">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <em> {!! session('warning_msg') !!}</em>
          </div>
          @endif
          @endif

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
                @if( !empty($driver->platenum) )
                <td><b>Plate Number:</b></td>
                <td>{{ $driver->platenum }}</td>
                @endif
              </tr>
            </tbody>
            
          </table>
        </div>

        @if( !empty($driver->lat) )
        <div style="margin: 10px;margin-top: -10px;">
          <p><b>Your Location: </b></p>
          <div id="showMap"></div>
        </div>
        @endif
        <div class="container" style="padding: 20px;">
       
        <p><b>Your Reviews: </b></p>
           @foreach($reviews as $review)
              <hr>
                <div class="row">
                  <div class="col-md-12">
                    @for ($i=1; $i <= 5 ; $i++)
                      <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                    @endfor

                    {{  $review->parent->parent_firstname. " " . $review->parent->parent_firstname }} <span class="pull-right">{{$review->timeago}}</span> 
                    
                    <p>{{{$review->comment}}}</p>
                  </div>
                </div>
              @endforeach
              {{ $reviews->links() }}
       
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
