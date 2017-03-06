 <?
 public function testExample()
    {
     $this->seeInDatabase('drivers', [
       'email' => 'zer.n3w@gmail.com'
       ]);
    }

    public function testShowMainUI()
    {
     $this->visit('/')
     ->See('Features');
    }

    public function testShowStudentListUI()
    {
     $response = $this->call('GET', '/addchild');

     $this->see(200, $response->status());
    }

    public function testPost()
    {
     $response = $this->call('POST', '/drivers/{id}/{sId}', ['id' => '1'],['sId' => '0']);

     $this->assertEquals(302, $response->status());
    }

public function testGetRoute()
    {
     $this->visitRoute('parent.index');
     $this->assertEquals(500, $this->status());
    }

    public function testInsertStudentModel(){
     $testData1 = 2;
     $testData2 = 1;
     $expectedResult             = new ServiceRequest();
     $expectedResult->student_id = $testData1;
     $expectedResult->driver_id  = $testData2;
     $expectedResult->accepted = 0;


     $service = new ServiceController();
     $actualResult = $service->createRequest($testData1, $testData2);


     $this->assertEquals($expectedResult,$actualResult);
    }

    public function testUpdateAcceptedServiceController(){
     $serviceId = 36;

     $expectedResult             = new ServiceRequest();
     $expectedResult->id = $serviceId;
     $expectedResult->accepted = 1;

     $service = new ServiceController();
     $actualResult = $service->updateAcceptRequest($serviceId);

     $this->assertEquals($expectedResult,$actualResult);
    }

      public function testUpdateAcceptedServiceController()
    {

        $expectedResult             = new Sbparent();
        $expectedResult->parent_firstname = "Thitipun";

        $parent = new ParentsController();
        $actualResult = $parent->getParent(66);

        $this->assertEquals($expectedResult,$actualResult);
    }