<?php

namespace Tests\Feature\Tasks;

use App\Models\Task\Task;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    private const API_ENDPOINT = '/api/v1/tasks/';

    protected User $user;


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


    public function test_it_can_update_task_priority_only(): void
    {
        $task = $this->createUserTask([
            'title' => 'Old title',
            'priority' => 'low',
            'due_at' => '2026-02-20',
        ]);

        $response = $this->patchJson(self::API_ENDPOINT . $task->id, [
            'priority' => 'high',
        ]);

        $response->assertOk();
        $response->assertJsonPath('data.id', $task->id);
        $response->assertJsonPath('data.title', 'Old title');
        $response->assertJsonPath('data.priority', 'high');
        $response->assertJsonPath('data.due_at', '2026-02-20');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'priority' => 'high',
        ]);
    }

    public function test_it_validates_priority_on_update(): void
    {
        $task = $this->createUserTask();

        $response = $this->patchJson(self::API_ENDPOINT . $task->id, [
            'priority' => 'urgent',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['priority']);
    }

    public function test_it_rejects_empty_update_payload(): void
    {
        $task = $this->createUserTask();

        $response = $this->patchJson(self::API_ENDPOINT . $task->id, []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['payload']);
    }

    public function test_it_can_set_due_at_to_null(): void
    {
        $task = $this->createUserTask([
            'due_at' => '2026-02-20',
        ]);

        $response = $this->patchJson(self::API_ENDPOINT . $task->id, [
            'due_at' => null,
        ]);

        $response->assertOk();
        $response->assertJsonPath('data.due_at', null);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'due_at' => null,
        ]);
    }

    public function test_title_is_trimmed_on_update_by_model_mutator(): void
    {
        $task = $this->createUserTask([
            'title' => 'Old',
        ]);

        $response = $this->patchJson(self::API_ENDPOINT . $task->id, [
            'title' => '  New title  ',
        ]);

        $response->assertOk();
        $response->assertJsonPath('data.title', 'New title');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'New title',
        ]);
    }

    public function test_it_can_update_title_only(): void
    {
        $task = $this->createUserTask([
            'title' => 'Old title',
            'priority' => 'low',
        ]);
        
        $response = $this->patchJson(self::API_ENDPOINT . $task->id, [
            'title' => 'New title',
        ]);

        $response->assertOk();
        $response->assertJsonPath('data.title', 'New title');
        $response->assertJsonPath('data.priority', 'low');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'New title',
        ]);
    }

    public function test_it_can_update_due_at_only(): void
    {
        $task = $this->createUserTask([
            'due_at' => null,
        ]);

        $response = $this->patchJson(self::API_ENDPOINT . $task->id, [
            'due_at' => '2026-03-01',
        ]);

        $response->assertOk();
        $response->assertJsonPath('data.due_at', '2026-03-01');

        $task->refresh();

        $this->assertSame('2026-03-01', $task->due_at?->format('Y-m-d'));
    }

    public function test_it_validates_due_at_on_update(): void
    {
        $task = $this->createUserTask();
       
        $response = $this->patchJson(self::API_ENDPOINT . $task->id, [
            'due_at' => 'not-a-date',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['due_at']);
    }

    public function test_it_returns_404_when_task_does_not_exist(): void
    {
        $response = $this->patchJson(self::API_ENDPOINT . 999999, [
            'title' => 'Does not matter',
        ]);

        $response->assertStatus(404);
    }

    public function test_user_cannot_update_task_of_another_user(): void
    {
        $otherUser = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $response = $this->patchJson(self::API_ENDPOINT . $task->id, [
            'title' => 'Changed title',
        ]);

        $response->assertStatus(403);
    }
}
