<?php
use App\ServiceRequest;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\ServiceController;

class ServiceControllerTest extends TestCase
{
	public function testUpdateStudentToList()
	{
		$serviceId                 = 36;
		$dId                       = 1;
		
		$expectedResult            = new ServiceRequest();
		$expectedResult->id        = $serviceId;
		$expectedResult->driver_id = $dId;
		
		$service                   = new ServiceController();
		$serviceObj                = $service->updateStudentToList($serviceId, $dId);
		$actualResult              = new ServiceRequest;
		$actualResult->id          = $serviceObj->id;
		$actualResult->driver_id   = $serviceObj->driver_id;
		$this->assertEquals($expectedResult,$actualResult);

	}

	// public function testUpdateAcceptedRequest()
	// {
	// 	$serviceId                = 36;
		
	// 	$expectedResult           = new ServiceRequest();
	// 	$expectedResult->id       = $serviceId;
	// 	$expectedResult->accepted = 1;
		
	// 	$service                  = new ServiceController();
	// 	$actualResult             = $service->updateAcceptRequest($serviceId);

	// 	$this->assertEquals($expectedResult,$actualResult);
	// }

	// 	public function testDestroyRequest()
	// {
	// 		$serviceId = 37;
	// 		$this->SeeInDatabase('Services', [
	// 		'id'       => $serviceId ]);
			
	// 		$service   = new ServiceController();
	// 		$service->destroyRequest($serviceId);
			
	// 		$this->notSeeInDatabase('Services', [
	// 		'id'       => $serviceId ]);
	// }

	public function testIsDuplicateRequest()
	{
		$sId          = 2;
		$dId		  = 1;

		$service       = new ServiceController();
		$actualResult = $service->isDuplicateRequest($sId,$dId);

		$this->assertTrue($actualResult);
	}
}
