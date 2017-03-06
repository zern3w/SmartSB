<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Alert;
use Log;
use Auth;
use Image;
use App\User;
use App\Student;
use App\School;
use App\Attendance;
use Validator;
use Illuminate\Support\Facades\Input as input;
use Illuminate\Support\Facades\Redirect;

class DriversController extends Controller{

  public function showIndex()
  {
   $driver  = User::find(Auth::user()->driver_id);
   $reviews = $driver->reviews()->with('parent')->approved()->notSpam()->orderBy('created_at','desc')->paginate(8);
   return view('drivers.home' , array('driver' => Auth::user(), 'reviews'=>$reviews));
 }

 public function showProfile()
 {
  return view('drivers.profile' , array('driver' => Auth::user()));
}

public function showStudentList()
{
  $students = $this->getStudentList(Auth::user()->driver_id);
  if ( empty($student)){}
    return view('students.index',['students' => $students]);
}

public function getStudentList($dId)
{

  $user     = Auth::user();
  // $students =  Student::where('driver_id', $user->driver_id )->get();
  $students =  Student::where('driver_id', $dId )->get();
  return $students;
}

public function update_photo(Request $request)
{
  $rules     = array(
    'photo'    => 'image'
    );
  $validator = Validator::make(Input::all(), $rules);

  if($validator->fails()){
    return Redirect::route('profile')
    ->withErrors($validator)
    ->withInput();
  }
  else if($request->hasFile('photo')){
   $photo    = $request->file('photo');
   $filename = time() . '.' . $photo->getClientOriginalExtension();
   Image::make($photo)->resize(300,300)->save(public_path('/uploads/avatars/' . $filename));
   
   $user        = Auth::user();
   // $user     = User::where('driver_id', $dId)->first();
   $user->photo = $filename;
   $user->save();
}return view('drivers.profile' , array('driver' => Auth::user()));

}

public function edit($id)
{
  $driver  = User::findOrFail($id);
  $schools = School::all();
  return view('drivers.editprofile',compact('driver','schools'));
}

public function update(Request $request, $id)
{
 $this->validate($request,[
   'driver_firstname' => 'required|max:255|alpha_spaces',
   'driver_lastname'  => 'required|max:255|alpha_spaces',
   'phone'            => 'required|regex:/(0)[0-9]{9}/',
   'platenum'         => 'required|regex:/[0-9ก-ฮa-zA-Z][ก-ฮa-zA-Z][ก-ฮa-zA-Z][0-9]{1,4}/',
   'fee'              => 'required|numeric',
   ]);
 $driver = User::findOrFail($id);
 $driver->driver_firstname  = $request->driver_firstname;
 $driver->driver_lastname   = $request->driver_lastname;
 $driver->phone             = $request->phone;
 $driver->platenum          = $request->platenum;
 $driver->note              = $request->note;
 $driver->school_stop_one   = $request->school_stop_one;
 $driver->school_stop_two   = $request->school_stop_two;
 $driver->school_stop_three = $request->school_stop_three;
 $driver->school_stop_four  = $request->school_stop_four;
 $driver->school_stop_five  = $request->school_stop_five;
 $driver->availability      = $request->availability;
 $driver->fee               = $request->fee;
 $driver->lat               = $request->lat;
 $driver->lng               = $request->lng;
 $driver->save();
 Alert::success('Your profile has been updated!', 'Successfully!');
 return view('drivers.profile' , array('driver' => Auth::user()));
  // return User::findOrFail($id);;
}

public function searchDrivers(Request $request)
{
  $lat      = $request->lat;
  $lng      = $request->lng;
  $distance = $request->distance;
  Log::info('Lng: '.$lng);
  Log::info('Distance: '.$distance);

  if ($distance == 1){
    $drivers=User::where('availability', 1)->whereBetween('lat', [$lat-0.01, $lat+0.01])->whereBetween('lng',[$lng-0.01, $lng+0.01])->get();
  }else if ($distance == 3){
    $drivers=User::where('availability', 1)->whereBetween('lat', [$lat-0.03, $lat+0.03])->whereBetween('lng',[$lng-0.03, $lng+0.03])->get();
  }else if ($distance == 5){
    $drivers=User::where('availability', 1)->whereBetween('lat', [$lat-0.05, $lat+0.05])->whereBetween('lng',[$lng-0.05, $lng+0.05])->get();
  }else{
    $drivers=User::where('availability', 1)->whereBetween('lat', [$lat-0.10, $lat+0.10])->whereBetween('lng',[$lng-0.10, $lng+0.10])->get();
  }
  return $drivers;
}

public function getDriver($dId)
{
  $result = User::where('driver_id', $dId)->first();
  return $result;
}

public function getStudentReport($id)
{
  $student = Student::where('student_id', $id)->first();
  $reports = Attendance::where('student_id', $id )->limit(30)->get();

  return view('parents.atd-report',array('student' => $student, 'reports' => $reports));
}

public function hasProfile($dId)
{
  return (bool)$driver  = User::where('driver_id', $dId)->whereNotNull('platenum')->first();
}

public function hasStudent($dId)
{
  return (bool)$student  = Student::where('driver_id', $dId)->first();
}

public function getLocation()
{
  return array('drivers' => Auth::user());
}

}