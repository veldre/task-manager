<?php

namespace Tests\Feature\Tasks;

use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_update_task_priority_only(): void
    {
        $task = Task::factory()->create([
            'title' => 'Old title',
            'priority' => 'low',
            'due_at' => '2026-02-20',
        ]);

        $response = $this->patchJson("/api/v1/tasks/{$task->id}", [
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
        $task = Task::factory()->create();

        $response = $this->patchJson("/api/v1/tasks/{$task->id}", [
            'priority' => 'urgent',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['priority']);
    }

    public function test_it_rejects_empty_update_payload(): void
    {
        $task = Task::factory()->create();

        $response = $this->patchJson("/api/v1/tasks/{$task->id}", []);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['payload']);
    }

    public function test_it_can_set_due_at_to_null(): void
    {
        $task = Task::factory()->create([
            'due_at' => '2026-02-20',
        ]);

        $response = $this->patchJson("/api/v1/tasks/{$task->id}", [
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
        $task = Task::factory()->create([
            'title' => 'Old',
        ]);

        $response = $this->patchJson("/api/v1/tasks/{$task->id}", [
            'title' => '  New title  ',
        ]);

        $response->assertOk();
        $response->assertJsonPath('data.title', 'New title');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'New title',
        ]);
    }
}
