<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Controllers\ParentsController;
use Illuminate\Http\Request;
use App\Sbparent;

class ParentsControllerTest extends TestCase
{
	public function testGetParent()
	{
		$pId                              = 19;
		
		$expectedResult                   = new Sbparent();
		$expectedResult->parent_id        = $pId;
		$expectedResult->parent_firstname = "Unit";
		$expectedResult->parent_lastname  = 'Test';
		$expectedResult->email            = 'unit@test.com';
		$expectedResult->phone            = '0904447722';
		$expectedResult->sex              = 0;
		$expectedResult->photo            = 'default.jpg';
		
		$parent                           = new ParentsController();
		$parentObj                        = $parent->getParent($pId);
		$actualResult                     = new Sbparent();
		$actualResult->parent_id          = $parentObj->parent_id;
		$actualResult->parent_firstname   = $parentObj->parent_firstname;
		$actualResult->parent_lastname    = $parentObj->parent_lastname;
		$actualResult->email              = $parentObj->email;
		$actualResult->phone              = $parentObj->phone;
		$actualResult->sex                = $parentObj->sex;
		$actualResult->photo              = $parentObj->photo;

		$this->assertEquals($expectedResult,$actualResult);
	}

	public function testUpdateProfile()
	{
		$pId          = 20;

		$expectedResult                    = new Sbparent();
		$expectedResult->parent_firstname  = "EPIC";
		$expectedResult->parent_lastname   = "TEST";
		$expectedResult->phone             = "0999999999";
		$parent       = new ParentsController();
		$request = new Request();
		$request->parent_firstname  = "EPIC";
		$request->parent_lastname   = "TEST";
		$request->phone             = "0999999999";

		$parentObj = $parent->update($request,$pId);

		$actualResult = new Sbparent();
		$actualResult->parent_firstname  = $parentObj->parent_firstname;
		$actualResult->parent_lastname   = $parentObj->parent_lastname;
		$actualResult->phone             = $parentObj->phone;

		$this->assertEquals($expectedResult,$actualResult);
	}

	public function testHasChild()
	{
		$pId          = 67;

		$parent       = new ParentsController();
		$actualResult = $parent->hasChild($pId);

		$this->assertTrue($actualResult);
	}

}
