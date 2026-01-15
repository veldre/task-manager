<?php

namespace Tests\Feature\Tasks;

use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_delete_a_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/v1/tasks/{$task->id}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }

    public function test_it_returns_404_when_task_does_not_exist(): void
    {
        $response = $this->deleteJson('/api/v1/tasks/999999');

        $response->assertNotFound();
    }

    public function test_deleting_same_task_twice_returns_404(): void
    {
        $task = Task::factory()->create();

        $this->deleteJson("/api/v1/tasks/{$task->id}")->assertNoContent();
        $this->deleteJson("/api/v1/tasks/{$task->id}")->assertNotFound();
    }

}
