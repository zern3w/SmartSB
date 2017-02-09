<div class="row">
        <div class="col-md-9">
            <div class="thumbnail">
              <img src="http://placehold.it/820x320" alt="">
              <div class="caption-full">
                  <h4 class="pull-right">${{ number_format($driver->fee, 2)}}</h4>
                  <h4><a href="{{url('drivers/'.$driver->id)}}">{{$driver->driver_firstname}}</a></h4>
                  <p>{{$driver->driver_firstname}}</p>
                  <p>{{$driver->driver_firstname}}</p>
              </div>
              <div class="ratings">
                  <p class="pull-right">{{$driver->rating_count}} {{ str_plural('review')}}</p>
                  <p>
                    @for ($i=1; $i <= 5 ; $i++)
                      <span class="glyphicon glyphicon-star{{ ($i <= $driver->rating_cache) ? '' : '-empty'}}"></span>
                    @endfor
                    {{ number_format($driver->rating_cache, 1)}} stars
                  </p>
              </div>
            </div>
            <div class="well" id="reviews-anchor">
              <div class="row">
                <div class="col-md-12">
                  @if(Session::get('errors'))
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       <h5>There were errors while submitting this review:</h5>
                       @foreach($errors->all('<li>:message</li>') as $message)
                          {{$message}}
                       @endforeach
                    </div>
                  @endif
                  @if(Session::has('review_posted'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5>Your review has been posted!</h5>
                    </div>
                  @endif
                  @if(Session::has('review_removed'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5>Your review has been removed!</h5>
                    </div>
                  @endif
                </div>
              </div>
              <div class="text-right">
                <a href="#reviews-anchor" id="open-review-box" class="btn btn-success btn-green">Leave a Review</a>
              </div>
              <div class="row" id="post-review-box" style="display:none;">
                <div class="col-md-12">
                  <form method="POST" action="http://demos.maxoffsky.com/shop-reviews/products/1" accept-charset="UTF-8">
                  <input id="ratings-hidden" name="rating" type="hidden">
                 <textarea rows="5" id="new-review" class="form-control animated" placeholder="Enter your review here..." name="comment" cols="50" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 54px;"></textarea>
                  <div class="text-right">
                    <div class="stars starrr" data-rating="{{Input::old('rating',0)}}"></div>
                    <a href="#" class="btn btn-danger btn-sm" id="close-review-box" style="display:none; margin-right:10px;"> <span class="glyphicon glyphicon-remove"></span>Cancel</a>
                    <button class="btn btn-success btn-lg" type="submit">Save</button>
                  </div>
                </form>
                </div>
              </div>

              @foreach($reviews as $review)
              <hr>
                <div class="row">
                  <div class="col-md-12">
                    @for ($i=1; $i <= 5 ; $i++)
                      <span class="glyphicon glyphicon-star{{ ($i <= $review->rating) ? '' : '-empty'}}"></span>
                    @endfor

                    {{ $review->user ? $review->user->name : 'Anonymous'}} <span class="pull-right">{{$review->timeago}}</span> 
                    
                    <p>{{{$review->comment}}}</p>
                  </div>
                </div>
              @endforeach
              {{ $reviews->links() }}
            </div>
        </div>
 </div>