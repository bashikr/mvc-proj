<?php

namespace Tests\Feature;

use App\Todo;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreateATaskSuccess()
    {
        $user = factory(User::class)->create();

        $todo = [
            "title" => 'user1 with note3',
            "content" => 'content 3',
            "type" => 'text',
            "author_email" => $user->email,
            "author_name" => $user->name,
            "date" => '2022-01-27',
            "color" => '#00aabb',
        ];

        $response = $this->actingAs($user)
            ->json('POST', '/store-data', $todo);

        $response->assertStatus(302);

        $theNewlyCreatedTodo = [
            "title" => 'user1 with note3',
            "content" => 'content 3',
            "type" => 'text',
            "author_email" => $user->email,
            "author_name" => $user->name,
            "starts_at" => '2022-01-27',
            "color" => '#00aabb',
        ];
        $this->assertDatabaseHas('todos', $theNewlyCreatedTodo);
    }

    public function testCreateATaskFail()
    {
        $user = factory(User::class)->create();

        $todo = [
            "title" => 'user1 with note3',
            "content" => 'content 3',
            "type" => 'text',
            "author_email" => $user->email,
            "author_name" => $user->name,
            "color" => '#00aabb',
        ];

        $response = $this->actingAs($user)
            ->json('POST', '/store-data', $todo);

        $response->assertStatus(422);

        $theNewlyCreatedTodo = [
            "title" => 'user1 with note3',
            "content" => 'content 3',
            "type" => 'text',
            "author_email" => $user->email,
            "author_name" => $user->name,
            "starts_at" => '2022-01-27',
            "color" => '#00aabb',
        ];
        $this->assertDatabaseMissing('todos', $theNewlyCreatedTodo);
    }

    public function testShowUnauthorizedNote()
    {
        $note = factory(Todo::class)->create();

        $response = $this->get('/details/' . $note->id);

        $response->assertSee($note->title)
            ->assertSee($note->description);

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->json('GET', '/details/' . $note->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');

    }

    public function testShowAnAuthorizedNote()
    {

        $user = factory(User::class)->create();

        $note = factory(Todo::class)->create(['author_email' => $user->email]);

        $response = $this->actingAs($user)
            ->withSession(['email' => $user->email])
            ->json('GET', '/details/' . $note->id);

        $response->assertViewIs('todos.details');
    }

    public function testNotLoggedInWhenNavigatingToGridRoute()
    {
        $response = $this->get('/grid');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function testDeleteANote()
    {
        $user = factory(User::class)->create();

        $note1 = factory(Todo::class)->create();

        $response = $this->actingAs($user)->json('GET', '/delete/' . $note1->id . '/home');

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $note2 = factory(Todo::class)->create();
        $response = $this->actingAs($user)->json('GET', '/delete/' . $note2->id . '/test');

        $response->assertStatus(302);
        $response->assertRedirect('/');

        $note3 = factory(Todo::class)->create();

        $response = $this->actingAs($user)->json('GET', '/delete/' . $note3->id . '/grid');

        $response->assertStatus(302);
        $response->assertRedirect('/grid');
    }

    public function testEditWithUnauthorizedCredentials()
    {
        $user = factory(User::class)->create();

        $note1 = factory(Todo::class)->create();

        $response = $this->actingAs($user)->json('GET', '/edit/' . $note1->id);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function testEditWithAnAuthorizedCredentials()
    {

        $user = factory(User::class)->create();

        $note = factory(Todo::class)->create(['author_email' => $user->email]);

        $response = $this->actingAs($user)
            ->withSession(['email' => $user->email])
            ->json('GET', '/edit/' . $note->id);

        $response->assertViewIs('todos.edit');
    }

    public function testUpdateWithAnAuthorizedCredentials()
    {
        $user = factory(User::class)->create();

        $note = factory(Todo::class)->create(
            [
                'title' => 'test1',
                "content" => 'content 3',
                "type" => 'text',
                "author_email" => $user->email,
                "author_name" => $user->name,
                "starts_at" => '2022-01-27',
                "color" => '#00aabb',
            ]
        );

        $todo = [
            'id' => $note->id,
            "title" => 'test2',
            "content" => 'content 3',
            "date" => '2022-01-27',
            "color" => '#00aabb',
        ];

        $response = $this->actingAs($user)
            ->withSession(['email' => $user->email])
            ->json('POST', '/edit/update/', $todo);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function testUpdateThrowsExceptionOnMissingPostFormFields()
    {
        $user = factory(User::class)->create();

        $note = factory(Todo::class)->create([
            'title' => 'test1',
            "content" => 'content 3',
            "type" => 'text',
            "author_email" => $user->email,
            "author_name" => $user->name,
            "starts_at" => '2022-01-27',
            "color" => '#00aabb',
        ]
        );

        $todo = [
            'id' => $note->id,
            "title" => 'test2',
            "content" => 'content 3',
            "color" => '#00aabb',
        ];

        $response = $this->actingAs($user)
            ->withSession(['email' => $user->email])
            ->json('POST', '/edit/update/', $todo);

        $response->assertStatus(422);
    }
}
