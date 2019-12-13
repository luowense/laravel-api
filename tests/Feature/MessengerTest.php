<?php

namespace Tests\Feature;

use App\Message;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessengerTest extends TestCase
{
    public function testsMessagesAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'body' => 'Ipsum',
            'user_id' => 1
        ];

        $this->json('POST', '/api/messages', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'body' => 'Ipsum', 'user_id' => 1]);
    }

    public function testsMessagesAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $message = factory(Message::class)->create([
            'body' => 'First Body',
            'user_id' => 1
        ]);

        $payload = [
            'body' => 'Ipsum',
            'user_id' => 1
        ];

        $message = $this->json('PUT', '/api/messages/' . $message->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'body' => 'Ipsum',
                'user_id' => 1
            ]);
    }

    public function testsMessagesAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $message = factory(Message::class)->create([
            'body' => 'First Body',
            'user_id' => 1
        ]);

        $this->json('DELETE', '/api/messages/' . $message->id, [], $headers)
            ->assertStatus(204);
    }

    public function testMessagesAreListedCorrectly()
    {
        factory(Message::class)->create([
            'body' => 'First Body',
            'user_id' => 1

        ]);

        factory(Message::class)->create([
            'body' => 'Second Body',
            'user_id' => 1

        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/messages', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [ 'body' => 'First Body' ],
                [ 'body' => 'Second Body' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'body', 'user_id', 'created_at', 'updated_at'],
            ]);
    }
}
