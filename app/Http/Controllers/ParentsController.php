<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Sbparent;
use App\Student;
use App\Attendance;
use Alert;
use Auth;
use Image;
use Validator;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ParentsController extends Controller
{

	public function index(){
		$student = Student::where('parent_id', Auth::guard('sbparent')->user()->parent_id)->first();

		$hasChild = false;
		if ( empty($student) ){
			$hasChild = true;
		}
		return view('parents.home', array('parent' => Auth::guard('sbparent')->user()), ['hasChild' => $hasChild]);
	}

	public function hasChild(){

	}
	
	public function childrenList(){
        //show data
		$students =  Student::where('parent_id', Auth::guard('sbparent')->user()->parent_id )->get();
		if ( !$students ){
			Alert::info("You haven't added a child information.");
			return redirect('/sbparent');
		}else{
			$state = 'atd';
			return view('students.add',['students' => $students],['state' => $state]);
		}
	}

	public function showReview(){
		$students =  Student::where('parent_id', Auth::guard('sbparent')->user()->parent_id )->get();
		if ( !$students ){
			Alert::info("You haven't added a child information.");
			return redirect('/sbparent');
		}else{
			$state = 'review';
			return view('students.add',['students' => $students],['state' => $state]);
		}
	}


	public function newParent(Request $request){
		$this->validate($request,[
			'parent_firstname' => 'required|max:255|alpha_spaces',
			'parent_lastname' => 'required|max:255|alpha_spaces',
			'email' => 'required|email|max:255|unique:Sbparents|unique:drivers',
			'phone' => 'required|regex:/(0)[0-9]{9}/',
			]);

		if ($request->ajax()){
			$parent=Sbparent::create([
				'parent_firstname' => $request['parent_firstname'],
				'parent_lastname' => $request['parent_lastname'],
				'email' => $request['email'],
				'phone' => $request['phone'],
				'sex' => $request['sex'],
				'driver_id' => Auth::user()->driver_id,
				]);
			return Response($parent);
		}
	}

	public function deleteParent(Request $request){
		if ($request->ajax()){
			Sbparent::destroy($request->parent_id);
			return Response()->json(['sms'=>'delete successful!']);
		}
	}

	public function showProfile(){
		return view('parents.profile', array('parent' => Auth::guard('sbparent')->user()));
	}

	public function edit($id){
		$parent = Sbparent::findOrFail($id);
        // return to the edit views
		return view('parents.editprofile', array('parent' => Auth::guard('sbparent')->user()));
	}

	public function update_photo(Request $request){
		$rules = array(
			'photo' => 'image'
			);
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::route('sbparent/profile')
			->withErrors($validator)
			->withInput();
		}
        // Handle the user upload photo
		else if($request->hasFile('photo')){
			$photo = $request->file('photo');
			$filename = time() . '.' . $photo->getClientOriginalExtension();
			Image::make($photo)->resize(300,300)->save(public_path('/uploads/avatars/' . $filename));

			$user = Auth::guard('sbparent')->user();
			$user->photo = $filename;
			$user->save();
		}
		Alert::success('Your photo has been updated!', 'Successfully!');
		return view('parents.profile', array('parent' => Auth::guard('sbparent')->user()));
	}

	public function update(Request $request, $id){
        // validation
		$this->validate($request,[
			'parent_firstname' => 'required|max:255|alpha_spaces',
			'parent_lastname' => 'required|max:255|alpha_spaces',
			'phone' => 'required|regex:/(0)[0-9]{9}/',
			]);

		$parent = Sbparent::findOrFail($id);
		$parent->parent_firstname = $request->parent_firstname;
		$parent->parent_lastname = $request->parent_lastname;
		$parent->phone = $request->phone;
		$parent->save();
		Alert::success('Your profile has been updated!', 'Successfully!');
		return view('parents.profile' , array('parent' => Auth::guard('sbparent')->user()));
        // redirect()->route('auth.profile')->with('alert-success','Data Hasbeen Saved!');
	}

}
