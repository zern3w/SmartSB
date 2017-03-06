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

	public function showIndex()
	{
		$student = $this->getChildren();
		$hasChild = false;

		if ( !$student->count()){
			$hasChild = true;
		}

		return view('parents.home', array('parent' => Auth::guard('sbparent')->user() , 'students' => $student), ['hasChild' => $hasChild]);
	}
	
	public function childrenList()
	{
		$students =  $this->getChildren();
		$state = 'atd';
		if ( !$students->count() ){
			Alert::info("You haven't added a child information.");
		}
		return view('students.add',['students' => $students],['state' => $state]);
	}

	public function showReview()
	{
		$students =  Student::whereNotNull('driver_id')->where('parent_id', Auth::guard('sbparent')->user()->parent_id )->get();
		if ( !$students->count() ){
			Alert::info("You haven't added a child information.");
			return redirect('/sbparent');
		}else{
			$state = 'review';
			return view('students.add',['students' => $students],['state' => $state]);
		}
	}

	public function childRequest($dId)
	{
		$student  =  $this->getChildren();
		$students =  Student::whereNull('driver_id')->where('parent_id', Auth::guard('sbparent')->user()->parent_id )->get();
		if ( !$student->count() ){
			Alert::info("You haven't added a child information");
			return redirect('/sbparent');
		}else if (!$students->count()){
			Alert::info("Your children has already got the school bus service provider");
			return redirect('/sbparent');
		}
		else{
			$state     = 'req';
			$driver_id = $dId;
			return view('students.add',['students' => $students],['state' => $state, 'driver_id' => $driver_id]);
		}
	}


	public function newParent(Request $request)
	{
		$this->validate($request,[
			'parent_firstname' => 'required|max:255|alpha_spaces',
			'parent_lastname'  => 'required|max:255|alpha_spaces',
			'email'            => 'required|email|max:255|unique:Sbparents|unique:drivers',
			'phone'            => 'required|regex:/(0)[0-9]{9}/',
			]);

		if ($request->ajax()){
			$parent=Sbparent::create([
				'parent_firstname' => $request['parent_firstname'],
				'parent_lastname'  => $request['parent_lastname'],
				'email'            => $request['email'],
				'phone'            => $request['phone'],
				'sex'              => $request['sex'],
				'driver_id'        => Auth::user()->driver_id,
				]);
			return Response($parent);
		}
	}

	public function deleteParent(Request $request)
	{
		if ($request->ajax()){
			Sbparent::destroy($request->parent_id);
			return Response()->json(['sms'=>'delete successful!']);
		}
	}

	public function showProfile()
	{
		return view('parents.profile', 
			array('parent' => Auth::guard('sbparent')->user()));
	}

	public function edit($id)
	{
		$parent = Sbparent::findOrFail($id);

		return view('parents.editprofile', 
			array('parent' => Auth::guard('sbparent')->user()));
	}

	public function update_photo(Request $request)
	{
		$rules = array(
			'photo' => 'image'
			);
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::route('sbparent/profile')
			->withErrors($validator)
			->withInput();
		}
		else if($request->hasFile('photo')){
			$photo    = $request->file('photo');
			$filename = time() . '.' . $photo->getClientOriginalExtension();
			Image::make($photo)->resize(300,300)->save(public_path('/uploads/avatars/' . $filename));

			$user = Auth::guard('sbparent')->user();
			$user->photo = $filename;
			$user->save();
		}
		Alert::success('Your photo has been updated!', 'Successfully!');
		return view('parents.profile', array('parent' => Auth::guard('sbparent')->user()));
	}

	public function update(Request $request, $id)
	{
		// $this->validate($request,[
		// 	'parent_firstname' => 'required|max:255|alpha_spaces',
		// 	'parent_lastname' => 'required|max:255|alpha_spaces',
		// 	'phone' => 'required|regex:/(0)[0-9]{9}/',
		// 	]);

		$parent                   = Sbparent::findOrFail($id);
		$parent->parent_firstname = $request->parent_firstname;
		$parent->parent_lastname  = $request->parent_lastname;
		$parent->phone            = $request->phone;
		// dd($request);
		$parent->save();
		return Sbparent::findOrFail($id);;
		// Alert::success('Your profile has been updated!', 'Successfully!');
		// return view('parents.profile' , array('parent' => Auth::guard('sbparent')->user()));
	}

	public function getChildren()
	{
		return Student::where('parent_id', Auth::guard('sbparent')->user()->parent_id)->get();
	}

	public function getParent($pId)
	{
  $result = Sbparent::where('parent_id', $pId)->first();
  return $result;
	}

	public function hasChild($pId)
	{
		return (bool)$student  = Student::where('parent_id', $pId)->first();
	}

}
