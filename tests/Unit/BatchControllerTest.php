<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class BatchControllerTest extends TestCase
{
    public function testIndexMethod()
    {
        // Create a mock of the Batch model
        $batchModelMock = $this->createMock(Batch::class);

        // Configure the mock to return an array of batches when the all() method is called
        $batchModelMock->expects($this->once())
            ->method('all')
            ->willReturn([
                [ 'id' => 1, 'name' => 'Batch 1' ],
                [ 'id' => 2, 'name' => 'Batch 2' ],
            ]);

        // Create a mock of the view
        $viewMock = $this->createMock(\Illuminate\View\View::class);

        // Configure the view mock to expect a call to the with() method with the correct data
        $viewMock->expects($this->once())
            ->method('with')
            ->with('batches', [
                [ 'id' => 1, 'name' => 'Batch 1' ],
                [ 'id' => 2, 'name' => 'Batch 2' ],
            ])
            ->willReturnSelf();

        // Create a mock of the BatchController
        $controllerMock = $this->getMockBuilder(BatchController::class)
            ->setMethods(['view'])
            ->getMock();

        // Configure the controller mock to return the view mock when the view() method is called
        $controllerMock->expects($this->once())
            ->method('view')
            ->with('batches.index')
            ->willReturn($viewMock);

        // Inject the mock of the Batch model into the controller
        $controllerMock->batch = $batchModelMock;

        // Call the index() method on the controller
        $result = $controllerMock->index();

        // Assert that the result is the expected view
        $this->assertSame($viewMock, $result);
    }

    public function testCreateMethod()
    {
        // Create a mock of the Beer model
        $beerModelMock = $this->createMock(Beer::class);

        // Configure the mock to return an array of beer IDs when the pluck() method is called
        $beerModelMock->expects($this->once())
            ->method('pluck')
            ->with('id')
            ->willReturn([1, 2, 3]);

        // Create a mock of the view
        $viewMock = $this->createMock(\Illuminate\View\View::class);

        // Configure the view mock to expect a call to the with() method with the correct data
        $viewMock->expects($this->once())
            ->method('with')
            ->with('beer_id', [1, 2, 3])
            ->willReturnSelf();

        // Create a mock of the BatchController
        $controllerMock = $this->getMockBuilder(BatchController::class)
            ->setMethods(['view'])
            ->getMock();

        // Configure the controller mock to return the view mock when the view() method is called
        $controllerMock->expects($this->once())
            ->method('view')
            ->with('batches.create')
            ->willReturn($viewMock);

        // Inject the mock of the Beer model into the controller
        $controllerMock->beer = $beerModelMock;

        // Call the create() method on the controller
        $result = $controllerMock->create();

        // Assert that the result is the expected view
        $this->assertSame($viewMock, $result);
    }

    public function testStoreMethod()
    {
        // Create a mock of the Request object
        $requestMock = $this->createMock(Request::class);

        // Configure the mock to return the input values when the input() method is called
        $requestMock->expects($this->exactly(3))
            ->method('input')
            ->will($this->returnValueMap([
                ['beer_id', null, 1],
                ['production_speed', null, 50],
                ['size', null, 1000],
            ]));

        // Create a mock of the Batch model
        $batchModelMock = $this->createMock(Batch::class);

        // Configure the mock to return itself when the save() method is called
        $batchModelMock->expects($this->once())
            ->method('save')
            ->willReturnSelf();

        // Create a mock of the User model
        $userModelMock = $this->createMock(User::class);

        // Configure the mock to return an array representing a user when the find() method is called
        $userModelMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn([ 'id' => 1, 'name' => 'Alice' ]);

        // Create a mock of the Auth facade
        $authMock = $this->createMock(Auth::class);

        // Configure the mock to return the user model mock when the user() method is called
        $authMock::expects($this->once())
            ->method('user')
            ->willReturn($userModelMock);

        // Create a mock of the BatchController
        $controllerMock = $this->getMockBuilder(BatchController::class)
            ->setMethods(['model'])
            ->getMock();

        // Configure the controller mock to return the batch model mock when the model() method is called
        $controllerMock->expects($this->once())
            ->method('model')
            ->with(Batch::class)
            ->willReturn($batchModelMock);

        // Inject the mock of the Auth facade into the controller
        $controllerMock->auth = $authMock;

        // Call the store() method on the controller
        $result = $controllerMock->store($requestMock);

        // Assert that the result is the ID of the batch
        $this->assertSame(1, $result);
    }

    public function testShow() {
        // Mock the Batch::find() and FinishedBatch::find() methods
        $batchMock = $this->createMock(stdClass::class);
        $finishedBatchMock = $this->createMock(stdClass::class);
        Batch::shouldReceive('find')
              ->once()
              ->with(1)
              ->andReturn($batchMock);
        FinishedBatch::shouldReceive('find')
                     ->once()
                     ->with(1)
                     ->andReturn($finishedBatchMock);
    
        // Assert that the view is returned with the correct data
        $response = $this->call('GET', '/batches/1');
        $this->assertViewHas('batch', $batchMock);
        $this->assertViewHas('result', $finishedBatchMock);
    }
    

    public function testEditMethod()
    {
        // Create a mock of the Batch model
        $batchModelMock = $this->createMock(Batch::class);

        // Configure the mock to return an array representing a batch when the find() method is called
        $batchModelMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn([ 'id' => 1, 'name' => 'Batch 1' ]);

        // Create a mock of the view
        $viewMock = $this->createMock(\Illuminate\View\View::class);

        // Configure the view mock to expect a call to the with() method with the correct data
        $viewMock->expects($this->once())
            ->method('with')
            ->with('batch', [ 'id' => 1, 'name' => 'Batch 1' ])
            ->willReturnSelf();

        // Create a mock of the BatchController
        $controllerMock = $this->getMockBuilder(BatchController::class)
            ->setMethods(['view'])
            ->getMock();

        // Configure the controller mock to return the view mock when the view() method is called
        $controllerMock->expects($this->once())
            ->method('view')
            ->with('batches.edit')
            ->willReturn($viewMock);

        // Inject the mock of the Batch model into the controller
        $controllerMock->batch = $batchModelMock;

        // Call the edit() method on the controller
        $result = $controllerMock->edit(1);

        // Assert that the result is the expected view
        $this->assertSame($viewMock, $result);
    }

    public function testUpdateMethod()
    {
        // Create a mock of the Request object
        $requestMock = $this->createMock(Request::class);

        // Configure the mock to return the input values when the input() method is called
        $requestMock->expects($this->exactly(3))
            ->method('input')
            ->will($this->returnValueMap([
                ['beer_id', null, 1],
                ['production_speed', null, 50],
                ['size', null, 1000],
            ]));

        // Create a mock of the Batch model
        $batchModelMock = $this->createMock(Batch::class);

        // Configure the mock to return itself when the save() method is called
        $batchModelMock->expects($this->once())
            ->method('save')
            ->willReturnSelf();

        // Create a mock of the BatchController
        $controllerMock = $this->getMockBuilder(BatchController::class)
            ->setMethods(['model'])
            ->getMock();

        // Configure the controller mock to return the batch model mock when the model() method is called
        $controllerMock->expects($this->once())
            ->method('model')
            ->with(Batch::class)
            ->willReturn($batchModelMock);

        // Call the update() method on the controller
        $result = $controllerMock->update($requestMock, 1);

        // Assert that the result is the ID of the batch
        $this->assertSame(1, $result);
    }

    public function testDestroyMethod()
    {
        // Create a mock of the Batch model
        $batchModelMock = $this->createMock(Batch::class);

        // Configure the mock to return itself when the delete() method is called
        $batchModelMock->expects($this->once())
            ->method('delete')
            ->willReturnSelf();

        // Create a mock of the BatchController
        $controllerMock = $this->getMockBuilder(BatchController::class)
            ->setMethods(['model'])
            ->getMock();

        // Configure the controller mock to return the batch model mock when the model() method is called
        $controllerMock->expects($this->once())
            ->method('model')
            ->with(Batch::class)
            ->willReturn($batchModelMock);

        // Call the destroy() method on the controller
        $result = $controllerMock->destroy(1);

        // Assert that the result is the ID of the batch
        $this->assertSame(1, $result);
    }

    public function testGetOptimalSpeed() {
        // Mock the DB::table() method
        $mock = $this->createMock(stdClass::class);
        $mock->method('where')
             ->willReturnSelf();
        $mock->method('value')
             ->willReturn(50);
        DB::shouldReceive('table')
          ->once()
          ->with('beers')
          ->andReturn($mock);
    
        // Assert that the method returns the expected value
        $this->assertEquals(50, getOptimalSpeed(1));
    }

    public function testStoreResultSet() {
        // Mock the DB::table() method
        $mock = $this->createMock(stdClass::class);
        $mock->expects($this->once())
             ->method('insert')
             ->with([
                 'batch_id' => 1,
                 'successful_products' => 10,
                 'failed_products' => 5
             ]);
        DB::shouldReceive('table')
          ->once()
          ->with('finished_batches')
          ->andReturn($mock);
    
        // Call the method and verify that the insert method is called with the expected arguments
        storeResultSet(1, 10, 5);
    }
    
    public function testHistory() {
        // Mock the FinishedBatch::all() method
        $mock = $this->createMock(stdClass::class);
        FinishedBatch::shouldReceive('all')
                     ->once()
                     ->andReturn($mock);
    
        // Assert that the view is returned with the correct data
        $response = $this->call('GET', '/history');
        $this->assertViewHas('batchResults', $mock);
    }
    
    
}
