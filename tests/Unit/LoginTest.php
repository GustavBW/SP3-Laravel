<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function failed_login_redirects_back_with_error(){

        // Create a user manually
        $user = new User([
            'name' => 'john',
            'password' => Hash::make('password'),
        ]);
        $user->save();

        // Simulate a login request with an incorrect password
        $response = $this->post('/login', [
            'name' => $user->name,
            'password' => 'invalid-password',
        ]);

        // Assert that the user is not authenticated and the 
        //correct error message is returned
        $response->assertRedirect('/');
        $response->assertSessionHasErrors('name');
        $this->assertFalse(Auth::check());
    }

    public function successful_login_logs_in_and_remembers_user(){
        // Create a user manually
        $user = new User([
            'name' => 'john',
            'password' => Hash::make('password'),
        ]);
        $user->save();

        // Simulate a login request with the correct 
        //password and a "remember me" checkbox checked
        $response = $this->post('/login', [
            'name' => $user->name,
            'password' => 'password',
            'remember' => 'on',
        ]);

        // Assert that the user is authenticated and the 
        //"remember me" functionality is working as expected
        $response->assertRedirect('/');
        $this->assertTrue(Auth::check());
        $this->assertTrue(Auth::viaRemember());
    }

    public function show_method_renders_login_view(){
        // Simulate a GET request to the show method
        $response = $this->get('/login');

        // Assert that the login view is rendered
        $response->assertViewIs('login');
    }
    
    public function logout_method_logs_out_user_and_redirects_to_home(){
        // Create a user manually
        $user = new User([
            'name' => 'john',
            'password' => Hash::make('password'),
        ]);
        $user->save();

        // Log in the user
        Auth::login($user);

        // Simulate a GET request to the logout method
        $response = $this->get('/logout');

        // Assert that the user is logged out and redirected to the home route
        $this->assertFalse(Auth::check());
        $response->assertRedirect('/');
    }
}
