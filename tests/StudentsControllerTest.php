<?php
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\StudentsController;
use App\Student;
use App\Attendance;
use App\ServiceRequest;
use App\Review;

class StudentsControllerTest extends TestCase
{

	public function testGetStudent()
	{
		$sId                               = 110;
		
		$expectedResult                    = new Student();
		$expectedResult->student_id        = $sId;
		$expectedResult->student_firstname = "Unit";
		$expectedResult->student_lastname  = 'Test';
		$expectedResult->student_nickname  = 'LOL';
		$expectedResult->email             = 'unit@test.com';
		$expectedResult->phone             = '0907507501';
		$expectedResult->sex               = 0;
		$expectedResult->photo             = '1487529326.png';
		$expectedResult->emergency_tel     = '0895552290';
		$expectedResult->school_id         = 1;
		$expectedResult->parent_id         = 11;
		$expectedResult->driver_id         = 1;
		
		$student                           = new StudentsController();
		$studentObj                        = $student->getStudent($sId);
		$actualResult                      = new Student();
		$actualResult->student_id          = $studentObj->student_id;
		$actualResult->student_firstname   = $studentObj->student_firstname;
		$actualResult->student_lastname    = $studentObj->student_lastname;
		$actualResult->student_nickname    = $studentObj->student_nickname;
		$actualResult->phone               = $studentObj->phone;
		$actualResult->sex                 = $studentObj->sex;
		$actualResult->photo               = $studentObj->photo;
		$actualResult->email               = $studentObj->email;
		$actualResult->emergency_tel       = $studentObj->emergency_tel;
		$actualResult->school_id           = $studentObj->school_id;
		$actualResult->parent_id           = $studentObj->parent_id;
		$actualResult->driver_id           = $studentObj->driver_id;

		$this->assertEquals($expectedResult,$actualResult);
	}

	// public function testDestroyChild()
	// {
	// 	$sId = 113;
	// 	$this->SeeInDatabase('students', [
	// 		'student_id' => $sId ]);

	// 	$student                           = new StudentsController();
	// 	$student->destroy($sId);

	// 	$this->notSeeInDatabase('students', [
	// 		'student_id' => $sId ]);
	// }

	public function testDestroyStudentFromList()
	{
		$sId                        = 4;
		$expectedResult             = new Student();
		$expectedResult->student_id = $sId;
		$expectedResult->driver_id  = null;

		$student                    = new StudentsController();
		$studentObj                 = $student->destroyStudentFromList($sId);
		$actualResult               = new Student();
		$actualResult->student_id   = $studentObj->student_id;
		$actualResult->driver_id    = $studentObj->driver_id;

		$this->assertEquals($expectedResult,$actualResult);

		// dd($student);
	}

}