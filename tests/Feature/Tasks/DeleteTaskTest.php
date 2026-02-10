<?php

namespace Tests\Feature\Tasks;

use App\Models\Task\Task;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
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

    public function test_user_can_delete_own_task(): void
    {
        $task = $this->createUserTask();

        $response = $this->deleteJson(self::API_ENDPOINT.$task->id);

        $response->assertNoContent();

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_user_cannot_delete_task_of_another_user(): void
    {
        $otherUser = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $response = $this->deleteJson(self::API_ENDPOINT.$task->id);

        $response->assertStatus(403);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_it_returns_404_when_task_does_not_exist(): void
    {
        $response = $this->deleteJson(self::API_ENDPOINT. 999999);

        $response->assertNotFound();
    }

    public function test_deleting_same_task_twice_returns_404(): void
    {
        $task = $this->createUserTask();

        $this->deleteJson(self::API_ENDPOINT.$task->id)->assertNoContent();
        $this->deleteJson(self::API_ENDPOINT.$task->id)->assertNotFound();
    }
}
