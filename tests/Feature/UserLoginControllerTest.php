<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class UserLoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login method succeed
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $user = factory(User::class)->create(['email' => 'test@test.se']);
        $response = $this->actingAs($user)
        ->withSession(['email' => $user->email])
        ->json('GET', '/login');

        $response->assertStatus(302);
        $response->assertLocation('http://localhost');
    }

            /**
     * Test register method succeeds on
     * filling correct input data
     *
     * @return void
     */
    public function testLoginFail()
    {
        $userRegister = [
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password' => 'passwordwith8characters',
            'password_confirmation' => 'passwordwith8characters'
        ];

        $response = $this->json('POST', '/register', $userRegister);

        Auth::logout();

        $userLogin = [
            'email' => 'johndoe@test.com',
            'password' => 'newPassthatdoesnotexist',
        ];

        $response = $this->json('POST', '/login', $userLogin);
        $response->assertStatus(422);
    }
}
