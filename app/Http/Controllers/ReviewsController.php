<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Review;
use Auth;
use Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ReviewsController extends Controller
{

	public function storeReviewForProduct($driverID, $studentID, $comment, $rating)
	{
		$driver             = User::find($driverID);
		$review             = new Review();
		$review->driver_id  = $driverID;
		$review->student_id = $studentID;
		$review->comment    = $comment;
		$review->rating     = $rating;
		$review->save();

		$this->recalculateRating($driver);
	}

	public function recalculateRating($driver)
    {
		$driver               = User::where('driver_id', $driver->driver_id)->first();
		$reviews              = $driver->reviews()->notSpam()->approved();
		$avgRating            = $reviews->avg('rating');
		$driver->rating_cache = round($avgRating,1);
		$driver->rating_count = $reviews->count();
		$driver->save();
    }

	public function showDriverProfile($id, $sId)
	{
		$driver = User::find($id);
		$date   = Review::where('student_id', $sId)
					->where('driver_id', $id)
					->orderBy('id', 'desc')->first();
		if (!$date){
			$date = "";
		}

		if (!$driver){
			Alert::info("Your child hasn't got the school bus provider");
			return redirect('/sbparent/review');
		}else{
			$reviews = $driver->reviews()->with('parent')->approved()->notSpam()->orderBy('created_at','desc')->paginate(10);
			return View('single', array('driver'=>$driver,'reviews'=>$reviews, 'sId'=>$sId, 'date'=>$date ));
		}
	}

	public function createReview($id, $sId)
	{
		$input = array(
			'comment' => Input::get('comment'),
			'rating'  => Input::get('rating')
			);
		$review = new Review;

		$rules = array(
			'comment' =>'required|min:10',
			'rating'  =>'required|integer|between:1,5'
			);

		$validator = Validator::make( $input, $rules);

		if ($validator->passes()) {
			$this->storeReviewForProduct($id, $sId, $input['comment'], $input['rating']);
			Alert::success("Your review has been posted!");
			return Redirect::to('drivers/'.$id.'/'.$sId.'#reviews-anchor');
		}

		return Redirect::to('drivers/'.$id.'/'.$sId.'#reviews-anchor')->withErrors($validator)->withInput();
	}

}
