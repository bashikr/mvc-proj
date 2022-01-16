<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegisterControllerTest extends TestCase
{
    use RefreshDatabase;

        /**
     * Test register method succeeds on
     * filling correct input data
     *
     * @return void
     */
    public function testRegisterSuccess()
    {
        $user = [
            'name' => 'John Doe',
            'email' => 'johndoe@test.com',
            'password' => 'passwordwith8characters',
            'password_confirmation' => 'passwordwith8characters'
        ];

        $response = $this->json('POST', '/register', $user);

        $response->assertStatus(201);
    }

    /**
     * Test register method fails when
     * filling incorrect input data
     *
     * @return void
     */
    public function testRegisterFail()
    {
        $user = [
            'name' => 'John Doe',
            'email' => 'johndoe',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];

        $response = $this->json('POST', '/register', $user);

        $response->assertStatus(422);
    }
}
