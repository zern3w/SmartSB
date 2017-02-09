<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Review;
use Auth;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class ReviewsController extends Controller
{

	public function storeReviewForProduct($driverID, $comment, $rating)
	{
		$driver = User::find($driverID);
		$review = new Review();

  // this will be added when we add user's login functionality
		$review->driver_id = $driverID;
		$review->parent_id = Auth::guard('sbparent')->user()->parent_id;
		$review->comment = $comment;
		$review->rating = $rating;
		$review->save();

  // recalculate ratings for the specified product
		$driver->recalculateRating();
	}

	public function showDriverProfile($id)
	{
		$driver = User::find($id);
		if (!$driver){
			Alert::info("Your child hasn't got the school bus provider.");
			return redirect('/sbparent/review');
		}else{
  // Get all reviews that are not spam for the product and paginate them
			$reviews = $driver->reviews()->with('parent')->approved()->notSpam()->orderBy('created_at','desc')->paginate(100);
		// dd($driver);

			return View('single', array('driver'=>$driver,'reviews'=>$reviews));
		}
	}

	public function createReview($id)
	{
		$input = array(
			'comment' => Input::get('comment'),
			'rating'  => Input::get('rating')
			);
  // instantiate Rating model
		$review = new Review;

  // Validate that the user's input corresponds to the rules specified in the review model
		$rules = array(
			'comment'=>'required|min:10',
			'rating'=>'required|integer|between:1,5'
			);

		$validator = Validator::make( $input, $rules);

  // If input passes validation - store the review in DB, otherwise return to product page with error message 
		if ($validator->passes()) {
			$this->storeReviewForProduct($id, $input['comment'], $input['rating']);
			Alert::success("Your review has been posted!");
			return Redirect::to('drivers/'.$id.'#reviews-anchor');
		}

		return Redirect::to('drivers/'.$id.'#reviews-anchor')->withErrors($validator)->withInput();
	}
}
