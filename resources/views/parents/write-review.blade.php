@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Write a review</div>
				<div class="panel-body">

                    <div class="row" style="margin-top:40px;">
                      <div class="col-md-12">
                       <div class="well well-sm">
                        <div class="text-right">
                            <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box">Leave a Review</a>
                        </div>
                        
                        <div class="row" id="post-review-box" style="display:none;">
                            <div class="col-md-12">
                                <form accept-charset="UTF-8" action="{{route('review', 1)}}" method="post">
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
