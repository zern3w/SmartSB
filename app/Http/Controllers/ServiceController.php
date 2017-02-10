<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ServiceController extends Controller
{
	public function getIndex(){
		$friends = Auth::user()->parents();
		return view('services.index')->with('friends', $friends);
	}
	public function friendRequests(){
		
	}

	public function friendRequestsPending(){
		
	}

	public function hasFriendRequestPending(){
		
	}

	// public function hasFriendRequestPending(User $user){
		
	// }

	public function hasFriendRequestReceived(User $user){
		
	}

	public function addFriend(User $user){

	}

	public function acceptFriendRequest(User $user){

	}

	public function isFriendWith(User $user){

	}

}
