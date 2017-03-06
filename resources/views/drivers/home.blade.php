@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row">
  <div class="col-md-12">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body text-center">

          @if( empty($driver->platenum) )
          <div class="alert alert-warning">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <em> Please update your information.<a href="{{route('driver.edit',$driver->driver_id)}}">CLICK</a></em>
          </div>
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
              <tr>
                <td><b>Availability:</b></td>
                @if ($driver->availability == 1)
                <td>available</td>
                @else <td>unavailable</td>
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
       
       @if (($reviews->count()))
        <p><b>Your Reviews: </b></p>
           @foreach($reviews as $review)
              <hr>
                <div class="row">
                  <div class="col-md-12">
                    @for ($i=1; $i <= 5 ; $i++)
                      <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                    @endfor

                    {{  $review->student->parent->parent_firstname. " " . $review->student->parent->parent_lastname }} <span class="pull-right">{{$review->timeago}}</span> 
                    
                    <p>{{{$review->comment}}}</p>
                  </div>
                </div>
              @endforeach
              {{ $reviews->links() }}
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
