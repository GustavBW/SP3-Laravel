<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIndexMethod()
    {
        // Create a mock of the User model
        $userModelMock = $this->createMock(User::class);

        // Configure the mock to return an array of users when the all() method is called
        $userModelMock->expects($this->once())
            ->method('all')
            ->willReturn([
                [ 'id' => 1, 'name' => 'Alice' ],
                [ 'id' => 2, 'name' => 'Bob' ],
            ]);

        // Create a mock of the view
        $viewMock = $this->createMock(\Illuminate\View\View::class);

        // Configure the view mock to expect a call to the with() method with the correct data
        $viewMock->expects($this->once())
            ->method('with')
            ->with('users', [
                [ 'id' => 1, 'name' => 'Alice' ],
                [ 'id' => 2, 'name' => 'Bob' ],
            ])
            ->willReturnSelf();

        // Create a mock of the UserController
        $controllerMock = $this->getMockBuilder(UserController::class)
            ->onlyMethods(['view'])
            ->getMock();

        // Configure the controller mock to return the view mock when the view() method is called
        $controllerMock->expects($this->once())
            ->method('view')
            ->with('user.index')
            ->willReturn($viewMock);

        // Inject the mock of the User model into the controller
        $controllerMock->user = $userModelMock;

        // Call the index() method on the controller
        $result = $controllerMock->index();

        // Assert that the result is the expected view
        $this->assertSame($viewMock, $result);
    }

    public function testCreateMethod()
    {
        // Create a mock of the UserController
        $controllerMock = $this->getMockBuilder(UserController::class)
            ->onlyMethods(['view'])
            ->getMock();

        // Configure the controller mock to return a view when the view() method is called
        $controllerMock->expects($this->once())
            ->method('view')
            ->with('create')
            ->willReturn($this->createMock(\Illuminate\View\View::class));

        // Call the create() method on the controller
        $result = $controllerMock->create();

        // Assert that the result is an instance of \Illuminate\View\View
        $this->assertInstanceOf(\Illuminate\View\View::class, $result);
    }

    public function testShowMethod()
    {
        // Create a mock of the User model
        $userModelMock = $this->createMock(User::class);

        // Configure the mock to return a user when the find() method is called
        $userModelMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn([
                'id' => 1,
                'name' => 'Alice',
            ]);

        // Create a mock of the view
        $viewMock = $this->createMock(\Illuminate\View\View::class);

        // Configure the view mock to expect a call to the with() method with the correct data
        $viewMock->expects($this->once())
            ->method('with')
            ->with('user', [
                'id' => 1,
                'name' => 'Alice',
            ])
            ->willReturnSelf();

        // Create a mock of the UserController
        $controllerMock = $this->getMockBuilder(UserController::class)
            ->onlyMethods(['view'])
            ->getMock();

        // Configure the controller mock to return the view mock when the view() method is called
        $controllerMock->expects($this->once())
            ->method('view')
            ->with('user.show')
            ->willReturn($viewMock);

        // Inject the mock of the User model into the controller
        $controllerMock->user = $userModelMock;

        // Call the show() method on the controller
        $result = $controllerMock->show(1);

        // Assert that the result is the expected view
        $this->assertSame($viewMock, $result);
    }

    public function testStoreMethod()
    {
        // Create a mock of the User model
        $userModelMock = $this->createMock(User::class);

        // Configure the mock to return a user when the create() method is called
        $userModelMock->expects($this->once())
            ->method('create')
            ->with([
                'name' => 'Alice',
            ])
            ->willReturn([
                'id' => 1,
                'name' => 'Alice',
            ]);

        // Create a mock of the redirect
        $redirectMock = $this->createMock(\Illuminate\Routing\Redirector::class);

        // Configure the redirect mock to expect a call to the route() method with the correct data
        $redirectMock->expects($this->once())
            ->method('route')
            ->with('user.show', 1)
            ->willReturnSelf();

        // Create a mock of the UserController
        $controllerMock = $this->getMockBuilder(UserController::class)
            ->onlyMethods(['redirect'])
            ->getMock();

        // Configure the controller mock to return the redirect mock when the redirect() method is called
        $controllerMock->expects($this->once())
            ->method('redirect')
            ->willReturn($redirectMock);

        // Inject the mock of the User model into the controller
        $controllerMock->user = $userModelMock;

        // Call the store() method on the controller
        $result = $controllerMock->store([
            'name' => 'Alice',
        ]);

        // Assert that the result is the expected redirect
        $this->assertSame($redirectMock, $result);
    }

    public function testUpdateMethod()
    {
        // Create a mock of the User model
        $userModelMock = $this->createMock(User::class);

        // Configure the mock to return a user when the find() method is called
        $userModelMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn([
                'id' => 1,
                'name' => 'Alice',
            ]);

        // Configure the mock to return a user when the update() method is called
        $userModelMock->expects($this->once())
            ->method('update')
            ->with([
                'name' => 'Bob',
            ])
            ->willReturn([
                'id' => 1,
                'name' => 'Bob',
            ]);

        // Create a mock of the redirect
        $redirectMock = $this->createMock(\Illuminate\Routing\Redirector::class);

        // Configure the redirect mock to expect a call to the route() method with the correct data
        $redirectMock->expects($this->once())
            ->method('route')
            ->with('user.show', 1)
            ->willReturnSelf();

        // Create a mock of the UserController
        $controllerMock = $this->getMockBuilder(UserController::class)
            ->onlyMethods(['redirect'])
            ->getMock();

        // Configure the controller mock to return the redirect mock when the redirect() method is called
        $controllerMock->expects($this->once())
            ->method('redirect')
            ->willReturn($redirectMock);

        // Inject the mock of the User model into the controller
        $controllerMock->user = $userModelMock;

        // Call the update() method on the controller
        $result = $controllerMock->update(1, [
            'name' => 'Bob',
        ]);

        // Assert that the result is the expected redirect
        $this->assertSame($redirectMock, $result);
    }

    public function testEditMethod()
    {
        // Create a mock of the User model
        $userModelMock = $this->createMock(User::class);

        // Configure the mock to return an array representing a user when the find() method is called
        $userModelMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn([ 'id' => 1, 'name' => 'Alice' ]);

        // Create a mock of the view
        $viewMock = $this->createMock(\Illuminate\View\View::class);

        // Configure the view mock to expect a call to the with() method with the correct data
        $viewMock->expects($this->once())
            ->method('with')
            ->with('user', [ 'id' => 1, 'name' => 'Alice' ])
            ->willReturnSelf();

        // Create a mock of the UserController
        $controllerMock = $this->getMockBuilder(UserController::class)
            ->onlyMethods(['view'])
            ->getMock();

        // Configure the controller mock to return the view mock when the view() method is called
        $controllerMock->expects($this->once())
            ->method('view')
            ->with('user.edit')
            ->willReturn($viewMock);

        // Inject the mock of the User model into the controller
        $controllerMock->user = $userModelMock;

        // Call the edit() method on the controller
        $result = $controllerMock->edit(1);

        // Assert that the result is the expected view
        $this->assertSame($viewMock, $result);
    }

    public function testDestroyMethod()
    {
        // Create a mock of the User model
        $userModelMock = $this->createMock(User::class);

        // Configure the mock to return a user when the find() method is called
        $userModelMock->expects($this->once())
            ->method('find')
            ->with(1)
            ->willReturn([
                'id' => 1,
                'name' => 'Alice',
            ]);

        // Configure the mock to return a user when the delete() method is called
        $userModelMock->expects($this->once())
            ->method('delete')
            ->willReturn(true);

        // Create a mock of the redirect
        $redirectMock = $this->createMock(\Illuminate\Routing\Redirector::class);

        // Configure the redirect mock to expect a call to the route() method with the correct data
        $redirectMock->expects($this->once())
            ->method('route')
            ->with('user.index')
            ->willReturnSelf();

        // Create a mock of the UserController
        $controllerMock = $this->getMockBuilder(UserController::class)
            ->onlyMethods(['redirect'])
            ->getMock();

        // Configure the controller mock to return the redirect mock when the redirect() method is called
        $controllerMock->expects($this->once())
            ->method('redirect')
            ->willReturn($redirectMock);

        // Inject the mock of the User model into the controller
        $controllerMock->user = $userModelMock;

        // Call the destroy() method on the controller
        $result = $controllerMock->destroy(1);

        // Assert that the result is the expected redirect
        $this->assertSame($redirectMock, $result);

    }


}
