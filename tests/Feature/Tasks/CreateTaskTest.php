<?php

namespace Tests\Feature\Tasks;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    private const API_ENDPOINT = '/api/v1/tasks';

    
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user, 'sanctum');
    }

    public function test_it_can_create_task(): void
    {
        $payload = [
            'title' => 'Buy milk',
            'priority' => 'high',
            'due_at' => now()->addDay()->toDateString(),
        ];

        $response = $this->postJson(self::API_ENDPOINT, $payload);

        $response->assertCreated();

        $response->assertJsonPath('data.title', $payload['title']);
        $response->assertJsonPath('data.priority', $payload['priority']);
        $response->assertJsonPath('data.due_at', $payload['due_at']);

        $this->assertNotNull($response->json('data.id'));

        $this->assertDatabaseHas('tasks', [
            'user_id' => $this->user->id,
            'title' => $payload['title'],
            'priority' => $payload['priority'],
            'due_at' => $payload['due_at'] . ' 00:00:00',
        ]);
    }
}
