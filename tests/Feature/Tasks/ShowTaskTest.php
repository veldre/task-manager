<?php

namespace Tests\Feature\Tasks;

use App\Models\Task\Task;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowTaskTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    private const API_ENDPOINT = '/api/v1/tasks/';

    
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user, 'sanctum');
    }

    private function createUserTask(array $overrides = []): Task
    {
        return Task::factory()->create(array_merge([
            'user_id' => $this->user->id,
        ], $overrides));
    }

    
    public function test_user_can_view_own_task(): void
    {
        $task = $this->createUserTask();

        $response = $this->getJson(self::API_ENDPOINT . $task->id);

        $response->assertOk();
        $response->assertJsonPath('data.id', $task->id);
        $response->assertJsonPath('data.title', $task->title);
        $response->assertJsonPath('data.priority', $task->priority);
    }

    public function test_user_cannot_view_task_of_another_user(): void
    {
        $otherUser = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $response = $this->getJson(self::API_ENDPOINT . $task->id);

        $response->assertStatus(403);
    }

    public function test_it_returns_404_when_task_does_not_exist(): void
    {
        $response = $this->getJson(self::API_ENDPOINT . 999999);

        $response->assertStatus(404);
    }
}
