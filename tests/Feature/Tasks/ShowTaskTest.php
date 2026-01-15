<?php

namespace Tests\Feature\Tasks;

use Tests\TestCase;
use App\Models\Task\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTaskTest extends TestCase
{
    use RefreshDatabase;


    public function test_it_can_show_task(): void
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/v1/tasks/{$task->id}");

        $response->assertOk();

        $response->assertJsonPath('data.id', $task->id);
        $response->assertJsonPath('data.title', $task->title);
        $response->assertJsonPath('data.priority', $task->priority);
    }
}
