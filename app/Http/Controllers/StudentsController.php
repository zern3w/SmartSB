<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Student;
use App\School;
use Log;
use Alert;
use Auth;
use Image;
use Validator;
use PDF;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Redirect;

class StudentsController extends Controller
{
	public function index(){
        //show data
		$students =  Student::all();
		return view('students.index',['students' => $students]);
	}

  public function addchild(){
        //show data
    $students =  Student::where('parent_id', Auth::guard('sbparent')->user()->parent_id )->get();
    $state = 'addchild';
    return view('students.add',['students' => $students],['state' => $state]);
  }

  public function create(){
    $schools = School::all();
    return view('students.create',['schools' => $schools]);
  }

  public function edit($id){
    $student = Student::findOrFail($id);
    $schools = School::all();
        // return to the edit views
    return view('students.edit', compact('student'),['schools' => $schools]);
  }

  public function store(Request $request){
       // validation
    $this->validate($request,[
     'student_firstname' => 'required|max:255|alpha_spaces',
     'student_lastname' => 'required|max:255|alpha_spaces',
     'student_nickname' => 'required|max:255|alpha_spaces',
     'email' => 'email|max:255|unique:Sbparents|unique:drivers|unique:students',
     'phone' => 'regex:/(0)[0-9]{9}/',
     'emergency_tel' => 'regex:/(0)[0-9]{9}/',
     'parent_id' => 'required',
     'photo' => 'required',
     ]);
      // create new data
    $student = new Student;
    $student->student_firstname = $request->student_firstname;
    $student->student_lastname = $request->student_lastname;
    $student->student_nickname = $request->student_nickname;
    $student->email = $request->email;
    $student->phone = $request->phone;
    $student->emergency_tel = $request->emergency_tel;
    $student->sex = $request->sex;
    $student->school_id = $request->school_id;
    $student->parent_id = $request->parent_id;
    $rules = array(
      'photo' => 'image'
      );
    $validator = Validator::make(Input::all(), $rules);

    if($validator->fails()){
      return Redirect::route('/')
      ->withErrors($validator)
      ->withInput();
    }
        // Handle the user upload photo
    else if($request->hasFile('photo')){
      $photo = $request->file('photo');
      $filename = time() . '.' . $photo->getClientOriginalExtension();
      Image::make($photo)->resize(300,300)->save(public_path('/uploads/avatars/' . $filename));

      $student->photo = $filename;
      $student->save();
      $students =  Student::where('parent_id', Auth::guard('sbparent')->user()->parent_id )->get();
      Alert::success('Your child has been added!', 'Successfully!');
    }
    return view('students.add',['students' => $students],['state' => 'addchild']);
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  IlluminateHttpRequest  $request
     * @param  int  $id
     * @return IlluminateHttpResponse
     */
    public function update(Request $request, $id){
     $students =  Student::all();
        // validation
     $this->validate($request,[
      'student_firstname' => 'required|max:255|alpha_spaces',
      'student_lastname' => 'required|max:255|alpha_spaces',
      'student_nickname' => 'required|max:255|alpha_spaces',
      'email' => 'email|max:255|unique:Sbparents|unique:drivers',
      'emergency_tel' => 'regex:/(0)[0-9]{9}/',
      'phone' => '|regex:/(0)[0-9]{9}/',
      ]);

     $student = Student::findOrFail($id);
     $student->student_firstname = $request->student_firstname;
     $student->student_lastname = $request->student_lastname;
     $student->student_nickname = $request->student_nickname;
     $student->email = $request->email;
     $student->school_id = $request->school_id;
     $student->phone = $request->phone;
     $student->emergency_tel = $request->emergency_tel;
     $rules = array(
      'photo' => 'image'
      );
     $validator = Validator::make(Input::all(), $rules);

     if($validator->fails()){
      return Redirect::route('student.edit')
      ->withErrors($validator)
      ->withInput();
    }
        // Handle the user upload photo
    else if($request->hasFile('photo')){
      $photo = $request->file('photo');
      $filename = time() . '.' . $photo->getClientOriginalExtension();
      Image::make($photo)->resize(300,300)->save(public_path('/uploads/avatars/' . $filename));

      $student->photo = $filename;
        // redirect()->route('auth.profile')->with('alert-success','Data Hasbeen Saved!');
    }
    $student->save();
    Alert::success('Your profile has been updated!', 'Successfully!');
    $students =  Student::where('parent_id', Auth::guard('sbparent')->user()->parent_id )->get();
    return view('students.add',['students' => $students],['state' => 'addchild']);
  }

  public function update_photo(Request $request){
   $rules = array(
    'photo' => 'image'
    );
   $validator = Validator::make(Input::all(), $rules);

   if($validator->fails()){
    return redirect()->route('student.create')
    ->withErrors($validator)
    ->withInput();
  }
        // Handle the user upload photo
  else if($request->hasFile('photo')){
    $photo = $request->file('photo');
    $filename = time() . '.' . $photo->getClientOriginalExtension();
    Image::make($photo)->resize(300,300)->save(public_path('/uploads/avatars/' . $filename));

    $user = new Student;
    $user->photo = $filename;
    $user->save();
  }
  return redirect()->route('student.create');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return IlluminateHttpResponse
     */
		 // delete data
    public function destroy($id){
     $student = Student::findOrFail($id);
     $student->delete();
     if (Auth::guard('sbparent')->user()){
       $students =  Student::where('parent_id', Auth::guard('sbparent')->user()->parent_id )->get();
       Alert::success('Your child has been deleted!', 'Successfully!');
       return view('students.add',['students' => $students],['atd' => false]);
     }
     else {
       $students =  Student::where('driver_id', Auth::user()->driver_id )->get();
       Alert::success('Your child has been deleted!', 'Successfully!');
       return view('students.index',['students' => $students]);
     }
   }

   public function generateTag(Request $req){
      // show all data to index
      // $student = Student::all();
    $students =  Student::where('parent_id', Auth::guard('sbparent')->user()->parent_id )->get();
    view()->share('students',$students);
    if($req->has('download')){
      $pdf = PDF::loadView('pdf');
      return $pdf->stream('SmartSB_Tag.pdf');
    }
    return view('students/add');
  }
}
