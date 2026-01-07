<?php

namespace Tests\Feature\Tasks;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_task(): void
    {
         $payload = [
            'title' => 'Buy milk',
            'priority' => 'high',
            'due_at' => now()->addDay()->toDateString(),
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'title' => 'Buy milk',
            'priority' => 'high',
        ]);
    }
}
