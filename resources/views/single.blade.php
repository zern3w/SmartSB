@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
   <h4> School Bus Provider Profile </h4>
   

   <div class="thumbnail">
    <img src="/uploads/avatars/{{ $driver->photo }}" style="margin-bottom: 20px;" class="img-rounded">
    <div class="caption-full">
      <h4 class="pull-right">฿{{ number_format($driver->fee)}}</h4>
      <h4>{{$driver->driver_firstname . " " . $driver->driver_lastname}}</h4>
      <p>{{$driver->note}}</p>
      @if ($driver->schoolOne)
      <h5 style="margin-left: 20px;"><u>School stops</u></h5>
      <ul style="margin-left: 20px;">
        <li>{{$driver->schoolOne->school_name or null}}</li>
        <li>{{$driver->schoolTwo->school_name or null}}</li>
        <li>{{$driver->schoolThree->school_name or null}}</li>
        <li>{{$driver->schoolFour->school_name or null}}</li>
        <li>{{$driver->schoolFive->school_name or null}}</li>
      </ul>
      @endif
    </div>
    <div class="ratings">
      <p class="pull-right">{{$driver->rating_count}} {{ str_plural('review')}}</p>
      <p>
        @for ($i=1; $i <= 5 ; $i++)
        <span class="glyphicon glyphicon-star{{ ($i <= $driver->rating_cache) ? '' : '-empty'}}"></span>
        @endfor
        {{ number_format($driver->rating_cache, 1)}} stars
      </p>
      @if (Auth::guard("sbparent")->user())
      <a href="{{ route('service.childrequest', $driver->driver_id) }}" class="btn btn-primary form-control" >
        <i class="glyphicon glyphicon-send"></i> Request</a>
        @elseif (Auth::guest())
        @endif
      </div>
      </div>

  <div class="well" id="reviews-anchor">
    <div class="row">
      <div class="col-md-12">
        @if(Session::get('errors'))
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5>There were errors while submitting this review:</h5>
          @foreach($errors->all(':message') as $message)
          {{$message}}
          @endforeach
        </div>
        @endif

        @include('alert')

        @if(Session::has('review_removed'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5>Your review has been removed!</h5>
        </div>
        @endif
      </div>
    </div>

    <div class="row" style="margin-top:40px;">
      <div class="col-md-12">

      @if ($date)
        @if (($date->dayago) >29)
        <div class="text-right">
          <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
        </div>
        @else
        <div class="alert alert-info">
         <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
         You can give them the feedback again after {{ -(($date->dayago) - 30) }} days. 
       </div>
       @endif
       @else
       <div class="text-right">
          <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
        </div>
       @endif
       @if ($driver->rating_count == 0)
       <div class="alert alert-warning">
         <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
         No data in the database. 
       </div>
       @endif

       <div class="row" id="post-review-box" style="display:none;">
        <div class="col-md-12">
          <form accept-charset="UTF-8" action="{{route('review', ['id'=>$driver->driver_id ,'sId'=>$sId ])}}" method="post">
            <input id="ratings-hidden" name="rating" type="hidden"> 
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <textarea class="form-control animated" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"></textarea>

            <div class="text-right">
              <div class="stars starrr" data-rating="0"></div>
              <a class="btn btn-danger btn-sm" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                <button class="btn btn-success btn-lg" type="submit"><span style='Times New Roman'><i class="glyphicon glyphicon-save-file"> </i>Save</span></button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
    @if ($reviews->count())
    @foreach($reviews as $review)
    <hr>
    <div class="row">
      <div class="col-md-12">
        @for ($i=1; $i <= 5 ; $i++)
        <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
        @endfor
        {{  $review->student->parent->parent_firstname. " " . $review->student->parent->parent_lastname }}    <span class="pull-right">{{$review->timeago}}</span> 
        <p>{{{$review->comment}}}</p>
      </div>
    </div>
    @endforeach
    {{ $reviews->links() }}
    @endif
  </div>
</div>
</div>
@endsection


@section('script')
<script src="{{asset('js/expanding.js')}}"></script>
<script src="{{asset('js/starrr.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
@endsection