<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\Review;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\ParentsController;
use Illuminate\Http\UploadedFile\UploadedFile;

class DriversControllerTest extends TestCase
{
	use WithoutMiddleware;

	// GET THE DRIVER ON THAT DRIVER ID
	public function testGetDriver()
	{
		// $driver = User::find(5);
		// dd($driver->reviews()->with('parent')->approved()->notSpam()->orderBy('created_at','desc')->get());
		$dId                               = 16;
		
		$expectedResult                    = new User();
		$expectedResult->driver_id         = $dId;
		$expectedResult->driver_firstname  = "Puttipong";
		$expectedResult->driver_lastname   = 'Tadang';
		$expectedResult->email             = 'unit@test.com';
		$expectedResult->phone             = '0007507501';
		$expectedResult->sex               = 0;
		$expectedResult->platenum          = 'AA1234';
		$expectedResult->photo             = 'default.jpg';
		$expectedResult->lat               = 18;
		$expectedResult->lng               = 99;
		$expectedResult->availability      = 1;
		$expectedResult->fee               = 2000;
		$expectedResult->rating_cache      = 3;
		$expectedResult->rating_count      = 0;
		$expectedResult->school_stop_one   = 1;
		$expectedResult->school_stop_two   = 2;
		$expectedResult->school_stop_three = 3;
		$expectedResult->school_stop_four  = 4;
		$expectedResult->school_stop_five  = 5;
		
		$driver                            = new DriversController();
		$driverObj                         = $driver->getDriver($dId);
		$actualResult                      = new User();
		$actualResult->driver_id           = $dId;
		$actualResult->driver_firstname    = $driverObj->driver_firstname;
		$actualResult->driver_lastname     = $driverObj->driver_lastname;
		$actualResult->email               = $driverObj->email;
		$actualResult->phone               = $driverObj->phone;
		$actualResult->sex                 = $driverObj->sex;
		$actualResult->platenum            = $driverObj->platenum;
		$actualResult->photo               = $driverObj->photo;
		$actualResult->lat                 = $driverObj->lat;
		$actualResult->lng                 = $driverObj->lng;
		$actualResult->availability        = $driverObj->availability;
		$actualResult->fee                 = $driverObj->fee;
		$actualResult->rating_cache        = $driverObj->rating_cache;
		$actualResult->rating_count        = $driverObj->rating_count;
		$actualResult->school_stop_one     = $driverObj->school_stop_one;
		$actualResult->school_stop_two     = $driverObj->school_stop_two;
		$actualResult->school_stop_three   = $driverObj->school_stop_three;
		$actualResult->school_stop_four    = $driverObj->school_stop_four;
		$actualResult->school_stop_five    = $driverObj->school_stop_five;
		$this->assertEquals($expectedResult,$actualResult);
	}

	// CHECK UPDATE PROFILE
	public function testUpdateProfile()
	{
		$dId          = 15;

		$expectedResult                    = new User();
		$expectedResult->driver_firstname  = "UNIT";
		$expectedResult->driver_lastname   = "TEST";
		$expectedResult->phone             = "0007507501";
		$expectedResult->platenum          = "ABC1234";
		$expectedResult->note              = "111";
		$expectedResult->school_stop_one   = 1;
		$expectedResult->school_stop_two   = 2;
		$expectedResult->school_stop_three = 3;
		$expectedResult->school_stop_four  = 4;
		$expectedResult->school_stop_five  = 5;
		$expectedResult->availability      = 1;
		$expectedResult->fee               = 111;
		$expectedResult->lat               = 111;
		$expectedResult->lng               = 111;
		
		$driver       = new DriversController();
		$request = new Request();
		$request->driver_firstname  = "UNIT";
		$request->driver_lastname   = "TEST";
		$request->phone             = "0007507501";
		$request->platenum          = "ABC1234";
		$request->note              = "111";
		$request->school_stop_one   = 1;
		$request->school_stop_two   = 2;
		$request->school_stop_three = 3;
		$request->school_stop_four  = 4;
		$request->school_stop_five  = 5;
		$request->availability      = 1;
		$request->fee               = 111;
		$request->lat               = 111;
		$request->lng               = 111;

		$driverObj = $driver->update($request,$dId);

		$actualResult = new User();
		$actualResult->driver_firstname  = $driverObj->driver_firstname;
		$actualResult->driver_lastname   = $driverObj->driver_lastname;
		$actualResult->phone             = $driverObj->phone;
		$actualResult->platenum          = $driverObj->platenum;
		$actualResult->note              = $driverObj->note;
		$actualResult->school_stop_one   = $driverObj->school_stop_one;
		$actualResult->school_stop_two   = $driverObj->school_stop_two;
		$actualResult->school_stop_three = $driverObj->school_stop_three;
		$actualResult->school_stop_four  = $driverObj->school_stop_four;
		$actualResult->school_stop_five  = $driverObj->school_stop_five;
		$actualResult->availability      = $driverObj->availability;
		$actualResult->fee               = $driverObj->fee;
		$actualResult->lat               = $driverObj->lat;
		$actualResult->lng               = $driverObj->lng;

		$this->assertEquals($expectedResult,$actualResult);
	}

	public static function getTestingFile($fileName, $stubDirPath, $mimeType = null, $size = null)
	{
		$file =  $stubDirPath . $fileName;

		return new \Illuminate\Http\UploadedFile($file, $fileName, $mimeType, $size, $error = null, $testMode = true);
	}

	public function testUploadPhoto()
	{
		$dId          = 8;
		$this->seeInDatabase('drivers', [
			'driver_id' => $dId,
			'photo' => 'default.jpg']);

		$fileName = 'avatar.png';
		$filePath = __DIR__ . '/';
		$file = $this->getTestingFile($fileName, $filePath, 'image/png', 2100);

		$request = new Request();
		$request->photo = $file;

		$driver = new DriversController();
		$driver->update_photo($request, $dId);
		$this->seeInDatabase('drivers', [
			'driver_id' => $dId,
			'photo' => 'default.jpg']);
	}

	// CHECK DRIVER ID HAS PLATE NUMBER
	public function testHasProfile()
	{
		$dId          = 1;

		$driver       = new DriversController();
		$actualResult = $driver->hasProfile($dId);

		$this->assertTrue($actualResult);
	}

	// CHECK STUDENT WHO HAS THAT DRIVER ID
	public function testHasStudent()
	{
		$dId          = 1;

		$driver       = new DriversController();
		$actualResult = $driver->hasStudent($dId);

		$this->assertTrue($actualResult);
	}

	// GET THE STUDENT LIST
	// public function testGetStudentList()
	// {
	// 	$dId = 1;

	// 	$expectedResult1                   = new Student();
	// 	$expectedResult->student_firstname = "Puttipong";
	// 	$expectedResult->student_lastname  = 'Tadang';
	// 	$expectedResult->student_nickname  = 'Tadang';
	// 	$expectedResult->email             = 'unit@test.com';
	// 	$expectedResult->phone             = '0007507501';
	// 	$expectedResult->sex               = 0;
	// 	$expectedResult->photo             = 'default.jpg';
	// 	$expectedResult->emergency_tel     = 3;
	// 	$expectedResult->school_id         = 4;
	// 	$expectedResult->parent_id         = 5;
	// 	$expectedResult->driver_id         = $dId;

	// 	$collection = collect([$expectedResult1,$expectedResult1,$expectedResult1]);

	// 	// $driver       = new DriversController();
	// 	// $actualResults = $driver->getStudentList($dId);

	// 	// $key = 0;
	// 	foreach ($actualResults as $actualResult) {
	// 		var_dump($key);
	// 		$key++;
	// 	}
	// }

	// public function testSearchDriver()
	// {
	// 	$request          = new Request();
	// 	$request->lat = 1;
	// 	$request->lon = 1;
	// 	$request->distance = 10;

	// 	$driver       = new DriversController();
	// 	$actualResult = $driver->searchDrivers($request);

	// 	$this->assertTrue($actualResult);
	// }

}