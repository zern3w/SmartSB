<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use App\User;
use App\Student;
use App\Sbparent;
use App\ServiceRequest;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

/*
**SHOW UI
*/
public function showRequest()
{
	$dId      = Auth::user()->driver_id;
	$requests = $this->getRequest($dId);

	return view('services.index')
	->with('requests', $requests);
}

/*
**OPERATOR
*/
public function serviceRequest($id, $dId)
{
	$driver = User::where('driver_id', $dId)->first();

	if (!$driver){
		Alert::warning('Driver could not be found!', 'Warning!');
		return redirect()->back();
	}

	if ($this->isDuplicateRequest($id, $dId)){
		Alert::warning('You have already sent the request!', 'Warning!');
		return view('bookservice');
	}

	$this->createRequest($id, $dId);

	Alert::success('Service request sent.', 'Successfully!');
	return redirect()
	->route('parent.index');
}

public function acceptRequest($id)
{
	$this->updateAcceptRequest($id);
	$this->updateStudentToList($id);

	Alert::success('The request has been accepted', 'Successfully!');
	return $this->showRequest();
}

public function deleteRequest($id)
{
	$this->destroyRequest($id);

	Alert::success('The request has been deleted', 'Successfully!');
	return $this->showRequest();
}

/*
**DATABASE
*/
public function createRequest($sId, $dId)
{
	$request             = new ServiceRequest();
	$request->student_id = $sId;
	$request->driver_id  = $dId;
	$request->save();
	$testData1 = 2;
	$testData2 = 1;

	$result = ServiceRequest::where('student_id', $sId)->where('driver_id', $dId)->first();
	$expectedResult             = new ServiceRequest();
	$expectedResult->student_id = $result->student_id;
	$expectedResult->driver_id  = $result->driver_id;
	$expectedResult->accepted = 0;

	return $expectedResult;
}

public function getRequest($dId)
{ 
	return 
	ServiceRequest::where('driver_id', $dId)
	->where('accepted', false)->get();
}

public function updateAcceptRequest($id)
{ 
	$request           = ServiceRequest::where('id', $id)
	->where('accepted', false)->findOrFail($id);
	$request->accepted = true;
	$request->save();

	$result = $request           = ServiceRequest::where('id', $id)->first();
	$expectedResult             = new ServiceRequest();
	$expectedResult->id = $id;
	$expectedResult->accepted = $result->accepted;


	return $expectedResult;
}

public function updateStudentToList($id)
{
	$student_id         = ServiceRequest::where('id', $id)
	->value('student_id');
	$student            = Student::where('student_id', $student_id)
	->findOrFail($student_id);
	$student->driver_id = Auth::user()->driver_id;
	// $student->driver_id = $dId;
	$student->save();
	return ServiceRequest::where('id', $id)->first();
}

public function destroyRequest($id)
{ 
	$request = ServiceRequest::where('id', $id)
	->where('accepted', false)->findOrFail($id);
	$request->delete();
}

/*
**VALIDATION
*/
public function isDuplicateRequest($id, $dId){
	return (bool) ServiceRequest::where('driver_id', $dId)
	->where('student_id', $id)->first();
}

}
